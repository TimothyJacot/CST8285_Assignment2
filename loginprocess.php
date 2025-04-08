<?php
//database connection settings
$servername = "localhost";  
$username = "root";         
$password = "";             
$database = "cst8285_assignment2"; 

//get form data
$User_Name = $_POST['User_Name'] ?? '';
$User_Password = $_POST['User_Password'] ?? '';
$User_Email = $_POST['User_Email'] ?? '';
$User_PhoneNumber = $_POST['User_PhoneNumber'] ?? '';

//check if fields are empty
if (empty($User_Name) || empty($User_Password) || empty($User_Email) || empty($User_PhoneNumber)) {
    die("Error: Missing form data.");
}

//create connection
$conn = new mysqli($servername, $username, $password, $database);

//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//prepare SQL statement using prepared statements
$stmt = $conn->prepare("INSERT INTO users (User_Name, User_Password, User_Email, User_PhoneNumber) VALUES (?, ?, ?, ?)");

if ($stmt) {
    $stmt->bind_param("ssss", $User_Name, $User_Password, $User_Email, $User_PhoneNumber);
    if ($stmt->execute()) {
        header("Location: allevents.php");
    exit(); 
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
