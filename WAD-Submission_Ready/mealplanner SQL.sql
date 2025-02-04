-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2025 at 04:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12
-- Group Members - Noraiz Ahmed, Maciej Makar, Assad ALi, Umar Shafiq
-- Completed by Noraiz Ahmed

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mealplanner`
--
-- Create and switch to the mealplanner database
Create DATABASE mealplanner;
USE mealplanner;

-- --------------------------------------------------------
--
-- Table structure for table `meals`
--
-- The `meals` table stores various recipes:
--   - meal_name, recipe_link: the recipe details
--   - meal_type: 'vegan' or 'non-vegan'
--   - goal: 'gain' or 'loss'
--   - meal_category: 'breakfast', 'lunch', or 'dinner'
-- This allows filtering meals by dietary preference, goal type, and category.

CREATE TABLE `meals` (
  `meal_id` int(11) NOT NULL,
  `meal_name` varchar(255) NOT NULL,
  `recipe_link` varchar(255) NOT NULL,
  `meal_type` enum('vegan','non-vegan') NOT NULL,
  `goal` enum('gain','loss') NOT NULL,
  `meal_category` enum('breakfast','lunch','dinner') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meals`
-- This includes all sample meals covering different preferences and goals
INSERT INTO `meals` (`meal_id`, `meal_name`, `recipe_link`, `meal_type`, `goal`, `meal_category`) VALUES
(1, 'Avocado Toast', 'https://www.bbcgoodfood.com/recipes/avocado-toast', 'vegan', 'gain', 'breakfast'),
(2, 'vegan pancakes', 'https://www.bbcgoodfood.com/recipes/easy-vegan-pancakes', 'vegan', 'gain', 'breakfast'),
(3, 'Chia & almond overnight oats', 'https://www.bbcgoodfood.com/recipes/chia-almond-overnight-oats', 'vegan', 'gain', 'breakfast'),
(4, 'California quinoa & avocado salad', 'https://www.bbcgoodfood.com/recipes/california-quinoa-avocado-salad', 'vegan', 'gain', 'lunch'),
(5, 'Peanut Butter & Dark Chocolate Banana Bread', 'https://www.bbcgoodfood.com/user/12262536/recipe/peanut-butter-dark-chocolate-banana-bread', 'vegan', 'gain', 'lunch'),
(6, 'Sweet potato & cauliflower lentil bowl', 'https://www.bbcgoodfood.com/recipes/sweet-potato-cauliflower-lentil-bowl', 'vegan', 'gain', 'lunch'),
(7, 'Vegan mushroom stroganoff', 'https://www.bbcgoodfood.com/recipes/vegan-mushroom-stroganoff', 'vegan', 'gain', 'dinner'),
(8, 'Sweet Potato & Black Bean Chili', 'https://www.bbcgoodfood.com/recipes/sweet-potato-black-bean-chilli-zesty-quinoa', 'vegan', 'gain', 'dinner'),
(9, 'Jackfruit bolognese', 'https://www.bbcgoodfood.com/recipes/jackfruit-bolognese-vegan-parmesan', 'vegan', 'gain', 'dinner'),
(10, 'Vegan baked oats', 'https://www.bbcgoodfood.com/recipes/vegan-almond-berry-baked-oats', 'vegan', 'loss', 'breakfast'),
(11, 'Green smoothie bowl', 'https://www.bbcgoodfood.com/recipes/green-goddess-smoothie-bowl', 'vegan', 'loss', 'breakfast'),
(12, 'Overnight oats with apricots & yogurt', 'https://www.bbcgoodfood.com/recipes/overnight-oats-with-apricots-yogurt', 'vegan', 'loss', 'breakfast'),
(13, 'Breakfast peppers & chickpeas with tofu', 'https://www.bbcgoodfood.com/recipes/breakfast-peppers-chickpeas-with-tofu', 'vegan', 'loss', 'lunch'),
(14, 'Slow cooker breakfast beans', 'https://www.bbcgoodfood.com/recipes/slow-cooker-breakfast-beans', 'vegan', 'loss', 'lunch'),
(15, 'Lentil soup', 'https://www.bbcgoodfood.com/recipes/spinach-sweet-potato-lentil-dhal', 'vegan', 'loss', 'lunch'),
(16, 'Veggie curry', 'https://www.bbcgoodfood.com/recipes/air-fryer-veggie-curry', 'vegan', 'loss', 'dinner'),
(17, 'Vegan chickpea curry jacket potatoes', 'https://www.bbcgoodfood.com/recipes/vegan-chickpea-curry-jacket-potato', 'vegan', 'loss', 'dinner'),
(18, 'Tempeh stir-fry', 'https://www.bbcgoodfood.com/recipes/sticky-tempeh-stir-fry', 'vegan', 'loss', 'dinner'),
(19, 'smoked salmon & avocado toastie', 'https://www.bbcgoodfood.com/recipes/egg-hole-smoked-salmon-avocado-toastie', 'non-vegan', 'gain', 'breakfast'),
(20, 'Protein pancakes with banana', 'https://www.bbcgoodfood.com/recipes/protein-pancakes-with-banana', 'non-vegan', 'gain', 'breakfast'),
(21, 'Smoothie bowl', 'https://www.bbcgoodfood.com/recipes/smoothie-bowl', 'non-vegan', 'gain', 'breakfast'),
(22, 'Spicy chicken & avocado wraps', 'https://www.bbcgoodfood.com/recipes/spicy-chicken-avocado-wraps', 'non-vegan', 'gain', 'lunch'),
(23, 'Macaroni', 'https://www.bbcgoodfood.com/recipes/best-ever-macaroni-cheese-recipe', 'non-vegan', 'gain', 'lunch'),
(24, 'Chilli con carne', 'https://www.bbcgoodfood.com/recipes/chilli-con-carne-recipe', 'non-vegan', 'gain', 'lunch'),
(25, 'Steak & creamy mushroom sauce', 'https://www.bbcgoodfood.com/recipes/one-pan-sirloin-steak-creamy-mushroom-sauce', 'non-vegan', 'gain', 'dinner'),
(26, 'almon with Mashed Potatoes', 'https://www.bbcgoodfood.com/recipes/sesame-salmon-purple-sprouting-broccoli-sweet-potato-mash', 'non-vegan', 'gain', 'dinner'),
(27, 'Chicken Alfredo Pasta', 'https://www.bbcgoodfood.com/recipes/chicken-alfredo-pasta-bake', 'non-vegan', 'gain', 'dinner'),
(28, 'Scrambled eggs with basil, spinach & tomatoes', 'https://www.bbcgoodfood.com/recipes/basil-scramble-wilted-spinach-seared-tomatoes', 'non-vegan', 'loss', 'breakfast'),
(29, 'Indian chickpeas with poached eggs', 'https://www.bbcgoodfood.com/recipes/indian-chickpeas-poached-eggs', 'non-vegan', 'loss', 'breakfast'),
(30, 'Porridge with baked bananas', 'https://www.bbcgoodfood.com/recipes/cinnamon-porridge-with-baked-bananas', 'non-vegan', 'loss', 'breakfast'),
(31, 'Chicken satay salad', 'https://www.bbcgoodfood.com/recipes/chicken-satay-salad', 'non-vegan', 'loss', 'lunch'),
(32, 'Tuna wraps', 'https://www.bbcgoodfood.com/recipes/tuna-mayo-wraps', 'non-vegan', 'loss', 'lunch'),
(33, 'Spicy chicken & avocado wraps', 'https://www.bbcgoodfood.com/recipes/spicy-chicken-avocado-wraps', 'non-vegan', 'loss', 'lunch'),
(34, 'Teriyaki salmon', 'https://www.bbcgoodfood.com/recipes/teriyaki-salmon-sesame-pak-choi', 'non-vegan', 'loss', 'dinner'),
(35, 'Chicken noodle soup', 'https://www.bbcgoodfood.com/recipes/chicken-noodle-soup', 'non-vegan', 'loss', 'dinner'),
(36, 'Chicken & chorizo jambalaya', 'https://www.bbcgoodfood.com/recipes/chicken-chorizo-jambalaya', 'non-vegan', 'loss', 'dinner');


