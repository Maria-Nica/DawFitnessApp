<?php
// /app/Core/Exceptions/ValidationException.php

/**
 * ValidationException
 * 
 * Custom exception thrown when data validation fails.
 * This exception is used throughout the application to handle validation errors
 * such as invalid email formats, empty required fields, invalid data types, etc.
 * 
 * Examples of usage:
 * - Invalid email format
 * - Empty title or description fields
 * - Out of range numeric values
 * - Invalid date formats
 * 
 * @package Core\Exceptions
 */
class ValidationException extends Exception {
    
    /**
     * Field name that failed validation
     * @var string|null
     */
    private $fieldName;
    
    /**
     * Invalid value that was provided
     * @var mixed
     */
    private $invalidValue;
    
    /**
     * Constructor
     * 
     * @param string $message Error message describing the validation failure
     * @param string|null $fieldName Name of the field that failed validation
     * @param mixed $invalidValue The value that failed validation
     * @param int $code Exception code (default: 0)
     * @param Throwable|null $previous Previous exception for exception chaining
     */
    public function __construct(
        string $message = "Validation failed", 
        ?string $fieldName = null,
        $invalidValue = null,
        int $code = 0, 
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->fieldName = $fieldName;
        $this->invalidValue = $invalidValue;
    }
    
    /**
     * Get the field name that failed validation
     * 
     * @return string|null
     */
    public function getFieldName(): ?string {
        return $this->fieldName;
    }
    
    /**
     * Get the invalid value that was provided
     * 
     * @return mixed
     */
    public function getInvalidValue() {
        return $this->invalidValue;
    }
    
    /**
     * Get formatted error message for display
     * 
     * @return string
     */
    public function getFormattedMessage(): string {
        $message = $this->getMessage();
        
        if ($this->fieldName) {
            $message .= " (Field: {$this->fieldName})";
        }
        
        return $message;
    }
}
