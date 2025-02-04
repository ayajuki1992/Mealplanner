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
?>
<!doctype html>
<html lang="en">
  <head>
    <!--HTML Author Maciej Makar -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up or Login | Meal Planner</title>
    <link 
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
      rel="stylesheet" 
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" 
      crossorigin="anonymous"
    >
    <link rel="stylesheet" href="Signuplogin.css">
  </head>
  <body>
    <header class="header">
      <img src="Resources/MealPlannerLogoPNG.png" alt="MealPlanner Logo" class="logo">
      <nav class="nav">
        <a href="../Index/Index.html">Home</a>
        <a href="../Support/Support.html">Support</a>
        <a href="../Signuplogin/Signuplogin.php">Sign up or Login</a>
      </nav>
    </header>
    <main class="container form-container">
      <!-- Sign-Up Form -->
      <div class="form-card">
        <h2>Sign Up</h2>
        <form action="../php/signup.php" method="POST">
          <div class="mb-3">
            <label for="signupName" class="form-label">Full Name</label>
            <input 
              type="text" 
              class="form-control" 
              id="signupName" 
              name="username" 
              placeholder="Enter your full name" 
              required
            >
          </div>
          <div class="mb-3">
            <label for="signupEmail" class="form-label">Email address</label>
            <input 
              type="email" 
              class="form-control" 
              id="signupEmail" 
              name="email" 
              placeholder="Enter your email" 
              required
            >
          </div>
          <div class="mb-3">
            <label for="signupPassword" class="form-label">Password</label>
            <input 
              type="password" 
              class="form-control" 
              id="signupPassword" 
              name="password" 
              placeholder="Create a password" 
              required
            >
          </div>

          <!-- Dietary Preference -->
          <div class="mb-3">
            <label for="dietary_preferences" class="form-label">Dietary Preference</label>
            <select 
              id="dietary_preferences" 
              class="form-select" 
              name="dietary_preferences" 
              required
            >
              <option value="non-vegan">Non-Vegan</option>
              <option value="vegan">Vegan</option>
            </select>
          </div>

          <!-- Goal: Gain or Lose -->
          <div class="mb-3">
            <label for="goal" class="form-label">Goal</label>
            <select 
              id="goal" 
              class="form-select" 
              name="goal" 
              required
            >
              <!-- Display text is "Gain Weight," but the value stored is "gain" -->
              <option value="gain">Gain Weight</option>
              <!-- Display text is "Lose Weight," but value is "loss" -->
              <option value="loss">Lose Weight</option>
            </select>
          </div>

          <!-- Weight -->
          <div class="mb-3">
            <label for="weight" class="form-label">Weight (kg)</label>
            <input 
              type="number" 
              class="form-control" 
              id="weight" 
              name="weight" 
              placeholder="Enter your weight in kg" 
              step="0.1" 
              required
            >
          </div>

          <button 
            type="submit" 
            class="btn btn-success" 
            name="signup"
          >
            Sign Up
          </button>
        </form>
      </div>

      <!-- Login Form -->
      <div class="form-card">
        <h2>Login</h2>
        <form action="../php/login.php" method="POST">
          <div class="mb-3">
            <label for="loginEmailOrUsername" class="form-label">
              Email or Username
            </label>
            <input 
              type="text" 
              name="email" 
              class="form-control" 
              id="loginEmailOrUsername" 
              placeholder="Enter your email or username" 
              required
            >
          </div>
          <div class="mb-3">
            <label for="loginPassword" class="form-label">Password</label>
            <input 
              type="password" 
              name="password" 
              class="form-control" 
              id="loginPassword" 
              placeholder="Enter your password" 
              required
            >
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
        </form>
      </div>
    </main>
    <script 
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" 
      crossorigin="anonymous"
    ></script>
  </body>
</html>
