<?php
require_once 'config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <link href="style.css" rel="stylesheet">
    <title>LMS</title>
</head>
<body>

<header>
        <!-- Logo -->
        <div class="logo-container">
    <?php
    $conn = connectToDatabase();
    $logoQuery = "SELECT pic FROM logo LIMIT 1"; // Assuming you have only one logo
    $logoResult = $conn->query($logoQuery);

    if ($logoResult->num_rows > 0) {
        $logoRow = $logoResult->fetch_assoc();
        $logoPath = $logoRow['pic'];

        // Display the logo with responsive image class
        echo '<img src="assets/img/' . $logoPath . '" alt="Logo" class="img-fluid" style="max-width: 6%;">';

    } else {
        // Display a default logo or handle accordingly
        echo '<img src="default-logo.png" alt="Default Logo" class="img-fluid" style="max-width: 100%;">';
    }

    $conn->close();
    ?>
</div>
         <!-- Navbar -->
         <nav>
            <div>
                <a href="#">Home</a>
                <a href="#">Contact US</a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#enrollModal">Enroll Now</a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
            </div>
        </nav>
    </header>


<!-- Image Slider -->
<div id="imageSlider" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php
            // Include your database connection file
            

            // Fetch cover images from the database
            $conn = connectToDatabase();
            $coverImagesQuery = "SELECT picture_path FROM cover";
            $coverImagesResult = $conn->query($coverImagesQuery);

            if ($coverImagesResult->num_rows > 0) {
                $active = true; // To set the first image as active

                while ($coverImageRow = $coverImagesResult->fetch_assoc()) {
                    $imagePath = $coverImageRow['picture_path'];

                    // Check if the file exists
                    $imageFullPath = 'photos/' . $imagePath;

                    if (file_exists($imageFullPath)) {
                        // Display each cover image as a carousel item
                        echo '<div class="carousel-item ' . ($active ? 'active' : '') . '">';
                        echo '<img src="' . $imageFullPath . '" alt="Cover Image" class="d-block w-100">';
                        echo '</div>';

                        $active = false; // Set to false after the first iteration
                    } else {
                        // Handle the case where the file doesn't exist
                        echo '<div class="alert alert-warning">Image not found: ' . $imageFullPath . '</div>';
                    }
                }
            } else {
                // Display a default image or handle accordingly
                echo '<div class="carousel-item active">';
                echo '<img src="default-cover-image.jpg" class="d-block w-100" alt="Default Cover Image">';
                echo '</div>';
            }

            $conn->close();
        ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#imageSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#imageSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<?php
$conn = connectToDatabase();
$sql = "SELECT image_path, title, caption FROM cards";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    ?>
    <!-- Container outside the loop -->
    <div class="container-fluid card-container">
        <div class="row">
            <?php
            while ($row = $result->fetch_assoc()) {
                ?>
                <!-- Image with Description for each row -->
                <div class="col-md-4">
                    <div class="card">
                        <!-- Replace "your-image.jpg" with the actual image path from your database -->
                        <img src="photos/<?php echo $row['image_path']; ?>" alt="Image with Description" class="img-fluid rounded" style="max-width: 100%; height: 2in;">
                        <div class="card-body">
                            <b><h2 class="card-title"><?php echo $row['title']; ?></h2></b>
                            <p class="card-text"><?php echo $row['caption']; ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
} else {
    echo 'No data available.';
}
?>
<div class="container mt-4 d-flex flex-wrap">

<?php
  $conn = connectToDatabase();

  // Retrieve and display the data
  $sql = "SELECT * FROM grid_data";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    // Display form for each card
    while ($row = $result->fetch_assoc()) {
      echo "<div class='col-md-4'>";
      echo "<div class='card d-flex flex-grow-1' style='background-color: " . $row['background_color'] . ";'>";
      
      // Dynamically set font size based on the 'size' property
      echo "<p class='fw-bold' style='font-size: " . $row['size'] . "mm;'>" . $row['title'] . "</p>";
      echo "<p style='font-size: " . $row['size'] . "mm;'>" . $row['caption'] . "</p>";
  
      echo "</div>";
      echo "</div>";
    }
  } else {
    // Handle case when no cards are found
    echo "No cards found.";
  }
?>

</div>


 

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="config/login.php">
                        <label for="username">Username:</label>
                        <input type="text" name="username" required><br>

                        <label for="password">Password:</label>
                        <input type="password" name="password" required><br>

                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Enroll Modal -->
