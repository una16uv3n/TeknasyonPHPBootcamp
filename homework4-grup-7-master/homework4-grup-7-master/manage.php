<?php  require "post.class.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Manage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>
<body style = "background-color:rgb(240, 240, 240)">

<?php 

if(isset($_GET['action'])){

    $postObj = new Post(new DB());
   
    if($_GET['action'] =="edit"){


        if(isset($_GET['post']) && isset($_GET['author']) && isset($_GET['post_header']) && isset($_GET['post_detail'])){
            $id = $_GET['post'];
            $author = $_GET['author'];
            $post_header = $_GET['post_header'];
            $post_detail = $_GET['post_detail'];
            
            $postObj->updatePost($id,["post_header" => $post_header, "post_detail" => $post_detail, "author" =>$author]);
            header("Location: http://localhost/homework4-grup-7/manage.php");
        }
       
    
        }else if($_GET['action'] == "delete"){

            $postObj->deletePost($_GET['post']);
            header("Location: http://localhost/homework4-grup-7/manage.php");
            
        }else if($_GET['action'] == "create"){

            $postObj-> createPost("posts",["author"=> $_GET['author'], "post_detail"=>$_GET['post_detail'], "post_header" => $_GET['post_header'] ]);
            header("Location: http://localhost/homework4-grup-7/manage.php");
        
        }
}

?>   
  


<div class = "container">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-primary mb-5"  >
  <a class="navbar-brand" href="http://localhost/homework4-grup-7/index.php" style="color: white; font-weight:bold">Homework4-grup-7</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" style="color: white;" href="http://localhost/homework4-grup-7/index.php">Index <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" style="color: white;" href="http://localhost/homework4-grup-7/manage.php">Manage<span class="sr-only">(current)</span></a>
      </li>
     
    </ul>
  </div>
</nav>
<!-- Navbar -->

    <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">id</th>
        <th scope="col">Yazar</th>
        <th scope="col">Başlık</th>
        <th scope="col">Oluşturulma Tarihi</th>

      </tr>
    </thead>
    <tbody>

      <?php   
    //Post Listeleme
      if(isset($_GET['post']) && isset($_GET['action'])){
        $id = $_GET['post'];
        $postObj = new Post(new DB());
        $post = $postObj->postDetail($id);
       

        foreach($post as $post_val){
          echo "<tr>" . PHP_EOL;
          echo "<th scope ='row'>$post_val[id]</th>" . PHP_EOL;
          echo "<td>$post_val[author]</td>" . PHP_EOL;
          echo "<td><a href='http://localhost/homework4-grup7/$post_val[post_header].php'> $post_val[post_header]</a></td>" . PHP_EOL;
          echo "<td>$post_val[post_created]</td>" . PHP_EOL;
          echo "<td></td>";
          echo "</tr> " . PHP_EOL;
          
          
      }
      } elseif(!isset($_GET['post']) && !isset($_GET['action'])) {

        $postObj = new Post(new DB());
        $posts = $postObj->postLists();

        foreach($posts as $post){
          echo "<tr>" . PHP_EOL;
          echo "<th scope ='row'>$post[id]</th>" . PHP_EOL;
          echo "<td>$post[author]</td>" . PHP_EOL;
          echo "<td><a href='http://localhost/homework4-grup7/$post[post_header].php'> $post[post_header]</a></td>" . PHP_EOL;
          echo "<td>$post[post_created]</td>" . PHP_EOL;
          echo "<td> <div class='d-flex '>";
          echo "<button class='btn btn-warning' id='editPost' type='submit' style ='margin-right:5px;'><span class='material-icons' style='font-size:18px;'><a href ='http://localhost/homework4-grup-7/manage.php?action=edit&post=$post[id]' style ='text-decoration:none;color:white;'>edit</a></span></button>";
          echo "<button class='btn btn-danger' id='deletePost' type='submit' ><span class='material-icons' style='font-size:18px;'><a href ='http://localhost/homework4-grup-7/manage.php?action=delete&post=$post[id]' style ='text-decoration:none;color:white;'>delete</a></span></button>";
          echo "</div> </td>";
          echo "</tr> " . PHP_EOL;
      }

      }
    //Post Listeleme 

      ?>
    
    </tbody>
</table>
<hr>
<?php 
if(isset($_GET['action'])){
    if($_GET['action'] == "edit"){
        echo "<button class ='btn btn-primary' id='addPost' style ='display:none;'>Post Ekle</button>";
    }
}else{
    echo "<button class ='btn btn-primary' id='addPost'>Post Ekle</button>";
}
?>

<div id = "createForm" style="display: none;">
<form action='manage.php' method='GET'>
            <div class='form-group'>
                <div >
                        <label for='author'>Yazar</label>
                        <input type="text" name ='action' value="create" style="display:none;">
                        <input type='text' name='author' class='form-control' >
                          <label for='post_header'>Başlık</label>
                          <input type='text' name='post_header' class='form-control'  >
                          <label for='post_detail'>İçerik</label>
                        <textarea name='post_detail' class='form-control' style='resize: none;' cols='30' rows='15'></textarea>
                   </div>
                   <button class = 'btn btn-primary mt-3'>Gönder</button>
            </div>
        
</form>
</div>
<?php

if(isset($_GET['action'])){
if($_GET['action'] == "edit" && !isset($_GET['post_detail']) ){
   
    $current_post = $postObj->postDetail($_GET['post']);
    $author = $current_post[0]['author'];
    $header = $current_post[0]['post_header'];
    $id = $current_post[0]['id'];

    echo  "<div>";
          echo "<form action='manage.php' method='GET'>";
                echo "<div class='form-group'>";
                    echo "<div>";
                        echo "<label for='author'>Yazar</label>" . PHP_EOL;
                        echo "<input type='text' name = 'action' value='edit' style='display:none;'>" . PHP_EOL;
                        echo "<input type='text' name = 'post' value='$id' style='display:none;'>" . PHP_EOL;
                        echo "<input type='text' name='author' value='$author' class='form-control' >" . PHP_EOL;
                        echo "<label for='post_header'>Başlık</label>";
                        echo "<input type='text' name='post_header' value='$header' class='form-control'>" . PHP_EOL;
                        echo "<label for='post_detail'>İçerik</label>";
                        echo "<textarea name='post_detail' class='form-control' style='resize: none;' cols='30' rows='15'></textarea>" . PHP_EOL;
                        echo "</div>";
                        echo "<button class ='btn btn-primary mt-3'>Gönder</button>" . PHP_EOL;
                echo "</div>";
        echo "</form>";
    echo "</div>";
}
}
?>



<script>

const createForm = document.querySelector('#createForm');
const addPost = document.querySelector('#addPost');

addPost.addEventListener('click',()=>{

createForm.style.display = "block"; 
addPost.style.display = "none";

});

 </script>   
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>
