<?php
// /app/Core/CSRF.php

class CSRF {
    // Token lifetime in seconds (optional)
    private const TOKEN_TTL = 3600; // 1 hour

    // Generate or return existing token
    public static function generateToken(): string {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION['csrf_token']) || !isset($_SESSION['csrf_token_time']) || (time() - $_SESSION['csrf_token_time']) > self::TOKEN_TTL) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            $_SESSION['csrf_token_time'] = time();
        }

        return $_SESSION['csrf_token'];
    }

    // Return HTML input field with token
    public static function getTokenInput(): string {
        $token = self::generateToken();
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
    }

    // Validate provided token
    public static function validateToken(?string $token): bool {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (empty($token) || !isset($_SESSION['csrf_token'])) {
            return false;
        }

        $valid = hash_equals($_SESSION['csrf_token'], $token);

        // Optionally regenerate after successful validation to mitigate replay
        if ($valid) {
            unset($_SESSION['csrf_token']);
            unset($_SESSION['csrf_token_time']);
        }

        return $valid;
    }

    // Helper to validate current request (POST)
    public static function validateRequest(): bool {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? null;
            return self::validateToken($token);
        }
        return true;
    }
}
