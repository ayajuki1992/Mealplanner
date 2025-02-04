# Meal Planner Web Application

This web application is designed to provide personalized meal plans based on the user's preferences, dietary requirements, and fitness goals (e.g., gaining mass, losing weight). Additionally, the app allows users to log their weight and track it over time for better fitness progress monitoring.

## Features

- **Personalized Meal Plans:** Tailored meal suggestions based on user goals (e.g., weight loss, muscle gain).
- **Weight Tracking:** Users can log their weight and view progress over time.
- **Database Integration:** SQL database included, ready to import into PHPMyAdmin for easy data management.
- **Database Structure:** ERM (Entity Relationship Model) included for easy visualization of the database schema.

## Requirements

- **XAMPP 8.0.28** (for working on macOS or use the equivalent for other operating systems)
- **PHP 8.0.28** (included with XAMPP)
- **MySQL/MariaDB** (database included)
- **PHPMyAdmin** (for importing the SQL database)

## Setup Instructions

1. **Clone the repository:**
   ```bash
   git clone https://github.com/yourusername/meal-planner.git
   ```
   
2. **Install XAMPP (if not installed already):**
   Download and install [XAMPP](https://www.apachefriends.org/index.html) 8.0.28 for macOS.

3. **Set up the database:**
   - Open XAMPP Control Panel and start Apache and MySQL.
   - Go to [PHPMyAdmin](http://localhost/phpmyadmin) in your browser.
   - Import the SQL database file (`database.sql`) provided in the `sql` folder of this repository.

4. **Configure header files (if necessary):**
   Ensure the paths to header files are correct. The paths are relative and should work with proper setup.

5. **Access the application:**
   Once the database is imported and the server is running, open the application by visiting:
   ```text
   http://localhost/meal-planner
   ```

## Database Structure

An ERM (Entity Relationship Model) diagram is provided to illustrate the database schema. You can view it in the `ERM` folder for a better understanding of the database structure.

## Notes

- This application has been tested on macOS using XAMPP 8.0.28.
- Header files should be set correctly for a working configuration on this setup. Paths are relative to the directory structure.

## Contributing

This is just a university project for one of my modules, feel free to take parts and use them to assist in your work (don't get done for plagarism, dont be a fool)

If you want to tell me how something could have been done better, or if I've commited some cardinal sin, my contact details are on my page. I probably won't update but I will apprecite the lesson.
