<?php
require_once (__DIR__ . '/BookManager.php');
session_start();
if (empty($_SESSION['user_type']) == "librarian") {
    header('Location:../userLogin.php');

}

if (!empty($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    $bookManager = new BookManager();
    $response = $bookManager->deleteBook($book_id);
    $responseDecode = json_decode($response);

    if (!empty($responseDecode) && isset($responseDecode->success)) {
        $_SESSION['success_message'] = $responseDecode->message;
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    } else {
        $_SESSION['error_message'] = $responseDecode->message;
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    }

}

?>