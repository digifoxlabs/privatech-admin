<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class FrontendController extends BaseController
{

    public function __construct() 
	{
		$this->db = db_connect(); // Loading database
	
	}


    public function render_view($page = null, $data = array())
    {
        $defaultData = array( 
            'pageTitle' => 'PRIVATECH',
        );


         echo view('Frontend/template/header',$data)
                . view('Frontend/template/navbar',$data)              
                . view($page,$data)
                . view('Frontend/template/footer',$defaultData);
    }




}
