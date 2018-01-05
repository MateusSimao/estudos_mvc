<?php

namespace App\Controller;

use \App\Service;

class IndexController
{
    /**
     * Metodo para exibir a tela de listagem de produtos
     */
    public function indexAction()
    {

        $arrayVars = [
            'titlePage' => 'Listagem'
        ];

        Service::render('listagem', $arrayVars);
    }
}