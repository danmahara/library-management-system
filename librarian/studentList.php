<?php
require_once ('../admin/AdminManager.php');
require_once ('LibrarianManager.php');
session_start();
if (empty($_SESSION['user_type']) == "librarian") {
    header('Location:../userLogin.php');
    exit();
}

$adminManager = new AdminManager();
$response = $adminManager->studentsList();
$responseDecode = json_decode($response, true);
?>

<link rel="stylesheet" href="../indexNavigation.css">
<?php include 'librarianNavigation.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students List</title>
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
            max-width: 800px;
            margin: 50px auto 0;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .student-list {
            list-style-type: none;
            padding: 0;
        }

        .student-item {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 4px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .student-item h2 {
            margin-top: 0;
            margin-bottom: 5px;
            color: #333;
        }

        .student-item p {
            margin: 0;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Students List</h1>
        <?php if (!empty($responseDecode) && isset($responseDecode['success']) && $responseDecode['success'] == true && !empty($responseDecode['data'])) { ?>
            <ul class="student-list">
                <?php foreach ($responseDecode['data'] as $student) { ?>
                    <li class="student-item">
                        <h2><?= htmlspecialchars($student['full_name']); ?></h2>
                        <p>Email: <?= htmlspecialchars($student['email']); ?></p>
                        <p>Department: <?= htmlspecialchars($student['department']); ?></p>
                    </li>
                <?php } ?>
            </ul>
        <?php } else { ?>
            <p><?= htmlspecialchars($responseDecode['message']); ?></p>
        <?php } ?>
    </div>
</body>

</html>