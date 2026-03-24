<?php
/*
    Author: Mareerose Possi
    Date: 23rd March 2026
    Unit: IS312 Web Application Development
    Description: PHP script to receive form data and insert a new program into the FRU10 database
*/

// Database connection settings
$host     = "localhost";
$user     = "root";
$password = "";
$database = "FRU10";

// Connect to MySQL database
$conn = mysqli_connect($host, $user, $password, $database);

// Check if connection was successful
if (!$conn) {
    die("<p style='color:red;'>Connection failed: " . mysqli_connect_error() . "</p>");
}

// Retrieve form data from POST and store in variables
$programCode = $_POST['programCode'];
$programName = $_POST['programName'];
$duration    = $_POST['duration'];
$faculty     = $_POST['faculty'];

// SQL INSERT statement to add the new program record
$sql = "INSERT INTO Program (ProgramCode, ProgramName, Duration, Faculty)
        VALUES ('$programCode', '$programName', '$duration', '$faculty')";

// Execute query and display success or error message
if (mysqli_query($conn, $sql)) {
    echo "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Success - FRU10</title>
        <style>
            body { font-family: Segoe UI, sans-serif; display:flex; justify-content:center; align-items:center; min-height:100vh; background:#f0f4f8; }
            .box { background:white; padding:40px 50px; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,0.1); text-align:center; }
            h2 { color: #27ae60; }
            a { display:inline-block; margin-top:20px; color:#2980b9; text-decoration:none; font-weight:600; }
            a:hover { text-decoration:underline; }
        </style>
    </head>
    <body>
        <div class='box'>
            <h2>✅ Program Added Successfully!</h2>
            <p>The program <strong>$programName ($programCode)</strong> has been added to the database.</p>
            <a href='index.html'>← Back to Home</a>
        </div>
    </body>
    </html>";
} else {
    echo "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Error - FRU10</title>
        <style>
            body { font-family: Segoe UI, sans-serif; display:flex; justify-content:center; align-items:center; min-height:100vh; background:#f0f4f8; }
            .box { background:white; padding:40px 50px; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,0.1); text-align:center; }
            h2 { color: #e74c3c; }
            a { display:inline-block; margin-top:20px; color:#2980b9; text-decoration:none; font-weight:600; }
            a:hover { text-decoration:underline; }
        </style>
    </head>
    <body>
        <div class='box'>
            <h2>❌ Error Adding Program</h2>
            <p>Error: " . mysqli_error($conn) . "</p>
            <a href='new-program.html'>← Try Again</a>
        </div>
    </body>
    </html>";
}

// Close the database connection
mysqli_close($conn);
?>
