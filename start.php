<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Bites - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        :root {
            --primary-color: #FF6B6B;
            --secondary-color: #4ECDC4;
            --accent-color: #FFD93D;
            --text-color: #333;
            --light-color: #F7F7F7;
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
            padding: 20px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            z-index: 1000;
            transition: background-color 0.3s ease;
        }

        header.scrolled {
            background-color: rgba(255, 107, 107, 1);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 80%;
            margin: 0 auto;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            align-items: center;
            color: var(--light-color);
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .hero {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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
            align-items: center; /* This ensures vertical alignment */
        }

        nav ul li a {
            text-decoration: none;
            color: var(--light-color);
            font-weight: bold;
            padding: 10px;
            transition: all 0.3s ease;
            display: flex; /* This helps with alignment */
            align-items: center; /* This ensures vertical centering */
        }

        .profile-icon {
            padding: 0 !important; /* Remove padding from the anchor tag */
        }

        .profile-img {
            width: 32px;  /* Adjust this value to match the height of your text */
            height: 32px; /* Adjust this value to match the height of your text */
            display: block; /* This removes any extra space below the image */
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
            transition: transform 0.2s;
            margin: 20px;
            animation: fadeInUp 1s ease-out;
        }

        .feature-item:hover {
            transform: translateY(-10px);
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
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <nav>
            <div class="logo">Quick Bites!</div>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="register.php">Menu</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="option.php">Log In</a></li> <!-- Log In link -->
                <li><a href="register.php">Register</a></li> <!-- Register link -->
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to Quick Bites!</h1>
            <p>Your favorite place for delicious meals, fast!</p>
            <a href="register.php">
                <button class="search-btn">Explore Menu</button>
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <h2>Our Features</h2>
        <div class="feature-items">
            <div class="feature-item">
                <img src="https://www.vnahealth.com/wp-content/uploads/2023/03/foods-to-immune-system-boost-scaled.jpeg" alt="Food Image">
                <h3>Real-time Updates</h3>
                <p>Get instant updates on menu availability, promotions, and special deals.</p>
            </div>
            <div class="feature-item">
                <img src="https://images.pexels.com/photos/6646201/pexels-photo-6646201.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Food Image">
                <h3>Variety of Options</h3>
                <p>Browse through a wide range of cuisines and dishes</p>
            </div>
            <div class="feature-item">
                <img src="https://images.pexels.com/photos/5077039/pexels-photo-5077039.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Food Image">
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
        // Add event listener to the header
        window.addEventListener('scroll', () =>
        {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>