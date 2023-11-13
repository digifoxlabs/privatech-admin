<?php

namespace App\Controllers\Backend;

use App\Controllers\AdminController;

class ClientController extends AdminController
{
    public function index()
    {
        //
    }

    public function viewAllClients(){


        $data = array();
        $this-> render_view("Backend/pages/clients/all_clients",$data);

    }


    //AJAX Call all clients
    public function ajaxCallAllClients(){


        
    }


}
