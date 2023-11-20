
            <?php
                include("functions.php");
          
          
                // Database connection information
                $dbhost = "localhost";
                $dbuser = "root";
                $dbpass = "";
                $dbname = "admin";
                
                // Create a connection to the database
                $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                if($_SERVER['REQUEST_METHOD'] == "POST")
                {

                $adname = $_POST['adname'];
                $name = $_POST['name'];
                $level = $_POST['level'];
                $lrn = $_POST['lrn'];
                $birthdate = $_POST['birthdate'];
                $birthplace = $_POST['birthplace'];
                $father = $_POST['father'];
                $contact1 = $_POST['contact1'];
                $occupation1 = $_POST['occupation1'];
                $mother = $_POST['mother'];
                $contact2 = $_POST['contact2'];
                $occupation2 = $_POST['occupation2'];
                $language = $_POST['language'];
                $earlydisease = $_POST['earlydisease'];
                $hobby = $_POST['hobby'];
                $subeasy = $_POST['subeasy'];
                $age = $_POST['age'];
                $height = $_POST['height'];
                $weight = $_POST['weight'];
                $seriousaccident = $_POSt['seriousaccident'];
                $specialtalent = $_POST['specialtalent'];
                $subdiff = $_POST['subdiff'];
            


                // Insert the data into the database
                $sql = "INSERT INTO record (adname, name, level, lrn, birthdate, birthplace, father, contact1, occupation1, mother, contact2, occupation2, language, earlydisease, hobby, subeasy, age, height, weight,seriousaccident, specialtalent, subdiff)
                 VALUES ('$adname', '$name', '$level', '$lrn', '$birthdate', '$birthplace', '$father', '$contact1', '$occupation1', '$mother', '$contact2', '$occupation2', '$language', '$earlydisease', '$hobby', '$subeasy', '$age', '$height', '$weight', '$seriousaccident', '$specialtalent', '$subdiff')";
                      if (mysqli_query($conn, $sql)) {
                        $success_message = "Data added successfully!";
                    } else {
                        $error_message = "Error: " . mysqli_error($conn);
                    }
                }

                mysqli_close($conn);
                ?>
 

   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css">
    <title>Anecdotal Form</title>

    <!-- Add a <style> tag for internal CSS -->
    <style>
        
    </style>
        
             <nav class="top-navigation">
                 <a href="principal.php">Settings</a>
                <a href="account.php">Account</a>

            </nav>
        <!-- Header -->
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
   
<body>
    <!-- Main content -->
    <div class="form-container">
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="form-row">
            <label for="adname">Name of the Adviser:</label>
            <input type="text" id="adname" name="adname" required>
        </div>

        <div class="form-row">
            <label for="level">Grade Level/Strand:</label>
            <input type="text" id="level" name="level" required>
        </div>
        <h2>ANECDOTAL FORM</h2>
        
            <div class="form-row">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="lrn">LRN:</label>
                <input type="text" id="lrn" name="lrn" required>
                
            </div>

        <div class="form-row">
            <label for="birthdate">Birth Date:</label>
            <input type="date" id="birthdate" name="birthdate" required>
            <label for="birthplace">Birth Place:</label>
            <input type="text" id="birthplace" name="birthplace" required>
            <label for="age">Age:</label>
            <input type="text" id="age" name="age" required>
        </div>
        

        <div class="form-row">
            <label for="father">Father:</label>
            <input type="text" id="father" name="father" required>
            <label for="occupation1">Occupation:</label>
            <input type="text" id="occupation1" name="occupation1" required>
        </div>
        
        <div class="form-row">
            <label for="contact1">Contact No.:</label>
            <input type="text" id="contact1" name="contact1" required>
            
        </div>

        <div class="form-row">
            <label for="mother">Mother:</label>
            <input type="text" id="mother" name="mother" required>
            <label for="occupation2">Occupation:</label>
            <input type="text" id="occupation2" name="occupation2" required>
        </div>

        <div class="form-row">
            <label for="contact2">Contact No.:</label>
            <input type="text" id="contact2" name="contact2" required>
        </div>

        <div class="form-row">
            <label for="language">Language:</label>
            <input type="text" id="language" name="language" required>
            <label for="height">Height:</label>
            <input type="text" id="height" name="height" required>
            <label for="weight">Weight:</label>
            <input type="text" id="weight" name="weight" required>
        </div>

        <div class="form-row">
            <label for="earlydisease">Early Disease/s:</label>
            <input type="text" id="earlydisease" name="earlydisease" required>
            <label for="seriousaccident">Serious Accidents:</label>
            <input type="text" id="seriousaccident" name="seriousaccident" required>
        </div>

        <div class="form-row">
            <label for="hobby">Hobby:</label>
            <input type="text" id="hobby" name="hobby" required>
            <label for="specialtalent">Special Talents:</label>
            <input type="text" id="specialtalent" name="specialtalent" required>
        </div>

        <div class="form-row">
            <label for="subeasy">Subject/s Found Easy:</label>
            <input type="text" id="subeasy" name="subeasy" required>
            <label for="subdiff">Subject/s Found Difficult:</label>
            <input type="text" id="subdiff" name="subdiff" required>
        </div>
        <h3>Do you plan to Graduate?</h3>
        <div class="checkbox-container">
            <label for="level">Elementary</label>
            <input type="checkbox" id="checkbox1" name="checkbox1">
            <label for="checkbox1">Yes</label>
            <input type="checkbox" id="checkbox2" name="checkbox2">
            <label for="checkbox2">No</label>
        </div>
        <div class="checkbox-container">
            <label for="level">Secondary</label>
            <input type="checkbox" id="checkbox3" name="checkbox3">
            <label for="checkbox3">Yes</label>
            <input type="checkbox" id="checkbox4" name="checkbox4">
            <label for="checkbox4">No</label>
        </div>
        <div class="checkbox-container">
            <label for="level">College</label>
            <input type="checkbox" id="checkbox5" name="checkbox5">
            <label for="checkbox5">Yes</label>
            <input type="checkbox" id="checkbox6" name="checkbox6">
            <label for="checkbox6">No</label>
        </div>
        <!-- Place the "Add" button inside a <div> for alignment -->
        <div class="add-button-container">
        <button type="submit" id="addButton" class="add-button">Add</button>
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
