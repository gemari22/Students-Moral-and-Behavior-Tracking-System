<?php
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password) && !is_numeric($username)) {
        // Read from the database
        $query = "SELECT * FROM user WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            // Compare passwords in plain text
            if ($user_data['password'] === $password) {
                $_SESSION['username'] = $user_data['username'];
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: home.html");
                die;
            }
        }

        $error_message = "Wrong username or password!";
    } else {
        $error_message = "Invalid input. Please provide a valid username and password.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Form</title>
    <link rel="stylesheet" href="loginBu.css">

    <style>
        /* Styles for the alert box */
        .alert {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 80px;
        background-color: white; /* Red background color */
        color: black;
        text-align: center;
        font-size: 20px;
        z-index: 1;
        visibility: hidden; /* Initially hide the alert */
        border-radius: 5px;
        border: 1px solid yellowgreen;
    }
    </style>

    <script>
        // Function to hide the alert after 5 seconds
        function hideAlert() {
        var alertBox = document.querySelector('.alert');
        alertBox.style.visibility = 'visible';
        setTimeout(function () {
            alertBox.style.visibility = 'hidden';
        }, 5000); // 5000 milliseconds = 5 seconds
    }
    </script>
</head>

<body onload="hideAlert()">
    <div class="header">
        <div class="logo">
            <img src="defemnhs.png" alt="Logo">
        </div>
        <div class="title">
            <h1>ETHICARE</h1>
            <h3>Students Moral and Behavior Tracker</h3>
        </div>
    </div>

    <?php
    if (isset($error_message)) {
        echo "<div class='alert'>$error_message</div>";
    }
    ?>

    <div class="login-container">
        <h2>Login Form</h2>
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" id="li">Login</button>
            <span>No Account?<a href="registration.php"> Register</a></span> 
        </form>
    </div>
</body>

</html>
