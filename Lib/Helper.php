<?php

# - NameSpace
    namespace Lib;
    use Lib\Logger;

# - Extra settings
    // - Load Home Template
    /**
        * Load the start of the website | Section outside the dashboard.
        *
        * @param array $data Data to be extracted and available in the view.
    */
    function headerHome(array $data = []): void
    {
        $templatePath = '../App/Template/Home/HeadAmind.php';

        if (file_exists($templatePath)) {
            require $templatePath;
        } else {
            Logger::log("ARTICMI/ART0004", 'Template not found in: ' . $templatePath);
        }
    }

    function footerHome(array $data = []): void
    {
        $templatePath = '../App/Template/Home/FooterAdmin.php';

        if (file_exists($templatePath)) {
            require $templatePath;
        } else {
            Logger::log("ARTICMI/ART0004", 'Template not found in: ' . $templatePath);
        }
    }

    // - Load Dashboard Template
    /**
        * Load the start of the dashboard | Section within the dashboard.
        *
        * @param array $data Data to be extracted and available in the view.
    */
    function headerDash(array $data = []): void
    {
        $templatePath = '../App/Template/Panel/HeadAdmin.php';

        if (file_exists($templatePath)) {
            require $templatePath;
        } else {
            Logger::log("ARTICMI/ART0004", 'Template not found in: ' . $templatePath);
        }
    }

    function footerDash(array $data = []): void
    {
        $templatePath = '../App/Template/Panel/FooterAdmin.php';

        if (file_exists($templatePath)) {
            require $templatePath;
        } else {
            Logger::log("ARTICMI/ART0004", 'Template not found in: ' . $templatePath);
        }
    }

    // - Load Modals
    /**
        * Load a modal into the view.
        *
        * @param string $nameModal Name of the modal to load.
        * @param array $data Data to be extracted and available in the view.
    */
    function getModal(string $nameModal, array $data = []): void
    {
        $modalPath = __DIR__ . '../App/Template/Modals/' . $nameModal . '.php';

        if (file_exists($modalPath)) {
            require $modalPath;
        } else {
            Logger::log("ARTICMI/ART0005", "Modal not found: $modalPath");
            echo "Modal not found: $modalPath";
        }
    }

    // - Debugging
    function dep($data)
    {
        $formatted_data = '<pre>' . htmlspecialchars(print_r($data, true)) . '</pre>';
        return $formatted_data;
    }
    
    // - Clean string
    function strClean($strCadena): string
    {
        $string = trim($strCadena);
        
        $string = stripslashes($string);
        
        $string = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $string);
        
        $sql_keywords = ['SELECT * FROM', 'DELETE FROM', 'INSERT INTO', 'SELECT COUNT(*) FROM', 'DROP TABLE'];
        $string = str_ireplace($sql_keywords, '', $string);
        
        $sql_patterns = ["OR '1'='1", 'OR "1"="1"', "OR ´1´=´1´", "is NULL; --", "LIKE '",
                         'LIKE "', "LIKE ´", "OR 'a'='a", 'OR "a"="a"', "OR ´a´=´a", "--", "^", "[", "]", "=="];
        $string = str_ireplace($sql_patterns, '', $string);
        
        return $string;
    }

    // - Password Generator
    /**
        * Generate a password.
        *
        * @param string $length number of characters that will be generated in the password.
    */
    function passGenerator($length = 12): string
    {
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789!@#$%^&*()';

        $password = '';
        $char_length = strlen($characters);

        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, $char_length - 1)];
        }

        return $password;
    }

    // - Token Generator (ART_XXXXXXXX-XXXXXXXX-XXXXXXXX-XXXXXXXX) Note: 73 characters
    function token()
    {
        $r1 = bin2hex(random_bytes(10));
        $r2 = bin2hex(random_bytes(10));
        $r3 = bin2hex(random_bytes(10));
        $r4 = bin2hex(random_bytes(10));
        
        $token = 'ART_' . $r1 . '-' . $r2 . '-' . $r3 . '-' . $r4;
        
        return $token;
    }