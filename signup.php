<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: red;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 100px;
            height: 100px;
            border-radius: 50%; /* Make the image circular */
            border: 2px solid white; /* Add a white border */
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group input[type="submit"] {
            background-color:black;
            color: white;
            cursor: pointer;
        }
        .login-button{
            background-color:black;
            color: white;
            cursor: pointer;
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="logo">
        <img src="image/signuplogo.png" alt="Logo">
    </div>
    <h2 style="text-align: center; margin-bottom: 20px;">Signup Details</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="mobile">Mobile Number:</label>
            <input type="text" id="mobile" name="mobile" required maxlength="11">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required maxlength="25">
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required maxlength="14">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required maxlength="15">
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required maxlength="15">
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="">Select Role</option>
                <option value="SUPER ADMIN">SUPER ADMIN</option>
                <option value="GENERAL ADMIN">GENERAL ADMIN</option>
                <option value="ADMIN">ADMIN</option>
                <option value="RIDER’s ACCOUNT">RIDER’s ACCOUNT</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="CREATE">
        </div>
    </form>

    <?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "iride_database";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $role = $_POST["role"];

    // Sanitize input data
    $name = mysqli_real_escape_string($conn, $name);
    $mobile = mysqli_real_escape_string($conn, $mobile);
    $email = mysqli_real_escape_string($conn, $email);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $confirm_password = mysqli_real_escape_string($conn, $confirm_password);
    $role = mysqli_real_escape_string($conn, $role);

    // Check for password match
    if ($password != $confirm_password) {
        echo "<p style='color: red;'>Passwords do not match!</p>";
        exit(); // Stop further execution
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check for duplicate username
    $sql_username = "SELECT * FROM users WHERE username='$username'";
    $result_username = mysqli_query($conn, $sql_username);
    if (mysqli_num_rows($result_username) > 0) {
        echo "<p style='color: red;'>Username already exists!</p>";
        exit(); // Stop further execution
    }

    // Check for duplicate mobile number
    $sql_mobile = "SELECT * FROM users WHERE mobile='$mobile'";
    $result_mobile = mysqli_query($conn, $sql_mobile);
    if (mysqli_num_rows($result_mobile) > 0) {
        echo "<p style='color: red;'>Mobile number already exists!</p>";
        exit(); // Stop further execution
    }

    // Check for duplicate email
    $sql_email = "SELECT * FROM users WHERE email='$email'";
    $result_email = mysqli_query($conn, $sql_email);
    if (mysqli_num_rows($result_email) > 0) {
        echo "<p style='color: red;'>Email already exists!</p>";
        exit(); // Stop further execution
    }

    // If no duplicates found, insert data into database
    // Insert data into database
    $sql = "INSERT INTO users (name, mobile, email, username, password, role) 
            VALUES ('$name', '$mobile', '$email', '$username', '$hashed_password', '$role')";

    if (mysqli_query($conn, $sql)) {
        echo "<p style='text-align: center;'>Signup successful!</p>";
        echo "<div style='text-align: center;'><img src='image/sucess signup.jpg' alt='Success' style='width: 50px; height: 50px;'></div>";
        echo "<button class='login-button' onclick='window.location.href=\"login.php\";'>Login Now</button>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);
?>


</div>

<script>
    document.getElementById('password').addEventListener('input', function (e) {
        var input = e.target;
        if (input.value.length > 15) {
            input.value = input.value.slice(0, 15);
        }
    });

    document.getElementById('confirm_password').addEventListener('input', function (e) {
        var passwordInput = document.getElementById('password');
        var confirmPasswordInput = e.target;
        if (confirmPasswordInput.value !== passwordInput.value) {
            confirmPasswordInput.setCustomValidity('Passwords do not match');
        } else {
            confirmPasswordInput.setCustomValidity('');
        }
    });
</script>


</body>
</html>
