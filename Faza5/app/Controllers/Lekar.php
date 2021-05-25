<?php

namespace App\Controllers;
use App\Models\KorisnikModel;
use App\Models\TerminModel;

    #Ivan Jevtic 0550/2018
    #Filip Kojic 0285/2018
    #Filip Zaric 0345/2018
   
class Lekar extends BaseController
{
    protected function prikaz($page, $data) {
        $data['controller']='Lekar';
        $data['korisnik']=$this->session->get('korisnik');
        echo view("sablon/header_lekar.php");
		echo view("sablon/sidebar.php");
        echo view ("stranice/$page", $data);
        echo view("sablon/footer.php");
    }



    public function index() {
         echo view('sablon/header_lekar.php');
         echo view('sablon/sidebar.php');
         echo view ("sablon/center.php");
         echo view('sablon/footer.php');
        // $this ->prikaz('center',[]);
    }

        #Filip Kojic 0285/2018
        public function prikaziPacijente(){
            $lekar = $this->session->get('korisnik');
             $korisnikModel = new KorisnikModel();
               $pacijenti = $korisnikModel->nadjiPacijente($lekar->IdK);
                  $this->prikaz('pacijenti.php', ['pacijenti'=>$pacijenti]);
        }
    
        #Filip Kojic 0285/2018
        public function prikaziKarton($IdK){
                  $korisnikModel = new KorisnikModel();
                  $terminModel = new TerminModel();
                  $pacijent = $korisnikModel->where('IdK',$IdK)->first();
                  $nalazi = $terminModel->nadjiNalaze($IdK);
                  $this->prikaz('karton.php', ['pacijent' => $pacijent,'nalazi'=>$nalazi]);
        }
    
        #Filip Kojic 0285/2018
        public function prikaziNalaz($IdT){
            $terminModel = new TerminModel();
            $nalaz = $terminModel->where('IdT',$IdT)->first();
            $this->prikaz('nalaz.php', ['nalaz' => $nalaz]);
    }

}