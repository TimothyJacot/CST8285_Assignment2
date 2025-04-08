
<?php
session_start();
//database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "cst8285_assignment2";
//connecting to database
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//get form data
$User_Email = $_POST['User_Email'] ?? '';
$User_Password = $_POST['User_Password'] ?? '';
//error handling if fields are empty
if (empty($User_Email) || empty($User_Password)) {
    die("Please enter both email and password."); 
}
//sql statement for database
$stmt = $conn->prepare("SELECT User_Password FROM users WHERE User_Email = ?");
$stmt->bind_param("s", $User_Email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($storedPassword);
    $stmt->fetch();
//if password is found, use password associated with email
    if ($User_Password === $storedPassword) {
        $_SESSION['User_Email'] = $User_Email;
        echo "Login successful. Welcome!";
        header("Location: allevents.php");
        exit;
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "Email address not found. Please try again.";
}

$stmt->close();
$conn->close();
?>
