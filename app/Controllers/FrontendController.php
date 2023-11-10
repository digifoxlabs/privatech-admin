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


    public function sendEmailOtp($address, $totp){

        $email = \Config\Services::email(); // loading for use

        $email->setTo($address);

        $email->setSubject("Login OTP - Privatech");

        // Using a custom template
        $data =  array("otp"=> $totp);
        $template = view("email_otp_template", $data);
        
        $email->setMessage($template);

        // Send email
        if ($email->send()) {
            echo 'Email successfully sent, please check.';
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }


    }


    public function sendOTP($number, $message)
    {
        // Account details
        $apiKey = urlencode(getenv('TL_API_KEY'));

        // Message details
        $numbers = array($number);
        $sender = urlencode(getenv('TL_SENDER'));
        $message = rawurlencode($message);
        $numbers = implode(',', $numbers);

        // Prepare data for POST request
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
        if(config('services.textlocal.test_mode')) {
            $data['test'] = true;
        }

        // Send the POST request with cURL
        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response, true);

        if ($response['status'] == 'success') {
            return true;
        } else {
            return false;
        }
    }



}
