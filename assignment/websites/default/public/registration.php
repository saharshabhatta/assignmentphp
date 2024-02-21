<?php
// Including the file containing the database connection
require 'dbconnection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="cont">
        <div class="left-side">
            <div class="form">
                <!-- Registration form -->
                <h1>Registration</h1>
                <form action="registration.php" method="post">
                    <!-- Input field for username -->
                    <label for="username"></label>
                    <input type="text" name="username" id="username" placeholder="Enter your username" required>

                    <!-- Input field for email -->
                    <label for="email"></label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required>

                    <!-- Input field for password -->
                    <label for="password"></label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>

                    <!-- Input field for confirming password -->
                    <label for="confirm_password"></label>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password" required>

                    <!-- Submit button -->
                    <input type="submit" value="submit" name="submit">
                </form>

                <!-- Link to login page -->
                <div class="login-link">
                    <p>Already a member? <a href="login.php">Login here</a></p>
                </div>
            </div>
        </div>

        <div class="right-side">
            <div class="img">
                <img src="../images/image2.jpg">
            </div>
        </div>
    </div>

    <?php

    // Function to hash the password
    //https://www.youtube.com/watch?v=G8x1cM6dvlM
    function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // Checking if the registration form is submitted
    if (isset($_POST['submit'])) {
        // Getting form data
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Email validation
        //  https://www.w3schools.com/php/php_form_url_email.asp
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email format');</script>";
        } else {
            // Checking if username or email already exists
            //https://www.youtube.com/watch?v=kffivnAYUAY
            $check = $Connection->prepare('SELECT * FROM registrations WHERE username = :username OR email = :email');
            $check->execute(['username' => $username, 'email' => $email]);
            if ($check->rowCount() > 0) {
                echo "<script>alert('Username or Email Has Already Taken');</script>";
            } else {
                // Checking if password matches confirm password
                //https://www.youtube.com/watch?v=kffivnAYUAY
                if ($password == $confirm_password) {
                    // Hashing the password
                    //https://www.youtube.com/watch?v=G8x1cM6dvlM
                    $hashedPassword = hashPassword($password);
                    // Inserting new user into the database
                    $registration = $Connection->prepare('INSERT INTO registrations (username, email, password) 
                    VALUES (:username, :email, :password)');
                    $registration->execute(['username' => $username, 'email' => $email, 'password' => $hashedPassword]);
                    // Redirecting to login page after successful registration
                     //https://www.youtube.com/watch?v=yAjj7ByyWx0
                    header("Location: login.php");
                    exit; // Ensure that subsequent code is not executed after redirection
                } else {
                    echo "<script>alert('Password does not match');</script>";
                }
            }
        }
    }
    ?>

</body>
</html>


