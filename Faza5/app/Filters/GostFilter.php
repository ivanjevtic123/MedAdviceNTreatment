<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class GostFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // $session=session();
        // if($session->has('korisnik')){
            //  if($session->get('korisnik')->Uloga == "P")
            //     return redirect()->to(site_url('Pacijent'));
            //  if($session->get('korisnik')->Uloga == "L")
            //     return redirect()->to(site_url('Lekar'));
            //  if($session->get('korisnik')->Uloga == "M")
            //     return redirect()->to(site_url('Menadzer'));
       // }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}