<?php
require_once ('../book/BookManager.php');
require_once ('LibrarianManager.php');
session_start();
if (empty($_SESSION['user_type']) == "librarian") {
    header('Location:../userLogin.php');

}
if (!empty($_POST)) {
    $bookTitle = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $avialable_copies = $_POST['availableCopies'];

    $bookManager = new BookManager();
    $response = $bookManager->addBook($bookTitle, $author, $isbn, $avialable_copies);
    $responseDecode = json_decode($response, true);

}
?>

<link rel="stylesheet" href="../indexNavigation.css">
<?php include 'librarianNavigation.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book </title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #00796b;
            margin-bottom: 20px;
            text-align: center;
        }

        .wrap {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        .viewBooks {
            text-decoration: none;
            color: blue;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #00796b;
            outline: none;
        }

        .error {
            /* color: red; */
            font-size: 14px;
            margin-top: 5px;
        }

        button {
            background-color: #00796b;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #004d40;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="wrap">
            <h2>Add Book Form</h2>
            <h2><a href="manageBooks.php" class="viewBooks" style="">View Books </a> </h2>

        </div>
        <?php if (!empty($responseDecode) && isset($responseDecode['success']) && $responseDecode['success'] == true && !empty($responseDecode['data'])) {
            if ($responseDecode['success'])
            ?>
            <p class="success"><?= $responseDecode['message'] ?></p>
        <?php } else { ?>
            <p class="error"><?= isset($responseDecode['message']) ? $responseDecode['message'] : '' ?></p>

        <?php } ?>

        <form id="addBookForm" action="" method="post">
            <div>
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" required>
                <span class="error" id="titleError"></span>
            </div>
            <div>
                <label for="author">Author:</label><br>
                <input type="text" id="author" name="author" required>
                <span class="error" id="authorError"></span>
            </div>
            <div>
                <label for="isbn">ISBN:</label><br>
                <input type="text" id="isbn" name="isbn" required>
                <span class="error" id="isbnError"></span>
            </div>
            <div>
                <label for="availableCopies">Available Copies:</label><br>
                <input type="number" id="availableCopies" name="availableCopies" required>
                <span class="error" id="availableCopiesError"></span>
            </div>
            <div>
                <button type="button" onclick="validateForm()">Add Book</button>
            </div>
        </form>
    </div>

    <script>
        function validateForm() {
            // Reset error messages
            document.getElementById('titleError').textContent = '';
            document.getElementById('authorError').textContent = '';
            document.getElementById('isbnError').textContent = '';
            document.getElementById('availableCopiesError').textContent = '';

            // Get form values
            let title = document.getElementById('title').value.trim();
            let author = document.getElementById('author').value.trim();
            let isbn = document.getElementById('isbn').value.trim();
            let availableCopies = document.getElementById('availableCopies').value.trim();

            let isValid = true;

            // Validate Title
            if (title === '') {
                document.getElementById('titleError').textContent = 'Title is required';
                isValid = false;
            }

            // Validate Author
            if (author === '') {
                document.getElementById('authorError').textContent = 'Author is required';
                isValid = false;
            }

            // Validate ISBN (Basic validation for numeric characters)
            if (isbn === '') {
                document.getElementById('isbnError').textContent = 'ISBN is required';
                isValid = false;
            } else if (!/^\d+$/.test(isbn)) {
                document.getElementById('isbnError').textContent = 'ISBN should contain only numeric characters';
                isValid = false;
            }

            // Validate Available Copies (Should be a positive integer)
            if (availableCopies === '') {
                document.getElementById('availableCopiesError').textContent = 'Available Copies is required';
                isValid = false;
            } else if (!/^\d+$/.test(availableCopies)) {
                document.getElementById('availableCopiesError').textContent = 'Available Copies should be a number';
                isValid = false;
            } else if (parseInt(availableCopies) <= 0) {
                document.getElementById('availableCopiesError').textContent = 'Available Copies should be greater than zero';
                isValid = false;
            }

            // If form is valid, submit it (You can replace this with actual form submission logic)
            if (isValid) {
                document.getElementById('addBookForm').submit();
            }
        }
    </script>
</body>

</html>