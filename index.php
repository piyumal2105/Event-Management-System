<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

    <a href="create_event.php">Create New Event</a>
    <h1>Events</h1>

    <?php
    $result = $conn->query("SELECT id, name, date, location FROM events");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='event'>";
            echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
            echo "<p>Date: " . htmlspecialchars($row['date']) . "</p>";
            echo "<p>Location: " . htmlspecialchars($row['location']) . "</p>";
            echo "<a href='event_details.php?id=" . $row['id'] . "'>View Details</a>";
            echo " | <a href='delete_event.php?id=" . $row['id'] . "'>Delete</a>";
            echo "</div>";
        }
    } else {
        echo "<p>No events found.</p>";
    }
    ?>

</body>
</html>
