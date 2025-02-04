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
 * @link     http://localhost/WAD/Mealplanusehome.php
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'php/MealplanSessiontracker.php'; // ensures session_start() + login check
require_once 'db/db_config.php'; // DB conf

// Mealplansessiontracker.php tracks the user's session ($_SESSION['username'])
$userGoal = isset($_SESSION['goal']) ? $_SESSION['goal'] : 'loss'; // default 'loss'
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Meal Planner</title>
  <link rel="stylesheet" href="Mealplanusehome.css">
  <!-- 1. Include Chart.js library from a CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<header>
  <div class="navigation">
    <div>
      <h1>Meal Planner</h1>
    </div>
    <div class="nav-links">
      <a href="/WAD/Mealplanusehome.php">Home</a>
      <a href="Support/Support.html">Support</a>
      <a href="logworkoutdetails/logworkoutdetails.html">Log</a>
      <a href="Changeuserdetails/changeuserdetails.php">Account settings</a>
      <a href="php/logout.php" onclick="return confirm('Are you sure you want to logout?');">Logout</a>
    </div>
  </div>
</header>

<div class="container">
  <!-- Greeting -->
  <h2>Welcome <?php echo htmlspecialchars($user_name); ?>!</h2>
  <h3>Today's delicious meals:</h3>

  <!-- Meals Container -->
  <div class="meals-container">
    <!-- BREAKFAST -->
    <div class="meal">
      <img src="Mealplanusehome/images/Breakfast-board28.jpg" alt="Breakfast">
      <h4>Breakfast</h4>
      <h4 class="meal-name" id="breakfast-name">...</h4>
      <button onclick="loadMeal('breakfast', 'breakfast-name', 'breakfast-recipe')">
        Change Breakfast
      </button>
      <button class="recipe-link" id="breakfast-recipe">...</button>
    </div>

    <!-- LUNCH -->
    <div class="meal">
      <img src="Mealplanusehome/images/budget-sunday-lunch-collection-2b94383.jpg" alt="Lunch">
      <h4>Lunch</h4>
      <h4 class="meal-name" id="lunch-name">...</h4>
      <button onclick="loadMeal('lunch', 'lunch-name', 'lunch-recipe')">
        Change Lunch
      </button>
      <button class="recipe-link" id="lunch-recipe">...</button>
    </div>

    <!-- DINNER -->
    <div class="meal">
      <img src="Mealplanusehome/images/The Therapeutic Power of Dinner Parties.jpg" alt="Dinner">
      <h4>Dinner</h4>
      <h4 class="meal-name" id="dinner-name">...</h4>
      <button onclick="loadMeal('dinner', 'dinner-name', 'dinner-recipe')">
        Change Dinner
      </button>
      <button class="recipe-link" id="dinner-recipe">...</button>
    </div>
  </div> <!-- .meals-container -->

  <!-- Quote Section -->
  <div class="quote">
    <p id="quote-text">Insert quote here</p>
    <p id="quote-author">QUOTER NAME</p>
    <img id="quote-image" alt="Quote Image">
  </div>

  <!-- Graph Section -->
  <div class="graph">
    <h3>Your Weight Progress</h3>
    <canvas id="weightChart" width="400" height="200"></canvas>
    <p id="motivationMessage" style="font-weight:bold; margin-top:10px;"></p>
  </div>
</div> <!-- .container -->

<footer>
  <p>&copy; 2025 Meal Planner</p>
</footer>

<!-- Existing meal + quote JS file -->
<script src="Mealplanusehome.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {


  // Fetch the user’s progress data from get_progress_data.php
  fetch('php/get_progress_data.php')
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not OK');
      }
      return response.json();
    })
    .then(data => {
      const messageElem = document.getElementById('motivationMessage');

      // If no data, user hasn't logged weight yet
      if (data.length === 0) {
        messageElem.textContent = 'No weight data logged yet.';
        return;
      }

      // Prepare chart labels (dates) and data (weights)
      const labels  = data.map(d => d.date);
      const weights = data.map(d => d.weight);

      // Compare first vs. last weight
      const startWeight = data[0].weight;
      const endWeight   = data[data.length - 1].weight;

      // Grab the userGoal from PHP session
      const userGoal = "<?php echo $userGoal; ?>"; // 'gain' or 'loss'

      if (userGoal === 'gain') {
        // User wants to gain weight
        if (endWeight > startWeight) {
          messageElem.textContent = "Keep it up! You're gaining weight!";
        } else {
          messageElem.textContent = "You're losing weight and need to improve!";
        }
      } else {
        // User wants to lose weight
        if (endWeight < startWeight) {
          messageElem.textContent = "Keep it up! You're losing weight!";
        } else {
          messageElem.textContent = "You're gaining weight and need to improve!";
        }
      }

      // Create the Chart.js line chart
      const ctx = document.getElementById('weightChart').getContext('2d');
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            label: 'Weight (kg)',
            data: weights,
            borderColor: 'blue',
            backgroundColor: 'rgba(0, 0, 255, 0.1)',
            fill: true,
            tension: 0.2
          }]
        },
        options: {
          responsive: true,
          scales: {
            x: {
              title: {
                display: true,
                text: 'Date'
              }
            },
            y: {
              title: {
                display: true,
                text: 'Weight (kg)'
              }
            }
          }
        }
      });
    })
    .catch(error => {
      console.error('Error loading weight chart:', error);
      document.getElementById('motivationMessage').textContent = 
        'Error loading chart data.';
    });
});
</script>
</body>
</html>
