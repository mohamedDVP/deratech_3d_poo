<?php

namespace App\Db;
use Dotenv\Dotenv;

require __DIR__.'/../../vendor/autoload.php';
$env = Dotenv::createImmutable(__DIR__);
$env->load();

class Mysql
{
    private $db_name;
    private $db_user;
    private $db_password;
    private $db_port;
    private $db_host;
    private $pdo = null;
    private static $_instance = null;

    public function __construct()
    {

        $this->db_name = $_SERVER["DB_NAME"];
        $this->db_user = $_SERVER["DB_USER"];
        $this->db_password = $_SERVER["DB_PASSWORD"];
        $this->db_port = $_SERVER["DB_PORT"];
        $this->db_host = $_SERVER["DB_HOST"];
    }

    public static function getInstance():self
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Mysql();
        }
        return self::$_instance;
    }

    public function getPDO():\PDO
    {
        if (is_null($this->pdo)) {
            $this->pdo = new \PDO('mysql:dbname=' . $this->db_name . ';charset=utf8;host=' . $this->db_host.':'.$this->db_port, $this->db_user, $this->db_password);
        }
        return $this->pdo;
    }
}