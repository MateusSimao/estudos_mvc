<?php

namespace App\Config;

use App\Config\Env;

class Connect
{
    private $instance;

    /**
     * Metodo que irá gerar uma instancia no banco de dados
     * @return $this
     */
    public function getInstance()
    {
        try {
            $config = [
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ];

            $this->instance = new \PDO (getenv('DB_TYPE') . ':host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME') . ';port=' . getenv('DB_PORT')
                , getenv('DB_USER')
                , getenv('DB_PASS')
                , $config);

            $this->instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->instance->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

        } catch(\PDOException $e) {
            return $e->getMessage();
        }

        return $this->instance;
    }
}