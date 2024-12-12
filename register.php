<?php
    $servername = "localhost"; // Your server name
    $username = "root"; // Your database username
    $password = ""; // Your database password
    $dbname = "canteendb"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $error = ''; // To hold error message

    // Check if the form is submitted
    if (isset($_POST['register'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phonenumber = $_POST['phonenumber'];
        
        // Query to search for the user in the database
        $stmt = $conn->prepare("insert into login (email, password, fullname, phonenumber) values (?,?,?,?)");
        $stmt->bind_param("ssss", $email, $password, $fullname, $phonenumber);
        $stmt->execute();
        $success = "Registered Successfully";
        echo '<script>alert("'.$success.'"); window.location.href = "login.php";</script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Bites - Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 600px;
            max-width: 100%;
            padding: 40px;
            text-align: center;
        }

        .logo h1 {
            font-size: 36px;
            color: #27ae60;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            font-size: 14px;
            color: #333;
            margin-bottom: 10px; /* Add 10px margin bottom to create space between label and input */
            display: block; /* Make label a block element to take full width */
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 20px; /* Add 20px margin bottom to create space between inputs */
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #219150;
        }

        .login-link {
            margin-top: 20px;
            font-size: 14px;
        }

        .login-link a {
            color: #3498db;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="logo">
            <h1>Register - Quick Bites!</h1>
        </div>
        <form id="registerForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label for="full-name">Full Name</label>
                <input type="text" id="full-name" name="fullname" placeholder="Enter your full name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <label for="phone number">Phone Number</label>
                <input type="text" id="phone number" name="phonenumber" placeholder="Enter your Phone Number" required>
            </div>
            <button type="submit" class="btn" name="register" >Register</button>
        </form>
        <div class="login-link">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>