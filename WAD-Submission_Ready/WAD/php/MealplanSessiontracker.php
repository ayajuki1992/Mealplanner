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

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: /WAD/Signuplogin/Signuplogin.php");
    exit;
}

require __DIR__ . '/../db/db_config.php';


// Fetch the user's details from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT username FROM Users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_name = $row['username'];
} else {
    // If no user found, clear session and redirect to login
    session_destroy();
    header("Location: /WAD/Signuplogin/Signuplogin.php");
    exit();
}

$user_name = $_SESSION['username'];
$stmt->close();
?>