<?php

namespace Api;

use \Slim\Slim;
use \Slim\pdo;
use \Exception;


// TODO Move all "features" things to a class with index() and get() methods
class Application extends Slim
{


    public function __construct(array $userSettings = array())
    {
        // Slim initialization
        parent::__construct($userSettings);
        $this->config('debug', false);
        $this->notFound(function () {
            $this->handleNotFound();
        });
        $this->error(function ($e) {
            $this->handleException($e);
        });

        // /features
        $this->get('/features', function () {

            $sql = "select * FROM feature";
            try {
                $db = $this->handleGetConnection();
                $stmt = $db->query($sql);
                $features = $stmt->fetchAll();
                $db = null;
                $this->response->headers->set('Content-Type', 'application/json');
                $this->response->setBody(json_encode($features));
            }
            catch(PDOException $e) {
                echo json_encode($e->getMessage());
            }

        });

        $this->get('/features/:id', function ($id) {

            $sql = "select * FROM feature WHERE id=".$id." ORDER BY id";
            try {
                $db = $this->handleGetConnection();
                $stmt = $db->query($sql);
                $feature = $stmt->fetchAll();
                $db = null;
                if ($feature === null) {
                    return $this->notFound();
                }
                $this->response->headers->set('Content-Type', 'application/json');
                $this->response->setBody(json_encode($feature));
            } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}';
            }
        });

        // /features
        $this->get('/blogs', function () {

            $sql = "select * FROM Blog";
            try {
                $db = $this->handleGetConnection();
                $stmt = $db->query($sql);
                $blogs= $stmt->fetchAll();
                $db = null;
                $this->response->headers->set('Content-Type', 'application/json');
                $this->response->setBody(json_encode($blogs));
            }
            catch(PDOException $e) {
                echo json_encode($e->getMessage());
            }
        });


        $this->get('/blogs/:id/posts/', function ($id) {

            $sql = "select * FROM Post WHERE Blog_idTrip=".$id." ORDER BY idPost;";
            try {
                $db = $this->handleGetConnection();
                $stmt = $db->query($sql);
                $post= $stmt->fetchAll();
                $db = null;
                if ($post === null) {
                    return $this->notFound();
                }
                $this->response->headers->set('Content-Type', 'application/json');
                $this->response->setBody(json_encode($post));
            } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}';
            }
        });


        $this->get('/blogs/:id/posts/:idTwo', function ($id, $idTwo) {

            $sql = "select * FROM Post WHERE Blog_idTrip=".$id." AND idPost =".$idTwo." ORDER BY idPost;";
            try {
                $db = $this->handleGetConnection();
                $stmt = $db->query($sql);
                $post= $stmt->fetchAll();
                $db = null;
                if ($post === null) {
                    return $this->notFound();
                }
            $this->response->headers->set('Content-Type', 'application/json');
            $this->response->setBody(json_encode($post));

            } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}';
            }
        });



        $this->get('/blogs/:idBlog/posts/:idPost/images/', function ($idBlog, $idPost) {

            $sql = "select * FROM Image WHERE Post_idPost=".$idPost." ORDER BY idImage;";
            try {
                $db = $this->handleGetConnection();
                $stmt = $db->query($sql);
                $images= $stmt->fetchAll();
                $db = null;
                if ($images === null) {
                    return $this->notFound();
                }
            $this->response->headers->set('Content-Type', 'application/json');
            $this->response->setBody(json_encode($images));

            } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}';
            }
        });


        $this->get('/blogs/:idBlog/posts/:idPost/comments/', function ($idBlog, $idPost) {

            $sql = "select * FROM Comment WHERE Post_idPost=".$idPost." ORDER BY DateTime;";
            try {
                $db = $this->handleGetConnection();
                $stmt = $db->query($sql);
                $comments= $stmt->fetchAll();
                $db = null;
                if ($comments === null) {
                    return $this->notFound();
                }
            $this->response->headers->set('Content-Type', 'application/json');
            $this->response->setBody(json_encode($comments));

            } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}';
            }
        });




        $this->get('/blogs/:id', function ($id) {


            $sql = "select * FROM Blog WHERE idBlog=".$id." ORDER BY idBlog";
            try {
                $db = $this->handleGetConnection();
                $stmt = $db->query($sql);
                $blog= $stmt->fetchAll();
                $db = null;
                if ($blog === null) {
                    return $this->notFound();
                }
                $this->response->headers->set('Content-Type', 'application/json');
                $this->response->setBody(json_encode($blog));
            } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}';
            }
        });
    }

    public function handleNotFound()
    {
        throw new Exception(
            'Resource ' . $this->request->getResourceUri() . ' using '
            . $this->request->getMethod() . ' method does not exist.',
            404
        );
    }

    public function handleException(Exception $e)
    {
        $status = $e->getCode();
        $statusText = \Slim\Http\Response::getMessageForCode($status);
        if ($statusText === null) {
            $status = 500;
            $statusText = 'Internal Server Error';
        }

        $this->response->setStatus($status);
        $this->response->headers->set('Content-Type', 'application/json');
        $this->response->setBody(json_encode(array(
            'status' => $status,
            'statusText' => preg_replace('/^[0-9]+ (.*)$/', '$1', $statusText),
            'description' => $e->getMessage(),
        )));
    }

    /**
     * @return \Slim\Http\Response
     */
    public function invoke()
    {
        foreach ($this->middleware as $middleware) {
            $middleware->call();
        }
        $this->response()->finalize();
        return $this->response();
    }

    public function handleGetConnection() 
    {
      $dbhost="127.0.0.1";
      $dbuser="root";
      $dbpass="1234";
      $dbname="mydb";
/*      $dbh = new \Slim\PDO\Database("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
*/      $dbh= new \Slim\PDO\Database("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass, array(\Slim\PDO\Database::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

      return $dbh;
    }

}
