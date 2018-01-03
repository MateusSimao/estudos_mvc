<?php

namespace App\Routes;

class RouteGet
{
    /**
     * Metodo que irá iniciar todas as rotas via GET da aplicação
     * @return array $routes
     */
    public static function initRoutesGet()
    {
        $routes['Index'] = [
            'Application' => '/',
            'Controller' => 'Index',
            'Action' => 'listar',
            'Type' => 'GET',
            'Description' => 'Tela de listagem de produtos'
        ];

        $routes['Detalhe produto'] = [
            'Application' => '/Produtos/Detalhe',
            'Controller' => 'Index',
            'Action' => 'detalhe',
            'Type' => 'GET',
            'Description' => 'Tela de detalhes de um produto'
        ];

        return $routes;
    }
}