<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Sign Up</title>
    <script>
        function validatePhoneNumber() {
            var phoneInput = document.getElementById('phone');
            var phoneValue = phoneInput.value.trim();

            // Check if the phone number starts with 0 and has exactly 11 digits
            if (!/^[0]\d{10}$/.test(phoneValue)) {
                alert('Please enter a valid phone number starting with 0 and having 11 digits.');
                phoneInput.focus();
                return false;
            }

            return true;
        }

        function validatePassword() {
            var passwordInput = document.getElementById('password');
            var confirmPasswordInput = document.getElementById('confirm-password');

            // Check if password meets criteria
            var passwordRegex = /^(?=.*\d)(?=.*[A-Z])(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]).{6,}$/;
            if (!passwordRegex.test(passwordInput.value)) {
                alert('Password must have at least 6 characters with at least one number, one capital letter, and one special character.');
                passwordInput.focus();
                return false;
            }

            // Check if passwords match
            if (passwordInput.value !== confirmPasswordInput.value) {
                alert('Passwords do not match. Please enter the same password in both fields.');
                confirmPasswordInput.focus();
                return false;
            }

            return true;
        }

        function validateName(inputField, fieldName) {
            var nameValue = inputField.value.trim();

            // Check if the name contains only letters
            if (!/^[a-zA-Z]+$/.test(nameValue)) {
                alert('Please enter a valid ' + fieldName + ' without numbers or special characters.');
                inputField.focus();
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
    <section id="login" class="container mt-5">
        <div class="box form-box col-md-6 mx-auto bg-light p-4 rounded">
        <?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // ... (other form data)

    // Check if the connection is successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the username already exists
    $verify_query = $conn->prepare("SELECT username FROM user WHERE username=?");
    if (!$verify_query) {
        die("Error in SELECT query: " . $conn->error);
    }

    $verify_query->bind_param("s", $username);
    $verify_query->execute();
    $verify_query->store_result();

    if ($verify_query->num_rows != 0) {
        echo "<div class='alert alert-danger'>
                <p>This username is already used. Try another one!</p>
            </div>";
    } else {
        // Prepare the INSERT query
        $insert_query = $conn->prepare("INSERT INTO user (username, password, fname, lname, email, phone, address, hobby, age, program, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$insert_query) {
            die("Error in INSERT query: " . $conn->error);
        }

        // Bind parameters and execute
        $insert_query->bind_param("sssssssssss", $username, $password, $fname, $lname, $email, $phone, $address, $hobby, $age, $program, $gender);

        if ($insert_query->execute()) {
            echo "<div class='alert alert-success'>
                    <p>Registration successful!</p>
                </div>";
            header("location: login.php");
        } else {
            echo "<div class='alert alert-danger'>
                    <p>Error: " . $insert_query->error . "</p>
                </div>";
        }

        // Close the INSERT query
        $insert_query->close();
    }

    // Close the SELECT query
    $verify_query->close();
    // Close the database connection
    $conn->close();
}
?>
            

            <!-- HTML form for user registration -->
            <h1 class="mb-4">Sign Up</h1>
            <form action="" method="post" onsubmit="return validatePhoneNumber() && validatePassword()">
                <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control" name="fname" id="fname" autocomplete="off" required
                        onchange="validateName(this, 'First Name')">
                </div>
                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" class="form-control" name="lname" id="lname" autocomplete="off" required
                        onchange="validateName(this, 'Last Name')">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" autocomplete="off" required>
                </div>
                <div class="form-group">
    <label for="password">Password</label>
    <div class="input-group">
        <input type="password" class="form-control" name="password" id="password" autocomplete="off" required>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">Show</button>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="confirm-password">Confirm Password</label>
    <div class="input-group">
        <input type="password" class="form-control" name="confirm-password" id="confirm-password"
            autocomplete="off" required>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('confirm-password')">Show</button>
        </div>
    </div>
</div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="hobby">Hobbies</label>
                    <input type="text" class="form-control" name="hobby" id="hobby" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="text" class="form-control" name="age" id="age" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" name="gender" id="gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="program">Program/Course</label>
                    <input type="text" class="form-control" name="program" id="program" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Sign Up" required>
                </div>
                <div class="form-group">
                    <p class="mt-3">Already have an account? <a href="login.php">Sign in</a></p>
                </div>
            </form>
        </div>
    </section>
    <script>
    function togglePassword(inputId) {
        var passwordInput = document.getElementById(inputId);
        var button = document.querySelector('button[onclick="togglePassword(\'' + inputId + '\')"]');

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            button.textContent = "Hide";
        } else {
            passwordInput.type = "password";
            button.textContent = "Show";
        }
    }
</script>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="js/script.js"></script>
</body>

</html>
