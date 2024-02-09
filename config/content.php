<?php 
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handling card updates
    if (isset($_POST['update_card'])) {
        $card_id = $_POST['card_id'];
        $title = $_POST['title'];
        $caption = $_POST['caption'];
        $size = $_POST['size'];
        $color = $_POST['color'];

        // SQL query to update data in database
        $sql = "UPDATE grid_data SET title='$title', caption='$caption', size='$size', background_color='$color' WHERE id=$card_id";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Card updated successfully</p>";
            header("Location: ../dashboard.php");
        } else {
            echo "Error updating card: " . $conn->error;
        }
    }
    // Handling card deletions
    elseif (isset($_POST['delete_card'])) {
        $card_id = $_POST['card_id'];

        // SQL query to delete data from database
        $sql = "DELETE FROM grid_data WHERE id = $card_id";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Card deleted successfully</p>";
            header("Location: ../dashboard.php");
        } else {
            echo "Error deleting card: " . $conn->error;
        }
    }
    // Handling card insertions
    elseif (isset($_POST['add_card'])) {
        $title = $_POST['title'];
        $caption = $_POST['caption'];
        $size = $_POST['size'];
        $color = $_POST['color'];

        // SQL query to insert data into database
        $sql = "INSERT INTO grid_data (title, caption, size, background_color) VALUES ('$title', '$caption', '$size', '$color')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>New card added successfully</p>";
            header("Location: ../dashboard.php");
        } else {
            echo "Error adding card: " . $conn->error;
        }
    }
}

?>