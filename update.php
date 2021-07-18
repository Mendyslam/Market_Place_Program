<?php
session_start();
require('classes/connect.php');
require('classes/login.php');
require('classes/orders.php');

$login = new Login();
$login->checkLogin($_SESSION['userid']);

if(isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $get = new Order();
    $result = $get->getOneOrder($id);
    $row = $result[0];
}

if(isset($_POST['update'])) {
    $item = $_POST['order'];
    $price = $_POST['price'];
    $update = new Order();
    $update->updateOrder($item, $price, $id);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order</title>
    <style>
        #header {
            margin-bottom: 50px;
            width: 100%;
        }
        h2 {
            text-align: center;
            margin-bottom: 7px;
            font-size: 25px;
            color: purple;
        }
        form {
            text-align: center;
        }
        #input {
            margin-bottom: 20px;
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
        .blue {
            background-color: blue; 
        }
        .red {
            background-color: red;
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
    <div id="header" style="margin-top:50px">
        <h2>Update Selected Item here:</h2><br />
        <form action="" method="POST">
        <input id="input" type="text" name="order" value="<?php echo $row['item']; ?>" placeholder="Update product"><br />
        <input id="input" type="text" name="price" value="<?php echo $row['price']; ?>" placeholder="Update price"><br />
        <input type="submit" name="update" value="Update Order" class="green btn">
        </form>
    </div>
</body>
</html>