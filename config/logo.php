<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_FILES["fileInput"])) {
        $uploadDir = "../assets/img/"; // Specify your upload directory
        $uploadedFile = $uploadDir . basename($_FILES["fileInput"]["name"]);

        // Check if the file already exists
        if (file_exists($uploadedFile)) {
            echo "File already exists. Please choose a different file name.";
            exit;
        }

        $imageFileType = strtolower(pathinfo($uploadedFile, PATHINFO_EXTENSION));
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");

        if (!in_array($imageFileType, $allowedExtensions)) {
            echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
        } else {
            $conn = connectToDatabase();

            // Check if the connection is successful
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve the ID of the latest entry
            $latestIdQuery = $conn->query("SELECT id FROM logo ORDER BY id DESC LIMIT 1");

            if ($latestIdQuery) {
                $latestId = $latestIdQuery->fetch_assoc()["id"];

                // Update the existing data in the logo table
                $stmtUpdate = $conn->prepare("UPDATE logo SET pic = ? WHERE id = ?");

                if (!$stmtUpdate) {
                    echo "Error in prepare statement: " . $conn->error;
                } else {
                    $filename = basename($_FILES["fileInput"]["name"]);
                    $stmtUpdate->bind_param("si", $filename, $latestId);

                    if ($stmtUpdate->execute()) {
                        // Move the uploaded file to the destination directory
                        if (move_uploaded_file($_FILES["fileInput"]["tmp_name"], $uploadedFile)) {
                            // Redirect to dashboard.php after successful update
                            header("Location: ../dashboard.php");
                            exit; // Ensure that no further code is executed after the header redirect
                        } else {
                            echo "Error moving file.";
                        }
                    } else {
                        echo "Error executing update statement: " . $stmtUpdate->error;
                    }

                    $stmtUpdate->close();
                }
            } else {
                echo "Error retrieving the latest ID: " . $conn->error;
            }

            $conn->close();
        }
    } else {
        echo "No file selected.";
    }
} else {
    echo "Invalid request.";
}
?>
