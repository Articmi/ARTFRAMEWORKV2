<?php

# - NameSpace
    namespace Lib\Database\MongoDB;
    use Lib\Database\MongoDB\MongoConnection;

# - MongoCore
    class MongoCore
    {
        private static $database;

        public static function getDatabase()
        {
            if (!self::$database) {
                self::$database = MongoConnection::getInstance()->getDatabase();
            }
            return self::$database;
        }
    }