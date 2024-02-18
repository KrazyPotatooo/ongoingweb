<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Website ni MAMAMO</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>
<body>
    
    <section id="login" class="py-5">
      <div class="container">
        <div class="box form-box p-4 mx-auto">
        <?php
            session_start();
            include("db.php");

            if (isset($_COOKIE['username']) && isset($_COOKIE['password'])){
                $username = $_COOKIE['username'];
                $password = $_COOKIE['password'];
            }
            else{
                $username = "";
                $password = "";
            }

            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
                $result = $conn->query($sql);

                if ($result->num_rows == 1) {
                    $_SESSION['login_user'] = $username;
                    
                    // Set cookie if "Remember Me" is checked
                    if(isset($_POST['remember_me'])) {
                        setcookie('username', $_POST['username'], time() + (86400 * 2));
                        setcookie('password', $_POST['password'], time() + (86400 * 2)); 
                    }
                    header("location: profile.php"); 
                } else {
                    echo "<div class='alert alert-danger'>
                      <p>Wrong Username or Password</p>
                       </div> <br>";
                   echo "<a href='home1.php' class='btn btn-primary'>Go Back</a>";
                }
            }
            ?>

            <!-- HTML form for user login -->
            <h1 class="mb-4">Login</h1>
            <form action="" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" autocomplete="off" required value="<?php echo $username?>" >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" autocomplete="off" value="<?php echo $password?>" required>
                        <div class="input-group-append">
                            <span class="input-group-text toggle-password" onclick="togglePasswordVisibility()">
                                <i class="far fa-eye"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" name="remember_me" id="remember_me" class="form-check-input">
                    <label class="form-check-label" for="remember_me">Remember Me</label>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Login" required>
                </div>
                <div class="form-group">
                    <a href="home1.php" class="btn btn-secondary">Go back</a> | <a href="register.php" class="btn btn-link">Sign Up</a>
                </div>
            </form>

        </div>
      </div>
    </section>
      <!-- footer section -->
  <section class="container-fluid footer_section mt-5">
    <p class="text-center">
      &copy; 2020 All Rights Reserved By
      <a href="https://html.design/" class="text-decoration-none">Free Html Templates</a>
      Distributed By <a href="https://themewagon.com" class="text-decoration-none">ThemeWagon</a>
    </p>
  </section>
  <!-- footer section -->

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

  <script>
    function togglePasswordVisibility() {
      var passwordField = document.getElementById("password");
      passwordField.type = passwordField.type === "password" ? "text" : "password";
    }
  </script>

</body>
</html>
