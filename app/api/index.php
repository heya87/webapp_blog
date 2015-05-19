<?php
require 'vendor/autoload.php';
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();


$app = new \Slim\Slim();
$app->contentType('application/json');
$app->get('/blogs', 'getBlogs');
$app->get('/blogs/:id', 'getBlog');
$app->get('/blogsbyuser/:username', 'getBlogsByUser');
$app->get('/blogs/:id/posts', 'getPosts');
$app->get('/blogs/:idBlog/posts/:idPost', 'getPost');
$app->get('/blogs/:idBlog/posts/:idPost/images/', 'getImages');
$app->get('/blogs/:idBlog/posts/:idPost/comments/', 'getComments');

$app->post('/newBlog', 'addBlog');
$app->post('/newPost', 'addPost');
$app->post('/newImage', 'addImage');
$app->post('/newComment', 'addComment');
$app->post('/signup', 'signup');
$app->post('/login', 'login');
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


function getBlogsByUser($username) {
  $userId = getUserId($username);
  $sql = "SELECT * FROM mydb.Blog WHERE User_idUser = ".$userId.";";
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

  $username = $app->request->headers->get('username');
  $token = $app->request->headers->get('token');

  $userId = getUserId($username);

  if(isLoggedIn($username, $token)) {

    $body = json_decode($app->request->getBody());

    $sql = "INSERT INTO `mydb`.`Blog` (`Title`, `Destination`, `Description`,`User_idUser`) VALUES (:title, :destination, :description, :userId);
    ";
    try {
      $db = getConnection();
      $stmt = $db->prepare($sql);
      $stmt->bindParam("title", $body->title);
      $stmt->bindParam("destination", $body->destination);
      $stmt->bindParam("description", $body->description);
      $stmt->bindParam("userId", $userId);
      $stmt->execute();
      $idBlog = $db->lastInsertId();
      $db = null;
      $body->idBlog = $idBlog;
      echo json_encode($body);
    } catch(PDOException $e) {
      $app->response()->status(500);
      echo json_encode($e->getMessage());
    } 
  } else {
    $app->response()->status(401);
  }


}


function addPost() {

  global $app;

  $username = $app->request->headers->get('username');
  $token = $app->request->headers->get('token');

  $req = $app->request();
  $body = json_decode($req->getBody());

  if(isLoggedIn($username, $token))  {
    if(isMyBlog($username, $body->blogId)) {

      $sql = "INSERT INTO `mydb`.`Post` (`idPost`, `Title`, `DateTime`, `Description`, `Place`, `Blog_idTrip`) VALUES ('', :title, :dateTime, :description, :place, :blogId);";
      try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("title", $body->title);
        $stmt->bindParam("place", $body->place);
        $stmt->bindParam("description", $body->description);
        $stmt->bindParam("dateTime", $body->dateTime);
        $stmt->bindParam("blogId", $body->blogId);
        $stmt->execute();
        $idPost = $db->lastInsertId();
        $db = null;
        $body->idPost = $idPost;
        echo json_encode($body);
      } catch(PDOException $e) {
        echo json_encode($e->getMessage());
      }
    } else {
      $app->response()->status(500);
      echo 'not your blog, fuck away!!';
    }
  } else {
    $app->response()->status(401);
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



function addImage() {
  global $app;
  $req = $app->request();
  $body = json_decode($req->getBody());

  $sql = "INSERT INTO `mydb`.`Image` (`Title`, `url`, `Post_idPost`) VALUES (:name, :link, :postId);";
  try {
    $db = getConnection();
    $stmt = $db->prepare($sql);
    $stmt->bindParam("name", $body->name);
    $stmt->bindParam("link", $body->link);
    $stmt->bindParam("postId", $body->postId);
    $stmt->execute();
    $db = null;
    echo json_encode($body);
  } catch(PDOException $e) {
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

function isLoggedIn($username, $token) {
  $rightNow = new DateTime("now");
  $sql = "SELECT * FROM mydb.User WHERE UserName = '".$username."' AND token = '".$token."' AND tokenExpired >= NOW();";

  try {

    $db = getConnection();
    $stmt = $db->query($sql);
    if($stmt->rowCount() > 0){
        $db = null;
        return true;
    }else {
      $db = null;
      return false;
    }
  }
  catch(PDOException $e) {
    $db = null;
    return false;
  }
}

function isMyBlog($username, $blogId) {

  $sql = "SELECT idUser FROM mydb.User WHERE UserName = '".$username."';";

  
  try {

    $db = getConnection();
    $stmt = $db->query($sql);
    $userId = $stmt->fetchColumn();

    $sql = "SELECT * FROM mydb.Blog WHERE idBlog = '".$blogId."' AND User_idUser = '".$userId."';";

    $stmt = $db->query($sql);

    if($stmt->rowCount() > 0){
      $db = null;
      return true;
    }else {
      $db = null;
      return false;
    }
  }
  catch(PDOException $e) {
    $db = null;
    return false;
  }
}

function getUserId($username) {

  $sql = "SELECT idUser FROM mydb.User WHERE UserName = '".$username."';";

  
  try {

    $db = getConnection();
    $stmt = $db->query($sql);
    $userId = $stmt->fetchColumn();
    return $userId;

  }
  catch(PDOException $e) {
    $db = null;
    return false;
  }
}



function login() {

  global $app;
  $req = $app->request();
  $body = json_decode($req->getBody());
  $username = $body->username;

  $sql = "SELECT UserPassword FROM mydb.User WHERE UserName = '".$username."';";
  try {

    $db = getConnection();
    $stmt = $db->query($sql);
    $hash = $stmt->fetchColumn();

    if(password_verify ( $username, $hash)) {
      $token = md5(uniqid(mt_rand(), true));
      $sql = "UPDATE `mydb`.`User` SET `tokenExpired`=NOW() + INTERVAL 1 HOUR, `token`='".$token."' WHERE `UserName`='".$body->username."';";
      try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $db = null;

        $body->username = $username;
        $body->token = $token;
        $body->password = null;
        echo json_encode($body); 
      }
      catch(PDOException $e) {
        echo json_encode($e->getMessage());
      }

    } else {
      $app->response()->status(401);
      echo 'Illegal credentials, try again';
    }
  }
  catch(PDOException $e) {
    echo json_encode($e->getMessage());
  }
}


function signup() {
  global $app;
  $req = $app->request();
  $body = json_decode($req->getBody());


  $sql = "INSERT INTO `mydb`.`User` (`UserName`, `UserPassword`, `tokenExpired`, `token`) VALUES (:username, :password, NOW() + INTERVAL  1 HOUR, :token);";
  try {
    $db = getConnection();
    $stmt = $db->prepare($sql);
    $stmt->bindParam("username", $body->username);
    $hash = password_hash($body->password, PASSWORD_DEFAULT);
    $stmt->bindParam("password", $hash);
    $token = md5(uniqid(mt_rand(), true));
    $stmt->bindParam("token", $token);
    $stmt->execute();
    $db = null;
    $body->token = $token;
    $body->password = null;
    echo json_encode($body  );
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
