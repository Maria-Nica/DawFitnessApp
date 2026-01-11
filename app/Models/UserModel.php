<?php
// /app/Models/UserModel.php

// Ensure the configuration settings are loaded
require_once __DIR__ . '/BaseModel.php';
require_once __DIR__ . '/../Core/AuthenticationInterface.php';
require_once __DIR__ . '/../Core/Exceptions/ValidationException.php';
require_once __DIR__ . '/../Core/Exceptions/DatabaseException.php';

class UserModel extends BaseModel implements AuthenticationInterface {

    public function __construct() {
        // Call parent constructor to establish database connection
        parent::__construct();
    }

    /**
     * Registers a new user in the database.
     * @param string $name
     * @param string $email
     * @param string $password
     * @return array Operation result (success, message, user_id)
     */
    public function createUser(string $name, string $email, string $password): array {

        // Email Format Validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException(
                "Invalid email format provided",
                'email',
                $email
            );
        }

        // Password Hashing and Role Assignment
        $password_hash_value = password_hash($password, PASSWORD_DEFAULT);
        $role_id = Config::DEFAULT_ROLE_ID;

        $sql = "INSERT INTO users (role_id, name, email, password_hash) VALUES (?, ?, ?, ?)";


        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("isss", $role_id, $name, $email, $password_hash_value);
            try {
                $stmt->execute();
                return [
                    'success' => true,
                    'message' => "Registration successful! Welcome, " . htmlspecialchars($name) . ".",
                    'user_id' => $this->db->insert_id
                ];
            } catch (mysqli_sql_exception $e) {
                // 1062 = Duplicate entry for unique key (email)
                if ($e->getCode() === 1062) {
                    throw new DatabaseException(
                        "Email address is already registered",
                        'INSERT',
                        null,
                        1062,
                        0,
                        $e
                    );
                } else {
                    throw new DatabaseException(
                        "Registration failed: " . $e->getMessage(),
                        'INSERT',
                        null,
                        $e->getCode(),
                        0,
                        $e
                    );
                }
            } finally {
                if (isset($stmt)) {
                    $stmt->close();
                }
            }
        } else {
             return ['success' => false, 'message' => "Database error: Could not prepare statement."];
        }
    }

    /**
     * Attempts to log in the user by verifying email and password.
     * @param string $email
     * @param string $password
     * @return array Operation result (success, message, user data)
     */
    public function verifyLogin(string $email, string $password): array {

        $sql = "SELECT user_id, name, email, role_id, password_hash FROM users WHERE email = ?";

        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("s", $email);

            try {
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows === 1) {
                    $user = $result->fetch_assoc();

                    if (password_verify($password, $user['password_hash'])) {
                        unset($user['password_hash']);
                        return [
                            'success' => true,
                            'message' => "Welcome back, " . $user['name'] . "!",
                            'user' => $user
                        ];
                    } else {
                        // Error: Incorrect password
                        return ['success' => false, 'message' => "Error: Invalid email or password."];
                    }
                } else {
                    // Error: User not found
                    return ['success' => false, 'message' => "Error: Invalid email or password."];
                }
            } catch (mysqli_sql_exception $e) {
                return ['success' => false, 'message' => "Database error during login: " . $e->getMessage()];
            } finally {
                 if (isset($stmt)) {
                    $stmt->close();
                }
            }
        } else {
            return ['success' => false, 'message' => "Database error: Could not prepare statement."];
        }
    }

    /**
     * Get user role by user_id
     * @param int $user_id
     * @return string|null Role name or null if user not found
     */
    public function getUserRole(int $user_id): ?string {
        $sql = "SELECT r.name as role_name 
                FROM users u 
                INNER JOIN roles r ON u.role_id = r.role_id 
                WHERE u.user_id = ?";

        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $stmt->close();
                return $row['role_name'];
            }
            
            $stmt->close();
        }

        return null;
    }

    /**
     * Check if user is admin
     * @param int $user_id
     * @return bool True if user is admin, false otherwise
     */
    public function isAdmin(int $user_id): bool {
        $role = $this->getUserRole($user_id);
        return $role === 'admin';
    }
}