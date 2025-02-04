<?php
/**
 * MyClass Class Doc Comment
 * php version 8.3.15
 *
 * @category Class
 * @package  PHP
 * @author   Maciej Makar <maciej.makar@mail.bcu.ac.uk>
 * @author   Noraiz Ahmed <noraiz.ahmed@mail.bcu.ac.uk>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost/WAD/Signuplogin/Signuplogin.php
 */

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../db/db_config.php'; // Include database configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_or_username = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Use prepared statements to prevent SQL injection
    // also grab 'username' so we can store the actual username from DB in session
    $sql = "SELECT user_id, username, password FROM Users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ss", $email_or_username, $email_or_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the typed password against the hashed password in DB
        if (password_verify($password, $row['password'])) {
            // Store in session
            $_SESSION['user_id'] = $row['user_id'];

            // IMPORTANT: Store actual username from DB, not the typed email_or_username
            $_SESSION['username'] = $row['username'];

            // Redirect to Mealplanusehome.php on successful login
            header("Location: /WAD/Mealplanusehome.php");
            exit();
        } else {
            // Incorrect password
            echo "Invalid password.";
        }
    } else {
        // No user found with that email or username
        echo "No account found with that username or email.";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
