<?php
$type     = 'mysql';            // Type of database
$server   = 'localhost';        // Server the database is on
$db       = 'luxury_watches';   // Name of the database
$port     = '3306';             // Port: 8889 for MAMP, 3306 for XAMPP
$charset  = 'utf8mb4';          // UTF-8 encoding

$username = 'root';             // Enter YOUR username here
$password = '';                 // Enter YOUR password here

$options  = [                                                       // PDO options
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// DO NOT CHANGE ANYTHING BENEATH THIS LINE
$dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset"; // Create DSN
try {
    $pdo = new PDO($dsn, $username, $password, $options);           // Create PDO object
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), $e->getCode());        // Re-throw exception
}