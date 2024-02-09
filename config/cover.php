<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_FILES["fileInput"])) {
        $uploadDir = "../assets/covers/"; // Specify your upload directory
        $uploadedFile = $uploadDir . basename($_FILES["fileInput"]["name"]);

        $imageFileType = strtolower(pathinfo($uploadedFile, PATHINFO_EXTENSION));
        $allowedExtensions = array ("jpg", "jpeg", "png", "gif");

        if (!in_array($imageFileType, $allowedExtensions)) {
            echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
        } else {
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $conn = connectToDatabase();

            // Check if the connection is successful
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $stmt = $conn->prepare("INSERT INTO cover (picture_path) VALUES (?)");

            if ($stmt) {
                $stmt->bind_param("s", $uploadedFile);

                // Move the uploaded file to the destination directory
                if (move_uploaded_file($_FILES["fileInput"]["tmp_name"], $uploadedFile) && $stmt->execute()) {
                    header("Location: ../dashboard.php");
                    exit();
                } else {
                    echo "Error uploading file.";
                }

                $stmt->close();
            } else {
                echo "Error in prepare statement: " . $conn->error;
            }

            $conn->close();
        }
    } elseif (isset($_POST["deleteId"])) {
        // Handle delete request
        $deleteId = $_POST["deleteId"];
        
        $conn = connectToDatabase();

        // Check if the connection is successful
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("DELETE FROM cover WHERE id = ?");

        if ($stmt) {
            $stmt->bind_param("i", $deleteId);

            // Execute the delete statement
            if ($stmt->execute()) {
                header("Location: ../dashboard.php");
                exit();
            } else {
                echo "Error deleting file.";
            }

            $stmt->close();
        } else {
            echo "Error in prepare statement: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Invalid request.";
    }
} else {
    echo "Invalid request.";
}
?>
