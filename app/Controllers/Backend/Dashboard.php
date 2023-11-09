<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Controllers\AdminController;

class Dashboard extends AdminController
{

    public function __construct(){

        parent::__construct();
        $this->db = db_connect();
    }


    public function index()
    {

        $data = array();

        $this-> render_view("Backend/pages/dashboard",$data);
    }
}


?>