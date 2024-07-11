
<?php

$host="localhost";
$user="root";
$password="";
$db="admin";

session_start();


$data=mysqli_connect($host,$user,$password,$db);

if($data===false)
{
	die("connection error");
}


if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$username=$_POST["username"];
	$password=$_POST["password"];


	$sql="select * from data where username='".$username."' AND password='".$password."' ";

	$result=mysqli_query($data,$sql);

	$row=mysqli_fetch_array($result);

	if($row["usertype"]=="user")
	{	

		$_SESSION["username"]=$username;

		header("location:userhome.php");
	}

	elseif($row["usertype"]=="admin")
	{

		$_SESSION["username"]=$username;
		
		header("location:adminhome.php");
	}

	else
	{
		echo "username or password incorrect";
	}

}




?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .h-1 {
            color: orange;
            margin-top: 30px;
            margin-left: 100px;
        }

        .img-1 {
            height: 530px;
            margin-top: 10px;
            margin-left: 140px;
        }

        .content {
            height: 642px;
            width: 580px;
            margin-left: 750px;
            margin-top: -605px;
        }

        .p1 {
            margin-left: 150px;
            top: 140px;
            position: relative;
            font-size: 28px;
            font-weight: 700;
        }

        .p2 {
            margin-left: 155px;
            top: 150px;
            position: relative;
        }

        .label1 {
            font-size: 22px;
            margin-left: 100px;
            top: 190px;
            position: relative;
        }

        .input1 {
            height: 25px;
            width: 300px;
            margin-left: 100px;
            top: 190px;
            position: relative;
            font-weight: 700;
            padding-left: 10px;
        }

        .label2 {
            font-size: 22px;
            margin-left: 100px;
            top: 190px;
            position: relative;
        }

        .input2 {
            height: 25px;
            width: 300px;
            margin-left: 100px;
            top: 190px;
            position: relative;
            font-weight: 700;
            padding-left: 10px;
        }

        .btn {
            margin-top: 220px;
            margin-left: 146px;
            height: 30px;
            width: 100px;
            font-size: 18px;
            border-radius: 10px;
            font-weight: 700;
            background-color: rgba(62, 161, 194, 0.814);
            color: white;
        }
        .btn1 {
            margin-top: 0px;
            margin-left: 10px;
            height: 30px;
            width: 100px;
            font-size: 18px;
            border-radius: 10px;
            font-weight: 700;
            background-color: rgba(255, 0, 0, 0.935);
            color: white;
        }
    </style>
</head>

<body>
     <!-- navigation starting -->
     <nav>
        <ul>
            <li class="li1"><a href="index.html">LMS</a></li>
            <div class="cont">
                <li class="li2"><input type="text" placeholder="search" class="inp1"></li>
                <button class="bton"><ion-icon name="search-outline" class="ion-1"></ion-icon></button>
            </div>
            <li class="li3"><a href="../librarian/librarianlogin.php">Librarian</a></li>
            <li class="li3"><a href="../student/login.php">Student</a></li>
            <li class="li3"><a href="admin/adminlogin.php">Admin</a></li>
        </ul>
    </nav>
    <!-- navigation ending -->
    <div class="container">
        <h1 class="h-1">WELCOME TO LIBRARY</h1>
        <img src="../images/background2.jpg" alt="Adminimages" class="img-1">
    </div>
    <div class="content">
        <p class="p1">Admin Login Page</p>
        <p class="p2">Welcome! Login to your account</p>
        
        <!-- form start -->
        <form action="#" method="post">
        <label for="" class="label1">Username:</label>
        <input type="text" placeholder="username" name="username" class="input1">
        <br><br>
        <label for="" class="label2">Password:</label>
        <br>
        <input type="password" placeholder="password" name="password" class="input2">
        <br>
        <button class="btn">Login</button>
        <button class="btn1">Sign up</button>
        </div>
 
</form>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>