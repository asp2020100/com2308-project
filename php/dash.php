<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contactme";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete functionality - Closed
/*
if (isset($_GET['delete']) && isset($_GET['email'])) {
    $deleteEmail = $_GET['email'];
    $sql = "DELETE FROM contact_us WHERE email = '$deleteEmail'";
    if ($conn->query($sql) === TRUE) {
        // Record deleted successfully
        header('Location: welcome.php');
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
*/

// Retrieve data from the database
$sql = "SELECT * FROM contact_us";
$result = $conn->query($sql);

// Close the database connection
$conn->close();

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="welcome.css">
</head>

<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
   
 <br><br>

<div class="container">
        <h1>Saved Contact Data</h1>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='contact-info'>";
            echo "<p><strong>Name:</strong> " . $row["name"] . "<br>";
            echo "<strong>Email:</strong> " . $row["email"] . "<br>";
            echo "<strong>Message:</strong> " . $row["message"] . "</p>";
           /* echo "<a href='?delete=true&email=" . $row["email"] . "'>Delete</a>";.*/
            echo "</div>";
        }
    } else {
        echo "No data to display.";
    }
?>

</div>

    <br>     <br>   <br>  
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
        <a href="http://localhost/COM-2303-Assignment-04/contact-us-php/login.php" class="btn btn-danger ml-3">Delete Contact us Data </a>
    </p>
</body>
</html>