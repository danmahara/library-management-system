<?php
require_once (__DIR__ . '/../book/BookManager.php');
require_once (__DIR__ . '/../student/StudentManager.php');
session_start();
if (empty($_SESSION['user_type']) == "admin") {
    header('Location:../userLogin.php');

}

$bookManager = new BookManager();
$studenManager = new StudentManager();
$totalBooks = $bookManager->getTotalBooks();
$totalBorrowedBooks = $bookManager->getTotalBorrowedBooks();
$totalStudents = $studenManager->getTotalStudents();


?>

<?php include 'adminNavigation.php'; ?>

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

        body {
            background-color: #f0f0f0;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .statistics {
            display: flex;
            justify-content: space-evenly;
            margin-bottom: 20px;
        }

        .stat {
            background-color: #00796b;
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 23%;
            text-align: center;
        }

        .section {
            margin-bottom: 30px;
        }

        .section h2 {
            margin-bottom: 10px;
            color: #00796b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        .button {
            background-color: #00796b;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .button:hover {
            background-color: #004d40;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Admin Dashboard</h1>

        <!-- Overview/Statistics Section -->
        <div class="statistics">
            <div class="stat">
                <h3>Total Students</h3>
                <p><?php echo $totalStudents; ?></p>

            </div>
            <div class="stat">
                <h3>Total Books</h3>
                <p><?php echo $totalBooks; ?></p>
            </div>

            <div class="stat">
                <h3>Books Borrowed</h3>
                <p><?php echo $totalBorrowedBooks; ?></p>

            </div>
            <!-- <div class="stat">
                <h3>Overdue Books</h3>
                <p>50</p>
            </div> -->
            <!-- <div class="stat">
                <h3>Registered Users</h3>
                <p>500</p>
            </div> -->
        </div>

        <!-- User Management Section -->
        <div class="section">
            <h2>Student Management</h2>
            <a href="manageStudent.php" class="button">Manage Student</a>
        </div>

        <!-- Book Management Section -->
        <!-- <div class="section">
            <h2>Book Management</h2>
            <a href="manageBooks.php" class="button">Manage Books</a>
        </div> -->

        <!-- Borrow/Return Management Section -->
        <!-- <div class="section">
            <h2>Borrow/Return Management</h2>
            <a href="borrowedBooks.php" class="button">Manage Borrowed Books</a>
        </div> -->

        <!-- Reports Section -->
        <!-- <div class="section">
            <h2>Reports</h2>
            <a href="generateReports.php" class="button">Generate Reports</a>
        </div> -->

        <!-- Notifications Section -->
        <!-- <div class="section">
            <h2>Notifications</h2>
            <p>No new notifications</p>
        </div> -->

        <!-- Settings Section -->
        <!-- <div class="section">
            <h2>Settings</h2>
            <a href="settings.php" class="button">Library Settings</a>
        </div> -->

    </div>
</body>

</html>