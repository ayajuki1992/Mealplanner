<?php

/**
 * Database configuration file
 *
 * PHP version 8.3.15
 *
 * @category Configuration
 * @package  Php
 * @author   Maciej Makar<maciej.makar@mail.bcu.ac.uk >
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     #
 */

// Database credentials
$servername = "localhost";
$username = "root";
$password = "rootpass";
$dbname = "mealplanner";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for any connection errors
if ($conn->connect_error) {
    // If the connection fails, display an error and exit
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8 to prevent encoding issues
$conn->set_charset("utf8");

?>