<div class="modal fade" id="enrollModal" tabindex="-1" aria-labelledby="enrollModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enrollModalLabel">Enroll Now</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="config/enroll.php">
                    <!-- Section I: Create your Student Portal Account -->
                    <div class="mb-3">
                    <p><b>I. Create your Student Portal Account</b></p>
        <label for="username">Username:</label>
        <br>
        <input type="text" name="username" placeholder="Username" required><input type="text" name="sformat" value="@student" readonly><br>

        <label for="password">Password:</label>
        <br>
        <input type="password" name="password" placeholder="Password" required><br>

        <label for="email">Email Address</label>
        <br>
        <input type="email" name="email"placeholder="Email" required><br>

     </div>

                    <!-- Section II: Education -->
                    <div class="mb-3">
                   
        <!-- Add more fields as needed -->
        <p><b>II. Education</b></p>
        <label for="elem">Elementary</label>
        <br>
        <input type="text" name="elementary" placeholder="School Name" required><input type="text" name="egrad" placeholder="Graduation Year"><br>
        <label for="elem">Junior High School</label>
        <br>
        <input type="text" name="juniorhigh" placeholder="School Name" required><input type="text" name="hgrad" placeholder ="Graduation Year"><br>
        <label for="elem">Senior High School</label>
        <br>
        <input type="text" name="seniorhigh" placeholder="School Name" required><input type="text" name="shgrad" placeholder="Graduation Year"><br>
                    </div>

                    <p><b>III. Enrollment Form</b></p>
        <label for="firstName">First Name:</label><br>
        <input type="text" id="firstName" name="firstName"placeholder="First Name" required><br>

        <label for="middle Name">Middle Name:</label><br>
        <input type="text" id="Middle Name" name="Middle Name"placeholder="Middle Name" required><br>

        <label for="lastName">Last Name:</label><br>
        <input type="text" id="lastName" name="lastName"placeholder="LastName" required><br>

        <label for="gender">Sex:</label><br>
        <select id="gender" name="gender" required><br>
        <option value="choose gender">Choose Gender:</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        </select><br>

        <label for="year">Year:</label><br>
        <select id="courseyear" name="courseyear" required><br>
            <option value="choose year">Choose Year:</option>
            <option value="1st">1st year</option>
            <option value="2nd">2nd year</option>
            <option value="3rd">3rd year</option>
            <option value="4th">4th year</option>
        </select><br>

        <label for="course">Select Course:</label><br>
        <select id="course" name="course" required><br>
            <option value="choose course">Choose Course:</option>
            <option value="BSIT">Bachelor of Science in Information Technology</option>
            <option value="BSCS">Bachelor of Science in Computer Science</option>
            <option value="BSCE">Bachelor of Science in Civil Engineering</option>
        </select><br>
    

       <label for="birthday">Birthday:</label><br>
        <input type="date" id="birthday" name="birthday" required><br>

        <label for="home address">Home Address:</label><br>
        <input type="address" name="address"placeholder="Home Address" required><br>


        <label for="phone number">Phone Number:</label><br>
        <input type="number" name="phonenumber"placeholder="Phone Number" required><br>


        <label for="Guardian name">Guardian Name:</label><br>
        <input type="text" name="guardianname"placeholder="Guardian Name" required><br>  
        

        <label for="guardian phone number">Guardian Phone Number:</label><br>
       <input type="number" name="guardianPhoneNumber"placeholder="Guardian Phone Number" required><br>

       <label for="guar home addressr">Guardian Home Address:</label><br>
        <input type="text" name="guardhomeaddress"placeholder="Guardian Home Address" required><br>
                    <!-- Data Privacy Notice -->
                    <div class="mb-3">

                        <h1>Data Privacy Notice</h1>

                        <p>Before you submit any personal information to our website, please take a moment to read this data privacy notice. Wir are committed to protecting your personal information and ensuring that your privacy is respected. We comply with the Data Privacy Act of the Philippines amt other applicable data protection laws.</p>

<h1>What personal information do we collect?</h1>
<p>We may collect personal information such as your name, email address, phone number, and other details that you provide when you fill out a form or interact witit our website</p>

