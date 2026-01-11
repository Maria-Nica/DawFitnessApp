<?php
// /app/Models/BaseModel.php

require_once __DIR__ . '/../Core/config.php';

/**
 * Abstract Base Model Class
 * 
 * Provides common database connection functionality for all models.
 * This class implements the DRY (Don't Repeat Yourself) principle by centralizing
 * database connection logic that would otherwise be duplicated across multiple models.
 * 
 * All model classes should extend this base class to inherit database connectivity.
 */
abstract class BaseModel {
    
    /**
     * Database connection instance
     * @var mysqli
     */
    protected $db;
    
    /**
     * Constructor - Establishes database connection
     * 
     * Configures mysqli to throw exceptions on errors and creates a new database connection
     * using credentials from the Config class.
     * 
     * @throws mysqli_sql_exception If database connection fails
     */
    public function __construct() {
        // Configure mysqli to throw exceptions on errors instead of warnings/fatals
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        
        try {
            // Establish database connection using Config constants
            $this->db = new mysqli(
                Config::DB_SERVER,
                Config::DB_USERNAME,
                Config::DB_PASSWORD,
                Config::DB_NAME
            );
            
            // Set character set to UTF-8 for proper encoding
            $this->db->set_charset("utf8mb4");
            
        } catch (mysqli_sql_exception $e) {
            // Display user-friendly error message and halt execution
            echo "<h1>DATABASE CONNECTION ERROR: Could not connect to the database.</h1>";
            echo "<p>Please check your database configuration and ensure the database server is running.</p>";
            
            // Log error for debugging (in production, this should go to a log file)
            error_log("Database connection error: " . $e->getMessage());
            
            exit;
        }
    }
    
    /**
     * Get the database connection instance
     * 
     * @return mysqli Database connection object
     */
    protected function getConnection(): mysqli {
        return $this->db;
    }
    
    /**
     * Destructor - Closes database connection
     * 
     * Automatically called when the object is destroyed or script execution ends.
     * Ensures proper cleanup of database resources.
     */
    public function __destruct() {
        if (isset($this->db) && $this->db instanceof mysqli) {
            $this->db->close();
        }
    }
}
