<?php
require 'vendor/autoload.php';
require 'include/config.php';
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();


$app = new \Slim\Slim();
$app->contentType('application/json');
$app->get('/blogs', 'getBlogs');
$app->get('/blogs/:id', 'getBlog');
$app->get('/blogs/:id/posts', 'getPosts');
$app->get('/blogs/:idBlog/posts/:idPost', 'getPost');
$app->get('/blogs/:idBlog/posts/:idPost/images/', 'getImages');
$app->get('/blogs/:idBlog/posts/:idPost/comments/', 'getComments');

$app->post('/newBlog', 'addBlog');
$app->post('/newComment', 'addComment');
$app->run();


function getBlogs() {
$sql = "select * FROM Blog";
  try {
    $db = getConnection();
    $stmt = $db->query($sql);
    $blogs = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    echo json_encode($blogs);
  }
  catch(PDOException $e) {
    echo json_encode($e->getMessage());
  }
}


function getBlog($id) {
    $sql = "select * FROM Blog WHERE idBlog=".$id." ORDER BY idBlog";
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $blog = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($blog);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


function addBlog() {
  global $app;
  $req = $app->request();
  $body = json_decode($req->getBody());
 
$sql = "INSERT INTO `Blog` (`Title`, `Destination`, `Description`,`User_idUser`) VALUES (:title, :destination, :description, '1');
";
  try {
    $db = getConnection();
    $stmt = $db->prepare($sql);
    $stmt->bindParam("title", $body->title);
    $stmt->bindParam("destination", $body->destination);
    $stmt->bindParam("description", $body->description);
    $stmt->execute();
    $idBlog = $db->lastInsertId();
    $db = null;
/*    $body['idBlog'] = $idBlog;
*/    $body->idBlog = $idBlog;
    echo json_encode($body);
  } catch(PDOException $e) {
      echo json_encode($e->getMessage());
  }
}



function getPosts($id) {
  $sql = "select * FROM Post WHERE Blog_idTrip=".$id." ORDER BY idPost;";
  try {
    $db = getConnection();
    $stmt = $db->query($sql);
    $posts = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    echo json_encode($posts);
  }
  catch(PDOException $e) {
    echo json_encode($e->getMessage());
  }
}


function getPost($idBlog, $idPost) {
  $sql = "select * FROM Post WHERE Blog_idTrip=".$idBlog." AND idPost =".$idPost." ORDER BY idPost;";
  try {
    $db = getConnection();
    $stmt = $db->query($sql);
    $post = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    echo json_encode($post);
  }
  catch(PDOException $e) {
    echo json_encode($e->getMessage());
  }
}

function getImages($idBlog, $idPost) {
  $sql = "select * FROM Image WHERE Post_idPost=".$idPost." ORDER BY idImage;";
  try {
    $db = getConnection();
    $stmt = $db->query($sql);
    $post = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    echo json_encode($post);
  }
  catch(PDOException $e) {
    echo json_encode($e->getMessage());
  }
}


function getComments($idBlog, $idPost) {
  $sql = "select * FROM Comment WHERE Post_idPost=".$idPost." ORDER BY DateTime;";
  try {
    $db = getConnection();
    $stmt = $db->query($sql);
    $post = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    echo json_encode($post);
  }
  catch(PDOException $e) {
    echo json_encode($e->getMessage());
  }
}

function addComment() {
  global $app;
  $req = $app->request();
  $body = json_decode($req->getBody());

 
$sql = "INSERT INTO `Comment` (`Text`, `DateTime`, `Post_idPost`, `name`) VALUES (:text, :DateTime, :postId, :name);
";
  try {
    $db = getConnection();
    $stmt = $db->prepare($sql);
    $stmt->bindParam("text", $body->Text);
    $stmt->bindParam("name", $body->name);
    $stmt->bindParam("DateTime", $body->dateTime);
    $stmt->bindParam("postId", $body->postId);
    $stmt->execute();
    $idBlog = $db->lastInsertId();
    $db = null;
/*    $body['idBlog'] = $idBlog;
*/    $body->idBlog = $idBlog;
    echo json_encode($body);
  } catch(PDOException $e) {
      echo json_encode($e->getMessage());
  }
}


function getConnection() 
{
    $dbhost="127.0.0.1";
    $dbuser="root";
    $dbpass="1234";
    $dbname="mydb";
    $dbh= new \Slim\PDO\Database("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass, array(\Slim\PDO\Database::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

return $dbh;
}
