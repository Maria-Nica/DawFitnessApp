<?php

// /app/Controllers/UserController.php

// Ensure that UserModel and Config are available
require_once __DIR__ . '/../Models/UserModel.php';
require_once __DIR__ . '/../Core/config.php';
require_once __DIR__ . '/../Core/Exceptions/ValidationException.php';
require_once __DIR__ . '/../Core/Exceptions/DatabaseException.php';

class UserController {

    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }



    // =========================================================================
    // 1. LOGIN (NO AJAX) - Route POST 'user/login'
    // =========================================================================

    /**
     * Handles the direct login request.
     * Verifies credentials via the Model, sets the session, and redirects.
     */
    public function login(): void {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            $_SESSION['error'] = 'Invalid access method.';
            $this->redirectToHome();
            return;
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // 1. Call the Model for verification
        $result = $this->userModel->verifyLogin($email, $password);

        if ($result['success']) {
            // Login successful: set session variables
            $user = $result['user'];
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['role_id'] = $user['role_id'];
            // Use the Model's message or a default success message
            $_SESSION['success'] = $result['message'] ?? "Login successful! Welcome back.";
        } else {
            // Login failed: set error message
            $_SESSION['error'] = $result['message'] ?? "Login failed. Please check your email and password.";
        }

        // 2. Redirect to the home page
        $this->redirectToHome();
    }

    // =========================================================================
    // 2. REGISTER (NO AJAX) - Route POST 'user/register'
    // =========================================================================

    /**
     * Handles the direct registration request.
     * Creates a new user via the Model and redirects.
     */
    public function register(): void {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            $_SESSION['error'] = 'Invalid access method.';
            $this->redirectToHome();
            return;
        }

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // 1. Call the Model for creation - with exception handling
        try {
            $result = $this->userModel->createUser($name, $email, $password);
            
            // Registration successful: set session variables
            $_SESSION['user_id'] = $result['user_id'];
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;
            $_SESSION['role_id'] = Config::DEFAULT_ROLE_ID;
            $_SESSION['success'] = $result['message'] ?? "Registration successful! You are now logged in.";
            
        } catch (ValidationException $e) {
            // Validation error - user-friendly message
            $_SESSION['error'] = $e->getFormattedMessage();
            
        } catch (DatabaseException $e) {
            // Database error - check if it's duplicate email
            if ($e->isDuplicateKeyError()) {
                $_SESSION['error'] = "This email address is already registered. Please use a different email or try logging in.";
            } else {
                $_SESSION['error'] = "Registration failed due to a technical error. Please try again later.";
            }
            
        } catch (Exception $e) {
            // Generic error fallback
            $_SESSION['error'] = "An unexpected error occurred. Please try again.";
        }

        // 2. Redirect to the home page
        $this->redirectToHome();
    }

    // =========================================================================
    // 3. LOGOUT - Route GET 'logout'
    // =========================================================================

    /**
     * Destroys the session and redirects.
     */
    public function logout(): void {
        session_start();
        session_destroy();

        // Use a temporary session variable to display a success message after redirect
        // NOTE: This relies on the index.php script reading the message before a full session destroy
        $_SESSION['success'] = "You have been successfully logged out.";

        $this->redirectToHome();
    }

    // =========================================================================
    // 4. HELPER METHOD
    // =========================================================================

    /**
     * Helper to redirect the user to the home page.
     */
    private function redirectToHome(): void {
        // Use BASE_URL from Config (if defined) for the complete URL
        $url = defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/';

        header("Location: " . $url);
        exit;
    }
}