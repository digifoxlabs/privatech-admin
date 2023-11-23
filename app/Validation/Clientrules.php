<?php

namespace App\Validation;
use App\Models\ClientModel;
use App\Models\OTPModel;

class Clientrules
{

    public function validateClientwithMobile(string $str, string $fields, array $data)
    {
        $model = new ClientModel();
        $user = $model->where('mobile', $data['user_id'])
            ->first();

        if (!$user)
            return false;

        return password_verify($data['password'], $user['password']);
    }  
    
    public function validateClientwithEmail(string $str, string $fields, array $data)
    {
        $model = new ClientModel();
        $user = $model->where('email', $data['user_id'])
            ->first();

        if (!$user)
            return false;

        return password_verify($data['password'], $user['password']);
    }


}

?>