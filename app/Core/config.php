<?php
// /app/Core/config.php

/**
 * Global Configuration Settings for the application.
 */
class Config {
    // Database Credentials
    public const DB_SERVER = 'localhost';
    public const DB_USERNAME = 'root';
    public const DB_PASSWORD = '';
    public const DB_NAME = 'fitnessapp';

    // Application Settings
    public const DEFAULT_ROLE_ID = 1; // Default role ID for new users
    public const APP_NAME = 'Fitness Studio App';

    // Paths (if needed)
    public const BASE_URL = 'http://localhost/fitnessapp/public/';
}