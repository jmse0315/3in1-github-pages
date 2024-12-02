<?php include db_connection;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $full_name = htmlspecialchars($_POST['full_name']);
    $email = htmlspecialchars($_POST['email']);
    $pax = htmlspecialchars($_POST['pax']);
    $preferred_time = htmlspecialchars($_POST['preferred_time']);
    $reservation_date = htmlspecialchars($_POST['reservation_date']);
    $contact_number = htmlspecialchars($_POST['contact_number']);
    $message = htmlspecialchars($_POST['message']);

    
    $file = fopen("reservations.txt", "a");
    fwrite($file, "Name: $full_name\nEmail: $email\nPax: $pax\nPreferred Time: $preferred_time\nReservation Date: $reservation_date\nContact Number: $contact_number\nMessage: $message\n\n");
    fclose($file);

    echo "<h1>Thank you, $full_name!</h1>";
    echo "<p>Your reservation request has been received.</p>";
}
?>
