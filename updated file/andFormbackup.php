<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "admin";

// Create connection
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = isset($_GET['id']) ? $_GET['id'] : null;

// Fetch data for the form fields based on the 'id'
if ($id) {
    $sql = "SELECT * FROM record WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $adname = $row['adname'];
        $level = $row['level'];
        $name = $row['name'];
        $lrn = $row['lrn'];
        $birthdate = $row['birthdate'];
        $birthplace = $row['birthplace'];
        $age = $row['age'];
        $father = $row['father'];
        $occupation1 = $row['occupation1'];
        $contact1 = $row['contact1'];
        $mother = $row['mother'];
        $occupation2 = $row['occupation2'];
        $contact2 = $row['contact2'];
        $language = $row['language'];
        $height = $row['height'];
        $weight = $row['weight'];
        $earlydisease = $row['earlydisease'];
        $seriousaccident = $row['seriousaccident'];
        $hobby = $row['hobby'];
        $specialtalent = $row['specialtalent'];
        $subeasy = $row['subeasy'];
        $subdiff = $row['subdiff'];
        $elem = $row['elem'];
        $hs = $row['hs'];
        $college = $row['college'];
    } else {
        echo "Student not found!";
    }
}

// Save edited student information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $adname = mysqli_real_escape_string($conn, $_POST['adname']);
    $level = mysqli_real_escape_string($conn, $_POST['level']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $lrn = mysqli_real_escape_string($conn, $_POST['lrn']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $birthplace = mysqli_real_escape_string($conn, $_POST['birthplace']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $father = mysqli_real_escape_string($conn, $_POST['father']);
    $occupation1 = mysqli_real_escape_string($conn, $_POST['occupation1']);
    $contact1 = mysqli_real_escape_string($conn, $_POST['contact1']);
    $mother = mysqli_real_escape_string($conn, $_POST['mother']);
    $occupation2 = mysqli_real_escape_string($conn, $_POST['occupation2']);
    $contact2 = mysqli_real_escape_string($conn, $_POST['contact2']);
    $language = mysqli_real_escape_string($conn, $_POST['language']);
    $height = mysqli_real_escape_string($conn, $_POST['height']);  // Assuming height is a float
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $earlydisease = mysqli_real_escape_string($conn, $_POST['earlydisease']);
    $seriousaccident = mysqli_real_escape_string($conn, $_POST['seriousaccident']);
    $hobby = mysqli_real_escape_string($conn, $_POST['hobby']);
    $specialtalent = mysqli_real_escape_string($conn, $_POST['specialtalent']);
    $subeasy = mysqli_real_escape_string($conn, $_POST['subeasy']);
    $subdiff = mysqli_real_escape_string($conn, $_POST['subdiff']);
    $elem = mysqli_real_escape_string($conn, $_POST['elem']);
    $hs = mysqli_real_escape_string($conn, $_POST['hs']);
    $college = mysqli_real_escape_string($conn, $_POST['college']);
    
    // Update data in the database using prepared statement
    $sql = "UPDATE record SET
            adname = ?,
            level = ?,
            name = ?,
            lrn = ?,
            birthdate = ?,
            birthplace = ?,
            age = ?,
            father = ?,
            occupation1 = ?,
            contact1 = ?,
            mother = ?,
            occupation2 = ?,
            contact2 = ?,
            language = ?,
            height = ?,
            weight = ?,
            earlydisease = ?,
            seriousaccident = ?,
            hobby = ?,
            specialtalent = ?,
            subeasy = ?,
            subdiff = ?,
            elem = ?,
            hs = ?,
            college = ?
            WHERE id = ?";

    // Use prepared statement to avoid SQL injection
    $stmt = mysqli_prepare($conn, $sql);

    // Check if the prepared statement is successful
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssss",
            $adname, $level, $name, $lrn, $birthdate, $birthplace, $age, $father, 
            $occupation1, $contact1, $mother, $occupation2, $contact2, $language, 
            $height, $weight, $earlydisease, $seriousaccident, $hobby, $specialtalent, 
            $subeasy, $subdiff, $elem, $hs, $college, $id);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            $alertMessage = '<div id="successAlert" class="alert success">&#10003; Student information updated successfully</div>';
        } else {
            $alertMessage = '<div id="errorAlert" class="alert error">&#10007; Error updating student information: ' . mysqli_error($conn) . '</div>';
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $alertMessage = '<div id="errorAlert" class="alert error">&#10007; Error preparing update statement: ' . mysqli_error($conn) . '</div>';
    }

    // Close the connection
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="andForm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5IepaaNlOxIh9HCAz3r9UQ9z5TCB5FaIbAAK5LhNPMJm+fc" crossorigin="anonymous">

    <title>Anecdotal Form</title>

    <!-- Additional Navigation -->
    <nav class="top-navigation">
        <a href="principal.php">Principal Information</a>
        <a href="account.php">Change Account Information</a>
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

    <!-- Add this style section for alert styling -->
    <style>
        /* Add this style to center the alert */
        .alert {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            z-index: 1;
            width: 800px;
            text-align: center;
            font-size: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Style for success alert */
        .alert.success {
            color: black;
            background-color: #dff0d8;
            border-color: black;
        }

        /* Style for error alert */
        .alert.error {
            color: red;
            background-color: #FFD2D2;
            border-color: red;
        }
    </style>
    
</head>

<style>
    input[type="submit"] {
        background-color: #007BFF;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    /* Add this style to center the alert */
</style>


<body>
    
    
    <div class="container">

        <?php echo isset($alertMessage) ? $alertMessage : ''; ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-row">
                <label for="adname">Name of the Adviser:</label>
                <input type="text" id="adname" name="adname" value="<?php echo $adname; ?>" required>
            </div>

            <div class="form-row">
                <label for="level">Grade Level/Strand:</label>
                <input type="text" id="level" name="level" value="<?php echo $level; ?>" required>
            </div>
            <h2>ANECDOTAL FORM</h2>
            <div class="form-row">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
            <label for="lrn">LRN:</label>
            <input type="text" id="lrn" name="lrn" value="<?php echo $lrn; ?>" required>
        </div>

        <div class="form-row">
            <label for="birthdate">Birth Date:</label>
            <input type="date" id="birthdate" name="birthdate" value="<?php echo $birthdate; ?>" required>
            <label for="birthplace">Birth Place:</label>
            <input type="text" id="birthplace" name="birthplace" value="<?php echo $birthplace; ?>" required>
            <label for="age">Age:</label>
            <input type="text" id="age" name="age" value="<?php echo $age; ?>" required>
        </div>

        <div class="form-row">
            <label for="father">Father:</label>
            <input type="text" id="father" name="father" value="<?php echo $father; ?>" required>
            <label for="occupation1">Occupation:</label>
            <input type="text" id="occupation1" name="occupation1" value="<?php echo $occupation1; ?>" required>
        </div>

        <div class="form-row">
            <label for="contact1">Contact No.:</label>
            <input type="text" id="contact1" name="contact1" value="<?php echo $contact1; ?>" required>
        </div>

        <div class="form-row">
            <label for="mother">Mother:</label>
            <input type="text" id="mother" name="mother" value="<?php echo $mother; ?>" required>
            <label for="occupation2">Occupation:</label>
            <input type="text" id="occupation2" name="occupation2" value="<?php echo $occupation2; ?>" required>
        </div>

        <div class="form-row">
            <label for="contact2">Contact No.:</label>
            <input type="text" id="contact2" name="contact2" value="<?php echo $contact2; ?>" required>
        </div>

        <div class="form-row">
            <label for="language">Language:</label>
            <input type="text" id="language" name="language" value="<?php echo $language; ?>" required>
            <label for="height">Height:</label>
            <input type="text" id="height" name="height" value="<?php echo $height; ?>" required>
            <label for="weight">Weight:</label>
            <input type="text" id="weight" name="weight" value="<?php echo $weight; ?>" required>
        </div>

        <div class="form-row">
            <label for="earlydisease">Early Disease/s:</label>
            <input type="text" id="earlydisease" name="earlydisease" value="<?php echo $earlydisease; ?>" required>
            <label for="seriousaccident">Serious Accidents:</label>
            <input type="text" id="seriousaccident" name="seriousaccident" value="<?php echo $seriousaccident; ?>" required>
        </div>

        <div class="form-row">
            <label for="hobby">Hobby:</label>
            <input type="text" id="hobby" name="hobby" value="<?php echo $hobby; ?>" required>
            <label for="specialtalent">Special Talents:</label>
            <input type="text" id="specialtalent" name="specialtalent" value="<?php echo $specialtalent; ?>" required>
        </div>

        <div class="form-row">
            <label for="subeasy">Subject/s Found Easy:</label>
            <input type="text" id="subeasy" name="subeasy" value="<?php echo $subeasy; ?>" required>
            <label for="subdiff">Subject/s Found Difficult:</label>
            <input type="text" id="subdiff" name="subdiff" value="<?php echo $subdiff; ?>" required>
        </div>
        <h3>Do you plan to Graduate?</h3>
        <div class="form-row">
            <label for="elem">Elementary:</label>
            <input type="text" id="elem" name="elem" value="<?php echo $elem; ?>" required>
            
        </div>
        <div class="form-row">
            <label for="hs">Highschool:</label>
            <input type="text" id="hs" name="hs"value="<?php echo $hs; ?>" required>
            
        </div>
        <div class="form-row">
            <label for="college">College:</label>
            <input type="text" id="college" name="college" value="<?php echo $college; ?>" required>
            
        </div>


            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="save" value="Save">
        </form>
    </div>
</body>
</html>
