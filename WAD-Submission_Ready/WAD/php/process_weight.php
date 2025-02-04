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

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Signuplogin/Signuplogin.php");
    exit();
}

require_once __DIR__ . '/../db/db_config.php';

$user_id      = $_SESSION['user_id'];
$new_weight   = (float)($_POST['current_weight'] ?? 0);
$report_date  = $_POST['weight_date'] ?? date('Y-m-d');

// Get the user's current weight from Profiles table
$sqlProfile = "SELECT weight FROM Profiles WHERE user_id = ?";
$stmtProfile = $conn->prepare($sqlProfile);
$stmtProfile->bind_param("i", $user_id);
$stmtProfile->execute();
$resultProfile = $stmtProfile->get_result();

if ($rowProfile = $resultProfile->fetch_assoc()) {
    $current_profile_weight = (float)$rowProfile['weight'];
} else {
    // Fallback if no profile found (*probably* never gonna happen)
    $current_profile_weight = $new_weight;
}
$stmtProfile->close();

//  Insert new row in progress_report
//    initial_weight = current profile weight
//    final_weight   = new logged wheight
$sqlInsert = "INSERT INTO progressreports (
user_id, report_month, initial_weight, final_weight, goals_met
) VALUES (?, ?, ?, ?, 0)";

$stmtInsert = $conn->prepare($sqlInsert);
$stmtInsert->bind_param("isss", 
    $user_id, 
    $report_date, 
    $current_profile_weight,
    $new_weight
);

if (!$stmtInsert->execute()) {
    echo "Error inserting progress row: " . $conn->error;
    exit();
}
$stmtInsert->close();

// Update profile weight to new weight
$sqlUpdate = "UPDATE Profiles SET weight = ? WHERE user_id = ?";
$stmtUpdate = $conn->prepare($sqlUpdate);
$stmtUpdate->bind_param("di", $new_weight, $user_id);

if (!$stmtUpdate->execute()) {
    echo "Error updating profile weight: " . $conn->error;
    exit();
}
$stmtUpdate->close();

$conn->close();

// Redirect or show success message
header("Location: ../Mealplanusehome.php?msg=weight_logged");
exit();
