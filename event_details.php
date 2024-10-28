<?php
include 'db.php';
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <link rel="stylesheet" href="styles/event.css">
</head>
<body>

<div class="event-details">
    <h1><?php echo htmlspecialchars($event['name']); ?></h1>
    <p class="description">Description: <?php echo htmlspecialchars($event['description']); ?></p>
    <p class="date">Date: <?php echo htmlspecialchars($event['date']); ?></p>
    <p class="location">Location: <?php echo htmlspecialchars($event['location']); ?></p>
    <a href="index.php" class="back-button">Back to Event List</a>
</div>

</body>
</html>