-- --------------------------------------------------------
--
-- Table structure for table `profiles`
--
-- 'profiles' adds extra info (age, gender, weight, goal, etc.) for each user.
-- Typically 1 user -> 1 profile. user_id references 'users' table.

CREATE TABLE `profiles` (
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `weight` float NOT NULL,
  `goal` enum('gain','loss') NOT NULL,
  `dietary_preferences` enum('vegan','non-vegan') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 

-- --------------------------------------------------------
--
-- Table structure for table `progressreports`
--
-- 'progressreports' tracks weight changes over time for each user.
-- user_id references 'users'. 1 user -> many progress reports.

CREATE TABLE `progressreports` (
  `report_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `report_month` date NOT NULL,
  `initial_weight` decimal(5,2) DEFAULT NULL,
  `final_weight` decimal(5,2) DEFAULT NULL,
  `goals_met` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 

-- --------------------------------------------------------
--
-- Table structure for table `users`
--
-- 'users' table for authentication (username, email, password).
-- Each user can have one profile and multiple reports, workouts.

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 

-- --------------------------------------------------------
--
-- Table structure for table `workouts`
--
-- 'workouts' records user workouts. user_id references 'users'.
-- 1 user -> many workouts. workout_date, type, calories_burned, etc.

CREATE TABLE `workouts` (
  `workout_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `workout_date` date NOT NULL,
  `workout_type` varchar(100) DEFAULT NULL,
  `calories_burned` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 

--
-- Indexes for dumped tables
--

-- Indexes for table `meals`
ALTER TABLE `meals`
  ADD PRIMARY KEY (`meal_id`);

-- Indexes for table `profiles`
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`profile_id`);

-- Indexes for table `progressreports`
ALTER TABLE `progressreports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `user_id` (`user_id`);

-- Indexes for table `users`
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

-- Indexes for table `workouts`
ALTER TABLE `workouts`
  ADD PRIMARY KEY (`workout_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

-- AUTO_INCREMENT for table `meals`
ALTER TABLE `meals`
  MODIFY `meal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

-- AUTO_INCREMENT for table `profiles`
ALTER TABLE `profiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

-- AUTO_INCREMENT for table `progressreports`
ALTER TABLE `progressreports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

-- AUTO_INCREMENT for table `users`
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

-- AUTO_INCREMENT for table `workouts`
ALTER TABLE `workouts`
  MODIFY `workout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
