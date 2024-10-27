<?php
include 'db.php';
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();
?>
<h1><?php echo $event['name']; ?></h1>
<p>Description: <?php echo $event['description']; ?></p>
<p>Date: <?php echo $event['date']; ?></p>
<p>Location: <?php echo $event['location']; ?></p>
<a href="index.php">Back to Event List</a>
