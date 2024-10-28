<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $location = $_POST['location'];

    if ($name && $date && $location) {
        $stmt = $conn->prepare("INSERT INTO events (name, description, date, location) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $description, $date, $location);
        $stmt->execute();
        $stmt->close();
        header("Location: index.php");
        exit();
    } else {
        echo "<p class='error'>Please fill all required fields.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link rel="stylesheet" href="styles/create_event_form.css">
</head>
<body>

    <div class="form-container">
        <div class="container">
            <h2>Create New Event</h2>
            <form method="POST">
                <label for="name">Event Name:</label>
                <input type="text" id="name" name="name" required>
            
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4"></textarea>
            
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
            
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required>
            
                <button type="submit" class="button">Create Event</button>
            </form>
        </div>
        
    </div>

</body>
</html>
