<?php 

class DB{

    protected string $user = "root";
    protected string $pass = "";
    protected string $db_name = "post";
    protected string $host_name ="localhost";
    

    public function __construct()
    {
      
    }
    public function createConn() : PDO{
        try{
            return new PDO("mysql:host=$this->host_name;dbname=$this->db_name","$this->user","$this->pass");
        }catch(PDOException $e){
            echo $e-> getMessage();
        }
    }

    public function get(string $table_name, int $id) : array{
        $conn  = $this->createConn();
        $stmt = $conn->prepare("SELECT * FROM $table_name WHERE id = $id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll(string $table_name) : array{
        $conn  = $this->createConn();
        $stmt = $conn->prepare("SELECT * FROM $table_name");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(string $table_name, array $columns): void{
        $conn  = $this->createConn();

        $sql = "INSERT INTO $table_name ("; 
        
        foreach($columns as $column){
            foreach ($column as $key => $col){
                $sql .= $key. ", ";
            }  
        }
      
        $sql = rtrim($sql, " , ");
        $sql .= ") "; 
        $sql .= "VALUES (";

        foreach($columns as $column) {
            foreach ($column as $col){
                $sql .= "'". $col . "'". ",";
            }  
        }

        $sql = rtrim($sql," , ");
        $sql .= ")";
    
        $stmt = $conn->prepare($sql);
        $stmt-> execute();
       
    }

    public function update(string $table_name, int $id, array $columns){
        $conn = $this->createConn();

        $sql = "UPDATE $table_name SET ";

        foreach($columns as $column){
            foreach ($column as $key => $col){

                if(is_string($col)){
                    $sql .= $key . " = " . "'" . $col . "'" . ", ";
                }else{
                    $sql .= $key . " = " . $col . ", ";
                }

            }  
        }
        $sql = rtrim($sql, " , ");
        $sql .= " WHERE id = $id";
       
        $stmt = $conn-> prepare($sql);
        $stmt->execute();
        echo $stmt->rowCount() . " kayıt başarılı bir şekilde değiştirildi.";

    }

    public function delete(string $table_name, int $id){

        $conn = $this->createConn();
        $sql = "DELETE FROM $table_name WHERE id = $id";
       
        $stmt = $conn->prepare($sql);
        $stmt-> execute();

    }
    
    
}