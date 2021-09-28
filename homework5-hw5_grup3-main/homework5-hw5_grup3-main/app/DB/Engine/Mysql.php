<?php

namespace App\DB\Engine;


class Mysql implements DriverInterface
{
    protected \PDO $pdo;

    public function __construct(string $host, string $user, string $pass, string $dbname)
    {
        try {
            $this->pdo = new \PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        }catch (\PDOException $exception){
            echo $exception->getMessage();
        }
    }

    public function all(string $table): array
    {
       $stmt = $this->pdo->prepare("SELECT * FROM $table");
       $stmt->execute();
       return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find(string $table, mixed $id): mixed
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE id = $id");
        $stmt-> execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create(string $table, array $values): bool
    {
        $sql = "INSERT INTO $table (";

        foreach($values as $value){
            foreach ($value as $key => $val){
                $sql .= $key. ", ";
            }
        }

        $sql = rtrim($sql, " , ");
        $sql .= ") ";
        $sql .= "VALUES (";

        foreach($values as $value) {
            foreach ($value as $val){
                $sql .= "'". $val . "'". ",";
            }
        }

        $sql = rtrim($sql," , ");
        $sql .= ")";
        $stmt = $this->pdo->prepare($sql);
        return $stmt-> execute();
    }

    public function update(string $table, mixed $id, array $values): bool
    {
        $sql = "UPDATE $table SET ";

        foreach($values as $value){
            foreach ($value as $key => $val){
                if(is_string($val)){
                    $sql .= $key . " = " . "'" . $val . "'" . ", ";
                }else{
                    $sql .= $key . " = " . $val . ", ";
                }
            }  
        }

        $sql = rtrim($sql, " , ");
        $sql .= " WHERE id = $id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute();

    }

    public function delete(string $table, mixed $id): bool
    {
        $sql = "DELETE FROM $table WHERE id = $id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute();
    }

    public function getPdo() { // :(
        return $this->pdo;
    }
}