<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
    <link rel="stylesheet" href="styles/index.css">
    <script>
        function filterEvents() {
            const searchValue = document.getElementById('searchInput').value.toLowerCase();
            const events = document.getElementsByClassName('event');

            for (let event of events) {
                const eventName = event.getElementsByTagName('h3')[0].textContent.toLowerCase();
                const eventLocation = event.getElementsByTagName('p')[1].textContent.toLowerCase();

                if (eventName.includes(searchValue) || eventLocation.includes(searchValue)) {
                    event.style.display = '';
                } else {
                    event.style.display = 'none';
                }
            }
        }
    </script>
</head>
<body>
    <h1>Events</h1>
    <input type="text" id="searchInput" onkeyup="filterEvents()" placeholder="Search events by name or location...">
    <div class="events-container">
        <?php
        $limit = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        $result = $conn->query("SELECT id, name, date, location FROM events LIMIT $limit OFFSET $offset");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='event'>";
                echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                echo "<p>Date: " . htmlspecialchars($row['date']) . "</p>";
                echo "<p>Location: " . htmlspecialchars($row['location']) . "</p>";  
                echo "<div class='button-container'>";
                echo "<button onclick=\"window.location.href='event_details.php?id=" . $row['id'] . "'\">View Details</button>";
                echo "<button onclick=\"if(confirm('Are you sure you want to delete this event?')) { window.location.href='delete_event.php?id=" . $row['id'] . "'; }\">Delete</button>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No events found.</p>";
        }
        ?>
    </div>

    <?php
    $total_events_result = $conn->query("SELECT COUNT(id) AS total FROM events");
    $total_events_row = $total_events_result->fetch_assoc();
    $total_events = $total_events_row['total'];
    $total_pages = ceil($total_events / $limit);

    echo '<div class="pagination">';
    if ($page > 1) {
        echo '<a href="?page=' . ($page - 1) . '"> << </a>';
    }

    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $page) {
            echo '<strong>' . $i . '</strong>';
        } else {
            echo '<a href="?page=' . $i . '">' . $i . '</a>';
        }
    }

    if ($page < $total_pages) {
        echo '<a href="?page=' . ($page + 1) . '"> >> </a>';
    }
    echo '</div>';
    ?>

    <button class="create-event-icon" onclick="window.location.href='create_event.php'">
        +
    </button>
</body>
</html>
