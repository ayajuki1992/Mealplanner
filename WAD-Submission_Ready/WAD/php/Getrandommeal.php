<?php
/**
 * MyClass Class Doc Comment
 * php version 8.3.15
 *
 * @category Class
 * @package  Php
 * @author   Maciej Makar <maciej.makar@mail.bcu.ac.uk>
 * @author   Noraiz Ahmed <noraiz.ahmed@mail.bcu.ac.uk>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost/WAD/Mealplanusehome.php
 */
session_start();
header('Content-Type: application/json'); // return JSON

// If not logged in, return an error or an empty JSON
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // Unauthorized
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

// Include DB config
require_once __DIR__ . '/../db/db_config.php';

// Retrieve the user's profile
$user_id = $_SESSION['user_id'];
$sqlProfile = "SELECT dietary_preferences, goal
            FROM profiles
            WHERE user_id = ?
            LIMIT 1";
$stmtProfile = $conn->prepare($sqlProfile);
$stmtProfile->bind_param("i", $user_id);
$stmtProfile->execute();
$resultProfile = $stmtProfile->get_result();
if ($resultProfile->num_rows === 0) {
    // No profile found for this user
    echo json_encode(["error" => "Profile not found"]);
    exit();
}
$profileData = $resultProfile->fetch_assoc();
$dietary_pref = $profileData['dietary_preferences']; // 'vegan' or 'non-vegan'
$goal_pref    = $profileData['goal'];               // 'gain' or 'loss'
$stmtProfile->close();

// Get the meal category from the frontend (breakfast, lunch, dinner)
$meal_category = $_GET['meal_category'] ?? 'breakfast'; 


$sqlMeals = "SELECT meal_name, recipe_link
            FROM Meals
            WHERE meal_category = ?
            AND meal_type = ?
            AND goal = ?
            ORDER BY RAND()
            LIMIT 1";

$stmtMeals = $conn->prepare($sqlMeals);
$stmtMeals->bind_param("sss", $meal_category, $dietary_pref, $goal_pref);
$stmtMeals->execute();
$resultMeals = $stmtMeals->get_result();

//  Return the meal if found
if ($row = $resultMeals->fetch_assoc()) {
    echo json_encode([
        "name"         => $row['meal_name'],
        "recipe_link"  => $row['recipe_link']
    ]);
} else {
    // No meals matching the filters
    echo json_encode([]);
}

$stmtMeals->close();
$conn->close();
