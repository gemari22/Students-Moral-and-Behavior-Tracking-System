<?php
// Database connection information
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

// Initialize variables
$adname = '';
$level = '';
$name = '';
$lrn = '';
$birthdate = '';
$birthplace = '';
$age = '';
$father = '';
$occupation1 = '';
$contact1 = '';
$mother = '';
$occupation2 = '';
$contact2 = '';
$language = '';
$height = '';
$weight = '';
$earlydisease = '';
$seriousaccident = '';
$hobby = '';
$specialtalent = '';
$subeasy = '';
$subdiff = '';

// Retrieve the 'id' from the URL
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
    }
}

// Handle form submissions to update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save'])) {
        // Retrieve and sanitize form input fields
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
        $height = mysqli_real_escape_string($conn, $_POST['height']);
        $weight = mysqli_real_escape_string($conn, $_POST['weight']);
        $earlydisease = mysqli_real_escape_string($conn, $_POST['earlydisease']);
        $seriousaccident = mysqli_real_escape_string($conn, $_POST['seriousaccident']);
        $hobby = mysqli_real_escape_string($conn, $_POST['hobby']);
        $specialtalent = mysqli_real_escape_string($conn, $_POST['specialtalent']);
        $subeasy = mysqli_real_escape_string($conn, $_POST['subeasy']);
        $subdiff = mysqli_real_escape_string($conn, $_POST['subdiff']);
    
        // Update the database record
        $updateSql = "UPDATE record SET
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
            subdiff = ?
            WHERE id = ?";

        $stmt = mysqli_prepare($conn, $updateSql);

        // Bind parameters to the placeholders
        mysqli_stmt_bind_param($stmt, "sisissississisddssssssi",
            $adname, $level, $name, $lrn, $birthdate, $birthplace, $age,
            $father, $occupation1, $contact1, $mother, $occupation2, $contact2,
            $language, $height, $weight, $earlydisease, $seriousaccident, $hobby,
            $specialtalent, $subeasy, $subdiff, $id);

        if (mysqli_stmt_execute($stmt)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="andForm.css">
    <title>Anecdotal Form</title>

             <!-- Additional Navigation -->
    <nav class="top-navigation">
        <a href="principal.php">Settings</a>
        <a href="account.php">Account</a>

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
                <a href="andForm.php">Anecdotal Form</a>
                <a href="aboutus.html">About</a>
                <a href="login.php">Logout</a>
    
            </nav>
        </header>
   
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
</style>


<body>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <!-- Display data from the first row in your form fields -->
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
            <input type="text" id="elem" name="elem" required>
            
        </div>
        <div class="form-row">
            <label for="highschool">Highschool:</label>
            <input type="text" id="highschool" name="highschool" required>
            
        </div>
        <div class="form-row">
            <label for="college">College:</label>
            <input type="text" id="college" name="college" required>
            
        </div>

        <input type="submit" name="save" value="Save">
    
        
    </form>
    
    <script>
     // Function to populate the form fields with data from the clicked row and toggle input fields
     function editRow(button) {
        const row = button.parentNode.parentNode;
        const inputs = row.querySelectorAll('input[type="text"]');
        const editButton = row.querySelector(".edit-button");
        const saveButton = row.parentNode.querySelector(".save-button");

        for (const input of inputs) {
            if (input.classList.contains("hidden-input")) {
                input.classList.remove('hidden-input');
            } else {
                input.classList.add('hidden-input');
            }
        }

        // Toggle the visibility of the "Edit" and "Save Changes" buttons
        if (editButton.style.display === "none") {
            editButton.style.display = "block";
            saveButton.style.display = "none";
        } else {
            editButton.style.display = "none";
            saveButton.style.display = "block";
        }
    }

    </script>
</body>
</html>