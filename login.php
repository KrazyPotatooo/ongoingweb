<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Login</title>
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

                    header("location: home.php"); 
                } else {
                    $_SESSION['login_user'] =! $username OR $_SESSION['login_user'] =! $password;
                    header("location: home1.php");
                }
            }
            ?>

            <!-- HTML form for user login -->
            <h1>Login</h1> <br>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" value=<?php echo $username?> required>
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
                    Don't have an account? <a href="register.php">Sign Up</a>
                </div>

            </form>

        </div>
      </div>
    </section>
      
</body>
</html>
