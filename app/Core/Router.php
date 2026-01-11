<?php
// /app/Core/Router.php

class Router {
    protected $routes = [];

    /**
     * Adauga o ruta GET in lista de rute.
     */
    public function get($uri, $controllerAction) {
        $this->routes['GET'][$uri] = $controllerAction;
    }

    /**
     * Adauga o ruta POST (pentru formulare/AJAX) in lista de rute.
     */
    public function post($uri, $controllerAction) {
        $this->routes['POST'][$uri] = $controllerAction;
    }

    /**
     * Proceseaza URL-ul primit si apeleaza Controller-ul/Metoda corespunzatoare.
     */
    public function dispatch() {
        // 1. Preia calea URL-ului (inclusiv subdirectorul)
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // Preia metoda HTTP (GET sau POST)
        $method = $_SERVER['REQUEST_METHOD'];

        // ====================================================================
        // CORECtIE CRITICa: Curatarea prefixului aplicatiei
        // ====================================================================

        // Obtine calea de baza din Config::BASE_URL
        if (defined('Config::BASE_URL')) {
            $basePath = parse_url(Config::BASE_URL, PHP_URL_PATH);
        } else {
            // Cale implicita, daca BASE_URL nu este definit (Ar trebui sa fie definit in config.php)
            $basePath = '/fitnessapp/public/';
        }

        // Elimina calea de baza din URI (ex: scoate /fitnessapp/public/ din /fitnessapp/public/user/login)
        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        // Curata barele oblice (slash-urile) de la inceput si sfarsit
        $uri = trim($uri, '/');
        // ====================================================================

        // Verifica daca ruta exista pentru metoda respectiva (exact match)
        if (isset($this->routes[$method][$uri])) {
            $controllerAction = $this->routes[$method][$uri];
            $this->executeController($controllerAction);
            return;
        }

        // Verifica rute cu parametri (ex: retete/edit/1)
        foreach ($this->routes[$method] as $route => $controllerAction) {
            // Converteste ruta in regex pentru a suporta parametri
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $route);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $uri, $matches)) {
                // Prima potrivire este intregul string, urmatoarele sunt parametrii
                array_shift($matches);
                $this->executeController($controllerAction, $matches);
                return;
            }
        }

        // Ruta nu a fost gasita (404 Not Found)
        http_response_code(404);
        die("404 Not Found: The requested URL was not found on this server.");
    }

    /**
     * Executa controller-ul si metoda specificata
     */
    private function executeController($controllerAction, $params = []) {
        // controllerAction ar trebui sa fie de forma "ControllerClass@methodName"
        list($controllerName, $methodName) = explode('@', $controllerAction);

        // 1. Instantiaza Controllerul
        // Verifica daca fisierul Controller exista inainte de a-l folosi
        $controllerPath = __DIR__ . '/../Controllers/' . $controllerName . '.php';
        if (!file_exists($controllerPath)) {
            http_response_code(404);
            die("Controller file not found: " . $controllerPath);
        }
        require_once $controllerPath;

        // 2. Executa Metoda
        $controller = new $controllerName();
        if (method_exists($controller, $methodName)) {
            // Returneaza rezultatul metodei cu parametri
            return call_user_func_array([$controller, $methodName], $params);
        } else {
            http_response_code(404);
            die("Method not found in Controller: " . $controllerName . '->' . $methodName);
        }
    }
}