<?php
// /app/Core/Exceptions/DatabaseException.php

/**
 * DatabaseException
 * 
 * Custom exception thrown when database operations fail.
 * This exception wraps database-related errors and provides additional context
 * about what operation was being performed when the error occurred.
 * 
 * Examples of usage:
 * - Connection failures
 * - Query execution errors
 * - Duplicate key violations
 * - Foreign key constraint violations
 * - Prepared statement failures
 * 
 * @package Core\Exceptions
 */
class DatabaseException extends Exception {
    
    /**
     * SQL query that caused the exception (if applicable)
     * @var string|null
     */
    private $query;
    
    /**
     * Database operation type (e.g., 'INSERT', 'UPDATE', 'DELETE', 'SELECT')
     * @var string|null
     */
    private $operationType;
    
    /**
     * Original mysqli error code
     * @var int|null
     */
    private $dbErrorCode;
    
    /**
     * Constructor
     * 
     * @param string $message Error message describing the database failure
     * @param string|null $operationType Type of database operation that failed
     * @param string|null $query SQL query that caused the error (optional)
     * @param int|null $dbErrorCode Original database error code
     * @param int $code Exception code (default: 0)
     * @param Throwable|null $previous Previous exception for exception chaining
     */
    public function __construct(
        string $message = "Database operation failed",
        ?string $operationType = null,
        ?string $query = null,
        ?int $dbErrorCode = null,
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->operationType = $operationType;
        $this->query = $query;
        $this->dbErrorCode = $dbErrorCode;
    }
    
    /**
     * Get the SQL query that caused the exception
     * 
     * @return string|null
     */
    public function getQuery(): ?string {
        return $this->query;
    }
    
    /**
     * Get the type of database operation that failed
     * 
     * @return string|null
     */
    public function getOperationType(): ?string {
        return $this->operationType;
    }
    
    /**
     * Get the original database error code
     * 
     * @return int|null
     */
    public function getDbErrorCode(): ?int {
        return $this->dbErrorCode;
    }
    
    /**
     * Check if this is a duplicate key error
     * 
     * @return bool
     */
    public function isDuplicateKeyError(): bool {
        return $this->dbErrorCode === 1062;
    }
    
    /**
     * Check if this is a foreign key constraint error
     * 
     * @return bool
     */
    public function isForeignKeyError(): bool {
        return $this->dbErrorCode === 1451 || $this->dbErrorCode === 1452;
    }
    
    /**
     * Get formatted error message for display
     * 
     * @return string
     */
    public function getFormattedMessage(): string {
        $message = $this->getMessage();
        
        if ($this->operationType) {
            $message .= " (Operation: {$this->operationType})";
        }
        
        if ($this->dbErrorCode) {
            $message .= " [Error Code: {$this->dbErrorCode}]";
        }
        
        return $message;
    }
}
