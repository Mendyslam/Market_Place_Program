<?php
class Login {
    private $error = "";

    public function evaluate($data) {
        $email = $this->test_input($data['email']);
        $password = $this->test_input($data['password']);
        $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $DB = new Database();
        $result = $DB->select($sql);

        if($result) {
            $row = $result[0];
            if($password == $row['pass']) {
                $_SESSION['userid'] = $row['userid'];
            }else {
                return $this->error.="Wrong Pass";
            }
        }else {
            return $this->error.="User not registered!";
        }
    }

    //Check if User is logged in
    public function checkLogin($id) {
        $userid = $this->test_input($id);
        $sql = "SELECT * FROM users WHERE userid = '$userid' LIMIT 1";
        $DB = new Database();
        $result = $DB->select($sql);

        if($result) {
           return $userData = $result[0];
        }else {
            header('Location:login.php');
            die;
        }
    }

    public function changePassword($old, $new) {
        if(!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $new)) {
            header('Location: reset.php?error=new password must contain at least one lower and uppercase letter and at least one number');
        }else {
            $userid = $_SESSION['userid'];
            $oldpassword = $this->test_input($old);
            $newpassword = $this->test_input($new);
            $sql = "SELECT * FROM users WHERE userid = '$userid' and pass = '$oldpassword'";
            $DB = new Database();
            $result = $DB->select($sql);
            if ($result) {
                $sql1 = "UPDATE users SET pass = '$newpassword' WHERE userid = '$userid' ";
                $result1 = $DB->update($sql1);
                if($result1) {
                    header('Location: login.php?succes=password changed successfully');
                    session_destroy();
                }else {
                    header('Location: reset.php?error=an error occured');
                }
            }else{
                header('Location: reset.php?error=old password incorrect');
            }
        }
        
    }

    public function deleteOrder($id) {
        $sql = "DELETE FROM products WHERE id = '$id'";
        $DB = new Database();
        $result = $DB->delete($sql);
        if($result) {
            header('Location: profile.php?success=Order deleted successfully');
        }else {
            header('Location: profile.php?error=Order was not deleted, try again!');
        }
    }

    private function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>