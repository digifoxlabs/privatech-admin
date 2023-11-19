<?php

namespace App\Controllers\Backend;

use App\Controllers\AdminController;

use App\Models\SettingsModel;

class SettingsController extends AdminController
{


    public function __construct(){

        parent::__construct();
        $this->db = db_connect();
    }


    public function index()
    {
        $data = array();

        $model = new SettingsModel();

        $this->postChecker();


        $settings_data = $model->findAll();

        if(!is_null($settings_data)) {
            // Map to data
            $store= array();

            foreach($settings_data as $value_settings) {
                if (!array_key_exists($value_settings['key'], $data)) {
                    $data['id'] = $value_settings['id'];
                    $data[$value_settings['key']] = $value_settings['value'];

                    array_push($store, $data);
                }
            }
            unset($settings_data);
        }

        // echo "<pre>";
        // print_r($store[0]['id']);
        // exit;

        $data = array('settings'=>$store,);

        $this-> render_view("Backend/pages/settings", $data);
    }



    private function postChecker(){

        $model = new SettingsModel();

        if ($this->request->getMethod() == 'post') {

            $updateData = array(

                'id'=> $this->request->getvar('id'),
                'value'=> $this->request->getvar('value'),

            );

            $model->save($updateData);

            $session = session();
            $session->setFlashdata('success', 'Value Updated');

        }

    }




}
