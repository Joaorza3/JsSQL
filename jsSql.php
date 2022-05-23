<?php
// Config
require_once('./config/connection.php');
// Class
require_once('./class/QueryValidations.php');
require_once('./class/jsSQLConnection.php');

$json = file_get_contents('php://input');

$query = json_decode($json, true);

class JsSQL{
    private $query;

    public function __construct($query){
        $this->query = $query;
    }

    public function makeSelection($connection){

        $result = $connection->query($this->query);
        $connection->close();

        !QueryValidations::validate($this->query) ? die(json_encode([
            'error' => true,
            'message' => 'Query inválida'
        ])) : null;

        $data = [];

        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
        } else{
            die(json_encode([
                'error' => true,
                'message' => 'Nenhum resultado encontrado'
            ]));
        }

        return $data;
    }
}

$connection = new jsSqlConnection($__user, $__password, $__database, $__host);
$connection->connect();

$jsSql = new JsSQL($query['query']);
$data = $jsSql->makeSelection($connection);

echo json_encode([
    'error' => false,
    'query' => $query,
    'data' => $data
]);

die();