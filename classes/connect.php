<?php
class Database {
    private $servername = "localhost";
    private $username  = "Practice";
    private $password = "@Mysqlphp";
    private $dbname = "market_place";

    //Function to connect to database
    public function connect() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        return $conn;
    }

    //Function to SELECT from database
    public function select($sql) {
        $conn = $this->connect();
        $result = $conn->query($sql);
        if($result) {
            $data = false;
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }else {
            echo $sql . "<br>" . $conn->error;
        }
        return $data;
    }

    //Function to INSERT into the database
    public function insert($sql) {
        $conn = $this->connect();
        $result = $conn->query($sql);
        if($result) {
            return true;
        } else {
            echo $sql . "<br>" . $conn->error;
        }
    }

    //Function to Update database
    public function update($sql) {
        $conn = $this->connect();
        $result = $conn->query($sql);
        if($result) {
            return true;
        } else {
            echo $sql . "<br>" . $conn->error;
        }
    }

    public function delete($sql) {
        $conn = $this->connect();
        $result = $conn->query($sql);
        if($result) {
            return true;
        } else {
            echo $sql . "<br>" . $conn->error;
        }
    }
    
}
?>