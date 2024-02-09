
<?php

require_once 'config/db.php';






?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/js/bootstrap.bundle.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>LMS</title>
</head>
<body>


<aside>
        <!-- Sidebar content goes here -->
        <h2>Admin</h2>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="#"></a></li>
            <li><a href="config/logout.php">Logout</a></li>
        </ul>
    </aside>
    <main>
<!-- Button to trigger the modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
    Update
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="config/logo.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                    <label for="fileInput" class="form-label">Choose File</label>
                    <input type="file" class="form-control" id="fileInput" name="fileInput" onchange="updateImageView(this)" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Image view under the modal -->
<div class="mt-3">
 
<?php


// Fetch the image URL from the database
$sql = "SELECT pic FROM logo";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imageURL = 'assets/img/' . $row['pic'];
        echo '<img src="' . $imageURL . '" alt="Logo Image" style="width: 200px; height: 150px;">';

    } else {
        echo 'No image found.';
    }
} else {
    echo 'Error in SQL query: ' . $conn->error;
}
?>

</div>



<div class="profile-container">
    <div class="profile-header">
        <h3>School Profile</h3>
    </div>
    <div class="profile-content">
        <?php
    

        // Fetch school profile data from the database
        $conn = connectToDatabase();
        $sql = "SELECT * FROM school_profile LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>
            <form action="config/school.php" method="post">
                <div class="mb-3">
                    <label for="schoolName" class="form-label">School Name</label>
                    <input type="text" class="form-control" id="schoolName" name="schoolName" placeholder="Enter school name" value="<?php echo $row['school_name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter school address" required><?php echo $row['address']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="contactNumber" class="form-label">Contact Number</label>
                    <input type="tel" class="form-control" id="contactNumber" name="contactNumber" placeholder="Enter contact number" value="<?php echo $row['contact_number']; ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Save Profile</button>
            </form>
        <?php
        } else {
            echo 'No school profile data found.';
        }
        $conn->close();
        ?>
    </div>
</div>

<!-- Button to trigger the modal -->
<!-- Button to trigger the modal -->
<!-- Button to trigger the modal -->
<!-- Button to trigger the modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#coverModal">
    Update
</button>
<h3>COVER PAGE</h3>

<!-- Modal -->
<div class="modal fade" id="coverModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="config/cover.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="fileInput" class="form-label">Choose File</label>
                        <input type="file" class="form-control" id="fileInput" name="fileInput" onchange="updateImageView(this)">
                    </div>
                    <button type="submit" class="btn btn-primary" name="upload">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="mt-3">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Picture</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody id="fileTableBody">
            <!-- File information will be dynamically added here -->
            <?php
            // Fetch data from your database and loop through the results
            $conn = connectToDatabase();
            $sql = "SELECT id, picture_path FROM cover";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                 

                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                   
                    echo '<td><img src="photos/' . $row["picture_path"] . '" alt="' . $row["picture_path"] . '"style="width: 200px; height: 150px;"></td>';
                    echo '<td>';
                    echo '<form action="config/cover.php" method="post" style="display: inline;">';
                    echo '<input type="hidden" name="deleteId" value="' . $row['id'] . '">';
                    echo '<button type="submit" class="btn btn-danger">Delete</button>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="3">No data found</td></tr>';
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>



<div>
    <!-- Button to trigger the modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cards">
        Add
    </button>
    <h3>Card and Images</h3>
    <!-- Modal -->
    <div class="modal fade" id="cards" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form method="post" action="config/alumni.php" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="fileInput" class="form-label">Choose File</label>
        <input type="file" class="form-control" id="fileInput" name="fileInput" onchange="updateImageView(this)">
    </div>
    <div class="mb-3">
        <label for="insertTitle" class="form-label">Insert Title</label>
        <input type="text" class="form-control" id="insertTitle" name="insertTitle" placeholder="Insert Title">
    </div>
    <div class="mb-3">
        <label for="insertCaption" class="form-label">Insert Caption</label>
        <input type="text" class="form-control" id="insertCaption" name="insertCaption" placeholder="Insert Caption">
    </div>
    <button type="submit" class="btn btn-primary">Upload</button>
