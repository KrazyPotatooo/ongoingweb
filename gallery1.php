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

  <title>WEBSITE NI MAMAMO</title>

  <!-- slider stylesheet -->
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
    
    <section id="login">      
        <div class="container">
        <div class="box form-box">
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
                        setcookie('username',$_POST['username'], time() + (86400 * 2));
                        setcookie('password', $_POST['password'], time() + (86400 * 2)); 
                    }
                    header("location: gallery.php"); 
                } else {
                    echo "<div class='message'>
                      <p>Wrong Username or Password</p>
                       </div> <br>";
                   echo "<a href='home1.php'><button class='btn'>Go Back</button>";
                }
            }
            ?>

            <!-- HTML form for user login -->
            <h1>Login</h1> <br>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required value=<?php echo $username?>>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <div style="position: relative;">
                        <input type="password" name="password" id="password" autocomplete="off" value="<?php echo $password?>" required>
                        <span class="toggle-password" onclick="togglePasswordVisibility()">
                            <i class="far fa-eye"></i>
                        </span>
                    </div>
                </div>
                <div class="field checkbox">
                    <label for="remember_me">Remember Me  &nbsp;<input type="checkbox" name="remember_me" id="remember_me"></label> 
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                <a href="home1.php">Go back</a> | <a href="register.php">Sign Up</a>
                </div>
            </form>

        </div>
      </div>
    </section>
  <!-- footer section -->
  <section class="container-fluid footer_section">
    <p>
      &copy; 2020 All Rights Reserved By
      <a href="https://html.design/">Free Html Templates</a>
      Distrubuted By <a href="https://themewagon.com">ThemeWagon</a>
    </p>
  </section>
  <!-- footer section -->

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>


</body>
</html>