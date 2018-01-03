<?php

namespace App\Routes;

class RoutePost
{
    /**
     * Metodo que irá iniciar todas as rotas via POST da aplicação
     * @return array $routes
     */
    public static function initRoutesPost()
    {
        $routes['Log In'] = [
            'Application' => '/test',
            'Controller' => '',
            'Action' => '',
            'Type' => 'POST',
            'Description' => ''
        ];

        return $routes;
    }
}