</form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Table to display card information -->
<div class="container mt-3">
    <?php
    $conn = connectToDatabase();
    $sql = "SELECT id, image_path, title, caption FROM cards";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <!-- Card for each row -->
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="photos/<?php echo $row['image_path']; ?>" alt="<?php echo $row['image_path']; ?>" class="img-fluid" >
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['title']; ?></h5>
                            <p class="card-text"><?php echo $row['caption']; ?></p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id']; ?>">Edit</button>

                            <!-- Delete form -->
                            <form method="post" action="config/alumni.php" class="d-inline">
                                <input type="hidden" name="deleteId" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Card Information</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form for editing -->
                            <form method="post" action="config/alumni.php" enctype="multipart/form-data">
                                <input type="hidden" name="editId" value="<?php echo $row['id']; ?>">

                                <div class="mb-3">
                                    <label for="editFileInput" class="form-label">Choose File</label>
                                    <input type="file" class="form-control" id="editFileInput" name="editFileInput" onchange="updateImageView(this)">
                                </div>

                                <div class="mb-3">
                                    <label for="editTitle" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="editTitle" name="editTitle" value="<?php echo $row['title']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="editCaption" class="form-label">Caption</label>
                                    <input type="text" class="form-control" id="editCaption" name="editCaption" value="<?php echo $row['caption']; ?>">
                                </div>

                                <!-- Add other form elements as needed -->

                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
    } else {
        echo '<div class="alert alert-info" role="alert">No data found</div>';
    }
    $conn->close();
    ?>
</div>

<h2>Content GRID</h2>
  <div class="row">
    <!-- Add New Card Form -->
    <div class="column">
        <div class="card">
            <form action="config/content.php" method="POST" class="my-form">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title">
                <label for="caption">Caption:</label>
                <input type="text" id="caption" name="caption">
                <label for="size">Size:</label>
                <input type="text" id="size" name="size">
                <label for="color">Color:</label>
                <input type="color" id="color" name="color">
                <br>
                <br>
                <input type="submit" name="add_card" value="Add Card">
            </form>
        </div>
    </div>

    <!-- Display Cards -->
    <?php
   $conn = connectToDatabase();

   // Retrieve and display the data
   $sql = "SELECT * FROM grid_data";
   $result = $conn->query($sql);
   
    if ($result->num_rows > 0) {
        // Display form for each card
        while ($row = $result->fetch_assoc()) {
            echo "<div class='column'>";
            echo "<div class='card'>";
            echo "<form action='config/content.php' method='POST'>";
            echo "<input type='hidden' name='card_id' value='" . $row['id'] . "'>";
            echo "<label for='title'>Title:</label>";
            echo "<input type='text' id='title' name='title' value='" . $row['title'] . "'><br>";
            echo "<label for='caption'>Caption:</label>";
            echo "<textarea name='caption'>" . $row["caption"] . "</textarea><br>";
            echo "<label for='size'>Size:</label>";
            echo "<input type='number' id='size' name='size' value='" . $row['size'] . "' max='5'><br>";
            echo "<label for='color'>Color:</label>";
            echo "<input type='color' id='color' name='color' value='" . $row['background_color'] . "'><br>";
            echo "<input type='submit' name='update_card' value='Update' style='margin-right: 10px;'><input type='submit' name='delete_card' value='Delete'>";
            echo "</form>";

            // Form for delete button

            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "No cards found.";
    }
    ?>
</div>
</main>
</body>
</html>

<style>
    body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        aside {
            width: 200px;
            max-width: 100%;
            background-color: #333;
            color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            height: 100%; /* Ensures the sidebar takes full height */
            overflow-y: auto; /* Enables scrolling for the sidebar if its content is too long */
        }

        aside h2 {
            margin-bottom: 10px;
        }

        aside ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        aside li {
            margin-bottom: 10px;
        }

        aside a {
            color: #fff;
            text-decoration: none;
        }

        aside a:hover {
            text-decoration: underline;
        }

        main {
            flex: 1;
            padding: 20px;
            margin-left: 200px; /* Adjust this margin to match the width of the sidebar */
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            aside {
                width: 100%;
                max-width: 100%;
                box-sizing: border-box;
                padding: 10px;
                position: static; /* Reset position for small screens */
            }

            main {
                margin-left: 0; /* Reset margin for small screens */
            }
        
        }

/* Style for the button */
.btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        /* Style for the modal */
        .modal-content {
            background-color: #fff;
            border-radius: 10px;
        }

        .modal-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 10px 10px 0 0;
        }

        .modal-title {
            font-size: 1.5rem;
        }

        /* Style for the form inside the modal */
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn-primary-modal {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .btn-primary-modal:hover {
            background-color: #0056b3;
        }

        /* Style for the image view */
        .image-view {
            margin-top: 20px;
            text-align: center;
        }

        .image-view img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
    
</style>
