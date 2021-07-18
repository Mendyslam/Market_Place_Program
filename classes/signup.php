<?php

class Signup {
    private $error = "";
    //Evaluate Users input
    public function evaluate($data) {
        foreach($data as $key=>$value) {
            if(empty($value)) {
                return $this->error.="empty";
            }
            if($key == "name") {
                $name = $this->test_input($value);
                if(!preg_match("/[a-zA-Z]+[0-9]+$/", $name)) {
                    return $this->error.="invalid";
                }else {
                    if($this->checkID($name)) {
                        return $this->error.="exist";
                    }
                }
            }
            if($key == "email") {
                $email = $this->test_input($value);
                if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
                    return $this->error.="invalid";
                }else {
                    if($this->checkEmail($email)) {
                        return $this->error.="exist";
                    }
                }
            }
            if($key == "password") {
                $password = $this->test_input($value);
                if(!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $password)) {
                    return $this->error.="invalid";
                }
            }
        }
        $this->createUser($data);
    }

    //Secure Input
    public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Create User by adding to the database
    public function createUser($data) {
        $userid = $data['name'];
        $email = $data['email'];
        $password = $data['password'];
        $sql = "INSERT INTO users (userid, email, pass) VALUES ('$userid', '$email', '$password')";
        $DB = new Database();
        $DB->insert($sql);
    }

    //Check if user exist in the database
    private function checkID($id) {
        $sql = "SELECT * FROM users WHERE userid = '$id'";
        $DB = new Database();
        $result = $DB->select($sql);
        return $result;
    }

    private function checkEmail($id) {
        $sql = "SELECT * FROM users WHERE email = '$id'";
        $DB = new Database();
        $result = $DB->select($sql);
        return $result;
    }
}

?>