<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class PacijentFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
         $session=session();
         if(!$session->has('korisnik')){
            return redirect()->to(site_url('Gost'));
        }
    else {
        if($session->get('korisnik')->Uloga == "P")
        return redirect()->to(site_url('Pacijent'));
       }  
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}