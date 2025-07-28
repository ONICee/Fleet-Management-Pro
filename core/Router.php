<?php
class Router {
    private $routes = [];
    
    public function add($uri, $controller) {
        $this->routes[$uri] = $controller;
    }
    
    public function dispatch($uri, $method, $db, $session) {
        // Remove trailing slash
        $uri = rtrim($uri, '/');
        if (empty($uri)) {
            $uri = '/';
        }
        
        $route = $this->findRoute($uri);
        
        if ($route) {
            $this->callController($route['controller'], $route['params'], $db, $session, $method);
        } else {
            $this->show404();
        }
    }
    
    private function findRoute($uri) {
        // First try exact match
        if (isset($this->routes[$uri])) {
            return ['controller' => $this->routes[$uri], 'params' => []];
        }
        
        // Try pattern matching for routes with parameters
        foreach ($this->routes as $route => $controller) {
            $pattern = preg_replace('/\{[^}]+\}/', '([^/]+)', $route);
            $pattern = str_replace('/', '\/', $pattern);
            
            if (preg_match('/^' . $pattern . '$/', $uri, $matches)) {
                array_shift($matches); // Remove full match
                
                // Extract parameter names
                preg_match_all('/\{([^}]+)\}/', $route, $paramNames);
                $params = [];
                
                if (!empty($paramNames[1])) {
                    foreach ($paramNames[1] as $index => $name) {
                        if (isset($matches[$index])) {
                            $params[$name] = $matches[$index];
                        }
                    }
                }
                
                return ['controller' => $controller, 'params' => $params];
            }
        }
        
        return false;
    }
    
    private function callController($controllerAction, $params, $db, $session, $method) {
        list($controllerName, $action) = explode('@', $controllerAction);
        
        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';
        
        if (!file_exists($controllerFile)) {
            $this->show404();
            return;
        }
        
        require_once $controllerFile;
        
        if (!class_exists($controllerName)) {
            $this->show404();
            return;
        }
        
        $controller = new $controllerName($db, $session);
        
        if (!method_exists($controller, $action)) {
            $this->show404();
            return;
        }
        
        // Set request method and parameters
        $controller->setRequestMethod($method);
        $controller->setParams($params);
        
        $controller->$action();
    }
    
    private function show404() {
        http_response_code(404);
        include __DIR__ . '/../views/errors/404.php';
        exit;
    }
}
?>