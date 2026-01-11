<?php
// /app/Core/AuthenticationInterface.php

/**
 * Interface AuthenticationInterface
 * 
 * Defines the contract for authentication operations.
 * Any class implementing this interface must provide login, register, and logout functionality.
 */
interface AuthenticationInterface {
    
    /**
     * Authenticate a user with email and password
     * 
     * @param string $email User's email address
     * @param string $password User's password (plain text, will be hashed internally)
     * @return array Operation result with keys: success (bool), message (string), user (array|null)
     */
    public function verifyLogin(string $email, string $password): array;
    
    /**
     * Register a new user in the system
     * 
     * @param string $name User's full name
     * @param string $email User's email address
     * @param string $password User's password (plain text, will be hashed internally)
     * @return array Operation result with keys: success (bool), message (string), user_id (int|null)
     */
    public function createUser(string $name, string $email, string $password): array;
    
    /**
     * Check if a user is an administrator
     * 
     * @param int $user_id User's ID
     * @return bool True if user is admin, false otherwise
     */
    public function isAdmin(int $user_id): bool;
    
    /**
     * Get user's role name
     * 
     * @param int $user_id User's ID
     * @return string|null Role name or null if user not found
     */
    public function getUserRole(int $user_id): ?string;
}
