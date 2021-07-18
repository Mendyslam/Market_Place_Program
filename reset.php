<?php
session_start();
require('classes/connect.php');
require('classes/login.php');

$login = new Login();
$login->checkLogin($_SESSION['userid']);

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $old = $_POST['oldpassword'];
    $new = $_POST['newpassword'];
    $login->changePassword($old, $new);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password</title>
    <style>
        #header {
            margin-bottom: 50px;
            width: 100%;
            margin-top: 100px;
        }
        h1 {
            text-align: center;
            margin-bottom: 5px;
            font-size: 35px;
            color: purple;
        }
        form {
            text-align: center;
        }
        #input {
            margin-bottom: 15px;
            width: 25%;
            height: 20px;
        }
        .btn {
            color: white;
            padding: 10px;
            border-radius: 5px;
            border: none;
            font-size: 15px;
        }
        .green {
            background-color: green;
        }
        .green:hover {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php require('header.php'); ?>
    <div style="color:purple;font-weight:bold;font-size:20px;">UserID: <?php echo ($login->checkLogin($_SESSION['userid']))['userid'] ?></div>
    <div id="header">
        <h1>Reset Password</h1><br />
        <form action="" method="POST">
            <input type="password" name="oldpassword" id="input" placeholder="Enter old password"><br/>
            <input type="password" name="newpassword" id="input" placeholder="Enter new password"><br/>
            <input type="submit" name="submit" value="Reset Password" class="green btn">
        </form>
    </div>
</body>
</html>