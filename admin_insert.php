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

    // Check if form is submitted
    if (isset($_POST['insert'])) {
        echo "connected";
        $foodname = $_POST['foodname'];
        $price = $_POST['price'];
        $foodtype = $_POST['foodtype'];
        $foodpreference = $_POST['foodpreference'];
        $quantity = $_POST['quantity'];
        $availability = $_POST['availability'];

        // Check if item already exists
        $checkSql = "SELECT * FROM food WHERE foodname = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("s", $foodname);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            echo json_encode(["status" => "error", "message" => "Item already exists in the menu."]);
        } else {
            // Insert new item
            $insertSql = "INSERT INTO food (foodname, price, foodtype, foodpreference, quantity, availability) VALUES (?, ?, ?, ?, ?, ?)";
            $insertStmt = $conn->prepare($insertSql);
            $insertStmt->bind_param("ssssis", $foodname, $price, $foodtype, $foodpreference, $quantity, $availability);

            if ($insertStmt->execute()) {
                $error = 'Added item to menu successfully!!';
                echo '<script>alert("'.$error.'"); window.location.href = "'.$_SERVER['PHP_SELF'].'";</script>';
            } else {
                $error = 'Invalid item entry!!';
                echo '<script>alert("'.$error.'"); window.location.href = "'.$_SERVER['PHP_SELF'].'";</script>';

            }

            $insertStmt->close();
        }

        $checkStmt->close();
    }

    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu Item</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        :root {
            --primary-color: #ff6b6b;
            --secondary-color: #4ecdc4;
            --background-color: #f7f7f7;
            --text-color: #2d3436;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('https://www.transparenttextures.com/patterns/food.png');
        }

        .container {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 600px;
            transform: translateY(50px);
            opacity: 0;
            animation: fadeIn 0.5s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: var(--text-color);
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .btn {
            background-color: var(--secondary-color);
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 16px;
            display: block;
            width: 100%;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #45a049;
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .icon {
            margin-right: 10px;
        }

        .food-icon {
            font-size: 48px;
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 20px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            40% {transform: translateY(-30px);}
        }
    </style>
</head>
<body>
    <div class="container">
        <i class="fas fa-utensils food-icon"></i>
        <h2>Add Menu Item</h2>
        <form id="add-menu-item" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label for="food-name">Food Name:</label>
                <input type="text" id="food-name" name="foodname" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="food-type">Food Type:</label>
                <select id="food-type" name="foodtype" required>
                    <option value="">Select Food Type</option>
                    <option value="breakfast">Breakfast</option>
                    <option value="lunch">Lunch</option>
                    <option value="snacks">Snacks</option>
                </select>
            </div>
            <div class="form-group">
                <label for="food-preference">Food Type:</label>
                <select id="food-preference" name="foodpreference" required>
                    <option value="">Select Food Preference</option>
                    <option value="veg">Veg</option>
                    <option value="non-veg">Non-Veg</option>
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="availability">Availability:</label>
                <select id="availability" name="availability" required>
                    <option value="">Select Availability</option>
                    <option value="available">Available</option>
                    <option value="not available">Not Available</option>
                </select>
            </div>
            <button class="btn" type="submit" name="insert" >Save</button>
        </form>
    </div>

    <script>
        document.getElementById('add-menu-item').addEventListener('submit', (e) => {
        const form = e.target;
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            // Handle the response here
        })
        .catch(error => console.error('Error:', error));
    });
    </script>
</body>
</html>