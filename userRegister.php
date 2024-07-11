<?php
require_once ('admin/AdminManager.php');

if (!empty($_POST)) {

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password securely
    $usertype = $_POST['usertype'];
    $department = $_POST['department'];
    $adminManager = new AdminManager();
    $response = $adminManager->createUser($full_name, $email, $password, $usertype, $department);
    $responseDecode = json_decode($response, true);

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .success {
            color: green;
        }

        .error {
            color: red;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #666;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #009688;
        }

        .form-group button {
            background: #009688;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-group button:hover {
            background: #00796b;
        }
    </style>
</head>

<body>
    <?php include 'indexNavigation.php'; ?>

    <div class="container">
        <h2>Registration Form</h2>
        <?php if (!empty($responseDecode) && isset($responseDecode['success']) && $responseDecode['success'] == true && !empty($responseDecode['data'])) { ?>
            <p class="success"><?= $responseDecode['message']; ?></p>
        <?php } else { ?>
            <p class="error"><?= isset($responseDecode['message']) ? htmlspecialchars($responseDecode['message']) : ''; ?></p>

        <?php } ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="usertype">User Type</label>
                <select id="usertype" name="usertype" required>
                    <option value="">Select</option>
                    <option value="student">Student</option>
                    <option value="librarian">Librarian</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="firstname">Full Name</label>
                <input type="text" id="firstname" name="full_name" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="department">Department</label>
                <input type="text" id="department" name="department">
            </div>
            <div class="form-group">
                <button type="submit">Register</button>
            </div>
        </form>
    </div>
</body>

</html>