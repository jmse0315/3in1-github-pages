<?php
session_start();
include 'login.php';
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $role = 'user'; 

  
    $storedPassword = ($role === 'admin') ? password_hash($password, PASSWORD_DEFAULT) : $password;

   
    $stmt = $conn->prepare("INSERT INTO user (first_name, last_name, username, password, role, contact_number, email, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die('Error preparing statement: ' . $conn->error);
    }

    $stmt->bind_param("ssssssss", $first_name, $last_name, $username, $storedPassword, $role, $contact_number, $email, $address);

    if ($stmt->execute()) {
        $user_id = $conn->insert_id;

        
        $activity_description = "User registered: " . $username;
        $stmt_log = $conn->prepare("INSERT INTO activity_log (user_id, activity_description) VALUES (?, ?)");
        $stmt_log->bind_param("is", $user_id, $activity_description);
        $stmt_log->execute();
        $stmt_log->close();

       
        echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 400px;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="text"], input[type="password"], input[type="email"], input[type="tel"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF; 
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form method="POST" action="">
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="tel" name="contact_number" placeholder="Contact Number" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="address" placeholder="Address" required>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>