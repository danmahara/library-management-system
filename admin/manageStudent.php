<?php
require_once (__DIR__ . '/AdminManager.php');

session_start();
if (empty($_SESSION['user_type']) == "admin") {
    header('Location:../userLogin.php');

}

$adminManager = new AdminManager();
$response = $adminManager->studentsList();
$responseDecode = json_decode($response, true);

?>
<?php include 'adminNavigation.php'; ?>

<link rel="stylesheet" href="../indexNavigation.css">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Student</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
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

        .action-buttons a {
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            margin-right: 5px;
        }

        .action-buttons .edit-button {
            background-color: #4CAF50;
            color: white;
        }

        .action-buttons .edit-button:hover {
            background-color: #45a049;
        }

        .action-buttons .delete-button {
            background-color: #f44336;
            color: white;
        }

        .action-buttons .delete-button:hover {
            background-color: #da190b;
        }

        @media (max-width: 768px) {
            .action-buttons a {
                display: block;
                margin-bottom: 5px;
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .section-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .section-actions {
                flex-direction: column;
                width: 100%;
            }

            .section-actions a {
                margin-bottom: 10px;
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Student Management</h2>

        <!-- Student Management Section -->
        <div class="section">
            <div class="section-header">
                <div class="section-actions">
                    <h2>Students List</h2>
                    
                    <!-- <a href="addBook.php">Add New Book</a> -->
                </div>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($responseDecode) && isset($responseDecode['success']) && $responseDecode['success'] == true && !empty($responseDecode['data'])) {
                            foreach ($responseDecode['data'] as $key => $student) {
                                ?>
                                <tr>
                                    <td><?= ++$key; ?></td>
                                    <td><?= $student['full_name']; ?></td>
                                    <td><?= $student['email']; ?></td>
                                    <td><?= $student['department']; ?></td>
                                    <td class="action-buttons">
                                        <a class="delete-button" href="deleteStudent.php?user_id=<?= $student['user_id']; ?>"
                                            onclick="return confirmDelete();">Delete</a>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this book?');
        }
    </script>
</body>

</html>