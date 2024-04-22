<?php
// Start session
session_start();

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
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Sanitize input data
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check user credentials
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $row['user_id']; // Assuming user_id is the primary key of the users table
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            // Redirect based on role
            switch ($row['role']) {
                case 'SUPER ADMIN':
                    header("Location: super_admin_dashboard.php"); // Redirect to super admin dashboard
                    exit();
                    break;
                case 'GENERAL ADMIN':
                    header("Location: general_admin_dashboard.php"); // Redirect to general admin dashboard
                    exit();
                    break;
                case 'ADMIN':
                    header("Location: admin_dashboard.php"); // Redirect to admin dashboard
                    exit();
                    break;
                case 'RIDER’s ACCOUNT':
                    header("Location: rider_dashboard.php"); // Redirect to rider dashboard
                    exit();
                    break;
                default:
                    // Redirect to a default page if role is not recognized
                    header("Location: default_dashboard.php");
                    exit();
                    break;
            }
        } else {
            // Password is incorrect
            $_SESSION['login_error'] = "Invalid username or password";
            header("Location: login.php"); // Redirect back to login page with error message
            exit();
        }
    } else {
        // Username not found
        $_SESSION['login_error'] = "Invalid username or password";
        header("Location: login.php"); // Redirect back to login page with error message
        exit();
    }
}
// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: red;
            color: white;
        }

        header {
            text-align: center;
            padding: 20px 0;
        }

        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 80px;
            height: 80px;
            border-radius: auto;
            margin-right: 10px;
        }

        main {
            padding: 20px;
        }

        .login-section {
            text-align: center;
            max-width: 400px;
            margin: 0 auto;
            position: relative;
        }

        h3 {
            text-align: 20%;
            width: 180px;
            margin-top: 1%;
            margin-bottom: 10px;
        }

        .username-input {
            width: calc(100% - 90px); /* Adjusted width to accommodate the logo */
            margin-bottom: 10px;
            padding: 10px;
            background-image: url('image/user.png'); /* Set background image */
            background-repeat: no-repeat; /* Prevent repeating */
            background-position: 10px center; /* Adjust position */
            background-size: 20px 20px; /* Adjust size */
            padding-left: 40px; /* Adjust padding to accommodate the image */
        }

        .password-input {
            width: calc(100% - 90px); /* Adjusted width to accommodate the logo */
            margin-bottom: 10px;
            padding: 10px;
            background-image: url('image/lock.jpg'); /* Set background image */
            background-repeat: no-repeat; /* Prevent repeating */
            background-position: 10px center; /* Adjust position */
            background-size: 20px 20px; /* Adjust size */
            padding-left: 40px; /* Adjust padding to accommodate the image */
        }
        .recover {
            color: white;
            text-decoration: none;
    font-size: 14px;
}

.login-section {
    position: relative;
}

.recover {
    position: absolute;
    right: 50px;
    bottom: 100px; /* Adjust this value to fit your layout */
}


        .login-section button {
            width: 70px;
            height: 60px;
            border-radius: 60%;
            background-color: black;
            color: white;
            border: none;
            cursor: pointer;
        }

        .login-section button.signup {
            background-color: black;
        }
        

        footer {
            text-align: center;
            padding: 20px 0;
        }

        .tagline {
            margin-bottom: 10px;
        }

        .company-details {
            font-size: 12px;
        }

        /* Animation for the text "SERVICES" */
        @keyframes wiggle {
            0% { transform: rotate(0deg); }
            10% { transform: rotate(-5deg); }
            10% { transform: rotate(5deg); }
            75% { transform: rotate(-5deg); }
            10% { transform: rotate(0deg); }
        }

        .wiggle {
            display: flex;
            animation: wiggle 0.5s infinite;
            color: 	 #fbe8b7;
            font-weight: bolder;
        }
        .signup{
            color:black;
            font-weight: bolder;
        }
    


    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="image/logo.png">
            <h2>I-RIDE MOTO TRANSPORT<br><span class="wiggle">SERVICES</span></h2>
        </div>
    </header>
    <main>
    <section class="login-section">
        <h3>LOGIN DETAILS</h3>
        <form action="" method="POST">
            <section class="login-password">
                <input type="text" class="username-input" name="username" placeholder="&#xf007; Username" required>
                <input type="password" class="password-input" name="password" id="password" placeholder="&#xf023; Password" required>
            </section>
            <a href="recovery.php" class="recover"><p>Recover Account</a></p>
            <button type="submit">Login</button>
        </form>
        
        <p>Don't have an account? <a href="signup.php" class="signup">Sign up</a></p>
    </section>
</main>

    <footer>
        <div class="tagline">"PROMISE HATID LANG"</div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="company-details">&copy; 2024 I-RIDE.PH.<br> All rights reserved.<br> Version 1.0.1001</div>
    </footer>
   


</body>
</html>