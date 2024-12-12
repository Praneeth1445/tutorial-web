<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Admin Dashboard</title>
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
            overflow-x: hidden;
        }
        .container {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: var(--primary-color);
            padding: 20px;
            transition: all 0.5s ease;
        }
        .sidebar h2 {
            margin-bottom: 30px;
            font-weight: 600;
            text-align: center;
            color: white;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        .sidebar li {
            margin-bottom: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 10px;
            border-radius: 5px;
            color: white;
        }
        .sidebar li:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        .main-content {
            flex-grow: 1;
            padding: 30px;
            transition: all 0.5s ease;
        }
        .card {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            transition: all 0.5s ease;
            opacity: 0;
            transform: translateY(50px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card h3 {
            margin-top: 0;
            color: var(--primary-color);
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
            margin: 10px;
            outline: none;
        }
        .btn:hover {
            background-color: #45a049;
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .btn:active {
            transform: scale(0.95);
        }
        .icon {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2><i class="fas fa-utensils icon"></i>Food Admin</h2>
            <ul>
                <li onclick="showSection('insert')"><i class="fas fa-plus icon"></i>Add Menu Item</li>
                <li onclick="showSection('update')"><i class="fas fa-edit icon"></i>Update Menu Item</li>
            </ul>
        </div>
        <div class="main-content">
            <div id="insert" class="card">
                <h3><i class="fas fa-plus icon"></i>Add Menu Item</h3>
                <a href="admin_insert.php" class="btn">Add Item</a>
            </div>
            <div id="update" class="card">
                <h3><i class="fas fa-edit icon"></i>Update Menu Item</h3>
                <a href="admin_update.php" class="btn">Update Item</a>
            </div>
        </div>
    </div>

    <script>
        let currentSection = 'insert';

        function showSection(section) {
            document.getElementById(currentSection).style.opacity = 0;
            document.getElementById(currentSection).style.transform = 'translateY(50px)';
            setTimeout(() => {
                document.getElementById(currentSection).style.display = 'none';
                document.getElementById(section).style.display = 'block';
                document.getElementById(section).style.opacity = 1;
                document.getElementById(section).style.transform = 'translateY(0)';
            }, 500);
            currentSection = section;
        }

        // Animate the cards on page load
        setTimeout(() => {
            document.getElementById('insert').style.opacity = 1;
            document.getElementById('insert').style.transform = 'translateY(0)';
        }, 500);

        // Add event listener to the sidebar
        document.querySelector('.sidebar').addEventListener('mouseover', () => {
            document.querySelector('.sidebar').style.width = '300px';
            document.querySelector('.main-content').style.paddingLeft = '320px';
        });

        document.querySelector('.sidebar').addEventListener('mouseout', () => {
            document.querySelector('.sidebar').style.width = '250px';
            document.querySelector('.main-content').style.paddingLeft = '270px';
        });
    </script>
</body>
</html>