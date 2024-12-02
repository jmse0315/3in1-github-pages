<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Villa Belinda Pavilion Resort</title>
        <style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url(hotel.jpg);
            background-color: #f7f9fc;
            color: #333;
        }
        
        .heading1 {
            width: 370px; 
            height: 200px;
           
            color: rgb(37,23,23); 
            padding: 20px;    
            margin: 70px; 
            text-align: left; 
         
            font-size: 33px; 
            
        }
        
        .heading1 h1 {
            margin: 0;
            line-height: 1.2; 
            word-wrap: break-word; 
        }
        
        
        .info {
            text-align: center;
            font-size: 1.2em;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #ffffff;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 20px auto;
        }
        
        .login-container {
            margin:-left 40%;
            width: 300px; position:fixed;
                    left: 43%;
                    top: 32%;
                    transform: translateY(-50%);
            padding: 20px;
            background-color: white;
            border-radius: auto;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        
        .login-container h1 {
            text-align: center;
            color: #4caf50;
            margin-bottom: 20px;
        }
        
        .login-container label {
            font-size: 1em;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }
        
        .login-container input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
            box-sizing: border-box;
        }
        
        textarea {
            resize: vertical;
            min-height: 80px;
        }
        
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .login-container button:hover {
            background-color: #45a049;
        }
        .Login-container1 {
            margin:-left 40%;
            width: 300px; 
            padding: 30px;
            background-color: white;
            border-radius: auto;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            text-align: right;
        }
                
                .Login-container1 {
                    position: fixed;
                    left: 0%;
                    top: 38%;
                    transform: translateY(-50%);
                    width: 300px;
                    padding: 20px ;
                    background-color: white;
                    margin-left: 70%;
                    height: 400px;
                    
                 }
                 .register input[type="text"],
                 .register input[type="password"] {
                     width: 100%;
                     padding: 10px;
                     margin: 10px 0;
                     border: 1px solid #ccc;
                     box-sizing: border-box;
                 }
        
        .p2 {
            text-align: left;
            font-size: 20px;
            margin-top: 20px;
            margin: 40px;
        }
        
        p a {
            color: #4caf50;
            text-decoration: none;
            font-weight: bold;
            
        }
        
        p a:hover {
            text-decoration: underline;
        }
        </style>    
        
</head>
<body>
<div class="heading1">
    <h1>MAKE<br>YOURSELF<br>AT HOME</h1>
</div>

<b>
<div class="p2">
    <p><font color="white">
        We accept walk-in guests subject to availability of<br>
        facilities. For reservation, full payment is a must.<br><br>
        We accept online payment through Gcash,<br>BPI / BDO Bank.</font>
    </p>
</div>
</b>

<form action="process_booking.php" method="post">
    <div class="login-container">
        <h1><b>Book Now</b></h1>
        <label for="full_name"><b>Enter Full Name</b></label>
        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Write your full name" required>
        
        <label for="email"><b>Enter Email Address</b></label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Write your email here" required>
        
        <label for="pax"><b>Number of Pax</b></label>
        <input type="number" class="form-control" id="pax" name="pax" placeholder="How many persons" required>
        
        <label for="time"><b>Preferred Time</b></label>
        <input type="time" class="form-control" id="time" name="time" required>
    </div>

    <div class="Login-container1">
        <center><label for="date"><b>Reservation Schedule</b></label>
        <input type="date" class="form-control" id="date" name="date" required><br>
        
        <label for="contact"><b>Contact No#</b></label>
        <input type="tel" class="form-control" id="contact" name="contact" placeholder="+63 " required><br>
        <p><b>Your message:</b></p></center>
        
        <textarea name="message" placeholder="Your suggestions (Optional)"></textarea><br>
        <p>Here's our <a href="Reservation rate.html">Room rates</a></p>
        <button type="submit">Submit</button>
    </div>
</form>
</body>
</html>
