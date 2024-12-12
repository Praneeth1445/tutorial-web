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
    if (isset($_POST['SignIn'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        // Query to search for the user in the database
        $stmt = $conn->prepare("SELECT * FROM login WHERE email = ? and password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
            
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            session_start();
            $_SESSION['username'] = $user['fullname'];   
            header('Location:home.php');
            exit;
        } else {
            // If user doesn't exist, show error message
            $error = 'Invalid email or password';
            echo '<script>alert("'.$error.'"); window.location.href = "'.$_SERVER['PHP_SELF'].'";</script>';
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Bites - Login</title>
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
            display: flex;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 800px;
            max-width: 100%;
            overflow: hidden;
        }

        .image {
            flex: 1;
            background-image: url('https://images.pexels.com/photos/28302512/pexels-photo-28302512/free-photo-of-spices-on-a-spoon-with-a-spoon-in-the-middle.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'); 
            background-size: cover;
            background-position: center;
        }

        .form-container {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .logo {
            margin-bottom: 20px;
            text-align: center;
        }

        .logo img {
            width: 100px;
        }

        .logo h1 {
            font-size: 36px;
            color: #27ae60;
            margin: 10px 0;
        }

        .form-group {
            width: 100%;
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 48%;
        }

        .btn-login {
            background-color: #27ae60;
            color: #fff;
        }

        .btn-register {
            background-color: #f1c40f;
            color: #fff;
        }

        .contact-link {
            margin-top: 20px;
            font-size: 14px;
            color: #3498db;
            text-align: center;
        }

        .contact-link a {
            color: #3498db;
            text-decoration: none;
        }

        .contact-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Left Image Section -->
        <div class="image"></div>

        <!-- Right Form Section -->
        <div class="form-container">
            <div class="logo">
                <img src="https://cdn-icons-png.flaticon.com/512/3075/3075977.png" alt="Logo">
                <h1>Quick Bites!</h1>
            </div>
            <form id="loginForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                </div>
                <div class="btn-container">
                    <button type="submit" class="btn btn-login" name="SignIn" >Sign In</button>
                    <button type="button" class="btn btn-register" onclick="window.location.href='register.php'">Register</button>
                </div>
            </form>
            <div class="contact-link">
                <p><a href="contact.html">Click here to contact me</a></p>
            </div>
        </div>
    </div>
</body>
</html>
