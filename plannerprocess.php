<?php
// Database connection settings
$servername = "localhost";  
$username = "root";         
$password = "";             
$database = "cst8285_assignment2"; 

// Get form data
$Event_Name = $_POST['Event_Name'] ?? '';
$Event_Date = $_POST['Event_Date'] ?? '';
$Event_Location = $_POST['Event_Location'] ?? '';
$Event_Type = $_POST['Event_Type'] ?? '';

// Check if fields are empty
if (empty($Event_Name) || empty($Event_Date) || empty($Event_Location) || empty($Event_Type)) {
    die("Error: Missing form data.");
}

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement using prepared statements
$stmt = $conn->prepare("INSERT INTO events (Event_Name, Event_Date, Event_Location, Event_Type) VALUES (?, ?, ?, ?)");

if ($stmt) {
    $stmt->bind_param("ssss", $Event_Name, $Event_Date, $Event_Location, $Event_Type);
    if ($stmt->execute()) {
        echo "Registration successful.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

// Close connection
$conn->close();
?>
