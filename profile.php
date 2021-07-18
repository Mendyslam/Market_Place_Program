<?php
session_start();

require('classes/connect.php');
require('classes/login.php');
require('classes/orders.php');

$login = new Login();
$result = $login->checkLogin($_SESSION['userid']);

$product = "";
$price = "";
$message = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $order = new Order();
    $userid = $_SESSION['userid'];
    $result = $order->createOrder($userid, $_POST);
    if($result) {
        header('Location: profile.php');
    }else {
        $message = "Fill Order Correctly";
    }
}

$products = new Order();
$myproducts = $products->getOrders();

if(isset($_GET['del'])) {
    $del = $_GET['del'];
    $login->deleteOrder($del);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <style>
        #header {
            margin-bottom: 50px;
            width: 100%;
        }
        h2 {
            text-align: center;
            font-size: 25px;
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
        .blue {
            background-color: blue; 
        }
        .red {
            background-color: red;
        }
        .green {
            background-color: green;
        }
        #table {
            border-collapse: collapse;
            width: 100%;
        }
        #table th {
            padding: 12px 0px;
            /* background-color: gray; */
            color: black;
        }
        #table td, #table th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        #table tr:hover {
            background-color: #ddd;
        }
        a {
            text-decoration: none;
            color: white;
        }
        .green:hover {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php require('header.php'); ?>
    <div style="color:purple;font-weight:bold;font-size:20px;">UserID: <?php echo ($login->checkLogin($_SESSION['userid']))['userid'] ?></div>
    <div style="text-align:center;height:20px;margin-top:0px;margin-bottom:0px;"><h2 style="color:red;"><?php echo $message; ?></h2></div>
    <div id="header">
        <h2 style="margin-bottom:0px;">Post Items</h2><br />
        <form action="" method="POST">
            <input value="<?php echo $product; ?>" type="text" name="product" id="input" placeholder="Enter product"><br/>
            <input value="<?php echo $price; ?>" type="text" name="price" id="input" placeholder="Product price"><br/>
            <input type="submit" name="submit" value="Add product" class="green btn">
        </form>
    </div>
    <div>
        <table id="table">
        <thead>
            <th>MY ITEMS</th>
            <th>SELL PRICE</th>
            <th>UPDATE</th>
            <th>DELETE</th>
        </thead>
        <tbody>
            <?php
                if($myproducts) {
                    foreach($myproducts as $row) {
                        if($row['userid'] == $_SESSION['userid']) { ?>
                            <tr>
                                <td><?php echo $row['item']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><button class="blue btn"><a href="update.php?edit=<?php echo $row['id'];?>">Update</a></button></td>
                                <td><button class="red btn"><a href="profile.php?del=<?php echo $row['id'];?>">Delete</a></button></td>
                            </tr>
            <?php       }
                    }
                } ?>
        </tbody>
        </table>
    </div>
</body>
</html>