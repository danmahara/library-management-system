<?php
require_once ('../book/BookManager.php');

session_start();
if (empty($_SESSION['user_type']) == "librarian") {
    header('Location:../userLogin.php');
}

$bookManager = new BookManager();
$book = $bookManager->bookList();
$responseDecode = json_decode($book, true);

?>

<link rel="stylesheet" href="../indexNavigation.css">
<?php include 'librarianNavigation.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librarian Dashboard</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Styling for navigation bar */
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
            padding-top: 70px;
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 80px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #00796b;
            margin-bottom: 15px;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .section-title {
            color: #333;
            font-size: 24px;
        }

        .section-actions a {
            background-color: #00796b;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .section-actions a:hover {
            background-color: #004d40;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            border: 1px solid #ddd;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
            color: #333;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .add-book-form {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }

        .add-book-form input[type="text"],
        .add-book-form input[type="number"] {
            padding: 8px;
            width: 100%;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .add-book-form input[type="submit"] {
            background-color: #00796b;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .add-book-form input[type="submit"]:hover {
            background-color: #004d40;
        }

        .section-actions {
            width: 100%;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
    </style>

    </style>
</head>

<body>
    <div class="container">
        <h2>Librarian Dashboard</h2>

        <!-- Book Management Section -->
        <div class="section">
            <div class="section-header">
                <!-- <div class="section-title">Books Management</div> -->
                <div class="section-actions">
                    <h2>Books List</h2>
                    <a href="addBook.php">Add New Book</a>
                </div>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>ISBN</th>
                            <th>Available Copies</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($responseDecode) && isset($responseDecode['success']) == true) {
                            foreach ($responseDecode['data'] as $key => $book) {
                                ?>
                                <tr>
                                    <td><?= ++$key; ?></td>
                                    <td><?= $book['title']; ?></td>
                                    <td><?= $book['author']; ?></td>
                                    <td><?= $book['isbn']; ?></td>
                                    <td><?= $book['available_copies']; ?></td>
                                </tr>
                            <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</body>

</html>