<h1>How do we use your personal information?</h1>
<p>We may use your personal information to provide you with the services or information that you have requested, to respond to your inquiries, and to improve our website and services. We may also use yuar persunal information for other purposes that are compatible with the original purpose of collection ur as required by law</p>

<h1>Do we share your personal information?</h1>
<p>We do not sell trade, or otherwise transfer your personal information to outside parties unless wir provide you with advance notice or as required by law</p>

<h1>How do we protect your personal information?</h1>
<p>We implement a variety of security measures to protect your personal information from unauthorized acress, use or disclosure. We use industry standani entryption technology and other masonable measures to safeguard your personal information</p>

<h1>What are your rights?</h1>
<p>You have the right to access, correct and delete your personal information that we have collected. You may also withdraw your consent to our processing of your personal informaticin at any time. To exercise your rights, please contact us using the contact detail provided on cat website</p>

<h1>Changes to this notice</h1>
<p>We may update this stata privacy natice from time to time. Any changes will be posted on mur website, ami the revised notice will apply to personal information collected after the date it is posted</p>

<h1>Contact us</h1>
<p>if you have any questions or concerns about our data privacy practices, please contact us by clicking this link.</p>
                        <!-- Include your data privacy notice content here -->
                    </div>

                    <!-- Terms and Submit Button -->
                    <div class="mb-3">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" required> I agree to the terms and conditions.
                        </label>
                        <button type="submit" class="btn btn-primary">Enroll</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Other HTML content -->

<nav>
    <div>
        <a href="#">Home</a>
        <a href="#">Contact US</a>
        <a href="#" data-bs-toggle="modal" data-bs-target="#enrollModal">Enroll Now</a>
        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
    </div>
</nav>

<!-- Other HTML content -->

    <!-- Footer -->
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <?php
            $conn = connectToDatabase();
            $sql = "SELECT school_name, address, contact_number FROM school_profile";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo '<b><p>School Name:</b> ' . $row['school_name'] . '</p>';
                echo '<b><p>Address:</b> ' . $row['address'] . '</p>';
                echo '<b><p>Contact Number: </b>' . $row['contact_number'] . '</p>';
            } else {
                echo 'No school profile data available.';
            }

            $conn->close();
            ?>
        </div>
         <div class="logo-container">
    <?php
    $conn = connectToDatabase();
    $logoQuery = "SELECT pic FROM logo LIMIT 1"; // Assuming you have only one logo
    $logoResult = $conn->query($logoQuery);

    if ($logoResult->num_rows > 0) {
        $logoRow = $logoResult->fetch_assoc();
        $logoPath = $logoRow['pic'];

        // Display the logo with responsive image class
        echo '<img src="assets/img/' . $logoPath . '" alt="Logo" class="img-fluid" style="max-width: 6%;">';

    } else {
        // Display a default logo or handle accordingly
        echo '<img src="default-logo.png" alt="Default Logo" class="img-fluid" style="max-width: 100%;">';
    }

    $conn->close();
    ?>
</div>
    </footer>


</body>
</html>
<style>
 
/* Modal Content Style */
#enrollModal .modal-content {
    max-width: 800px; /* Adjust the maximum width as needed */
}

/* Form Style */
#enrollModal form {
    padding: 20px;
}

/* Data Privacy Notice Style */
#enrollModal .mb-3 h1 {
    margin-top: 20px;
}

#enrollModal .mb-3 p {
    margin-bottom: 15px;
}

/* Terms and Submit Button Style */
#enrollModal .mb-3 label {
    display: block;
    margin-bottom: 15px;
}

/* Responsive Styling */
@media (max-width: 767px) {
    #enrollModal .modal-content {
        width: 90%;
    }
}
     body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .card {
      border-radius: 10px;
      box-shadow: 10px 8px 10px rgba(0, 0, 0, 0.1);
      padding: 15px;
      margin-bottom: 15px;
    }
    .card-container {
      margin-top: 5%;
    }

    .card {
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .card img {
      width: 100%;
      height: auto;
    }

    .card-body {
      padding: 20px;
    }
    .logo-container {
            display: flex;
            align-items: center;
        }

        .logo {
            max-height: 100px; /* Adjust the height as needed */
            margin-right: 50px; /* Add margin to separate the logo from the navbar links */
        }

        /* Align the logo in the footer */
        .footer .logo {
            margin-right: 0; /* Remove margin to align the logo to the left in the footer */
        }
        
  </style>