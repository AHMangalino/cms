<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = connectToDatabase();

    // Check if the connection is successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $address = $_POST['address'];
    $contactNumber = $_POST['contactNumber'];
    $school = $_POST['schoolName'];

    // Log the received form data for debugging
    error_log("School Name: $school, Address: $address, Contact Number: $contactNumber");

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("UPDATE school_profile SET school_name = ?, address = ?, contact_number = ?");

    if ($stmt) {
        $stmt->bind_param("sss", $school, $address, $contactNumber);

        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "School profile updated successfully.";
            // You might want to add a link to redirect the user to the dashboard or another page
            header("Location: ../dashboard.php");
            exit; // Ensure that no further code is executed after the header redirect
        } else {
            echo "Error executing query: " . $stmt->error;
            error_log("Error executing query: " . $stmt->error);
        }

        $stmt->close();
    } else {
        echo "Error in prepare statement: " . $conn->error;
        error_log("Error in prepare statement: " . $conn->error);
    }

    $conn->close();
}
?>
