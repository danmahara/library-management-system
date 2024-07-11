<?php
require_once ('../book/BookManager.php');
session_start();
if (empty($_SESSION['user_type']) == "student") {
    header('Location:../userLogin.php');

}


if (!empty($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
    $user_id = $_SESSION['user_id'];
    $bookManager = new BookManager();
    $response = $bookManager->borrowBook($book_id, $user_id);
    $responseDecode = json_decode($response, true);

    if (!empty($responseDecode) && isset($responseDecode['success'])) {
        $_SESSION['success_message'] = $responseDecode['message'];
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    } else {
        $_SESSION['error_message'] = $responseDecode['message'];
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    }

} else {
    echo "book id not found";
}


?>