<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        * {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 200px;
        }

        .logo a {
            text-decoration: none;
            color: white;
            font-size: 20px;
            font-weight: bold;
            transition: color 0.3s;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #00796b;
            width: 100%;
            padding: 15px 20px;
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
            flex-wrap: wrap;
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

        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .menu-toggle div {
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 5px 0;
            transition: 0.4s;
        }

        @media (max-width: 768px) {
            nav ul {
                display: none;
                flex-direction: column;
                width: 100%;
                text-align: center;
                padding: 10px 0;
                background-color: #00796b;
                position: absolute;
                top: 60px;
                left: 0;
            }

            nav ul li {
                margin: 10px 0;
            }

            nav ul.show {
                display: flex;
            }

            .menu-toggle {
                display: flex;
            }
        }
    </style>
</head>

<body>
    <nav>
        <div class="logo">
            <a href="./">Admin Panel</a>
        </div>
        <div class="menu-toggle" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <ul>
            <li><a href="./">Dashboard</a></li>
            <!-- <li><a href="manageUsers.php">Manage Librarian</a></li> -->
            <li><a href="manageStudent.php">Manage Student</a></li>
            <!-- <li><a href="borrowedBooks.php">Borrowed Books</a></li> -->
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <script>
        function toggleMenu() {
            const menu = document.querySelector('nav ul');
            menu.classList.toggle('show');
        }
    </script>
</body>

</html>