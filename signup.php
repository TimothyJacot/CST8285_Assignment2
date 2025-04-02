<?php
$host = 'localhost';
$db   = 'user_accounts';
$user = 'root'; // Change if needed
$pass = '';     // Change if needed
$charset = 'utf8mb4';

// Create DB connection
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
  $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
  die("Database connection failed: " . $e->getMessage());
}

// Get form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Insert into DB
$sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);

try {
  $stmt->execute([$username, $email, $password]);
  echo "<h2>Account created successfully!</h2>";
  echo "<p><a href='index.html'>Go back</a></p>";
} catch (PDOException $e) {
  if ($e->getCode() == 23000) { // Duplicate email
    echo "<p>Email already exists. Please try again.</p>";
  } else {
    echo "Error: " . $e->getMessage();
  }
}
?>
