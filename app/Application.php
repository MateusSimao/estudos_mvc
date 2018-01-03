<?php

namespace App;

class Application
{
    /**
     * Metodo para iniciar/criar as rotas do sistema
     * @return array $routes
     */
    public function initRoutes()
    {
        $routesGet = \App\Routes\RouteGet::initRoutesGet();
        $routesPost = \App\Routes\RoutePost::initRoutesPost();
        $routes = array_merge($routesGet, $routesPost);

        return $routes;
    }

    /**
     * Metodo para ler a url digitada pelo usuario e executar a rota responsavel, caso exista
     */
    public function runApplication()
    {
        $routes = $this->initRoutes();
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $routeFound = false;

        foreach ($routes as $route => $routeConfig) {
            if (strtoupper($url) == strtoupper($routeConfig['Application'])){
                $routeFound = true;

                if ($routeConfig['Type'] == 'POST' && $_SERVER['REQUEST_METHOD'] != 'POST') {
                    header('Content-Type: application/json');
                    exit(json_encode(['Invalid request!']));
                }

                $classController = '\\App\\Controller\\' . $routeConfig['Controller'] . 'Controller';
                if ($routeConfig['Action']) {
                    $actionController = $routeConfig['Action'] . 'Action';
                    $controller = new $classController();
                    $controller->$actionController();
                } else {
                    header('Content-Type: application/json');
                    exit(json_encode(['Invalid action!']));
                }
            }
        }

        if ($routeFound === false) {
            header('Content-Type: application/json');
            exit(json_encode(['Route not found!']));
        }
    }
}