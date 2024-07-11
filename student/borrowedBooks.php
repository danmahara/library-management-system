<?php
require_once (__DIR__ . "/../book/BookManager.php");
session_start();
if (empty($_SESSION['user_type']) == "librarian") {
    header('Location:../userLogin.php');

}
$student_id = $_SESSION['user_id'];
$bookManager = new BookManager();
$response = $bookManager->getBorrowedBooks($student_id);
$borrowedBooksArray = json_decode($response, true);

?>

<?php include 'studentNavigation.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowed Books</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f0f0f0;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto 0;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #00796b;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            border: 1px solid #ddd;
            background-color: #fff;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f2f2f2;
        }

        .empty-message {
            text-align: center;
            font-style: italic;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Borrowed Books</h2>

        <?php
        if (!empty($borrowedBooksArray) && isset($borrowedBooksArray['success']) && $borrowedBooksArray['success'] == true && !empty($borrowedBooksArray['data'])) {
            ?>
            <table>
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Borrow Date</th>
                        <th>Return Date</th>
                        <th>Borrower</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($borrowedBooksArray['data'] as $key => $book) {
                        ?>
                        <tr>
                            <td><?= $key + 1; ?></td>
                            <td><?= $book['title']; ?></td>
                            <td><?= $book['author']; ?></td>
                            <td><?= $book['borrow_date']; ?></td>
                            <td><?= $book['return_date']; ?></td>
                            <td><?= $book['full_name']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } else {
            echo '<p class="empty-message">No borrowed books found.</p>';
        }
        ?>
    </div>
</body>

</html>