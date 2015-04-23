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
      $dbname="featuresDB";
      $dbh = new \Slim\PDO\Database("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
      return $dbh;
    }

}
