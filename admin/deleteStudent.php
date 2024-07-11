<?php
require_once (__DIR__ . "/AdminManager.php");
session_start();
if (empty($_SESSION['user_type']) == "admin") {
    header('Location:../userLogin.php');

}

if (!empty($_GET['user_id'])) {
    $student_id = $_GET['user_id'];
    $adminManager = new AdminManager();
    $response = $adminManager->deleteStudent($student_id);
}


if (!empty($responseDecode) && isset($responseDecode->success)) {
    $_SESSION['success_message'] = $responseDecode->message;
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
} else {
    $_SESSION['error_message'] = $responseDecode->message;
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}




?>