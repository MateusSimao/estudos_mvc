<?php
namespace App\CRUD;

use App\Service;

class Insert
{
    private $table;
    private $fields;
    private $fieldsValues;
    private $values;
    private $con;
    
    public function __construct()
    {
        $this->con = Service::con();
        return $this->con;
    }

    /**
     * Metodo para setar a tabela que irá trabalhar no insert
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
     * Função para setar os parametros e valores que serão
     * usados no bindValue do PDO
     * @param array $values
     * @return $this
     */
    public function setFieldsValues(array $values)
    {
        foreach ($values as $column => $value) {
            $this->fieldsValues[] = ':' . $column;
            $this->values[':' . $column] = $value;
        }
        return $this;
    }

    /**
     * Metodo que irá executar a query de insert
     * @param bool $all
     * @return array|mixed
     */
    public function runInsert()
    {
        try {
            $sqlInsert =  'INSERT ' . $this->table . ' (' . $this->fields . ')'
                . ' Value (' . implode(', ', $this->fieldsValues) . ')';
            $query = $this->con->prepare($sqlInsert);

            foreach($this->values as $column => $value) {
                $query->bindValue($column, $value);
            }
            $query->execute();

            $result = [
                'success' => true,
                'lastId' => $this->con->lastInsertId()
            ];
        } catch(\PDOException $errorPDO) {
            return $errorPDO->getMessage();
        }
    }
}