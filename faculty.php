<?php
$conn = new mysqli("localhost","root","","ems");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Faculty Event Panel</title>
<link rel="stylesheet" href="faculty.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-maroon">
<div class="container-fluid">
<span class="navbar-brand">Faculty Event Management</span>
</div>
</nav>

<div class="container mt-5">

<h3 class="text-center text-maroon mb-4">Create Event</h3>

<!-- Event Form -->
<form action="add_event.php" method="POST">
    <div class="row mb-3">
        <div class="col-md-3">
            <input type="text" name="event_name" class="form-control" placeholder="Event Name" required>
        </div>
        <div class="col-md-3">
            <input type="text" name="event_description" class="form-control" placeholder="Event Description" required>
        </div>
        <div class="col-md-2">
            <input type="date" name="event_date" class="form-control" required>
        </div>
        <div class="col-md-2">
            <input type="time" name="event_time" class="form-control" required>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-maroon w-100">Add Event</button>
        </div>
    </div>
</form>

<!-- Event Table -->
<table class="table table-bordered text-center">
<thead class="table-dark">
<tr>
<th>Event Name</th>
<th>Description</th>
<th>Date</th>
<th>Time</th>
</tr>
</thead>
<tbody>
<?php
$sql = "SELECT * FROM events";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['event_name']."</td>";
        echo "<td>".$row['event_description']."</td>";
        echo "<td>".$row['event_date']."</td>";
        echo "<td>".$row['event_time']."</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No events yet</td></tr>";
}
$conn->close();
?>
</tbody>
</table>

<a href="show_event.php" class="btn btn-primary mt-3">See All Events</a>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>