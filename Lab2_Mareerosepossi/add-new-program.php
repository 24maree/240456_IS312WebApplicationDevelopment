<?php
/*
    Author: Mareerose Possi
    Date: 19th March 2026
    Unit: IS312 Web Application Development
    Description: Retrieves program details submitted via POST from new-program.html,
                 then inserts them as a new record into the Program table in FRU10 database.
*/

// ============================================
// Database connection settings
// ============================================
$host     = "localhost";
$dbUser   = "root";       // Default XAMPP MySQL username
$dbPass   = "";           // Default XAMPP MySQL password (empty)
$dbName   = "FRU10";

// ============================================
// Step 1: Establish connection to the database
// ============================================
$conn = mysqli_connect($host, $dbUser, $dbPass, $dbName);

// Check if the connection was successful
if (!$conn) {
    die("<p style='color:red;'>Connection failed: " . mysqli_connect_error() . "</p>");
}

// ============================================
// Step 2: Retrieve and sanitize form data from POST
// ============================================
$programCode = trim($_POST['programCode']);
$programName = trim($_POST['programName']);
$duration    = trim($_POST['duration']);
$department  = trim($_POST['department']);

// ============================================
// Step 3: Validate that all fields are present
// ============================================
if (empty($programCode) || empty($programName) || empty($duration) || empty($department)) {
    echo "<p style='color:red;'>Error: All fields are required. Please go back and fill in all fields.</p>";
    echo "<a href='new-program.html'>Go Back</a>";
    exit();
}

// ============================================
// Step 4: Build and execute the SQL INSERT statement
// ============================================
$sql = "INSERT INTO Program (ProgramCode, ProgramName, Duration, Department)
        VALUES ('$programCode', '$programName', '$duration', '$department')";

if (mysqli_query($conn, $sql)) {
    // Success message
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <title>Program Added - FRU10</title>
        <style>
            body { font-family: Arial, sans-serif; background-color: #f0f4f8; text-align: center; padding: 80px; }
            .box { background: white; display: inline-block; padding: 40px 50px; border-radius: 10px;
                   box-shadow: 0 4px 14px rgba(0,0,0,0.1); }
            h2 { color: #27ae60; }
            p  { color: #555; }
            a  { color: #2980b9; text-decoration: none; font-size: 15px; }
            a:hover { text-decoration: underline; }
        </style>
    </head>
    <body>
        <div class='box'>
            <h2>&#10003; Program Added Successfully!</h2>
            <p>The program <strong>" . htmlspecialchars($programName) . "</strong>
               (" . htmlspecialchars($programCode) . ") has been added to the database.</p>
            <a href='new-program.html'>Add Another Program</a> &nbsp;|&nbsp;
            <a href='index.html'>Back to Home</a>
        </div>
    </body>
    </html>";
} else {
    // Error message if INSERT fails (e.g., duplicate ProgramCode)
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <title>Error - FRU10</title>
        <style>
            body { font-family: Arial, sans-serif; background-color: #f0f4f8; text-align: center; padding: 80px; }
            .box { background: white; display: inline-block; padding: 40px 50px; border-radius: 10px;
                   box-shadow: 0 4px 14px rgba(0,0,0,0.1); }
            h2 { color: #e74c3c; }
            p  { color: #555; }
            a  { color: #2980b9; text-decoration: none; font-size: 15px; }
            a:hover { text-decoration: underline; }
        </style>
    </head>
    <body>
        <div class='box'>
            <h2>&#10007; Error Adding Program</h2>
            <p>" . mysqli_error($conn) . "</p>
            <a href='new-program.html'>Go Back</a> &nbsp;|&nbsp;
            <a href='index.html'>Back to Home</a>
        </div>
    </body>
    </html>";
}

// ============================================
// Step 5: Close the database connection
// ============================================
mysqli_close($conn);
?>