<?php

# - NameSpace
    namespace Lib\Database\MongoDB;
    use MongoDB\Client;
    use MongoDB\Exception\Exception;
    use Lib\Logger;

# - MongoDB
    class MongoConnection
    {
        private static $instance;
        private $client;
        private $database;

        private function __construct($uri, $dbName)
        {
            try {
                $this->client = new Client($uri);
                $this->database = $this->client->$dbName;
            } catch (Exception $e) {
                Logger::log("ARTICMI/ART0007", "Connection failed: " . $e->getMessage());
                throw new \Exception("Connection failed: " . $e->getMessage());
            }
        }

        public static function getInstance(): self
        {
            if (!isset(self::$instance)) {
                $uri = MONGO_DB_URI;
                $dbName = MONGO_DB_NAME;
                self::$instance = new self($uri, $dbName);
            }
            return self::$instance;
        }

        public function getDatabase()
        {
            return $this->database;
        }
    }