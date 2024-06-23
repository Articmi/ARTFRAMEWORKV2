<?php

# - NameSpace
    namespace Lib\Database\MySQL;
    use Lib\Logger;
    use PDO;
    use PDOException;

# - Conexion PDO
    class MySQLConnection
    {
        private static $instance;
        private $connection;

        private function __construct($host, $dbName, $charset, $user, $password)
        {
            $dsn = "mysql:host={$host};dbname={$dbName};charset={$charset}";

            try {
                $this->connection = new PDO($dsn, $user, $password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                Logger::log(1045, "Connection failed: " . $e->getMessage());
                throw new \Exception("Connection failed: " . $e->getMessage());
            }
        }

        public static function getInstance()
        {
            if (!isset(self::$instance)) {
                $host = DB_HOST;
                $dbName = DB_NAME;
                $charset = DB_CHARSET;
                $user = DB_USER;
                $password = DB_PASSWORD;
                self::$instance = new self($host, $dbName, $charset, $user, $password);
            }
            return self::$instance;
        }

        public function getConnection()
        {
            return $this->connection;
        }
    }