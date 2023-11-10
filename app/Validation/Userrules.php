<?php

namespace App\Validation;
use App\Models\UserModel;
use App\Models\OTPModel;

class Userrules
{
    public function validateUserwithMobile(string $str, string $fields, array $data)
    {
        $model = new UserModel();
        $user = $model->where('mobile', $data['user_id'])
            ->first();

        if (!$user)
            return false;

        return password_verify($data['password'], $user['password']);
    }  
    
    public function validateUserwithEmail(string $str, string $fields, array $data)
    {
        $model = new UserModel();
        $user = $model->where('email', $data['user_id'])
            ->first();

        if (!$user)
            return false;

        return password_verify($data['password'], $user['password']);
    }


    public function validateEmailwithOTP(string $str, string $fields, array $data){

        $model = new OTPModel();
        $user = $model->where('email', $data['user_id'])
                        ->where('otp',$data['otp'])
                        ->where('isexpired', 1)
                        ->where('DATE_ADD(created_at, INTERVAL 2 MINUTE) >=', now())
                        ->first();
        if (!$user)
            return false;

        return true;

    }


    public function validateMobilewithOTP(string $str, string $fields, array $data){

        $model = new OTPModel();
        $user = $model->where('mobile', $data['user_id'])
                        ->where('otp',$data['otp'])
                        ->where('isexpired', 1)
                        ->where('DATE_ADD(created_at, INTERVAL 2 MINUTE) >=', now())
                        ->first();
        if (!$user)
            return false;

        return true;

    }


}
