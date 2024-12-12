<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meal Menu with Search</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .search-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background-color: #ffcc00;
        }

        .search-bar {
            width: 50%;
            padding: 10px;
            font-size: 16px;
            border: 2px solid #fff;
            border-radius: 25px;
            outline: none;
            transition: all 0.3s ease;
        }

        .search-bar:focus {
            border-color: #333;
        }

        .search-btn {
            background-color: white;
            color: #ffcc00;
            border: 2px solid #ffcc00;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-left: 10px;
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }
        
        .logout-btn {
            background-color: #ff4444;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 25px;
            transition: background-color 0.3s ease;
            position: absolute;  /* Add this */
            right: 20px;         /* Add this */
        }

        .search-btn:hover, .logout-btn:hover {
            background-color: #ffb300;
            color: white;
        }

        .logout-btn {
            background-color: #ff4444;
            color: white;
            border: none;
        }

        .logout-btn:hover {
            background-color: #cc0000;
        }

        .menu-container {
            text-align: center;
            padding: 50px;
            background-color: #fff8e1;
        }
        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #333;
        }
        p {
            color: gray;
            margin-bottom: 40px;
        }
        .menu-items {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }
        .menu-item {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 250px;
            text-align: center;
            padding: 20px;
            transition: transform 0.2s;
        }
        .menu-item:hover {
            transform: translateY(-10px);
        }
        .menu-item img {
            width: 100%;
            height: 180px;
            border-radius: 15px;
            object-fit: cover;
        }
        .menu-item h3 {
            font-size: 1.5em;
            margin: 15px 0;
            color: #333;
        }
        .menu-item p {
            color: gray;
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
            transition: background-color 0.3s ease;
        }
        .read-more:hover {
            background-color: #ffb300;
        }
        footer {
            margin-top: 30px;
            font-size: 12px;
            color: gray;
        }

    </style>
</head>
<body>
    <!-- Search Bar Container -->

    <div class="search-container">
        <input type="text" class="search-bar" id="searchInput" placeholder="Search for food items...">
        <button class="search-btn" onclick="searchMenu()">Search</button>
        <button class="logout-btn" onclick="logout()">Logout</button>
    </div>
    

    <div class="menu-container">
        <h1>View Our Menu</h1>
        <p>Explore our delicious meal options!</p>
        
        <div class="menu-items" id="menuItems">
            <!-- Breakfast Item -->
            <div class="menu-item">
                <img src="Screenshot 2024-09-27 213238.png" alt="Breakfast">
                <h3>Breakfast</h3>
                <p>Start your day with fresh, healthy breakfast.</p>
                <a href="search_breakfast.php" class="read-more">Read More</a>
            </div>

            <!-- Lunch Item -->
            <div class="menu-item">
                <img src="lunch.jpg" alt="Lunch">
                <h3>Lunch</h3>
                <p>Enjoy a fulfilling lunch for a great afternoon.</p>
                <a href="search_lunch.php" class="read-more">Read More</a>
            </div>

            <!-- Snacks Item -->
            <div class="menu-item">
                <img src="snacks.jpg" alt="Snacks">
                <h3>Snacks</h3>
                <p>Perfect snacks to keep you energized.</p>
                <a href="search_snacks.php" class="read-more">Read More</a>
            </div>
        

    <script>
         function logout() {
            // Here you would typically handle the logout process
            // For this example, we'll just redirect to a hypothetical logout page
            window.location.href = 'logout.php';
        }
     
        // Function to search the menu items
        function searchMenu() {
            let input = document.getElementById('searchInput');
            let filter = input.value.toLowerCase();
            let menuItems = document.getElementById('menuItems');
            let items = menuItems.getElementsByClassName('menu-item');

            for (let i = 0; i < items.length; i++) {
                let title = items[i].getElementsByTagName("h3")[0];
                if (title.innerHTML.toLowerCase().indexOf(filter) > -1) {
                    items[i].style.display = "";
                } else {
                    items[i].style.display = "none";
                }
            }
        }
    </script>
</body>
</html>