<?php

namespace App\Models;

use \App\CRUD\Select;
use \App\CRUD\Insert;
use \App\CRUD\Delete;

class Produto
{
    private $idProduto;
    private $nomeProduto;
    private $descricaoProduto;
    private $valorProduto;
    private $quantidadeProduto;

    public function setIdProduto($idProduto)
    {
        $this->idProduto = $idProduto;
        return $this;
    }

    public function setNomeProduto($nomeProduto)
    {
        $this->nomeProduto = $nomeProduto;
        return $this;
    }

    public function setDescricaoProduto($descricaoProduto)
    {
        $this->descricaoProduto = $descricaoProduto;
        return $this;
    }

    public function setValorProduto($valorProduto)
    {
        $this->valorProduto = $valorProduto;
        return $this;
    }

    public function setQuantidadeProduto($quantidadeProduto)
    {
        $this->quantidadeProduto = $quantidadeProduto;
        return $this;
    }

    /**
     * Metodo para montar o filtro da query
     * @return array
     */
    public function mountConditionSelect()
    {
        $arrayValues = [
            ':idProduto'         => '%' . $this->idProduto . '%',
            ':nomeProduto'       => '%' . $this->nomeProduto . '%',
            ':descricaoProduto'  => '%' . $this->descricaoProduto . '%',
            ':valorProduto'      => '%' . $this->valorProduto . '%',
            ':quantidadeProduto' => '%' . $this->quantidadeProduto . '%'
        ];
        $condition = 'WHERE 1=1 ';
        if (!empty($this->idProduto)) $condition .= ' AND idProduto LIKE :idProduto'; 
        if (!empty($this->nomeProduto)) $condition .= ' AND nomeProduto LIKE :nomeProduto';
        if (!empty($this->descricaoProduto)) $condition .= ' AND descricaoProduto LIKE :descricaoProduto';
        if (!empty($this->valorProduto)) $condition .= ' AND valorProduto LIKE :valorProduto';
        if (!empty($this->quantidadeProduto)) $condition .= ' AND quantidadeProduto LIKE :quantidadeProduto';

        return ['condition' => $condition, 'values' => $arrayValues];
    }

    public function getProduto()
    {
        $select = new Select();
        $select
            ->setTable('produtos')
            ->setFields(['idProduto','nomeProduto','valorProduto','descricaoProduto','quantidadeProduto'])
            ->setCondition('WHERE idProduto = :idProduto', [':idProduto'=>$this->idProduto]);

        $produto = $select->runSelect();

        return $produto;
    }

    public function getProdutos()
    {
        /**
         * Criando os filtros para a query
         */
        $arrayCondition = $this->mountConditionSelect();
        $arrayValues    = $arrayCondition['values'];
        $condition      = $arrayCondition['condition'];

        $select = new Select();
        $select
            ->setTable('produtos')
            ->setFields(['idProduto','nomeProduto','valorProduto','descricaoProduto','quantidadeProduto'])
            ->setCondition($condition, $arrayValues);

        $produtos = $select->runSelect(true);

        return $produtos;
    }

    public function deleteProduto()
    {
        $delete = new Delete();
        $delete
            ->setTable('produtos')
            ->setCondition('WHERE idProduto = :idProduto', [':idProduto' => $this->idProduto]);

        $result = $delete->runDelete();

        return $result;
    }

    public function insertProduto()
    {
        $arrayValues = [
            'nomeProduto' => $this->nomeProduto,
            'descricaoProduto' => $this->descricaoProduto,
            'valorProduto' => $this->valorProduto,
            'quantidadeProduto' => $this->quantidadeProduto
        ];

        $insert = new Insert();
        $insert
            ->setTable('produtos')
            ->setFields(['nomeProduto','descricaoProduto','valorProduto','quantidadeProduto'])
            ->setFieldsValues($arrayValues);

        $result = $insert->runInsert();

        return $result;
    }
}