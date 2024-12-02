<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "villa_resort";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$pax = $_POST['pax'];
$time = $_POST['time'];
$date = $_POST['date'];
$contact = $_POST['contact'];
$message = $_POST['message'];

// Step 1: Check if there's already a reservation for the same date
$sql_check = "SELECT * FROM reservations WHERE date = '$date'";
$result = $conn->query($sql_check);

// If a reservation exists for the same day
if ($result->num_rows > 0) {
    echo "<h1>Sorry, this date is already booked.</h1>";
    echo "<p>Please choose another date.</p>";
    echo "<p><a href='index.php'>Go Back</a></p>";
} else {
    // Step 2: Proceed to insert the new reservation if no existing reservation found
    $sql = "INSERT INTO reservations (full_name, email, pax, time, date, contact, message) 
            VALUES ('$full_name', '$email', '$pax', '$time', '$date', '$contact', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<h1>Thank you for your reservation!</h1>";
        echo "<p>We have received your details and will contact you shortly.</p>";
        echo "<p><a href='index.php'>Go Back</a></p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
