<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen Menu</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('https://images.pexels.com/photos/5639754/pexels-photo-5639754.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'); 
            background-size: cover; 
            background-position: center; 
            background-attachment: fixed; 
            background-repeat: no-repeat; 
            transition: background-color 0.3s ease;
        }

        .search-container {
            display: flex;
            justify-content: center;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
            animation: slideInDown 1s ease-in-out; /* Smooth slide-in animation */
        }

        .search-bar {
            width: 50%;
            padding: 10px;
            font-size: 16px;
            border: 2px solid #ccc;
            border-radius: 25px;
            outline: none;
            transition: all 0.3s ease;
        }

        .search-bar:focus {
            border-color: #333;
            box-shadow: 0 0 5px rgba(51, 51, 51, 0.3); /* Add a subtle glow effect */
        }

        .search-btn {
            background-color: #ffcc00;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-left: 10px;
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }

        .search-btn:hover {
            background-color: #ffb300;
        }

        .table-container {
            margin-top: 50px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); 
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
            border-radius: 10px;
            overflow: hidden;
            animation: fadeInUp 1s ease-in-out; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            transition: all 0.3s ease;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f9f9f9; 
            cursor: pointer; /* Indicate rows are interactive */
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; 
        }

        /* Style for unavailable items */
        .unavailable {
            color: red; 
            font-style: italic;
        } /* Style for available items */
        .available {
            color: green; 
            font-weight: bold;
        }

        @keyframes slideInDown {
            0% {
                transform: translateY(-100%);
            }
            100% {
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            0% {
                transform: translateY(100%);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>

    <!-- Search Bar Container at the Top -->
    <div class="search-container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" class="search-bar" name="search" placeholder="Search for food items...">
            <button type="submit" class="search-btn">Search</button>
        </form>
    </div>

    <!-- Table Container -->
    <div class="table-container">
        <table>
            <tr>
                <th>Food Name</th>
                <th>Price</th>
                <th>Food Type</th>
                <th>Veg / Non-Veg</th>
                <th>Quantity</th>
                <th>Availability</th>
            </tr>
            <?php
                $servername = "localhost"; 
                $username = "root"; 
                $password = ""; 
                $dbname = "canteendb"; 

                $conn = new mysqli($servername, $username, $password, $dbname);
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
        

                $error = ''; 
                $sql = "SELECT * FROM food WHERE foodtype='snacks'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $food_name = $row["foodname"];
                        $price = $row["price"];
                        $food_type = $row["foodtype"];
                        $food_preference = $row["foodpreference"];
                        $quantity = $row["quantity"];
                        $availability = $row["availability"];

                        if ($availability == "available") {
                            $availability_color = "green";
                            $availability_class = "available";
                        } else {
                            $availability_color = "red";
                            $availability_class = "unavailable";
                        }
                        echo "<tr>
                            <td>$food_name</td>
                            <td>$price</td>
                            <td>$food_type</td>
                            <td>$food_preference</td>
                            <td>$quantity</td>
                            <td class='$availability_class'>$availability</td>
                        </tr>";
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
            ?>
        </table>
        <script>
            const searchBar = document.querySelector('.search-bar');
            const foodTable = document.querySelector('table');

            searchBar.addEventListener('input', () => {
                const searchValue = searchBar.value.toLowerCase();
                const rows = foodTable.getElementsByTagName('tr');

                for (let i = 1; i < rows.length; i++) {
                    const row = rows[i];
                    const cells = row.getElementsByTagName('td');

                    let match = false;

                    for (let j = 0; j < cells.length; j++) {
                        const cell = cells[j];
                        const cellText = cell.textContent.toLowerCase();

                        if (cellText.includes(searchValue)) {
                            match = true;
                            break;
                        }
                    }

                    if (match) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
        </script>
    </div>
</body>
</html>