
<?php
/**
 * Database configuration file
 *
 * PHP version 8.3.15
 *
 * @category Configuration
 * @package  Changeuserdetails
 * @author   Noraiz Ahmed <noraiz.ahmed@mail.bcu.ac.uk>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost/WAD/Changeuserdetails/changeuserdetails.php
 */

require '../php/MealplanSessiontracker.php'; // ensures $_SESSION['username'] is set
require_once '../db/db_config.php';

// Grab username from session
$username = $_SESSION['username'] ?? '';

//  handle the update (email or password)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_type'])) {
    $updateType = $_POST['update_type'];   // "email" or "password"
    $newValue   = trim($_POST['new_value'] ?? '');

    if (!empty($newValue) && !empty($username)) {
        if ($updateType === 'email') {
            // Update email
            $sql = "UPDATE Users SET email = ? WHERE username = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("ss", $newValue, $username);
                $stmt->execute();
                $stmt->close();
            }
        } elseif ($updateType === 'password') {
            // Update password 
            $hashedPass = password_hash($newValue, PASSWORD_DEFAULT);
            $sql = "UPDATE Users SET password = ? WHERE username = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("ss", $hashedPass, $username);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    // Refresh to show updated data
    header("Location: changeuserdetails.php");
    exit();
}

//  Fetch current email 
$user_email = 'Unknown';
if (!empty($username)) {
    $sql = "SELECT email FROM Users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $row        = $result->fetch_assoc();
            $user_email = $row['email'];
        }
        $stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>User Settings</title>
  <link rel="stylesheet" href="changeruserdetails.css">
</head>
<body>
  <header>
    <div class="navigation">
      <div>
        <h1>Meal Planner</h1>
      </div>
      <div class="nav-links">
        <a href="/WAD/Mealplanusehome.php">Home</a>
        <a href="../Support/Support.html">Support</a>
        <a href="../Mealplanusehome.php">Profile Dashboard</a>
      </div>
    </div>
  </header>

  <div class="container settings-container">
    <h2>Changing user settings for: <?= htmlspecialchars($username) ?></h2>

    <!-- Current Email -->
    <div class="setting">
      <label>EMAIL: 
        <span id="user-email"><?= htmlspecialchars($user_email) ?></span>
      </label>
      <button onclick="changeSetting('email')">CHANGE</button>
    </div>

    <!-- Password -->
    <div class="setting">
      <label>PASSWORD: 
        <span id="user-password">********</span>
      </label>
      <button onclick="changeSetting('password')">CHANGE</button>
    </div>
  </div>

  <footer>
    <p>&copy; 2024 Meal Planner. All rights reserved.</p>
  </footer>

  <script>
    
    function changeSetting(settingType) {
      let newValue = prompt("Enter new " + settingType + ":");
      if (newValue !== null && newValue.trim() !== "") {
        const formData = new FormData();
        formData.append('update_type', settingType);
        formData.append('new_value', newValue);

        fetch('changeuserdetails.php', {
          method: 'POST',
          body: formData
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          // Reload the page to see updated data
          window.location.reload();
        })
        .catch(error => {
          console.error('Error updating ' + settingType + ':', error);
          alert('An error occurred while updating ' + settingType);
        });
      }
    }
  </script>
</body>
</html>
