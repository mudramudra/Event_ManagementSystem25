<?php
$conn = new mysqli("localhost","root","","ems");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM events";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<h2 class="text-center mb-4">All Events</h2>

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

<a href="faculty.php" class="btn btn-secondary">Back</a>
</div>
</body>
</html>