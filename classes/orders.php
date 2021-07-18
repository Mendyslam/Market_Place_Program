<?php

class Order {

    public function createOrder($userid, $order) {
        if(!empty($order['product']) && !empty($order['price'])) {
            $item = $this->test_input($order['product']);
            $price = $this->test_input($order['price']);
            $sql = "INSERT INTO products (userid, item, price) VALUES ('$userid', '$item', '$price')";
            $DB = new Database();
            $result = $DB->insert($sql);
            if($result) {
                return true;
            }else {
                return false;
            }
        } else {
            return false;
        }
            
    }

    public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function getOrders() {
        $sql = "SELECT * FROM products";
        $DB = new Database();
        $result = $DB->select($sql);
        if($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function getOneOrder($id) {
        $sql = "SELECT * FROM products WHERE id = '$id'";
        $DB = new Database();
        $result = $DB->select($sql);
        if($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function updateOrder($item, $price, $id) {
        $newItem = $this->test_input($item);
        $newPrice = $this->test_input($price);
        $sql = "UPDATE products set item='$newItem', price='$newPrice' where id= '$id'";
        $DB = new Database();
        $result = $DB->update($sql);
        if($result) {
            header('Location: profile.php?success=Your order has been successfully');
        }else {
            header('Location: update.php?error=error trying to update order');
        }
    }

}

?>