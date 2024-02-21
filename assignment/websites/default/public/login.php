<?php
// Including the file containing the database connection
require 'dbconnection.php';

// Start session
session_start();

// Function to generate a secure hash of the password
//https://www.youtube.com/watch?v=G8x1cM6dvlM
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Initialize variables
$username = $password = '';
$errorMessage = '';

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get email, password, and role from the form
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Check if the login attempt is for admin
    if ($role === 'admin') {
        // Check if the email and password match the admin credentials
        if ($email === 'nami@gmail.com' && $password === 'nami@123') {
            // Set session variable for logged-in admin
            $_SESSION['email'] = $email;
            $_SESSION['role'] = 'admin';
            // Redirect to index.php with a success message
            header("Location: index.php?login=success");
            exit; // Ensure that subsequent code is not executed after redirection
        } else {
            // Set error message if admin credentials are incorrect
            $errorMessage = "Incorrect Admin Credentials";
        }
    } else {
        // SQL statement to select user by email
        $statement = $Connection->prepare("SELECT * FROM registrations WHERE email = :email");
        $statement->execute(['email' => $email]);
        $row = $statement->fetch();

        // Check if user exists
        //https://www.youtube.com/watch?v=kffivnAYUAY
        if ($row) {
            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Set session variable for logged-in user
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $role;
                // Redirect to index.php with a success message
                //https://www.youtube.com/watch?v=yAjj7ByyWx0
                header("Location: index.php?login=success");
                exit; // Ensure that subsequent code is not executed after redirection
            } else {
                // Set error message if password is incorrect
                $errorMessage = "Wrong Password";
            }
        } else {
            // Set error message if user does not exist
            $errorMessage = "User Not Registered or Incorrect Role";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="left">
            <div class="photo">
                <img src="../images/image1.png">
            </div>
        </div>
        
        <div class="right">
            <div class="Signin">
                <h1>Sign in</h1>
            </div>

            <div class="lform">
                <!-- Form to collect username and password -->
                <form action="login.php" method="post">
                    <select name="role" id="role" required>
                        <option value="admin">Admin</option>
                        <option value="member">Member</option>
                    </select>
                    <br>
                    <label for="email"></label>
                    <!-- Input field for username -->
                    <!-- Input field for email -->
                    <input type="email" name="email" id="email" placeholder="Enter your email" required>
                    <br>
                    <label for="password"></label>
                    <!-- Input field for password -->
                    <input type="password" name="password" id="passwordid" placeholder="Enter your password" required>
                    <br>

                    <!-- Link to register page -->
                    <div class="register-link">
                        <a href="registration.php">Create an account</a>
                    </div>

                    <!-- Submit button -->
                    <input type="submit" value="Sign in" name="submit">
                </form>

                <?php if(!empty($errorMessage)) { ?>
                    <div class="error-message"><?php echo $errorMessage; ?></div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>
