<?php 

require "db.class.php";

class Post{
    
  

    private object $database;

    public function __construct(DB $database)
    {
        $this->database = $database;// DB nesnesi inject edildi.
        
    }
    
    public function postLists() : array{  
       return $this->database->getAll("posts");
    }
    public function postDetail(int $post_id): array{
        return $this->database->get("posts", $post_id);
    }
    public function createPost(string $table_name, array $columns): void{
        $this->database->create("posts", [$columns]);
    }
    public function updatePost(int $post_id, array $columns): void{
        $this-> database->update("posts", $post_id, [$columns]);
    } 
    public function deletePost(int $post_id): void{
        $this-> database->delete("posts", $post_id);
    }


}

//$post = new Post(new DB()); Yeni Post sınıfı oluşturur.
//$post->postLists(); Tüm postları çeker
//$post->postDetail(2); Parametre olarak verilen id deki postu çeker
//$post-> createPost("posts", ["author"=> "Salih Duran", "post_detail" => "Lorem IPsum Dolar sit Amet", "post_header" => "Created_Header"]);
//createPost "posts" tablosundaki parametre olarak verilen dizideki verileri veritabanına ekler 
//$post->updatePost(3, ["post_header" => "Updated Headers"]); 
//updatePost Parametre olarak verilen id deki parametre olarak 
//verilen dizinin değeleriyle veritabandaki değerleri değiştirir.
//$post->deletePost(4); //Verilen id parametresi ile veritanında aynı olan id li kayıtı siler