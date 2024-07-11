<?php
require_once ('admin/AdminManager.php');

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $adminManager = new AdminManager();
    $response = $adminManager->login($email, $password);
    $responseDecode = json_decode($response, true);
} else {
    echo "";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        .success {
            color: green;
        }

        .error {
            color: red;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #e0f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            color: #333;
        }

        .container {
            text-align: center;
            margin-bottom: 20px;
        }

        .container h2 {
            color: #00796b;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .content {
            background-color: white;
            padding: 30px 50px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
            color: #00796b;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            border-color: #00796b;
            outline: none;
        }

        .btn {
            background-color: #00796b;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #004d40;
        }

        .signup-link {
            margin-top: 15px;
            display: block;
            font-size: 16px;
            color: #00796b;
            text-decoration: none;
            transition: color 0.3s;
        }

        .signup-link:hover {
            color: #004d40;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <?php include 'indexNavigation.php'; ?>
    <div class="container">
        <h2>User Login</h2>
        <div class="content">
            <form action="" method="post">
                <div class="form-group">
                    <?php if (!empty($responseDecode) && isset($responseDecode['success']) == true) {
                        if ($responseDecode['success']) { ?>
                            <p class="success"><?= $responseDecode['message']; ?></p>
                        <?php } else { ?>
                            <p class="error"><?= $responseDecode['message']; ?></p>
                        <?php }
                    } ?>

                    <label for="email">Email</label>
                    <input type="email" id="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>"
                        name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">Login</button>
                </div>
            </form>
            <a href="userRegister.php" class="signup-link">Don't have an account? Sign up</a>
        </div>
    </div>
</body>

</html>