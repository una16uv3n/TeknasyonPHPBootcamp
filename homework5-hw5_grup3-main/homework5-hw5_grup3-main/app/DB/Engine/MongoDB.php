<?php

namespace App\DB\Engine;

use MongoDB\BSON\ObjectId;

class MongoDB implements DriverInterface
{
    protected \MongoDB\Client $client;
    protected $dbname;

    public function __construct(string $protocol, string $host, string $user, string $pass, string $dbname, ?array $options)
    {
        try{
            //$this->client = new \MongoDB\Client("mongodb://$user:$pass@$host:$protocol/$dbname");//Düzenlenecek;
            $this->client = new \MongoDB\Client("mongodb://127.0.0.1/");
            $this->dbname = $dbname;


        }catch (\MongoException $exception){
            echo $exception->getMessage();
        }
    }

    public function all(string $table): array
    {
        $db= $this->client->selectDatabase($this->dbname);
        $collection = $db->$table;
        $result = $collection->find()->toArray();
        return $result;
    }

    public function find(string $table, mixed $id): mixed
    {
        $db= $this->client->selectDatabase($this->dbname);
        $collection = $db->$table;
        $result = $collection->findOne(['_id' =>new \MongoDB\BSON\ObjectId($id)]);
        return $result;
    }

    public function create(string $table, array $values): bool 
    {
        $db = $this->client->selectDatabase($this->dbname);
        $collection = $db->$table;
        $insertManyResult = $collection->insertMany($values);
        return  $insertManyResult->isAcknowledged();

    }

    public function update(string $table, mixed $id, array $values): bool
    {
        $db = $this->client->selectDatabase($this->dbname);
        $collection = $db->$table;
        $updateResult = $collection->updateMany(
            ['_id' => new \MongoDB\BSON\ObjectId($id)],
            ['$set'=>$values]
        );
        return $updateResult->isAcknowledged();
    }

    public function delete(string $table, mixed $id): bool
    {
        $db = $this->client->selectDatabase($this->dbname);
        $collection = $db->$table;
        $deleteResult = $collection->deleteMany(
            ['_id' => new \MongoDB\BSON\ObjectID($id)]
        );
        return $deleteResult->isAcknowledged();
    }
}


//Kullanım aşağıdaki gibidir



//$mongoDb = new MongoDB("","","","","book_app",[]);
//$insertArr = [
//    [
//    "name" => "Basreal",
//    "author" => "AAA",
//    "section" => [
//        "1" => "Yeni Dünya Düzeni",
//        "2" =>"Soğuk Savaşın Başlaması",
//        "3" => "Yeni Dünya Düzeninin Yeniden değerlendirilmesi",
//    ],
//    "content" => "Yeni milli ve yerli framework",
//    ]
//
//];
//$books = $mongoDb->create("book",$insertArr);
//
//$config = include "config.php";
//var_dump($config);

//$mongoDb = new MongoDB("","","","","book_app",[]);
//$updateArr =
//[
//    "name" => "Basreal Güncel halim",
//    "author" => "Güncellendi",
//];
//$mongoDb->update('book',"6143b77fe77500001b003f54",$updateArr);

//$mongoDb = new MongoDB("","","","","book_app",[]);
//
//$mongoDb->delete('book',"6143a458e77500001b003f4e");
