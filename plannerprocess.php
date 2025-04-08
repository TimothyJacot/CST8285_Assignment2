<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: eventplanner.html");
    exit();
}
//database connection settings
$servername = "localhost";  
$username = "root";         
$password = "";             
$database = "cst8285_assignment2"; 

//get form data
$Event_Name = $_POST['Event_Name'] ?? '';
$Event_Date = $_POST['Event_Date'] ?? '';
$Event_Location = $_POST['Event_Location'] ?? '';
$Event_Type = $_POST['Event_Type'] ?? '';

//check if fields are empty
if (empty($Event_Name) || empty($Event_Date) || empty($Event_Location) || empty($Event_Type)) {
    die("Error: Missing form data.");
}

//create connection
$conn = new mysqli($servername, $username, $password, $database);

//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//prepare SQL statement using prepared statements
$stmt = $conn->prepare("INSERT INTO events (Event_Name, Event_Date, Event_Location, Event_Type) VALUES (?, ?, ?, ?)");

if ($stmt) {
    $stmt->bind_param("ssss", $Event_Name, $Event_Date, $Event_Location, $Event_Type);
    if ($stmt->execute()) {
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Event Registration Successful</title>
            <link rel="stylesheet" href="stylesheet.css"> 
            <style>
                body {
                    font-family: Arial, sans-serif;
                    text-align: center;
                    background-color: #f4f4f4;
                    padding: 50px;
                }
                .confirmation-box {
                    background: white;
                    padding: 30px;
                    border-radius: 10px;
                    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                    max-width: 500px;
                    margin: auto;
                }
                h2 {
                    color: #28a745;
                }
                p {
                    font-size: 16px;
                    color: #333;
                }
                .btn {
                    display: inline-block;
                    margin-top: 20px;
                    padding: 10px 20px;
                    font-size: 16px;
                    color: white;
                    background: #007bff;
                    border: none;
                    border-radius: 5px;
                    text-decoration: none;
                }
                .btn:hover {
                    background: #0056b3;
                }
            </style>
        </head>
        <body>
            <div class="confirmation-box">
                <h2>Event Registered Successfully 🎉</h2>
                <p>Thank you for registering your event, <strong>' . htmlspecialchars($Event_Name) . '</strong>!</p>
                <p><strong>Event Date:</strong> ' . htmlspecialchars($Event_Date) . '</p>
                <p><strong>Location:</strong> ' . htmlspecialchars($Event_Location) . '</p>
                <p><strong>Type:</strong> ' . htmlspecialchars($Event_Type) . '</p>
                <a href="allevents.php" class="btn">Return to All events page</a>
                <a href="eventplanner.html" class="btn">Return to Event Registration page</a>
            </div>
        </body>
        </html>
        ';
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

//close connection
$conn->close();
?>
