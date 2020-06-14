<?php

class Sql extends PDO {

    private $conn;

    public function __construct(){
        $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "abc123");
    }

    private function setParams($statment, $parameters = arry()){
        foreach ($parameters as $key => $value) {
            $statment->bindParam($key, $value);
            
        }
    }

    private function setParams($statment, $key, $value){
        $statment->bindParam($key, $value);
    }

    public function query($rawQuery, $params = array()){
        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);
        $stmt->execute();
        
        return $stmt;


    }

    public function select($rawQuery, $params = array()) {
        $stmt = $this->query($rawQuery, $params);


       return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>