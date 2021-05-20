<?php

namespace App\Controllers;
use App\Models\KorisnikModel;
use App\Models\LecioModel;


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
        $pacijent = $this->session->get('korisnik');
         $korisnikModel = new KorisnikModel();
           $lekari = $korisnikModel->nadjiLekare($pacijent->IdK);
              $this->prikaz('ocenjivanjeLekara.php', ['poruka'=>$poruka,'lekari'=>$lekari]);
    }

     #Filip Kojic 0285/2018
    public function ocenaSubmit($IdK){
        $ocena = $this->request->getVar('Ocena');
        switch ($ocena) {
            case "Jedan":
              $ocenaVrednost = 1;break;
            case "Dva":
               $ocenaVrednost = 2; break;
            case "Tri":
             $ocenaVrednost = 3; break;
            case "Cetiri":
            $ocenaVrednost = 4; break;
            case "Pet":
            $ocenaVrednost = 5; break;
            default:$ocenaVrednost = null; break;
          }
          // $this->oceni($ocenaVrednost);

         if ($ocenaVrednost == null) return $this->oceni();

          $pacijent = $this->session->get('korisnik');
            $IdPac = $pacijent->IdK;  

            $korisnikModel = new KorisnikModel();
              $lecioModel = new LecioModel();

              if(!$lecioModel->mozeDaSeOceni($IdPac,$IdK)) return $this->oceni("Ne mozete vise ocenjivati lekara!");

                $korisnikModel->uvecajZbirIBrojOcena($IdK,$ocenaVrednost);
                  $lecioModel->dekrementriajPreostaloOcena($IdPac,$IdK);
                  return $this->oceni("Uspesno ste ocenili lekara!");
                    
    }
}