<?php

# - Namespace
    namespace Articmi\Controllers;
    use Lib\Logger;

# - Load View Manager
    class Controller
    {
        /**
            * Renders a view.
            *
            * @param string $route View path in 'folder.file' format.
            * @param array $data Data to be extracted and available in the view.
            * @return string View content.
        */
        public function view(string $route, array $data = []): string
        {
            extract($data);
            $viewPath = __DIR__ . '/../Views/' . str_replace('.', '/', $route) . '.php';

            if (file_exists($viewPath)) {
                ob_start();
                include $viewPath;
                $content = ob_get_clean();

                return $content;
            } else {
                Logger::log("ARTICMI/ART0003", "View not found: $route");
                return "View not found: $route";
            }
        }

        /**
            * Redirect to a specific route.
            *
            * @param string $route Route to redirect to.
        */
        public function redirect(string $route): void
        {
            header("Location: $route");
            exit;
        }
    }