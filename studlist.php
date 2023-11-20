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

// ... (Your database connection code remains the same)

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
    $lrn = $_POST['lrn'];
    $level = $_POST['level'];
    $majoroffense = $_POST['majoroffense'];
    $minoroffense = $_POST['minoroffense'];
    $status = $_POST['status'];


    for ($i = 0; $i < count($_POST['id']); $i++) {
        $idValue = mysqli_real_escape_string($conn, $_POST['id'][$i]);
        $lrnValue = mysqli_real_escape_string($conn, $_POST['lrn'][$i]);
        $levelValue = mysqli_real_escape_string($conn, $_POST['level'][$i]);
        $majorValue = mysqli_real_escape_string($conn, $_POST['majoroffense'][$i]);
        $minorValue = mysqli_real_escape_string($conn, $_POST['minoroffense'][$i]);
        $statusValue = mysqli_real_escape_string($conn, $_POST['status'][$i]);

        $sql = "UPDATE record SET lrn = '$lrnValue', level = '$levelValue', majoroffense = '$majorValue', minoroffense = '$minorValue', status = '$statusValue' WHERE id = '$idValue'";

        if (mysqli_query($conn, $sql)) {
            // Database update was successful
            // You may redirect the user or display a success message
        } else {
            // Handle the case where the update failed
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
}


// Check if a search query is provided
$searchQuery = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : "";

// Construct the SQL query for searching
$sql = "SELECT * FROM record";
if (!empty($searchQuery)) {
    $sql .= " WHERE lrn LIKE '%$searchQuery%' OR level LIKE '%$searchQuery%' OR majoroffense LIKE '%$searchQuery%' OR minoroffense LIKE '%$searchQuery%' OR status LIKE '%$searchQuery%'";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="studlist1.css">
    <title>Students List</title>
</head>
        <nav class="top-navigation">
            <a href="principal.php">Settings</a>
            <a href="account.php">Account</a>

        </nav>

    <header class="header">
        <div class="title">
            <div class="logo">
                <img src="defemnhs.png" alt="Logo">
            </div>
            <h1>ETHICARE</h1>
        </div>
        <nav>
            <a href="home.html">Homepage</a>
            <a href="studlist.php">Student Profile</a>
            <a href="andForm.php">Anecdotal Form</a>
            <a href="aboutus.html">About</a>
            <a href="login.php">Logout</a>
        </nav>
    </header>
    <body>
    <div class="container">
        <div class="table-title">
            <h1>LIST OF STUDENTS</h1>
            <form method="post">
                <input class="search-bar" type="text" placeholder="Search..." name="search" id="searchInput" value="<?php echo $searchQuery; ?>">
                <button type="submit" class="search-button">Search</button>
                <a href="form.php" class="add-button">Add</a> <!-- Link to the "Add" form -->
                <button type="submit" name="save" class="save-button">Save Changes</button>
            </form>
        </div>
        <form method="post">
            <table>
                <thead>
                    <tr>
                        <th>List of Students LRN</th>
                        <th>Grade Level</th>
                        <th>Degree of Offense (Major)</th>
                        <th>Degree of Offense (Minor)</th>
                        <th>Status</th>
                        <th>Update</th>
                        <th>Edit information</th>
                        <th>Good Moral</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 0; // Initialize an index
                if (mysqli_num_rows($result) == 0) {
                    echo '<tr><td colspan="6">No results found</td></tr>';
                } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td><span class='read-only-input'>" . $row['lrn'] . "</span><input type='text' name='lrn[$i]' value='" . $row['lrn'] . "' class='hidden-input'></td>";
                    echo "<td><span class='read-only-input'>" . $row['level'] . "</span><input type='text' name='level[$i]' value='" . $row['level'] . "' class='hidden-input'></td>";
                    echo "<td><span class='read-only-input'>" . $row['majoroffense'] . "</span><input type='text' name='majoroffense[$i]' value='" . $row['majoroffense'] . "' class='hidden-input'></td>";
                    echo "<td><span class 'read-only-input'>" . $row['minoroffense'] . "</span><input type='text' name='minoroffense[$i]' value='" . $row['minoroffense'] . "' class='hidden-input'></td>";
                    echo "<td><span class='read-only-input'>" . $row['status'] . "</span><input type='text' name='status[$i]' value='" . $row['status'] . "' class='hidden-input'></td>";
                    echo "<td><button type='button' class='edit-button' onclick='editRow(this)'>Update</button></td>";
                    echo "<td class='hidden-id'><input type='hidden' name='id[$i]' value='" . $row['id'] . "'></td>";
                    echo "<td><a href='andFormbackup.php?id=" . $row['id'] . "' class='viewedit-button'>View/Edit</a></td>";
                    echo "<td><a href='certificate.php?id=" . $row['id'] . "' class='good-moral-button'>Good Moral</a></td>";
                    echo "</tr>";
                    $i++; // Increment the index for the next row
                }}
                ?>
                </tbody>
            </table>
            <button type="submit" name="save" class="save-button">Save Changes</button>
        </form>
    </div>

    <script>
    function clearSearchInput() {
        document.getElementById("searchInput").value = "";
    }

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
