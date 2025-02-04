<?php
/**
 * Database configuration file
 *
 * PHP version 8.3.15
 *
 * @category Configuration
 * @package  MyPackage
 * @author   Maciej Makar<maciej.makar@mail.bcu.ac.uk >
 * @author   Noraiz Ahmed <noraiz.ahmed@mail.bcu.ac.uk>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost/WAD/Signuplogin/Signuplogin.php
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Start or resume session

//  Check if form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Include DB conf
    require_once __DIR__ . '/../db/db_config.php';

    // Retrieve and sanitize form inputs
    $username            = trim($_POST['username'] ?? '');
    $email               = trim($_POST['email'] ?? '');
    $rawPassword         = trim($_POST['password'] ?? '');
    $dietary_preferences = $_POST['dietary_preferences'] ?? 'non-vegan';
    // user selects "gain" or "loss" for profule table
    $goal                = $_POST['goal'] ?? 'loss';
    $weight              = (float)($_POST['weight'] ?? 0.0);

    // Basic validation
    if (empty($username) || empty($email) || empty($rawPassword)) {
        echo "All fields are required.";
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($rawPassword, PASSWORD_DEFAULT);

    // Check if the username or email already exists
    $checkQuery = "SELECT * FROM Users WHERE username = ? OR email = ?";
    $stmtCheck = $conn->prepare($checkQuery);
    if (!$stmtCheck) {
        die("Prepare failed: " . $conn->error);
    }
    $stmtCheck->bind_param("ss", $username, $email);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        echo "Username or email already exists. Please choose another.";
        $stmtCheck->close();
        $conn->close();
        exit();
    }
    $stmtCheck->close();

    //  Insert the new user into `Users`
    $insertUser = "INSERT INTO Users (username, email, password) VALUES (?, ?, ?)";
    $stmtUser = $conn->prepare($insertUser);
    if (!$stmtUser) {
        die("Prepare failed (Users): " . $conn->error);
    }
    $stmtUser->bind_param("sss", $username, $email, $hashedPassword);

    // Making sure the user is inserted before we insert into `Profiles`
    $sql_insert_profile = $conn->prepare(
        "INSERT INTO Profiles (user_id, dietary_preferences, goal, weight) 
        VALUES (?, ?, ?, ?)"
    );
    if (!$sql_insert_profile) {
        die("Prepare failed (Profiles): " . $conn->error);
    }

    if ($stmtUser->execute()) {
        // Sign-up successful: get newly created user_id
        $user_id = $conn->insert_id;

        // Insert into `Profiles`
        $sql_insert_profile->bind_param("issd", $user_id, $dietary_preferences, $goal, $weight);
        if (!$sql_insert_profile->execute()) {
            echo "Error inserting into Profiles: " . $conn->error;
            exit();
        }

        //  Insert an initial row in `progress_report` so we have a starting weight
        $reportDate    = date('Y-m-d');
        $sql_progress  = "INSERT INTO progressreports (
            user_id, report_month, initial_weight, final_weight, goals_met
        ) VALUES (?, ?, ?, ?, 0)";
        $stmtProgress = $conn->prepare($sql_progress);
        if (!$stmtProgress) {
            die("Prepare failed (progress_report): " . $conn->error);
        }
        // initial_weight = final_weight = sign-up weight
        $stmtProgress->bind_param("isss", $user_id, $reportDate, $weight, $weight);
        if (!$stmtProgress->execute()) {
            echo "Error inserting into progress_report: " . $conn->error;
            exit();
        }
        $stmtProgress->close();

        //  Storing goal in for messages about weight later
        $_SESSION['user_id']  = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['goal']     = $goal;   // 'gain' or 'loss'

        //  Redirect to mealplanusehome.php
        header("Location: /WAD/mealplanusehome.php");
        exit();
    } else {
        echo "Error inserting user into `Users`: " . $conn->error;
    }

    // Cleanup
    $stmtUser->close();
    $sql_insert_profile->close();
    $conn->close();

} else {
    // If accessed directly without POST, then GET OUT!!! (lol)
    header("Location: /WAD/Signuplogin/Signuplogin.php");
    exit();
}
