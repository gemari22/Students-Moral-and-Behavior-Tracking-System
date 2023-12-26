<?php
// Database connection information for the "record" table
$record_dbhost = "localhost";
$record_dbuser = "root";
$record_dbpass = "";
$record_dbname = "admin";

// Create a connection to the "record" table
$record_conn = mysqli_connect($record_dbhost, $record_dbuser, $record_dbpass, $record_dbname);

// Check the connection for the "record" table
if (!$record_conn) {
    die("Connection to the 'record' table failed: " . mysqli_connect_error());
}

// Retrieve the student's ID from the URL parameter
$id = isset($_GET['id']) ? $_GET['id'] : '';
if (empty($id)) {
    die("Student ID is missing.");
}

// Fetch the student's data from the "record" table based on the provided ID
$record_sql = "SELECT * FROM record WHERE id = '$id'";
$record_result = mysqli_query($record_conn, $record_sql);

if (mysqli_num_rows($record_result) > 0) {
    $record_row = mysqli_fetch_assoc($record_result);
    $name = $record_row['name'];
    $level = $record_row['level'];
    $category = $record_row['category'];
    $majoroffense = $record_row['majoroffense'];
    $minoroffense = $record_row['minoroffense'];
} else {
    die("Student not found in the 'record' table.");
}

// Database connection information for the "schoolInfo" table
$schoolinfo_dbhost = "localhost";
$schoolinfo_dbuser = "root";
$schoolinfo_dbpass = "";
$schoolinfo_dbname = "admin";

// Create a connection to the "schoolInfo" table
$schoolinfo_conn = mysqli_connect($schoolinfo_dbhost, $schoolinfo_dbuser, $schoolinfo_dbpass, $schoolinfo_dbname);

// Check the connection for the "schoolInfo" table
if (!$schoolinfo_conn) {
    die("Connection to the 'schoolInfo' table failed: " . mysqli_connect_error());
}

// Fetch school, place, and academic year data from the "schoolInfo" table
$schoolinfo_sql = "SELECT * FROM schoolInfo";
$schoolinfo_result = mysqli_query($schoolinfo_conn, $schoolinfo_sql);

if (mysqli_num_rows($schoolinfo_result) > 0) {
    $schoolinfo_row = mysqli_fetch_assoc($schoolinfo_result);
    $school = $schoolinfo_row['school'];
    $place = $schoolinfo_row['place'];
    $acadyear = $schoolinfo_row['acadyear'];
} else {
    die("School information not found in the 'schoolInfo' table.");
}
// Database connection information for the "principal" table
$principal_dbhost = "localhost";
$principal_dbuser = "root";
$principal_dbpass = "";
$principal_dbname = "admin";

// Create a connection to the "schoolInfo" table
$principal_conn = mysqli_connect($principal_dbhost, $principal_dbuser, $principal_dbpass, $principal_dbname);

// Check the connection for the "schoolInfo" table
if (!$principal_conn) {
    die("Connection to the 'principal' table failed: " . mysqli_connect_error());
}

// Fetch school, place, and academic year data from the "schoolInfo" table
$principal_sql = "SELECT * FROM principal";
$principal_result = mysqli_query($principal_conn, $principal_sql);

if (mysqli_num_rows($principal_result) > 0) {
    $principal_row = mysqli_fetch_assoc($principal_result);
    $prinname = $principal_row['prinname'];
    $position1 = $principal_row['position1'];
    $position2 = $principal_row['position2'];
} else {
    die("Principal information not found in the ''principal' table.");
}




// Function to format the date as "18th day of July 2023"
function formatDate($date) {
    $day = $date->format('j');
    $month = $date->format('F');
    $year = $date->format('Y');
    return $day . getDaySuffix($day) . " day of " . $month . " " . $year;
}

// Function to get the day suffix (e.g., "st", "nd", "rd", "th")
function getDaySuffix($day) {
    if ($day >= 11 && $day <= 13) {
        return "th";
    }
    switch ($day % 10) {
        case 1:
            return "st";
        case 2:
            return "nd";
        case 3:
            return "rd";
        default:
            return "th";
    }
}

// Generate the current date
$currentDate = new DateTime();
$formattedDate = formatDate($currentDate);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="certificate1.css">
    <style>
        /* Additional CSS for the print button */
        .print-button-container {
            text-align: center;
            margin-top: 20px;
        }

        .print-button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .print-button:hover {
            background-color: #45a049;
        }
        /* Regular styles for screen */
body {
    font-size: 20px;
}

.certificate {
    /* Your regular certificate styles */
    padding-left: 30px;
    padding-right: 30px;
    padding-top: 100px;

    position: relative;
}


.top-logo img,
.bottom-logo img {
    width: 100%; /* Set the width of the logo to 100% */
    height: auto; /* Maintain aspect ratio */
}

