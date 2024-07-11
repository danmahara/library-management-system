<?php
require_once (__DIR__ . "/../book/BookManager.php");
session_start();
if (empty($_SESSION['user_type']) == "student") {
    header('Location:../userLogin.php');

}

$studentName = $_SESSION['student_name']; // Example variable for student's name

$student_id = $_SESSION['user_id'];

$bookManager = new BookManager();
$response = $bookManager->getBorrowedBooks($student_id);
$borrowedBooksArray = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f0f4f8;
            color: #333;
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

        .container {
            margin-top: 70px;
            padding: 20px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .welcome-message {
            text-align: center;
            margin-bottom: 30px;
        }

        .section {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .section h2 {
            margin-bottom: 20px;
            color: #00796b;
        }

        .section table {
            width: 100%;
            border-collapse: collapse;
        }

        .section table,
        .section th,
        .section td {
            border: 1px solid #ddd;
        }

        .section th,
        .section td {
            padding: 12px;
            text-align: left;
        }

        .section th {
            background-color: #f7f7f7;
        }

        .quick-actions,
        .notifications {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .quick-actions button,
        .notifications div {
            background-color: #00796b;
            color: white;
            padding: 15px;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .quick-actions button:hover,
        .notifications div:hover {
            background-color: #004d40;
        }
    </style>
</head>

<body>
    <?php include 'studentNavigation.php';
     ?>

    <div class="container">
        <div class="welcome-message">
            <h1>Welcome, <?php echo htmlspecialchars($studentName); ?>!</h1>
        </div>

        <div class="section">
            <h2>Currently Borrowed Books</h2>
            <table>
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Author</th>
                        <th>Return Date</th>
                        <!-- <th>Actions</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($borrowedBooksArray) && isset($borrowedBooksArray['success']) && $borrowedBooksArray['success'] == true && !empty($borrowedBooksArray['data'])) {
                        foreach ($borrowedBooksArray['data'] as $key => $book) { ?>
                            <tr>
                                <td><?= $book['title']; ?></td>
                                <td><?= $book['author']; ?></td>

                                <td><?= $book['return_date']; ?></td>
                                <!-- <td>
                                    <button>Renew</button>
                                    <button>Return</button>
                                </td> -->
                            </tr>
                        <?php }
                    } ?>
                </tbody>
            </table>
        </div>

        <!-- <div class="section">
            <h2>Available Books</h2>
            <p>Search and explore the library's collection.</p>
            <input type="text" placeholder="Search books..." style="width: 100%; padding: 10px; margin-bottom: 20px;">

            <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                <div
                    style="flex: 1; min-width: 200px; background-color: #fff; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                    <h3>Book Title</h3>
                    <p>Author Name</p>
                    <button
                        style="background-color: #00796b; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer;">View
                        Details</button>
                </div>
            </div>
        </div> -->

        <!-- <div class="section">
            <h2>Borrow History</h2>
            <table>
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Author</th>
                        <th>Borrow Date</th>
                        <th>Return Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>To Kill a Mockingbird</td>
                        <td>Harper Lee</td>
                        <td>2024-06-01</td>
                        <td>2024-06-15</td>
                    </tr>
                </tbody>
            </table>
        </div> -->

        <!-- <div class="quick-actions">
            <button>Search for Books</button>
            <button>Renew Book</button>
            <button>Return Book</button>
        </div> -->

        <!-- <div class="notifications">
            <div>
                <h3>Notification Title</h3>
                <p>Notification message...</p>
            </div>
        </div> -->
    </div>
</body>

</html>