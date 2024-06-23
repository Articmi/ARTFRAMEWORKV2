<?php

# - NameSpace
    namespace Articmi\Controllers;
    use Lib\Logger;
    use Lib\Database\MySQL\Core;

# - Home Controller
    class Home extends Controller
    {
        /**
            * How to show a view.
            * @return string Home page view content.
        */
        public function index(): string
        {
            $db = Core::getConnection();

            $data = [
                'page_id' => 1,
                'page_title' => "Home",
                'page_content' => "View and Controller Home Set Correctly.",
                'page_script' => ""
            ];
            
            return $this->view('home', $data);
        }
    }