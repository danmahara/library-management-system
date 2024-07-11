<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System - Student Navigation</title>
    <style>
        * {
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
    </style>
</head>

<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="bookList.php">View Books</a></li>
            <li><a href="borrowedBooks.php">Borrow History</a></li>
            <!-- <li><a href="profileSettings.php">Profile Settings</a></li> -->
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</body>

</html>