<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database configuration
require_once 'db_config.php';

// Check the connection
if ($conn) {
    echo "Connection successful!";
} else {
    echo "Connection failed!";
}
?>
