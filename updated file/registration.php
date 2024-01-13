<?php
    // Handle form submission
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "admin";
    
    // Create a connection to the database
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
    
        // Validate if passwords match
        if ($_POST["password"] != $_POST["confirm_password"]) {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        showErrorMessage('Error: Passwords do not match.');
                    });
                 </script>";
        } else {
            // Insert data into the "users" table without hashing the password
            $sql = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
    
            if ($conn->query($sql) === TRUE) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            showSuccessMessage('Registration successful!');
                            setTimeout(function(){ window.location.replace('login.php'); }, 2000); // Redirect after 2 seconds
                        });
                     </script>";
            } else {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            showErrorMessage('Error: " . $sql . "<br>" . $conn->error . "');
                            setTimeout(function() {window.location.replace('registration.php'); }, 2000);
                        });
                     </script>";
            }
        }
    
        // Close the connection
        $conn->close();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginBu.css">
    <style>
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background: #fff;
            border: 1px solid black;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
    </style>
    <script>
        function showErrorMessage(message) {
            var popup = document.getElementById('errorPopup');
            popup.innerHTML = '<p>' + message + '</p>';
            popup.style.display = 'block';
            
            // Hide the popup after 2 seconds
            setTimeout(function() {
                popup.style.display = 'none';
            }, 2000);
        }

        function showSuccessMessage(message) {
            var popup = document.getElementById('successPopup');
            popup.innerHTML = '<p>' + message + '</p>';
            popup.style.display = 'block';
            
            // Hide the popup after 2 seconds
            setTimeout(function() {
                popup.style.display = 'none';
            }, 2000);
        }
    </script>
    <title>User Registration</title>
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
        <h2>Registration Form</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <br>
            <input type="submit" id="li" value="Register">
        </form>
    </div>

    <!-- Error Popup -->
    <div id="errorPopup" class="popup"></div>

    <!-- Success Popup -->
    <div id="successPopup" class="popup"></div>
</body>
</html>
