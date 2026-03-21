<?php
/*
    Author: Mareerose Possi
    Date: 19th March 2026
    Unit: IS312 Web Application Development
    Description: Retrieves all student records from the Student table in the FRU10
                 database and displays them in a formatted HTML table.
*/

// ============================================
// Database connection settings
// ============================================
$host   = "localhost";
$dbUser = "root";    // Default XAMPP MySQL username
$dbPass = "";        // Default XAMPP MySQL password (empty)
$dbName = "FRU10";

// ============================================
// Step 1: Connect to the database
// ============================================
$conn = mysqli_connect($host, $dbUser, $dbPass, $dbName);

// Check connection
if (!$conn) {
    die("<p style='color:red;'>Connection failed: " . mysqli_connect_error() . "</p>");
}

// ============================================
// Step 2: Execute SELECT query to fetch all students
// ============================================
$sql    = "SELECT StudentNo, Firstname, Lastname, Gender, ContactNo, ProgramCode FROM Student";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Listing - FRU10</title>
    <style>
        /* General page styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
        }

        /* Header */
        header {
            background-color: #2c3e50;
            color: white;
            padding: 20px 40px;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 26px;
        }

        /* Content wrapper */
        .content {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        /* Table header row */
        thead tr {
            background-color: #2c3e50;
            color: white;
            text-align: left;
        }

        thead th {
            padding: 14px 16px;
            font-size: 14px;
        }

        /* Table data rows */
        tbody tr {
            border-bottom: 1px solid #ecf0f1;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        /* Alternate row shading for readability */
        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tbody tr:hover {
            background-color: #eaf4fb;
        }

        tbody td {
            padding: 12px 16px;
            font-size: 14px;
            color: #2c3e50;
        }

        /* No records message */
        .no-records {
            text-align: center;
            padding: 30px;
            color: #7f8c8d;
            font-size: 15px;
        }

        /* Navigation link */
        .nav-links {
            margin-top: 25px;
            font-size: 14px;
        }

        .nav-links a {
            color: #2980b9;
            text-decoration: none;
            margin-right: 15px;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 20px;
            color: #95a5a6;
            font-size: 13px;
            margin-top: 40px;
        }
    </style>
</head>
<body>

    <!-- Page header -->
    <header>
        <h1>FRU10 Student Management System</h1>
    </header>

    <div class="content">
        <h2>Student Listing</h2>

        <!-- Student table -->
        <table>
            <thead>
                <tr>
                    <th>StudentNo</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Gender</th>
                    <th>ContactNo</th>
                    <th>ProgramCode</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // ============================================
                // Step 3: Display rows if records were found
                // ============================================
                if ($result && mysqli_num_rows($result) > 0) {
                    // Loop through each student record and output a table row
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['StudentNo'])   . "</td>";
                        echo "<td>" . htmlspecialchars($row['Firstname'])   . "</td>";
                        echo "<td>" . htmlspecialchars($row['Lastname'])    . "</td>";
                        echo "<td>" . htmlspecialchars($row['Gender'])      . "</td>";
                        echo "<td>" . htmlspecialchars($row['ContactNo'])   . "</td>";
                        echo "<td>" . htmlspecialchars($row['ProgramCode']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // Display message if no student records exist
                    echo "<tr><td colspan='6' class='no-records'>No student records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Navigation links -->
        <div class="nav-links">
            <a href="new-program.html">&#43; Add New Program</a>
            <a href="index.html">&larr; Back to Home</a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 IS312 Web Application Development &mdash; Mareerose Possi</p>
    </footer>

</body>
</html>
<?php
// ============================================
// Step 4: Close the database connection
// ============================================
mysqli_close($conn);
?>