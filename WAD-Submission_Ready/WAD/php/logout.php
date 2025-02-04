<?php

/**
 * MyClass Class Doc Comment
 * php version 8.3.15
 *
 * @category Class
 * @package  Php
 * @author   Maciej Makar <maciej.makar@mail.bcu.ac.uk>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost/WAD/Mealplanusehome.php
 */
session_start(); // Resume the session
session_destroy(); // Destroy all session data
header("Location: ../Signuplogin/Signuplogin.php"); // Redirect to login page
exit();
?>
