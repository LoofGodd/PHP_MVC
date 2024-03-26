<?php
namespace App\Modal;

use App\Modal\DB;
use PDOStatement;

 // Allow requests from any origin
header('Access-Control-Allow-Origin: *');

// Allow specific HTTP methods
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

// Allow specific request headers
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Allow credentials (if needed)
class MVCModal{

        private int $limit;
        private $conn = null;
        private $table_columns = ['heading', 'description', 'image', 'id'];
        private $table = 'mvc';
        public function __construct(){
            global $url_params;
            $this->limit = isset($url_params['limit']) ? $url_params['limit'] : 20;
            $this->conn = (new DB())->connect();

        }


        private function correctColumnAndValueAdd($data = []){
            $arr_columns = [];
            $arr_values_bind = [];
            foreach ($data as $key => $value) {
                $arr_columns[] = $key;
                $arr_values_bind[] = ":" . $key;
            }
            $columns = "(" . implode(", ", $arr_columns) . ")"; //(id, name, age)
            $values = "(" . implode(", ", $arr_values_bind) . ")"; //(id, name, age)
            return [$columns,  $values, $arr_values_bind];
        }
        private function is_matchColumn(array $data): bool{
            foreach ($this->table_columns as $value) {
                if ($value == 'id')
                    continue;
                if(!isset($data[$value])){
                var_dump($data[$value]);
                return false;
                }
            }
        return true;
        }
        private function is_inColumns(array $data = []){
        var_dump($data);
            foreach($data as $key => $value){
                if(!in_array($key,$this->table_columns)){
                return false;
                }
            }
        return true;
        }
        private function is_execute(bool|PDOStatement $stmt): array{
            $data = [];
            $data['data'] = [];
            $data['status'] = 'error';
            if($stmt->execute()){
                $rowCount = $stmt->rowCount();
                if($rowCount == 1){
                $data['data'] = $stmt->fetch(\PDO::FETCH_ASSOC);
                }else if($rowCount){
                    while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                    $data['data'][] = $row;
                     }
                 }
                $data['status'] = 'success';
            }else{
            $data['message'] = 'no executed';
            }
        return $data;
        }
        private function getAllID(){
            $query = "SELECT id FROM $this->table";
            $stmt = $this->conn->prepare($query);
           $data =  $this->is_execute($stmt);
        var_dump($data);
            $ids = [];
           foreach ($data['data'] as  $value) {
            $ids[] = $value['id'] ?? $value;
           }
        $data['data'] = $ids;
        return $data;
        }
        public function getAll(): array{
            $query = "SELECT * from $this->table ORDER BY id ASC LIMIT :limit";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':limit', $this->limit, \PDO::PARAM_INT);
            return $this->is_execute($stmt);
        }
        public function getBySearch(string $text=""):array{
            if(empty($text)){
                return $this->getAll();
            }
            $like = "%$text%";
            $query = "SELECT * from $this->table WHERE heading LIKE :like_heading OR description LIKE :like_description OR image LIKE :like_image";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':like_heading', $like, \PDO::PARAM_STR);
            $stmt->bindValue(':like_description', $like, \PDO::PARAM_STR);
            $stmt->bindValue(':like_image', $like, \PDO::PARAM_STR);
            return $this->is_execute($stmt);
        }
        public function get(int | string $id){
            $query = "SELECT * from $this->table where id=:id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            return $this->is_execute($stmt);
        }

        public function add($data = []):array{
            //for more valid
            if(!$this->is_matchColumn($data)){
            return ['status' => 'error', 'message' => 'column not much', 'data' => $data];
            }
            //query
            [$columns, $values] = $this->correctColumnAndValueAdd($data);
            $query = "INSERT INTO  $this->table" . $columns . ' VALUE' . $values;

            $stmt = $this->conn->prepare($query);


            foreach ($data as $key => $value) {
                $v = is_numeric($value) ? +$value : $value;
                $pdoParam = is_numeric($value) ??  is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR;
                $stmt->bindValue(':'.$key, $v , $pdoParam);
            }
        return $this->is_execute($stmt);
        }

        public function delete($data = []){
            if(!isset($data['id'])){
                return ['status' => 'error'];
            }
            $ids = $this->getAllID()['data'];
            if (!in_array($data["id"], $ids)) {
                return ['status' => 'error',];
            }
            $query = "DELETE FROM $this->table where id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(":id", $data['id'], \PDO::PARAM_INT);
            return $this->is_execute($stmt);
        }

        private function setColVal($data){
            $tempData = [];
            foreach ($data as $key => $value) {
                if($key == 'id') continue;
                $tempData[] = $key . " = " . ":" . $key; //name=:name
            }
            return  implode(', ', $tempData); //name=:name, age=:age
        }


        public function patch($data = []){
            if (!isset($data["id"]) || !$this->is_inColumns($data)) {
                return ['status' => 'error', 'message' => 'wrong post'];
            }
            $colVal_str = $this->setColVal($data);
            $query = "UPDATE $this->table SET $colVal_str  WHERE id = :id";
            $stmt = $this->conn->prepare($query);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
        return $this->is_execute($stmt);
        }

    }
