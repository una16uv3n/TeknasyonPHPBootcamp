<?php  require "post.class.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
      .post-box{
        width: 100%;
        height: 400px;
        background-color: white;
        border-radius: 5px;
        position: relative;
      }
      .post-box h1{
        text-align: center;
      }
      .post-box-inner p{
        padding: 2em;
      }
      .post-box-inner a{
        text-decoration: none;
      }
      .post-author{
        position: absolute;
        bottom:5%;
        left: 3%;
        font-weight: bold;
      }
      .post-read{
        position: absolute;
        bottom: 5%;
        right:5%;
      }
    </style>
</head>
<body style = "background-color:rgb(240, 240, 240)">
   
  
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
    
      if(isset($_GET['post'])){
        $id = $_GET['post'];
        $postObj = new Post(new DB());
        $post = $postObj->postDetail($id);
       

        foreach($post as $post_val){
          echo "<tr>" . PHP_EOL;
          echo "<th scope ='row'>$post_val[id]</th>" . PHP_EOL;
          echo "<td>$post_val[author]</td>" . PHP_EOL;
          echo "<td><a href='http://localhost/homework4-grup7/$post_val[post_header].php'> $post_val[post_header]</a></td>" . PHP_EOL;
          echo "<td>$post_val[post_created]</td>" . PHP_EOL;
          echo "</tr> " . PHP_EOL;
          
      }
      } else {

        $postObj = new Post(new DB());
        $posts = $postObj->postLists();

        foreach($posts as $post){
          echo "<tr>" . PHP_EOL;
          echo "<th scope ='row'>$post[id]</th>" . PHP_EOL;
          echo "<td>$post[author]</td>" . PHP_EOL;
          echo "<td><a href='http://localhost/homework4-grup7/$post[post_header].php'> $post[post_header]</a></td>" . PHP_EOL;
          echo "<td>$post[post_created]</td>" . PHP_EOL;
          echo "</tr> " . PHP_EOL;
      }
      }

      ?>
    </tbody>
</table>

<form action="index.php" method="GET">
<div class="form-group">
       <label for="search-post">Post ara</label>
       <input type="text" name = "post" class="form-control" placeholder="id değeri giriniz">
</div>
<button class="btn btn-primary" type="submit">Ara</button>
</form>
 
<div class="container p-0 mt-5">

    <?php 
  if(isset($_GET['post'])){
    foreach($post as $post_val){

      echo "<div class ='post-box mt-5'>";
      echo "<div class = 'post-box-inner'>";
      echo "<h1> <a href='http://localhost/homework4-grup7/$post_val[post_header].php'>$post_val[post_header]</a></h1>";
      echo "<p>";
      echo substr($post_val['post_detail'], 0 ,1500);
      echo "...</p>"; 
      echo "</div>";
      echo "<div class ='post-author'>Yazar: $post_val[author]</div>";
      echo "<div class ='post-read'><a href='http://localhost/homework4-grup7/$post_val[post_header].php'>Devamını okumak için tıklayın</a></div>";
      echo "</div>";
    }

  }else{

    foreach($posts as $post){
      echo "<div class ='post-box mt-5'>";
      echo "<div class = 'post-box-inner'>";
      echo "<h1> <a href='http://localhost/homework4-grup7/$post[post_header].php'>$post[post_header]</a></h1>";
      echo "<p>";
      echo substr($post['post_detail'], 0 ,1500);
      echo "...</p>"; 
      echo "</div>";
      echo "<div class ='post-author'>Yazar: $post[author]</div>";
      echo "<div class ='post-read'><a href='http://localhost/homework4-grup7/$post[post_header].php'>Devamını okumak için tıklayın</a></div>";
      echo "</div>";
     
   }

  }
 
    ?>
     
</div>
    

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>

  
  

