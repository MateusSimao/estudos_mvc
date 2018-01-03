<?php

namespace App;

use App\Config\Connect;

class Service
{
    /**
     * Metodo que inicia o serviço de conexão com o banco de dados
     * @return PDO|string
     */
    public static function con()
    {
        return (new Connect())->getInstance();
    }

    /**
     * Metodo que inicia o serviço de renderização do template do sistema
     */
    public static function render($view, $param = [], $headerFooter = true) 
    {
        ob_start();
        
        extract($param);
        session_start();
        
        if ($headerFooter == true) {
            require PATH_VIEW . 'includes/header.phtml';
        }
        require PATH_VIEW . $view . '.phtml';
        if ($headerFooter == true) {
            require PATH_VIEW . 'includes/footer.phtml';
        }

        ob_end_flush();
    }
}