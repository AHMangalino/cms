
<?php
// Include the template content
ob_start();

require_once 'config/db.php';

include('template.php');
$templateContent = ob_get_clean();

// Echo the entire HTML content of the template
echo $templateContent;


?>
<!DOCTYPE html>
<html>

<head>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
<h1> Appointment </h1>

<!-- Form for inputting new data -->
<form action="config/appoint.php" method="post">
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Slots</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="date" name="date" required></td>
                <td><input type="time" name="start_time" required></td>
                <td><input type="time" name="end_time" required></td>
                <td><input type="number" name="slots" required></td>
                <td><button type="submit" class="btn btn-primary" name="add">Add</button></td>
            </tr>
            <!-- Add more rows as needed -->
     
</form>
<?php
$result = $conn->query("SELECT * FROM appointment");



while ($row = $result->fetch_assoc()) {
    echo "<tr>
            
            <td>" . $row['date'] . "</td>
            <td>" . $row['start_time'] . "</td>
            <td>" . $row['end_time'] . "</td>
            <td>" . $row['slots'] . "</td>
            <td>
            <form action='config/appoint.php' method='post'>
            <input type='hidden' name='id' value='" . $row['id'] . "'>
            <button type='submit' name='delete' class ='bnt btn-danger'>Delete</button>
        </form>
        </td>
          </tr>";
}

echo "</table>";

// Close the database connection
$conn->close();
?>

</body>

</html>
