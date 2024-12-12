<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Options</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.pexels.com/photos/1640773/pexels-photo-1640773.jpeg?auto=compress&cs=tinysrgb&w=600') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .menu-container {
            text-align: center;
            padding: 50px;
            background-color: rgba(255, 248, 225, 0.9);
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #333;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        p {
            color: #555;
            margin-bottom: 40px;
        }

        .menu-items {
            display: flex;
            justify-content: center;
            gap: 50px;
            flex-wrap: wrap;
        }

        .menu-item {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .menu-item img {
            width: 100%;
            height: 280px;
            border-radius: 15px;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .menu-item:hover img {
            transform: scale(1.05);
        }

        .menu-item h3 {
            font-size: 1.5em;
            margin: 25px 0;
            color: #333;
        }

        .menu-item p {
            color: #666;
            margin-bottom: 15px;
        }

        .read-more {
            padding: 10px 20px;
            background-color: #ffcc00;
            border: none;
            color: white;
            text-transform: uppercase;
            font-weight: bold;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .read-more:hover {
            background-color: #ffb300;
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(255, 204, 0, 0.4);
        }

        footer {
            margin-top: 30px;
            font-size: 12px;
            color: #ddd;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <div class="menu-container">
        <h1>Login Options</h1>
        <p>Please select your login type:</p>
        
         <div class="menu-items" id="menuItems">
            <!-- Student Login -->
            <div class="menu-item">
                <img src="student.png" alt="Student Login">
                <h3>Student Login</h3>
        
                <a href="login.php" class="read-more">Login</a>
            </div>

            <!-- Admin Login -->
            <div class="menu-item">
                <img src="admin.png" alt="Admin Login">
                <h3>Admin Login</h3>
            
                <a href="admin_login.php" class="read-more">Login</a>
            </div>
        </div>
    </div>

</body>
</html>