/* Media query for print */
@media print {
    body {
        font-size: 18px; /* Set a fixed font size for printing */
    }
    
    .top-logo {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        text-align: center; /* Center the logos */
    }
 
  
    .top-logo img,
    .bottom-logo img {
        width: 700px; /* Set a fixed width for printing */
        
    }
    .print-button-container {
        display: none; /* Hide the logos and print button during printing */
    }
    header,
    nav {
        display: none; /* Hide the header, navigation, logos, and print button during printing */
    }
   .signature p{
    font-size: 14px;
   
   }
   .bottom-logo{
    padding-top: 20px;
   }
   .hanging-indent {
            text-indent: 40px; /* Adjust the value as needed for the first line */
            margin-left: 40px; /* Adjust the same value as text-indent for subsequent lines */
        }
}

    </style>
    <title>Certificate</title>
</head>

    <!-- Header -->
    
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
    
    <body>
    

    <div class="certificate">
        <div class="top-logo">
            <img src="top-logo.png" alt="Top Logo" class="top-logo">
        </div>
        <div class="header">C E R T I F I C A T I O N </div>

        <div class="content">
            <div class="towhom">
                <p>TO WHOM IT MAY CONCERN:</p>
            </div>
            <p>&emsp;&emsp;&emsp;&emsp;This is to certify that <span id="nameField"><strong><?php echo htmlspecialchars($name); ?></strong> is a Grade <strong><?php echo htmlspecialchars($level); ?></strong> graduate of this institution for
                the school year <strong><?php echo htmlspecialchars($acadyear); ?></strong>.</span></p>
            <p>&emsp;&emsp;&emsp;&emsp;It is certified that <strong><?php echo htmlspecialchars($category); ?></strong> character is categorized as:</p>
            
            <div class="checkbox">
    <input type="checkbox" id="a" <?php echo ($majoroffense == 1 && $minoroffense == 1) ? 'checked' : ''; ?>>
    <label for="checkbox">Category A: The student is of good moral character and has never been subjected to administrative proceedings for violation/s of the school policies.</label>
</div>
<div class="checkbox">
    <input type="checkbox" id="b" <?php echo ($majoroffense == 2 && $minoroffense == 1) ? 'checked' : ''; ?>>
    <label for="checkbox">Category B: The student is generally of good moral character but was subjected
        to administrative proceedings for less grave violation/s of the school policies. With
        interventions given by the <strong><?php echo htmlspecialchars($category); ?></strong> class adviser, the student improved in<strong><?php echo htmlspecialchars($category); ?> </strong>  behavior.
    </label>
</div>
<div class="checkbox">
    <input type="checkbox" id="c" <?php echo ($majoroffense == 2 && $minoroffense == 3) ? 'checked' : ''; ?>>
    <label for="checkbox">Category C: The student is of good moral character and was subjected to
        administrative proceedings for less grave violation/s of the school policies. With
        interventions given by the guidance counselor, the student improved <strong><?php echo htmlspecialchars($category); ?></strong> behavior.
    </label>
</div>
<div class="checkbox">
    <input type="checkbox" id="d" <?php echo ($majoroffense == 3 && $minoroffense == 1) ? 'checked' : ''; ?>>
    <label for="checkbox">Category D: The student's record shows that in spite of interventions by the
        class adviser and guidance counselor, there are no signs of improvement in <strong><?php echo htmlspecialchars($category); ?></strong> behavior or conduct.
    </label>
</div>

            <p>&emsp;&emsp;&emsp;&emsp;This certification is issued to the above-mentioned student for enrollment purposes.</p>
            <p>&emsp;&emsp;&emsp;&emsp;Issued this <strong id="dateAndTime"><?php echo $formattedDate; ?></strong> at <strong><?php echo htmlspecialchars($school); ?></strong>, <strong><?php echo htmlspecialchars($place); ?></strong>.</p>
        </div>

        <div class="signature">
          
            <p><strong><?php echo htmlspecialchars($prinname); ?></strong></p>
            <p><strong><?php echo htmlspecialchars($position1); ?></strong></p>
            <p><strong><?php echo htmlspecialchars($position2); ?></strong></p>
        </div>
        <div class="bottom-logo">
            <img src="bottom-logo.png" alt="Bottom Logo" class="bottom-logo">
        </div>
       
    </div>
    <div class="print-button-container">
            <button class="print-button" onclick="printCertificate()">Print Certificate</button>
        </div>
    <script>
    function printCertificate() {
        // Hide unnecessary elements before printing
        document.querySelector('.top-navigation').style.display = 'none';
        document.querySelector('header').style.display = 'none';
        // Hide the timestamp before printing
        document.getElementById('dateAndTime').style.display = 'none';

        // Use the window.print() method to trigger the print dialog
        window.print();

        // Show the hidden elements after printing
        document.querySelector('.top-navigation').style.display = 'block';
        document.querySelector('header').style.display = 'flex';
         // Show the timestamp again after printing
         document.getElementById('dateAndTime').style.display = 'block';
       
       
       
    }

  


</script>
</body>
</html>
