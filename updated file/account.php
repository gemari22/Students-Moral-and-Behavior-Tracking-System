<?php
session_start();

include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $newUsername = $_POST['newUsername'];
    $newPassword = $_POST['newPassword'];

    // Assuming you have a logged-in user (replace 'current_user' with your actual method of identifying the current user)
    $currentUsername = $_SESSION['username'];

    // Update the database
    if (!empty($newUsername)) {
        $updateUsernameQuery = "UPDATE user SET username = '$newUsername' WHERE username = '$currentUsername'";
        mysqli_query($con, $updateUsernameQuery);
        $_SESSION['username'] = $newUsername; // Update the session variable
    }

    if (!empty($newPassword)) {
        $updatePasswordQuery = "UPDATE user SET password = '$newPassword' WHERE username = '$currentUsername'";
        mysqli_query($con, $updatePasswordQuery);
    }

    header("Location: home.html"); // Redirect to the user's profile or wherever you want after the update
    die;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="account.css">
    <title>Change Account</title>
</head>
<style>
 body {
        margin: 0;
        padding: 0;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    }

    .change-credentials-container {
        max-width: 400px;
        margin: 50px auto;
        padding: 60px;
        background-color: #f4f4f4;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    }

    h2 {
        text-align: center;
        font-size: 30px;
        margin-bottom: 10px;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    }

    h3 {
        font-size: 12px;
        margin-top: 10px;
        margin-bottom: 20px;
        color: #777;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-top: 10px;
        margin-bottom: 8px;
        font-size: 18px;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    }

    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        box-sizing: border-box;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    }

    button {
        width: 100%;
        background-color: #0a0a2b;
        color: white;
        padding: 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 18px;
        transition: background-color 0.3s;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    }

    button:hover {
        background-color: #87cefa;
    }
</style>
    <!-- Header -->
    
         <!-- Additional Navigation -->
    <nav class="top-navigation">
    <a href="principal.php">Principal Information</a>
    <a href="account.php">Change Account Infomation</a>

    </nav>
    <header>
        <!-- Title on the left -->
        <div class="title">
            <div class="logo">
                <img src="defemnhs.png" alt="Logo">
            </div>
            <h1>ETHICARE</h1>
        </div>
        <!-- Navigation on the right -->
        <nav>
            <a href="home.html">Homepage</a>
            <a href="studlist.php">Student Profile</a>
            <a href="form.php">Anecdotal Form</a>
            <a href="aboutus.html">About</a>
            <a href="login.php">Logout</a>
        </nav>
    </header>
    <style>
        
</style>
    <body>
    
    <div class="change-credentials-container">
        <h2>Change Username or Password</h2>
        <h3>Note: You can only change one of them, it is either the Password or the Username.</h3>
        <form method="post">
            <label for="newUsername">New Username:</label>
            <input type="text" id="newUsername" name="newUsername">

            <label for="newPassword">New Password:</label>
            <input type="password" id="newPassword" name="newPassword">

            <button type="submit">Change Credentials</button>
        </form>
    </div>
</body>

</html>
