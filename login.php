<?php
session_start();
require('classes/connect.php');
require('classes/login.php');

$email = "";
$alert = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $login = new Login();
    $result = $login->evaluate($_POST);

    if($result == 'Wrong pass') {
        $alert = "Wrong password!";
    }elseif($result == 'User not registered') {
        $alert = "User not registered";
    }else {
        header('Location:profile.php');
    }

    $email = $_POST["email"];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <style>

        h1 {
            color: green;
        }
        input {
            width: 400px;
            margin-bottom: 20px;
            height: 30px;
            border-radius:5px;
            border: 1px solid;
        }
        .blue {
            color: blue;
        }
        .green {
            color: green;
        }
        .red {
            color: red;
        }
    </style>
</head>
<body>
<div style="margin-bottom:10px;">
        <div style="text-align:left;float:left;margin:20px;color:#405d9b;font-weight:bold;font-size:30px;">MARKET PLACE</div>
        <div style="text-align:right;margin:20px;float:right"><a href="index.php" style="text-decoration:none;"><button style="background-color:#405d9b;border-radius:5px;border:1px solid;color:white;padding:10px;font-weight:bold;">Sign Up</button></a></div>
    </div>
    <!-- Login -->
    <h1 class="red" style="margin-top:50px;text-align:center;font-size:50px;clear:both;"><?php echo $alert; ?></h1>
    <h1 class="green" style="margin-top:50px;text-align:center;font-size:50px;">Log In</h1>
    <div style="text-align:center;margin-top:50px;">
    <form action="" method="POST">
    <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Enter email"><br />
    <input type="password" name="password" placeholder="Enter password"><br />
    <input type="submit" name="login" value="Log In" style="background-color:#405d9b;color:white;font-weight:bold;">
    </form>
    </div>
</body>
</html>