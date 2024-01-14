<?php
session_start();

include("connection.php");

// Fetch the principal information from the database
$query = "SELECT * FROM principal LIMIT 1";
$result = mysqli_query($con, $query);

if (!$result) {
    // Display the error message and exit
    die("Error fetching principal information: " . mysqli_error($con));
}

if (mysqli_num_rows($result) > 0) {
    $principal_data = mysqli_fetch_assoc($result);
    $currentName = $principal_data['prinname'];
    $currentPosition1 = $principal_data['position1'];
    $currentPosition2 = $principal_data['position2'];
} else {
    // Display a message if principal information is not found
    echo "Principal information not found.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $newName = $_POST['newName'];
    $newPosition1 = $_POST['newPosition1'];
    $newPosition2 = $_POST['newPosition2'];

    // Update the database
    $updateQuery = "UPDATE principal SET prinname = '$newName', position1 = '$newPosition1', position2 = '$newPosition2' LIMIT 1";
    if (mysqli_query($con, $updateQuery)) {
        $success_message = "Principal information updated successfully!";
        // Update current values after successful update
        $currentName = $newName;
        $currentPosition1 = $newPosition1;
        $currentPosition2 = $newPosition2;
    } else {
        $error_message = "Error updating principal information: " . mysqli_error($con);
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="principal.css">
    <title>Change Principal</title>
</head>

    <nav class="top-navigation">
        <<a href="principal.php">Principal Information</a>
        <a href="account.php">Change Account Infomation</a>

    </nav>
    <header>
 
        <div class="title">
            <div class="logo">
                <img src="defemnhs.png" alt="Logo">
            </div>
            <h1>ETHICARE</h1>
        </div>
  
        <nav>
            <a href="home.html">Homepage</a>
            <a href="studlist.php">Student Profile</a>
            <a href="form.php">Anecdotal Form</a>
            <a href="aboutus.html">About</a>
            <a href="login.php">Logout</a>
        </nav>
    </header>

    <style>

        .form-container {
            max-width: 400px;
            margin: 0 auto;
        }

        .form-row {
            margin-bottom: 15px;
        }

        .update-button-container {
            text-align: center;
        }

        .update-button {
            padding: 10px;
        }

        .success-message {
            color: green;
            margin-top: 10px;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
        h2 {
        text-align: center;
        font-size: 30px;
        margin-bottom: 10px;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        padding-bottom: 10px;
    }

        h3 {
        font-size: 12px;
        margin-top: 10px;
        margin-bottom: 20px;
        color: #777;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    }

    </style>
</head>
<body>
    <!-- Main content -->
    <div class="form-container">
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <h2>Principal's Information</h2>
        <h3>Note:The principal's name should be typed in all capital letters (CAPSLOCK).</h3>
            <div class="form-row">
                <label for="newName">New Principal:</label>
                <input type="text" id="newName" name="newName" value="<?php echo $currentName; ?>" required>
            </div>

            <div class="form-row">
                <label for="newPosition1">Position:</label>
                <input type="text" id="newPosition1" name="newPosition1" value="<?php echo $currentPosition1; ?>" required>
            </div>

            <div class="form-row">
                <label for="newPosition2">Position:</label>
                <input type="text" id="newPosition2" name="newPosition2" value="<?php echo $currentPosition2; ?>" required>
            </div>

            <div class="update-button-container">
                <button type="submit" class="update-button">Update</button>
            </div>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($success_message)) {
                echo "<div class='success-message'>$success_message</div>";
            } elseif (isset($error_message)) {
                echo "<div class='error-message'>$error_message</div>";
            }
            ?>
        </form>
    </div>
</body>
</html>
