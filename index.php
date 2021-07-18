<?php

require('classes/connect.php');
require('classes/signup.php');

$userid = "";
$email = "";
$alert = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    // print_r($_POST);
    $new = new Signup();
    $result = $new->evaluate($_POST);
    if($result == "empty") {
        $alert = "Fill all Field";
    }elseif($result == "invalid") {
        $alert = "Wrong Data Input";
    }elseif($result == "exist") {
        $alert = "User Exist, LogIn!";
    }else {
        header('Location:login.php');
        die;
    }

    $userid = $_POST['name'];
    $email = $_POST['email'];

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        h1 {
            color: green;
        }
        input {
            width: 400px;
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
        <div style="text-align:right;margin:20px;float:right"><a href="login.php" style="text-decoration:none;"><button style="background-color:#405d9b;border-radius:5px;border:1px solid;color:white;padding:10px;font-weight:bold;">Log In</button></a></div>
    </div>
    <!-- Login -->
    <h1 class="red" style="margin-top:50px;text-align:center;font-size:50px;clear:both;"><?php echo $alert; ?></h1>
    <h1 class="green" style="margin-top:100px;text-align:center;font-size:50px;">Sign Up</h1>
    <div style="text-align:center;margin-top:50px;">
    <form action="" method="POST">
    <input type="text" name="name" id="name" value="<?php echo $userid; ?>" placeholder="Create a user id"><br />
    <span style="margin-left:-190px;color:#405d9b">Must be letters and numbers only</span><br />
    <input type="email" name="email" id="email" value="<?php echo $email; ?>" placeholder="Enter email" style="margin-top:20px;"><br />
    <span style="margin-left:-220px;color:#405d9b">Email address must be valid</span><br />
    <input placeholder="Enter password" type="password" name="password" id="password" style="margin-top:20px;"><br />
    <span style="margin-left:-60px;color:#405d9b">At least 1 number, upper & lower case letter & 8 long</span><br />
    <input type="submit" name="login" value="Sign Up" style="background-color:#405d9b;color:white;font-weight:bold;margin-top:20px;">
    </form>
    </div>
</body>
</html>