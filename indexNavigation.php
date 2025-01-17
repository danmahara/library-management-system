<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        nav {
            background-color: #00796b;
            width: 100%;
            padding: 15px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        nav ul {
            list-style-type: none;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #e0f7fa;
        }

        body {
            padding-top: 70px; /* Adjust based on nav height */
        }

        .search-container {
            display: flex;
            align-items: center;
        }

        .search-container input {
            height: 25px;
            width: 250px;
            margin-right: 10px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .search-container button {
            height: 37px;
            width: 37px;
            background-color: orange;
            color: white;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
        }

        .search-container button ion-icon {
            font-size: 18px;
            font-weight: 900;
        }
    </style>
</head>

<body>
    <!-- Navigation starting -->
    <nav>
        <ul>
            <li><a href="index.php">LMS</a></li>
            <li><a href="booksList.php">View Books</a></li>
            <li><a href="userLogin.php">Login</a></li>
            <li><a href="userRegister.php">Register</a></li>
        </ul>
    </nav>
    <!-- Navigation ending -->

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
