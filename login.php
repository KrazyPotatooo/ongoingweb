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
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <link href="css/form.css" rel="stylesheet" />
</head>

<body>
  <div class="hero_area">
    <!-- Header Section Starts -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container pt-3">
          <a class="navbar-brand" href="index.php">
            <span>MAMAMO</span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="gallery.php">Gallery</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.php">ContactUS</a>
                </li>
              </ul>
              <div class="user_option">
                <a href="">
                  <img src="images/user.png" alt="">
                </a>
              </div>
            </div>
          </div>
        </nav>
      </div>
      <!-- Loginform -->
      <section class="container mt-5">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h2 class="text-center mb-4">Login</h2>
                <form class="form-inline">
                  <label for="username" class="sr-only">Username</label>
                  <input type="text" id="username" class="form-control mb-2 mr-sm-2" placeholder="Username" required>

                  <label for="password" class="sr-only">Password</label>
                  <input type="password" id="password" class="form-control mb-2 mr-sm-2" placeholder="Password" required>

                  <div class="form-check mb-2 mr-sm-2">
                    <input class="form-check-input" type="checkbox" id="showPassword">
                    <label class="form-check-label" for="showPassword">
                      Show Password
                    </label>
                  </div>

                  <div class="form-check mb-2 mr-sm-2">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">
                      Remember Me
                    </label>
                  </div>

                  <button class="btn btn-outline-success mb-2" type="submit">Login</button>
                </form>
                <p class="text-center mt-3">Don't have an account? <a href="register.php">Sign Up</a></p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End Login Form Section -->
    </header>
  </div>

  <!-- footer section -->
  <section class="container-fluid footer_section">
    <p>
      &copy; 2020 All Rights Reserved By
      <a href="https://html.design/">Free Html Templates</a>
      Distributed By <a href="https://themewagon.com">ThemeWagon</a>
    </p>
  </section>
  <!-- footer section -->

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script>
    function togglePasswordVisibility() {
      var passwordInput = document.getElementById("password");
      var eyeIcon = document.querySelector(".toggle-password i");

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
      } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
      }
    }

    // Show Password Function
    document.getElementById("showPassword").addEventListener("change", function () {
      var passwordInput = document.getElementById("password");

      if (this.checked) {
        passwordInput.type = "text";
      } else {
        passwordInput.type = "password";
      }
    });
  </script>
</body>

</html>
