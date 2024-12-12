<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "canteendb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if form is submitted
    if (isset($_POST['update'])) {
        $foodname = $_POST['foodname'];

        // Check if item already exists
        $checkSql = "SELECT * FROM food WHERE foodname = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("s", $foodname);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            // Item exists, update it
            $updateFields = [];
            $updateValues = [];
            $types = "";

            // Check each field and add to update if it's set
            if (!empty($_POST['price'])) {
                $updateFields[] = "price = ?";
                $updateValues[] = $_POST['price'];
                $types .= "s";
            }
            if (!empty($_POST['foodtype'])) {
                $updateFields[] = "foodtype = ?";
                $updateValues[] = $_POST['foodtype'];
                $types .= "s";
            }
            if (!empty($_POST['foodpreference'])) {
                $updateFields[] = "foodpreference = ?";
                $updateValues[] = $_POST['foodpreference'];
                $types .= "s";
            }
            if (!empty($_POST['quantity'])) {
                $updateFields[] = "quantity = ?";
                $updateValues[] = $_POST['quantity'];
                $types .= "i";
            }
            if (!empty($_POST['availability'])) {
                $updateFields[] = "availability = ?";
                $updateValues[] = $_POST['availability'];
                $types .= "s";
            }

            if (!empty($updateFields)) {
                $updateSql = "UPDATE food SET " . implode(", ", $updateFields) . " WHERE foodname = ?";
                $updateStmt = $conn->prepare($updateSql);

                $updateValues[] = $foodname;
                $types .= "s";

                $updateStmt->bind_param($types, ...$updateValues);

                if ($updateStmt->execute()) {
                    $message = 'Updated item in menu successfully!!';
                } else {
                    $message = 'Error updating item: ' . $conn->error;
                }

                $updateStmt->close();
            } else {
                $message = 'No fields to update.';
            }
        } else {
            $message = 'Item does not exist in the menu.';
        }

        $checkStmt->close();

        // Display message and redirect
        echo '<script>alert("'.$message.'"); window.location.href = "'.$_SERVER['PHP_SELF'].'";</script>';
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
            --primary-color: #6a4c93;
            --secondary-color: #1982c4;
            --background-color: #f0f3f5;
            --text-color: #333333;
            --accent-color: #8ac926;
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
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: var(--text-color);
            font-weight: 500;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(25, 130, 196, 0.2);
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
            font-weight: 600;
        }

        .btn:hover {
            background-color: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
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
        <h2>Update Menu Item</h2>
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
            <button class="btn" type="submit" name="update" >Update</button>
        </form>
    </div>

    <script>
        // Add event listener to the form
        document.getElementById('add-menu-item').addEventListener('submit', (e) => {
            const foodName = document.getElementById('food-name').value;
            const price = document.getElementById('price').value;
            const foodType = document.getElementById('food-type').value;
            const quantity = document.getElementById('quantity').value;
            const availability = document.getElementById('availability').value;

            // Add your logic to save the data here
            console.log(`Food Name: ${foodName}`);
            console.log(`Price: ${price}`);
            console.log(`Food Type: ${foodType}`);
            console.log(`Quantity: ${quantity}`);
            console.log(`Availability: ${availability}`);
        });
    </script>
</body>
</html>