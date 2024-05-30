<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header with Logo and Navigation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        /* Resetting default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styles */
        body {
            font-family: Arial, sans-serif;
        }

        /* Header styles */
        header {
            background-color:#325fd7;
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        header .logo {
            margin-right: auto;
        }

        header .logo img {
            height: 40px; /* Adjust height as needed */
        }

        header nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        header nav ul li {
            margin-right: 20px;
        }

        header nav ul li:last-child {
            margin-right: 0;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        header nav ul li a:hover {
            color: #ffcc00;
        }
        footer {
            margin-top:32%;
            background-color: #325fd7;
            color: #fff;
            padding: 15px 15px;
            text-align: center;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.2);
        }
        footer .social-icons a {
            color: #fff;
            text-decoration: none;
            margin: 0 30px;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        footer .social-icons a:hover {
            color: #ffcc00;
        }

        footer .copyright {
            font-size: 14px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <div class="logo">
            <img src="your-logo.png" alt="Your Logo">
        </div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
                <?php if(isset($_SESSION['fullname'])){?>
                   <li> <a href="logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
                   <div><?=$_SESSION['fullname']?></div>
                   <?php }else{?>
                    <a href="login.php"><i class="fa fa-sign-in"></i>Login</a><?php } ?>
            </ul>
        </nav>
    </header>

    <!-- Main content -->
    <div>
    <a href="addproject.php">Add a Project</a>
    <p>Welcome</p>
       
    </div>


    <footer>
        <div class="social-icons">
            <a href="mailto:info@example.com" target="_blank" title="Email"><i class="fa-brands fa-facebook-f"></i> Email</a>
            <a href="https://www.example.com" target="_blank" title="Website"><i class="fas fa-globe"></i> Website</a>
            <a href="https://www.facebook.com/example" target="_blank" title="Facebook"><i class="fab fa-facebook"></i> Facebook</a>
            <a href="https://www.instagram.com/example" target="_blank" title="Instagram"><i class="fab fa-instagram"></i> Instagram</a>
        </div>
        <p class="copyright">© 2024 Your Website. All rights reserved.</p>
    </footer>
</body>
</html>