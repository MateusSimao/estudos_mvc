<?php
namespace App\CRUD;

use App\Service;

class Delete
{
    private $table;
    private $values;
    private $filters;
    private $con;
    
    public function __construct()
    {
        $this->con = Service::con();
        return $this->con;
    }

    /**
     * Metodo para setar a tabela que irá trabalhar no delete
     * @param $table
     * @return $this
     */
    public function setTable($table)
    {
        $this->table = $table;
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

    /**
     * Metodo que irá executar a query de delete
     * @return array|mixed
     */
    public function runDelete()
    {
        try {
            $sqlDelete =  'DELETE FROM ' . $this->table
                . ' ' . $this->filters['condition'];
            $query = $this->con->prepare($sqlDelete);
            
            if ($this->filters['condition'] && $this->filters['values']) {
                foreach ($this->filters['values'] as $fieldValue => $value) {
                    if (strstr($sqlDelete, $fieldValue)) {
                        $query->bindValue($fieldValue, $value);
                    }
                }
            }
            
            if ($query->execute()) {
                $result = [
                    'success' => true
                ];
            } else {
                $result = [
                    'success' => false
                ];
            }
            
            return $result;
        } catch(\PDOException $errorPDO) {
            return $errorPDO->getMessage();
        }
    }
}