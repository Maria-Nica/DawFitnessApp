<?php
// Simple bootstrap for tests: ensure autoloading of app files
require_once __DIR__ . '/../app/Models/BaseModel.php';
require_once __DIR__ . '/../app/Models/UserModel.php';
require_once __DIR__ . '/../app/Models/RecipeModel.php';
require_once __DIR__ . '/../app/Core/config.php';
require_once __DIR__ . '/../app/Core/Exceptions/ValidationException.php';
require_once __DIR__ . '/../app/Core/Exceptions/DatabaseException.php';

// A small helper function to run raw queries for cleanup
function test_db_connect() {
    $mysqli = new mysqli(
        \Config::DB_SERVER,
        \Config::DB_USERNAME,
        \Config::DB_PASSWORD,
        \Config::DB_NAME
    );
    $mysqli->set_charset('utf8mb4');
    return $mysqli;
}
