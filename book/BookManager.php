<?php
require_once (__DIR__ . '/../config/DatabaseConnection.php');

class BookManager extends DatabaseConnection
{
    public function __construct()
    {
        parent::__construct();
    }


    function addBook($bookTitle, $author, $isbn, $availableCopies)
    {
        $response = [];

        // Check if required fields are empty
        if (empty($bookTitle) || empty($isbn) || empty($availableCopies)) {
            $response = [
                'success' => false,
                'message' => 'Title, ISBN, Available Copies fields are required'
            ];
            return json_encode($response);
        }

        // Prepare SQL statement
        $stmt = $this->conn->prepare("INSERT INTO books (title, author, isbn, available_copies) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $bookTitle, $author, $isbn, $availableCopies);

        // Execute the statement
        if ($stmt->execute()) {
            $response = [
                'success' => true,
                'message' => 'Book added successfully'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Error adding book: ' . $this->conn->error
            ];
        }

        // Close statement and connection
        // $this->stmt->close();
        $this->conn->close();

        return json_encode($response);
    }
    function updateBook($bookTitle, $author, $isbn, $availableCopies)
    {
        $response = [];

        // Check if required fields are empty
        if (empty($bookTitle) || empty($isbn) || empty($availableCopies)) {
            $response = [
                'success' => false,
                'message' => 'Title, ISBN, Available Copies fields are required'
            ];
            return json_encode($response);
        }

        // Prepare SQL statement
        $stmt = $this->conn->prepare("UPDATE books SET title=?, author=?, isbn=?, available_copies=? WHERE isbn=?");
        $stmt->bind_param("sssii", $bookTitle, $author, $isbn, $availableCopies, $isbn);

        // Execute the statement
        if ($stmt->execute()) {
            $response = [
                'success' => true,
                'message' => 'Book updated successfully'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Error updating book: ' . $stmt->error
            ];
        }

        // Close statement and connection
        $stmt->close();
        // $this->conn->close();

        return json_encode($response);
    }


    public function getBookDetails($book_id)
    {
        $response = [];
        if (empty($book_id)) {
            $response = [
                'success' => false,
                'message' => 'Select book item'
            ];
            return json_encode($response);
        }
        $sql = "SELECT * FROM books WHERE id='$book_id' ";
        $result = $this->conn->query($sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $response[] = $row;
            }
            //     $response = [
            //         'success' => true,
            //         'message' => 'Category found',
            //         'category' => $row
            // ];

        } else {
            $response = [
                'success' => false,
                'message' => 'Book not found'
            ];
        }
        return json_encode($response);

    }

    function bookList()
    {
        $response = [];

        // Prepare SQL statement
        try {

            $sql = "SELECT id,title, author, isbn, available_copies FROM books";

            $result = $this->conn->query($sql);
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

        if ($result && mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                $response['data'][] = $row; // Add each product to the array
            }
            $response['success'] = true;
            $response['message'] = 'Data found';
        } else {
            $response = [
                'success' => false,
                'message' => "No products found"
            ];
        }

        // Return the response in JSON format
        return json_encode($response);
    }


    function deleteBook($book_id)
    {
        $response = [];

        if (empty($book_id)) {
            $response = [
                'success' => false,
                'message' => 'Book id is not found'
            ];
            return json_encode($response);
        }

        // Prepare SQL statement
        $stmt = $this->conn->prepare("DELETE FROM books WHERE id = ?");
        $stmt->bind_param("i", $book_id);

        // Execute the statement
        if ($stmt->execute()) {
            $response = [
                'success' => true,
                'message' => 'Book is deleted'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to delete book'
            ];
        }

        // Close the statement
        $stmt->close();

        return json_encode($response);
    }


    public function borrowBook($book_id, $user_id)
    {
        $response = [];

        // Check if book_id is empty
        if (empty($book_id)) {
            $response = [
                'success' => false,
                'message' => 'Book id is not found'
            ];
            return json_encode($response);
        }

        // Check if user_id is empty
        if (empty($user_id)) {
            $response = [
                'success' => false,
                'message' => 'User id is not found'
            ];
            return json_encode($response);
        }

        // Check if the book is available
        $stmt = $this->conn->prepare("SELECT available_copies FROM books WHERE id = ?");
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $book = $result->fetch_assoc();

        if ($book['available_copies'] > 0) {
            // Decrease the available copies
            $new_copies = $book['available_copies'] - 1;
            $stmt = $this->conn->prepare("UPDATE books SET available_copies = ? WHERE id = ?");
            $stmt->bind_param("ii", $new_copies, $book_id);
            if ($stmt->execute()) {
                // Log the borrow transaction
                $borrow_date = date('Y-m-d');
                $return_date = date('Y-m-d', strtotime($borrow_date . ' + 7 days'));
                $stmt = $this->conn->prepare("INSERT INTO borrowed_books (book_id, user_id, borrow_date, return_date) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("iiss", $book_id, $user_id, $borrow_date, $return_date);
                if ($stmt->execute()) {
                    $response = [
                        'success' => true,
                        'message' => 'Book borrowed successfully'
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Failed to log borrow transaction'
                    ];
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Failed to update book copies'
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'No copies available'
            ];
        }

        return json_encode($response);
    }



    public function getBorrowedBooks($studentId)
    {
        $response = [];
        $sql = "SELECT books.*, borrowed_books.*, users.* FROM borrowed_books 
        INNER JOIN books ON books.id = borrowed_books.book_id
        INNER JOIN users ON users.user_id = borrowed_books.user_id
        WHERE users.user_id='$studentId'";


        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $response['data'][] = $row;
            }
            $response['success'] = true;
            $response['message'] = 'Borrowed books found';
        } else {
            $response = [
                'success' => false,
                'message' => 'No borrowed books found'
            ];
        }

        return json_encode($response);
    }


     // Function to get total number of books
     public function getTotalBooks() {
        $sql = "SELECT COUNT(*) as total FROM books";
        $result = $this->conn->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            return 0;
        }
    }
     public function getTotalBorrowedBooks() {
        $sql = "SELECT COUNT(*) as total FROM borrowed_books";
        $result = $this->conn->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            return 0;
        }
    }

}

?>