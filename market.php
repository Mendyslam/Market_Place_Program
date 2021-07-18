<?php
session_start();

require('classes/connect.php');
require('classes/login.php');
require('classes/orders.php');

$login = new Login();
$login->checkLogin($_SESSION['userid']);

$products = new Order();
$market = $products->getOrders();

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
    <title>Market Place</title>
    <style>        
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
        .yellow {
            background-color: purple;
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
    <div style="text-align:center;margin-top:50px;"><h1 style="color:green;font-weight:bold;">MARKET PLACE</h1></div>
    <div style="margin-top:50px;">
        <table id="table">
            <thead>
                <th>USER</th>
                <th>ITEMS</th>
                <th>ITEM PRICE</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                <?php
                    if($market) {
                        foreach ($market as $row) {
                            if ($row['userid'] == $_SESSION['userid']) { ?>
                                <tr>
                                    <td><?php echo $row['userid']?></td>
                                    <td><?php echo $row['item']?></td>
                                    <td><?php echo $row['price']?></td>
                                    <td><button class="blue btn"><a href="update.php?edit=<?php echo $row['id'];?>">Update</a></button></td>
                                    <td><button class="red btn"><a href="index.php?del=<?php echo $row['id'];?>">Delete</a></button></td>
                                </tr>
                           <?php } else { ?>
                                <tr>
                                    <td><?php echo $row['userid']?></td>
                                    <td><?php echo $row['item']?></td>
                                    <td><?php echo $row['price']?></td>
                                    <td><button class="green btn"><a href="">Order</a></button></td>
                                    <td><button class="yellow btn"><a href="">Enquire</a></button></td>
                                </tr>
                    <?php       }
                        }
                    } ?>
                
            </tbody>
        </table>
    </div>
</body>
</html>