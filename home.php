<?php
    session_start();
    // Check if user is logged in
    if (!isset($_SESSION['username'])) {
        header("Location: login.php"); // Redirect to login page if not logged in
        exit();
    }
    $username = htmlspecialchars($_SESSION['username']);
    // Retrieve user avatar URL from session or use a default
    $avatarUrl = isset($_SESSION['avatar']) ? htmlspecialchars($_SESSION['avatar']) : 'https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Bites - Home</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTTXRNW4bTcnFy2Ka5+Z6a13k8vHkC0jh3hqI71q8OQsm+H7YxXjmz1T+Dj9ZKygqE3iNFg1iw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #FF6B6B;
            --secondary-color: #4ECDC4;
            --accent-color: #FFD93D;
            --text-color: #333;
            --light-color: #F7F7F7;
            --header-height: 80px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            background-image: url('https://images.pexels.com/photos/941869/pexels-photo-941869.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2');
            background-attachment: fixed;
            background-size: cover;
        }

        .overlay {
            background-color: rgba(255, 255, 255, 0.8);
            min-height: 100vh;
        }

        header {
            background-color: rgba(255, 107, 107, 0.9);
            padding: 0 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            transition: background-color 0.3s ease;
            height: var(--header-height);
            display: flex;
            align-items: center;
        }

        header.scrolled {
            background-color: rgba(255, 107, 107, 1);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: var(--light-color);
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            cursor: pointer;
        }

        .hero {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - var(--header-height));
            color: var(--light-color);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* Optional: Add an overlay color if needed */
        }

        @keyframes pulse {
            0% { opacity: 0.6; }
            50% { opacity: 0.8; }
            100% { opacity: 0.6; }
        }

        .hero-content {
            z-index: 1;
        }

        .hero h1 {
            font-size: 4em;
            margin-bottom: 20px;
            animation: fadeInDown 1s ease-out;
        }

        .hero p {
            font-size: 1.5em;
            margin-bottom: 30px;
            animation: fadeInUp 1s ease-out 0.5s both;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
            align-items: center;
        }

        nav ul li {
            position: relative;
        }

        nav ul li a {
            text-decoration: none;
            color: var(--light-color);
            font-weight: bold;
            padding: 10px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        nav ul li a:hover {
            color: var(--accent-color);
        }

        /* User Greeting and Avatar */
        .user-menu {
            position: relative;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        /* Remove hover to prevent conflict with click-based dropdown */
        /* .user-menu:hover .dropdown {
            display: block;
        } */

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 10px;
            border: 2px solid var(--light-color);
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Updated Greeting Style */
        .greeting {
            color: var(--light-color);
            font-weight: 500; /* Initial font weight */
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px; /* Space between image and text */
        }

        .greeting img {
            width: 24px;
            height: 24px;
            object-fit: cover;
            border-radius: 50%;
        }

        /* Make "Hello" bold */
        .greeting .bold-text {
            font-weight: bold;
        }

        /* Advanced Dropdown Menu - Redesigned */
        .dropdown {
            position: absolute;
            top: 60px;
            right: 0;
            background-color: var(--light-color);
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
            display: none;
            min-width: 220px;
            z-index: 1001;
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.4s ease, transform 0.4s ease;
            overflow: hidden;
        }

        .dropdown.show {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .dropdown a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            text-decoration: none;
            color: var(--text-color);
            transition: background-color 0.3s ease, color 0.3s ease;
            font-size: 1em;
        }

        .dropdown a:hover {
            background-color: var(--secondary-color);
            color: var(--light-color);
        }

        .dropdown a i {
            margin-right: 12px;
            width: 24px;
            text-align: center;
            font-size: 1.2em;
        }

        .dropdown .divider {
            height: 1px;
            background-color: #e0e0e0;
            margin: 8px 0;
        }

        .hero button {
            background-color: var(--accent-color);
            color: var(--text-color);
            padding: 10px 30px;
            font-size: 16px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            animation: fadeInUp 1s ease-out 1s both;
        }

        .hero button:hover {
            background-color: var(--secondary-color);
        }

        .features {
            padding: 50px;
            text-align: center;
            background-color: var(--light-color);
        }

        .features h2 {
            font-size: 2.5em;
            margin-bottom: 40px;
            color: var(--text-color);
            animation: fadeInDown 1s ease-out;
        }

        .features .feature-items {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .feature-item {
            background-color: var(--light-color);
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 250px;
            text-align: center;
            padding: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
            margin: 20px;
            animation: fadeInUp 1s ease-out;
        }

        .feature-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .feature-item img {
            width: 100%;
            height: 150px;
            border-radius: 15px;
            object-fit: cover;
        }

        .feature-item h3 {
            font-size: 1.5em;
            margin: 15px 0;
            color: var(--text-color);
        }

        .feature-item p {
            color: gray;
            margin-bottom: 15px;
        }

        footer {
            padding: 20px;
            background-color: var(--primary-color);
            color: var(--light-color);
            text-align: center;
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInDown {
            0% { opacity: 0; transform: translateY(-50px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(50px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .features .feature-items {
                flex-direction: column;
                align-items: center;
            }

            nav ul {
                flex-direction: column;
                gap: 10px;
                position: absolute;
                top: var(--header-height);
                right: 0;
                background-color: rgba(255, 107, 107, 0.95);
                width: 200px;
                display: none;
                border-bottom-left-radius: 8px;
                border-bottom-right-radius: 8px;
            }

            nav ul.active {
                display: flex;
            }

            .menu-toggle {
                display: block;
                cursor: pointer;
                color: var(--light-color);
                font-size: 24px;
            }
        }

        /* Hamburger Menu */
        .menu-toggle {
            display: none;
        }

        /* Show dropdown when 'show' class is added */
        .dropdown.show {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <nav>
            <div class="logo">Quick Bites!</div>
            <div class="menu-toggle" aria-label="Toggle navigation" tabindex="0">
                <i class="fas fa-bars"></i>
            </div>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="category.php">Menu</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li>
                    <div class="user-menu" tabindex="0" aria-haspopup="true" aria-expanded="false">
                        <div class="user-avatar">
                            <img src="<?php echo $avatarUrl; ?>" alt="User Avatar">
                        </div>
                        <!-- Updated Greeting with Image and Bold "Hello" -->
                        <span class="greeting">
                           
                            <span class="bold-text">Hello, <?php echo $username; ?>!</span>
                        </span>
                        <div class="dropdown" aria-label="User menu">
                            <div class="divider"></div>
                            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to Quick Bites!</h1>
            <p>Your favorite place for delicious meals, fast!</p>
            <a href="category.php">
                <button class="search-btn">Explore Menu</button>
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <h2>Our Features</h2>
        <div class="feature-items">
            <div class="feature-item">
                <img src="https://www.vnahealth.com/wp-content/uploads/2023/03/foods-to-immune-system-boost-scaled.jpeg" alt="Real-time Updates">
                <h3>Real-time Updates</h3>
                <p>Get instant updates on menu availability, promotions, and special deals.</p>
            </div>
            <div class="feature-item">
                <img src="https://images.pexels.com/photos/6646201/pexels-photo-6646201.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Variety of Options">
                <h3>Variety of Options</h3>
                <p>Browse through a wide range of cuisines and dishes.</p>
            </div>
            <div class="feature-item">
                <img src="https://images.pexels.com/photos/5077039/pexels-photo-5077039.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Easy Access">
                <h3>Easy Access</h3>
                <p>See the food with just a few clicks!</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Quick Bites. All rights reserved.</p>
    </footer>

    <script>
        // Add event listener to the header for scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Toggle dropdown on user menu click (for mobile and accessibility)
        const userMenu = document.querySelector('.user-menu');
        const dropdown = document.querySelector('.dropdown');

        const toggleDropdown = () => {
            const isShown = dropdown.classList.contains('show');
            dropdown.classList.toggle('show');
            userMenu.setAttribute('aria-expanded', !isShown);
        };

        userMenu.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleDropdown();
        });

        // Allow toggling via keyboard
        userMenu.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggleDropdown();
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            if (dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
                userMenu.setAttribute('aria-expanded', 'false');
            }
        });

        // Hamburger Menu Toggle (for mobile)
        const menuToggle = document.querySelector('.menu-toggle');
        const navUl = document.querySelector('nav ul');

        const toggleMenu = () => {
            navUl.classList.toggle('active');
        };

        menuToggle.addEventListener('click', () => {
            toggleMenu();
        });

        // Allow toggling menu via keyboard
        menuToggle.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggleMenu();
            }
        });
    </script>
</body>
</html>
