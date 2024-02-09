<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add"])) {
        // Insert data into the database
        $date = $_POST["date"];
        $startTime = $_POST["start_time"];
        $endTime = $_POST["end_time"];
        $slots = $_POST["slots"];

        $sql = "INSERT INTO appointment (date, start_time, end_time, slots) VALUES ('$date', '$startTime', '$endTime', '$slots')";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../apointment.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST["delete"])) {
        // Delete data from the database
        $id = $_POST["id"];
        $sql = "DELETE FROM appointment WHERE id = '$id'";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../apointment.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
