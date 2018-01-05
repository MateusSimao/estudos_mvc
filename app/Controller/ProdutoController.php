<?php

namespace App\Controller;

use \App\Service;

class ProdutoController
{
    /**
     * Metodo para exibir a tela detalhes do produto
     */
    public function detalheAction()
    {
        $produto = new \App\Models\Produto();
        $produto->setIdProduto($_GET['idProduto']);

        $arrayVars = [
            'titlePage' => 'Detalhe do produto',
            'produto' => $produto->getProduto()
        ];

        Service::render('detalhe', $arrayVars);
    }

    public function detalheJsonAction()
    {
        $produto = new \App\Models\Produto();
        $produto->setIdProduto($_POST['idProduto']);

        echo json_encode($produto->getProduto());
    }

    public function listagemJsonAction()
    {
        $produtos = new \App\Models\Produto();
        
        $produtos
            ->setIdProduto($_POST['idProduto'])
            ->setNomeProduto($_POST['nomeProduto'])
            ->setDescricaoProduto($_POST['descricaoProduto'])
            ->setValorProduto($_POST['valorProduto'])
            ->setQuantidadeProduto($_POST['quantidadeProduto']);
        
        echo json_encode($produtos->getProdutos());
    }

    public function removerProdutoAction()
    {
        $produto = new \App\Models\Produto();

        $produto->setIdProduto($_POST['idProduto']);
        
        echo json_encode($produto->deleteProduto());
    }
}