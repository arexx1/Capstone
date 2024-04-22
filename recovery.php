<?php
// Establishing connection with the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iride_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Checking connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieving form data
$email = $_POST['email'];
$old_password = $_POST['old-password'];
$new_password = $_POST['new-password'];

// Querying the database to check if the email and old password match
$sql = "SELECT * FROM users WHERE email='$email' AND password='$old_password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Update the password in the database
    $update_sql = "UPDATE users SET password='$new_password' WHERE email='$email'";
    if ($conn->query($update_sql) === TRUE) {
        echo "Password updated successfully";
    } else {
        echo "Error updating password: " . $conn->error;
    }
} else {
    echo "Invalid email or old password";
}

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

        
        .email-input{
            width: calc(100% - 90px); /* Adjusted width to accommodate the logo */
            margin-bottom: 10px;
            padding: 10px;
            background-image: url('image/email.png'); /* Set background image */
            background-repeat: no-repeat; /* Prevent repeating */
            background-position: 10px center; /* Adjust position */
            background-size: 30px 30px; /* Adjust size */
            padding-left: 40px; /* Adjust padding to accommodate the image */
        }
        .new-password-input {
            width: calc(100% - 90px); /* Adjusted width to accommodate the logo */
            margin-bottom: 10px;
            padding: 10px;
            background-image: url('image/lock.jpg'); /* Set background image */
            background-repeat: no-repeat; /* Prevent repeating */
            background-position: 10px center; /* Adjust position */
            background-size: 20px 20px; /* Adjust size */
            padding-left: 40px; /* Adjust padding to accommodate the image */
        }
        .old-password-input{
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
            color: #fbe8b7;
            font-weight: bolder;
        }

        .signup {
            color: black;
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
        <h3>Account Recovery</h3>
        <form action="" method="POST">
    <section class="login-password">
        <input type="email" class="email-input" name="email" placeholder="&#xf0e0; Email" required>
        <input type="password" class="old-password-input" name="old-password" id="old-password"  placeholder="&#xf084; Old Password"
               required>
        <input type="password" class="new-password-input" name="new-password" id="new-password" placeholder="&#xf084; New Password"
               required>
    </section>
    <button type="submit">Confirm</button>
</form>

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