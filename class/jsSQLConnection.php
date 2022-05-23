
<?php

class jsSQLConnection{
    private $user;
    private $password;
    private $database;
    private $host;

    public function __construct($user, $password, $database, $host){
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
        $this->host = $host;
    }

    public function connect(){
        $connection = new mysqli($this->host, $this->user, $this->password, $this->database);
        if($connection->connect_error){
            die("Connection failed: " . $connection->connect_error);
        }
        return $connection;
    }

    public function query($query){
        $connection = $this->connect();
        $result = $connection->query($query);
        $connection->close();
        return $result;
    }

    public function close(){
        $connection = $this->connect();
        $connection->close();
    }
}