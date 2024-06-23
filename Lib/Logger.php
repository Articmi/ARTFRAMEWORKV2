<?php

# - NameSpace
    namespace Lib;

# - Logger Manager Errors
    class Logger
    {
        private static $logFile = __DIR__ . '/../Logs/Errors.log';

        public static function log($code, $message)
        {
            date_default_timezone_set('America/Managua');
            $date = date('d/m/Y | h:i A');
            $error = "ART_LOG - $date - [$code] - $message" . PHP_EOL;

            file_put_contents(self::$logFile, $error, FILE_APPEND);
        }
    }