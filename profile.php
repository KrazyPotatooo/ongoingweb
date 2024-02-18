<?php
session_start();

// Include database connection
include("db.php");

// Check if user is logged in
if(!isset($_SESSION['login_user'])){
    header("location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch user details from the database
$username = $_SESSION['login_user'];
$sql = "SELECT * FROM user WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Extract user details
    $fname = $row['fname'];
    $lname = $row['lname'];
    $program = $row['program'];
    $profile_image = $row['profile_image']; 
    $email = $row['email'];
    $phone = $row['phone'];
    $hobby = $row['hobby'];
    $age = $row['age'];
    $gender = $row['gender'];
    $address = $row['address'];
} else {
    // Handle errors if user details are not found
    $error_message = "User details not found!";
}

// Handle image upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_image"])) {
    $target_dir = "profile_images/";
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $error_message = "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["profile_image"]["size"] > 500000) {
        $error_message = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $error_message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $error_message = "Sorry, your file was not uploaded.";
        header("location: profile_error.php?error_message=" . urlencode($error_message));
        exit();
    } else {
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            $success_message = "The file ". basename( $_FILES["profile_image"]["name"]). " has been uploaded.";

            // Update the database with the file path
            $file_path = $target_file; // Adjust if necessary
            $update_sql = "UPDATE user SET profile_image = '$file_path' WHERE username = '$username'";
            if ($conn->query($update_sql) === TRUE) {
                // Database updated successfully
                header("location: profile_success.php");
                exit();
            } else {
                $error_message = "Error updating record: " . $conn->error;
                header("location: profile_error.php?error_message=" . urlencode($error_message));
                exit();
            }
        } else {
            $error_message = "Sorry, there was an error uploading your file.";
            header("location: profile_error.php?error_message=" . urlencode($error_message));
            exit();
        }
    }
}

$conn->close();
// ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"> 
    <title>Website ni MAMAMO</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="right-links">
            <a href="profile1.php"> <button class="btn btn-primary btn-sm">Log Out</button> </a>
        </div>
    </nav>
</header>
<div class="container">
    <div class="box form-box">
        <section id="profile">
            <div class="col-lg-4">
              <?php if(isset($error_message)): ?>
                  <p><?php echo $error_message; ?></p>
              <?php endif; ?>
              <?php if(isset($success_message)): ?>
                  <p><?php echo $success_message; ?></p>
              <?php endif; ?>

              <?php if(!isset($profile_image) || !file_exists($profile_image)): ?>
                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                      <div id="upload-section">
                          <input type="file" name="profile_image" id="file-input">
                          <label for="file-input" id="file-label">Choose</label>
                          <span id="file-name"></span>
                          <br>
                          <input type="submit" value="Upload" id="upload-btn">
                      </div>
                  </form>
              <?php endif; ?>

              <?php if(isset($profile_image) && file_exists($profile_image)): ?>
                  <img src="<?php echo $profile_image; ?>" class="img-fluid" alt="Profile Picture">
              <?php endif; ?>
          </div>
            <div class="col-lg-5 content">
                <h2>Details About Me</h2>
                <div class="row">
                    <div class="col-lg-6">
                        <ul>
                        <li><i class="bi bi-chevron-right"></i> <strong>Name:</strong> <span><?php echo $fname . ' ' . $lname; ?></span></li>
                        <li><i class="bi bi-chevron-right"></i> <strong>Course:</strong> <span><?php echo $program;?></span></li>
                        <li><i class="bi bi-chevron-right"></i> <strong>Address:</strong> <span><?php echo $address;?></span></li>
                        <li><i class="bi bi-chevron-right"></i> <strong>Age:</strong> <span><?php echo $age; ?></span></li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul>
                        <li><i class="bi bi-chevron-right"></i> <strong>Mobile:</strong> <span><?php echo $phone;?></span></li>
                        <li><i class="bi bi-chevron-right"></i> <strong>Gender:</strong> <span><?php echo $gender;?></span></li>
                        <li><i class="bi bi-chevron-right"></i> <strong>Hobby:</strong> <span><?php echo $hobby; ?></span></li>
                        <li><i class="bi bi-chevron-right"></i> <strong>Email:</strong> <span><a href="mailto:<?php echo $email; ?>"><?php echo $email;?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <br> <br>
        </section>
    </div>
</div>

</body>
</html>
