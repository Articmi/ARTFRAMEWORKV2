<?php

# - NameSpace
    namespace Lib\Database\MySQL;
    use Lib\Database\MySQL\MySQLConnection;

# - MySQL Core
    class MySQLCore
    {
        private static $connection;

        public static function getConnection()
        {
            if (!self::$connection) {
                self::$connection = MySQLConnection::getInstance();
            }
            return self::$connection->getConnection();
        }
    }