<?php

    #Ivan Jevtic 0550/2018
    #Filip Kojic 0285/2018
    #Filip Zaric 0345/2018

namespace App\Controllers;
use App\Models\KorisnikModel;

class Menadzer extends BaseController
{
    protected function prikaz($page, $data) {
        $data['controller']='Menadzer';
        $data['korisnik']=$this->session->get('korisnik');
        echo view("sablon/header_menadzer.php");
		echo view("sablon/sidebar.php");
        echo view ("stranice/$page", $data);
        echo view("sablon/footer.php");
    }



    public function index() {
        echo view('sablon/header_menadzer.php');
         echo view('sablon/sidebar.php');
        echo view ("sablon/center.php");
        echo view('sablon/footer.php');
    }


}