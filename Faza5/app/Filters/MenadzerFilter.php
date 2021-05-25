<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class MenadzerFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
         $session=session();
         if(!$session->has('korisnik')){
            return redirect()->to(site_url('Gost'));
        }
    else {
        if($session->get('korisnik')->Uloga == "M")
        return redirect()->to(site_url('Menadzer'));
       }  
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}