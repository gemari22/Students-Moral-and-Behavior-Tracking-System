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

        echo "Wrong username or password!";
    } else {
        echo "Invalid input. Please provide a valid username and password.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Form</title>
    <link rel="stylesheet" href="loginBu.css">
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="defemnhs.png" alt="Logo">
        </div>
        <div class="title">
            <h1>ETHICARE</h1>
            <h3>Students Moral and Behavior Tracker</h3>
        </div>
    </div>

    <div class="login-container">
        <h2>Login Form</h2>
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" id="li">Login</button>
        </form>
    </div>
</body>

</html>
	