<?php
// Database connection settings
$servername = "localhost";  
$username = "root";         
$password = "";             
$database = "cst8285_assignment2"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$eventname = $_POST['Event_Name'];
$eventdate = $_POST['Event_Date'];
$eventlocation = $_POST['Event_Location'];
$eventType = $_POST['Event_Type'];

// Prepare SQL statement
$sql = "INSERT INTO events (Event_Name, Event_Date, Event_Location, Event_Type) 
        VALUES ('$eventname', '$eventdate', '$eventlocation', '$eventType')";

// Execute query and check success
if ($conn->query($sql) === TRUE) {
    echo "Event Registered Successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
