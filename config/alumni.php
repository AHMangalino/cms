<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["insertTitle"]) && isset($_POST["insertCaption"])) {
        // Insert record code (as you had it before)
        $uploadDir = "../assets/cards/"; // Specify your upload directory
        $uploadedFile = $uploadDir . basename($_FILES["fileInput"]["name"]);

        $imageFileType = strtolower(pathinfo($uploadedFile, PATHINFO_EXTENSION));
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");

        if (!in_array($imageFileType, $allowedExtensions)) {
            echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
        } else {
            $conn = connectToDatabase();

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $stmt = $conn->prepare("INSERT INTO cards (image_path, title, caption) VALUES (?, ?, ?)");

            if ($stmt) {
                $title = $_POST["insertTitle"];
                $caption = $_POST["insertCaption"];

                $stmt->bind_param("sss", $uploadedFile, $title, $caption);

                if (move_uploaded_file($_FILES["fileInput"]["tmp_name"], $uploadedFile) && $stmt->execute()) {
                    header("Location: ../dashboard.php");
                } else {
                    echo "Error uploading card and image.";
                }

                $stmt->close();
            } else {
                echo "Error in prepare statement: " . $conn->error;
            }

            $conn->close();
        }
    } elseif (isset($_POST["editTitle"]) && isset($_POST["editCaption"])) {
        // Update record code (as you had it before)
        $conn = connectToDatabase();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $editedTitle = $_POST["editTitle"];
        $editedCaption = $_POST["editCaption"];
        $editedFile = "";

        if (isset($_FILES["editFileInput"]) && !empty($_FILES["editFileInput"]["name"])) {
            $uploadDir = "../assets/cards/"; // Specify your upload directory
            $editedFile = $uploadDir . basename($_FILES["editFileInput"]["name"]);

            $imageFileType = strtolower(pathinfo($editedFile, PATHINFO_EXTENSION));
            $allowedExtensions = array("jpg", "jpeg", "png", "gif");

            if (!in_array($imageFileType, $allowedExtensions)) {
                echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
                exit();
            }

            if (!move_uploaded_file($_FILES["editFileInput"]["tmp_name"], $editedFile)) {
                echo "Error uploading edited file.";
                exit();
            }
        }

        $stmt = $conn->prepare("UPDATE cards SET title = ?, caption = ?, image_path = ? WHERE id = ?");

        if ($stmt) {
            if (isset($editedFile)) {
                $stmt->bind_param("sssi", $editedTitle, $editedCaption, $editedFile, $_POST['editId']);
            } else {
                $stmt->bind_param("ssi", $editedTitle, $editedCaption, $_POST['editId']);
            }

            if ($stmt->execute()) {
                header("Location: ../dashboard.php");
            } else {
                echo "Error updating card and image information: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error in prepare statement: " . $conn->error;
        }

        $conn->close();
    } elseif (isset($_POST["deleteId"])) {
        // Delete record code (new code)
        $conn = connectToDatabase();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $deleteId = $_POST["deleteId"];

        $stmt = $conn->prepare("DELETE FROM cards WHERE id = ?");

        if ($stmt) {
            $stmt->bind_param("i", $deleteId);

            if ($stmt->execute()) {
                header("Location: ../dashboard.php");
            } else {
                echo "Error deleting record: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error in prepare statement: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Missing form fields.";
    }
} else {
    echo "Invalid request.";
}
?>
