<?php

namespace App\Controllers;
use App\Models\KorisnikModel;

    #Ivan Jevtic 0550/2018
    #Filip Kojic 0285/2018
    #Filip Zaric 0345/2018

class Pacijent extends BaseController
{
    protected function prikaz($page, $data) {
        $data['controller']='Pacijent';
        $data['korisnik']=$this->session->get('korisnik');
        echo view("sablon/header_pacijent.php");
		echo view("sablon/sidebar.php");
        echo view ("stranice/$page", $data);
        echo view("sablon/footer.php");
    }

    public function index() {
        echo view('sablon/header_pacijent.php');
         echo view('sablon/sidebar.php');
        echo view ("sablon/center.php");
        echo view('sablon/footer.php');
    }


     #Filip Kojic 0285/2018
    public function oceni($poruka=null){
        $this->prikaz('ocenjivanjeLekara.php', ['poruka'=>$poruka]);
    }

     #Filip Kojic 0285/2018
    public function ocenaSubmit(){
 
    }
}