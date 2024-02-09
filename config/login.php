<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $enteredPassword = $_POST["password"];
    $hashedEnteredPassword = md5($enteredPassword); // Hash the entered password using MD5

    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($hashedEnteredPassword === $row['password']) {
                // Passwords match
                $_SESSION["user_id"] = $row["user_id"];
                $_SESSION["username"] = $row["username"];
                $_SESSION["role"] = $row["role"];

                header("Location: ../dashboard.php");
                exit();
            } else {
                $error = "Invalid password";
            }
        } else {
            $error = "Invalid username";
        }

        $stmt->close();
    } else {
        $error = "Error preparing statement";
    }

    $conn->close();
}

// Redirect to index.php after login attempt
header("Location: ../index.php");
exit();
?>
