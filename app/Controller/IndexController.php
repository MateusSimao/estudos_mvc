<?php

namespace App\Controller;

use \App\Service;
use \App\CRUD\Select;

class IndexController
{
    /**
     * Metodo para exibir a tela de listagem de produtos
     */
    public function listarAction()
    {
        $select = new Select();
        $select
            ->setTable('produtos')
            ->setFields(['idProduto','nomeProduto','valorProduto','descricaoProduto','quantidadeProduto']);
        $produtos = $select->runSelect(true);

        $arrayVars = [
            'titlePage' => 'Listagem',
            'produtos' => $produtos
        ];

        Service::render('listagem', $arrayVars);
    }

    /**
     * Metodo para exibir a tela detalhes do produto
     */
    public function detalheAction()
    {
        $select = new Select();
        $select
            ->setTable('produtos')
            ->setFields(['idProduto','nomeProduto','valorProduto','descricaoProduto','quantidadeProduto'])
            ->setCondition('WHERE idProduto = :idProduto', [':idProduto'=>base64_decode($_GET['idProduto'])]);

        $produto = $select->runSelect();

        $arrayVars = [
            'titlePage' => 'Detalhe do produto',
            'produto' => $produto
        ];

        Service::render('detalhe', $arrayVars);
    }
}