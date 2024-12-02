<?php
session_start(); 

require 'db_connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$message = ''; 
$keepForgotModalOpen = false; 
$keepRegisterModalOpen = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        
        $sql = "SELECT password FROM user WHERE email = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error preparing SQL statement: " . $conn->error);
        }

       
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

       
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $password = $row['password']; 
            $mail = new PHPMailer();
            
            try {
            
                $mail->isSMTP();
                $mail->Host = 'booking.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'booking@gmail.com';
                $mail->Password = 'booking123'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('booking@gmail.com', 'Resort Reservation');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Your Account Password Recovery';
                $mail->Body    = "Hello,<br><br>Your password for the Resort Reservation System is: <strong>$password</strong><br><br>Please use this password to log in.";
                $mail->AltBody = "Hello,\n\nYour password for the Resort Reservation System is: $password\n\nPlease use this password to log in.";

        
                if ($mail->send()) {
                    $message = "<p style='color: green;'>Password has been sent to your email. Please check and try again.</p>";
                } else {
                    $message = "<p style='color: red;'>Failed to send the email. Error: {$mail->ErrorInfo}</p>";
                }
            } catch (Exception $e) {
                $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $message = "<p style='color: red;'>N    .</p>";
        }

        $keepForgotModalOpen = !empty($message); 
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background: url('img1.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        
        }
        .container {
            width: 400px;
            padding: 20px;
            background: rgba(245, 245, 245, 0.6 );
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 {
            font-size: 24px;
            color: #007bff;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        input[type="text"], input[type="password"], input[type="email"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .register, .forgot-password {
            margin-top: 10px;
        }
        .forgot-password a, .register a {
            color: #007bff;
            font-size: 14px;
            text-decoration: none;
        }
        .forgot-password a:hover, .register a:hover {
            text-decoration: underline;
        }
        
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 400px;
            position: relative;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            cursor: pointer;
            color: #aaa;
        }
        .close-btn:hover {
            color: #000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Resort Reservation System</h2>
        <form method="POST" action="index.php">
            <input type="text" name="username" placeholder="Username" required value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>">
            <input type="password" name="password" placeholder="Password" required value="<?php echo isset($_COOKIE['password']) ? $_COOKIE['password'] : ''; ?>">
            <div style="display: flex; align-items: center; justify-content: start; margin-top: 10px;">
                <input type="checkbox" name="remember_me" id="remember_me">
                <label for="remember_me" style="font-size: 14px; margin-left: 5px;">Remember Me</label>
            </div>
            <button type="submit">LOGIN</button>
        </form>
        
        <div class="forgot-password">
            <p><a href="javascript:void(0);" onclick="openForgotPasswordModal()">Forgot Password?</a></p>
        </div>

        <div class="register">
            <p>Don't have an account? <a href="javascript:void(0);" onclick="openRegisterModal()">Register here</a></p>
        </div>
    </div>

    <div id="forgotPasswordModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('forgotPasswordModal')">&times;</span>
            <h2>Forgot Password</h2>
            <form method="POST" action="">
                <input type="email" name="email" placeholder="Enter your email" required>
                <button type="submit">Send Password</button>
            </form>
            <div class="message">
                <?php if (!empty($message)) echo $message; ?>
            </div>
        </div>
    </div>

   
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('registerModal')">&times;</span>
            <h2>Register</h2>
            <form method="POST" action="login.php">
                <input type="text" name="first_name" placeholder="First Name" required>
                <input type="text" name="last_name" placeholder="Last Name" required>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="contact_number" placeholder="Contact Number">
                <input type="text" name="address" placeholder="Address">
                <button type="submit">Sign Up</button>
            </form>
        </div>
    </div>

    <script>
        
        function openForgotPasswordModal() {
            document.getElementById("forgotPasswordModal").style.display = "flex";
        }

        function openRegisterModal() {
            document.getElementById("registerModal").style.display = "flex";
        }

        
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }

        
        <?php if ($keepForgotModalOpen): ?>
            openForgotPasswordModal();
        <?php endif; ?>
        <?php if ($keepRegisterModalOpen): ?>
            openRegisterModal();
        <?php endif; ?>
    </script>
</body>
</html>