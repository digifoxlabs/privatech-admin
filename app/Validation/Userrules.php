<?php

namespace App\Validation;
use App\Models\UserModel;

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
}
