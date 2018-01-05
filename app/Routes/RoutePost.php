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
        $routes['Detalhe produto Json'] = [
            'Application' => '/Produtos/Detalhe/Json',
            'Controller' => 'Produto',
            'Action' => 'detalheJson',
            'Type' => 'Post'
        ];

        $routes['Listagem produtos Json'] = [
            'Application' => '/Produtos/Lista/Json',
            'Controller' => 'Produto',
            'Action' => 'listagemJson',
            'Type' => 'Post'
        ];

        $routes['Deletar produto'] = [
            'Application' => '/Produtos/Remove',
            'Controller' => 'Produto',
            'Action' => 'removerProduto',
            'Type' => 'Post'
        ];

        $routes['Novo produto'] = [
            'Application' => '/Produtos/Novo',
            'Controller' => 'Produto',
            'Action' => 'adicionarProduto',
            'Type' => 'Post'
        ];

        return $routes;
    }
}