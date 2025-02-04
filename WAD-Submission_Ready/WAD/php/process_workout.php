<?php
/**
 * MyClass Class Doc Comment
 * php version 8.3.15
 *
 * @category Class
 * @package  Php
 * @author   Noraiz Ahmed <noraiz.ahmed@mail.bcu.ac.uk>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost/WAD/logworkoutdetails/logworkoutdetails.html
 */
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Signuplogin/Signuplogin.php");
    exit();
}
// Include DB conf
require_once __DIR__ . '/../db/db_config.php';

// Get all form data needed
$workout_type    = $_POST['workout_type'] ?? '';
$calories_burned = (int)($_POST['calories_burned'] ?? 0);
$workout_date    = $_POST['workout_date'] ?? date('Y-m-d');
$user_id         = $_SESSION['user_id'];

//Insert into the 'workouts' table 
$sql = "INSERT INTO workouts (user_id, workout_type, calories_burned, workout_date)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param("isis", $user_id, $workout_type, $calories_burned, $workout_date);

if ($stmt->execute()) {
    // Redirect on success or show a success message
    header("Location: ../Mealplanusehome.php?msg=workout_logged");
    exit();
} else {
    echo "Error logging workout: " . $conn->error;
}

$stmt->close();
$conn->close();
