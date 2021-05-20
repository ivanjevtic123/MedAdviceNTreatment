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

     #Filip Kojic 0285/2018
    public function ukloni($poruka=null){
        $korisnikModel = new KorisnikModel();
           $korisnici = $korisnikModel->nadjiKorisnike();
              $this->prikaz('ukloniKorisnika', ['poruka'=>$poruka,'korisnici'=>$korisnici]);
    }

     #Filip Kojic 0285/2018
      public function ukloniKorisnika($IdK){
        $korisnikModel = new KorisnikModel();
          $korisnik = $korisnikModel->where('IdK',$IdK)->first();
          if($korisnik->JeObrisan == 0){
            $korisnikModel->obrisiKorisnika($IdK);
              return $this->ukloni('Uspesno ste uklonili korisnika!');
               }
                return $this->ukloni();
        }
}