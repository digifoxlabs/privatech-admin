<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class NoAuthclient implements FilterInterface
{
 
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('isLoggedInClient')) {
            return redirect()->to(base_url('/dashboard'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}