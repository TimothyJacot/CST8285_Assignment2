<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="allevents.html page to display all event in database">
    <meta name="author" content="Timothy Jacot">
    <title>All Events</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body class="allevents">

    <header>
        <h1>All Events listed in planner database</h1>
        <h3><a href="eventplanner.html">Register a new event</a></h3>
        <h3><a href="createaccount.html">Create a new account</a></h3>
    </header>
    <form method="GET" action="" id="filteringform">
    <label for="type">Filter by Event Type:</label>
    <select name="type" id="type">
        <option value="">All</option>
        <option value="Conference" <?= (isset($_GET['type']) && $_GET['type'] == 'Conference') ? 'selected' : '' ?>>Conference</option>
        <option value="Charity" <?= (isset($_GET['type']) && $_GET['type'] == 'Charity') ? 'selected' : '' ?>>Charity Events</option>
        <option value="Festival" <?= (isset($_GET['type']) && $_GET['type'] == 'Festival') ? 'selected' : '' ?>>Festivals</option>
        <option value="Networking" <?= (isset($_GET['type']) && $_GET['type'] == 'Networking') ? 'selected' : '' ?>>Networking Events</option>
        <option value="Birthday" <?= (isset($_GET['type']) && $_GET['type'] == 'birthday') ? 'selected' : '' ?>>Birthday Parties</option>
        <option value="Sports" <?= (isset($_GET['type']) && $_GET['type'] == 'Sports') ? 'selected' : '' ?>>Sports Events</option>
    </select>

    <label for="sort">Sort by Date:</label>
    <select name="sort" id="sort">
        <option value="ASC" <?= (isset($_GET['sort']) && $_GET['sort'] == 'ASC') ? 'selected' : '' ?>>Closest Events</option>
        <option value="DESC" <?= (isset($_GET['sort']) && $_GET['sort'] == 'DESC') ? 'selected' : '' ?>>Furthest Events</option>
    </select>

    <input type="submit" value="Apply" id="submit">
</form>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "cst8285_assignment2";  

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Event_Name, Event_Date, Event_Location, Event_Type FROM events"; 
$conditions = [];
if (!empty($_GET['type'])) {
    $type = $conn->real_escape_string($_GET['type']);
    $conditions[] = "Event_Type LIKE '%$type%'";
}

if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$sort_order = "ASC";
if (!empty($_GET['sort']) && in_array($_GET['sort'], ['ASC', 'DESC'])) {
    $sort_order = $_GET['sort'];
}
$sql .= " ORDER BY Event_Date $sort_order";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    echo "<table class='event-table'>";
    echo "<thead>
            <tr>
                <th>Event Name</th>
                <th>Date</th>
                <th>Location</th>
                <th>Type</th>
            </tr>
          </thead>";
    echo "<tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['Event_Name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Event_Date']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Event_Location']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Event_Type']) . "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p>No events found.</p>";
}

$conn->close();
?>
 </div>
 <div class="event-container">

</div>
</body>
</html>
