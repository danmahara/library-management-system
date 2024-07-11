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
        }

        html,
        body {
            height: 100%;
            overflow: hidden;
            /* Prevent scrolling */
        }

        /* Main content styles */
        .img--1 {
            height: 100vh;
            width: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            /* Ensures the image stays behind other content */
        }

        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
        }

        .content p {
            font-size: 35px;
            margin-bottom: 15px;
        }

        .seperate {
            height: 4px;
            width: 750px;
            background-color: #ffffff;
            margin: 0 auto;
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
    <!-- Include navigation -->
    <?php include 'indexNavigation.php'; ?>

    <img src="images/back1.jpg" alt="Library Background" class="img--1">

    <div class="content">
        <p>Welcome to Library Management System</p>
        <div class="seperate"></div>
    </div>
</body>

</html>