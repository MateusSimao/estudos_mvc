<?php
namespace App\CRUD;

use App\Service;

class Select
{
    private $table;
    private $fields = '*';
    private $limit;
    private $order;
    private $filters;
    private $innerTables;
    private $con;
    
    public function __construct()
    {
        $this->con = Service::con();
        return $this->con;
    }

    /**
     * Metodo para setar a tabela que irá trabalhar no select
     * @param $table
     * @return $this
     */
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * Metodo para setar as colunas da tabela
     * @param array $fields
     * @return $this
     */
    public function setFields(array $fields)
    {
        $this->fields = implode(', ', $fields);
        return $this;
    }

    /**
     * Metodo para setar o limite de registros a ser puxado, na consulta da query
     * @param string $limit
     * @return $this
     */
    public function setLimit($limit = '')
    {
        $this->limit = 'LIMIT ' . $limit;
        return $this;
    }

    /**
     * Metodo para setar a ordem dos registros a ser puxado, na consulta da query
     * @param string $order
     * @return $this
     */
    public function setOrder($order = '')
    {
        $this->order = 'ORDER BY ' . $order;
        return $this;
    }

    /**
     * Metodo para inserir uma condição na query a ser executada
     * @param $condition
     * @param array $arrayValue
     * @return $this
     */
    public function setCondition($condition, array $arrayValue)
    {
        $this->filters['condition'] = $condition;
        $this->filters['values'] = $arrayValue;

        return $this;
    }

    public function setInner(array $arrayInner)
    {
        $this->innerTables = $arrayInner;
        return $this;
    }

    /**
     * Metodo que irá executar a query de select
     * @param bool $all
     * @return array|mixed
     */
    public function runSelect($all = false)
    {
        try {
            $filter = '';
            if ($this->filters['condition']) {
                $filter = $this->filters['condition'];
            }

            $innerTable = '';
            if ($this->innerTables) {
                $innerTable = implode(' ', $this->innerTables);
            }
            $sqlSelect = 'SELECT ' . $this->fields . ' FROM ' . $this->table
                . ' ' . $innerTable
                . ' ' . $filter
                . ' ' . $this->order
                . ' ' . $this->limit;
            $query = $this->con->prepare($sqlSelect);
            
            if ($this->filters['condition'] && $this->filters['values']) {
                foreach ($this->filters['values'] as $fieldValue => $value) {
                    if (strstr($sqlSelect, $fieldValue)) {
                        $query->bindValue($fieldValue, $value);
                    }
                }
            }

            $query->execute();

            if ($all === true) {
                return $query->fetchAll();
            } else {
                return $query->fetch();
            }
        } catch(\PDOException $errorPDO) {
            return $errorPDO->getMessage();
        }
    }
}