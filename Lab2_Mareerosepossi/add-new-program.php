<?php
/*
    Author: Mareerose Possi
    Date: 23rd March 2026
    Unit: IS312 Web Application Development
    Description: PHP script to retrieve all students from FRU10 database and display in a table
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

// SQL SELECT query to retrieve all student records
$sql    = "SELECT StudentNo, Firstname, Lastname, Gender, ContactNo, ProgramCode FROM Student";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--
        Author: Mareerose Possi
        Date: 23rd March 2026
        Unit: IS312 Web Application Development
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Listing - FRU10</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            padding: 40px 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #2c3e50;
            font-size: 1.6rem;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #7f8c8d;
            font-size: 0.9rem;
            margin-bottom: 30px;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        thead {
            background-color: #2980b9;
            color: white;
        }

        thead th {
            padding: 12px 16px;
            text-align: left;
            font-weight: 600;
        }

        tbody tr {
            border-bottom: 1px solid #ecf0f1;
            transition: background-color 0.2s;
        }

        tbody tr:hover {
            background-color: #f5faff;
        }

        tbody td {
            padding: 11px 16px;
            color: #34495e;
        }

        .no-records {
            text-align: center;
            padding: 30px;
            color: #7f8c8d;
        }

        .back-link {
            display: inline-block;
            margin-top: 25px;
            color: #2980b9;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Student Listing</h1>
        <p class="subtitle">All enrolled students in the FRU10 database.</p>

        <!-- Display students in a table -->
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
                // Loop through each student record and display as a table row
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['StudentNo']   . "</td>";
                        echo "<td>" . $row['Firstname']   . "</td>";
                        echo "<td>" . $row['Lastname']    . "</td>";
                        echo "<td>" . $row['Gender']      . "</td>";
                        echo "<td>" . $row['ContactNo']   . "</td>";
                        echo "<td>" . $row['ProgramCode'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // Show message if no records found
                    echo "<tr><td colspan='6' class='no-records'>No student records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <a href="index.html" class="back-link">← Back to Home</a>
    </div>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
