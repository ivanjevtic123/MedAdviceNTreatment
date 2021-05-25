<?php

    #Ivan Jevtic 0550/2018
    #Filip Kojic 0285/2018
    #Filip Zaric 0345/2018

namespace App\Controllers;
use App\Models\KorisnikModel;
use App\Models\TerminModel;
   
/**
 * Klasa Lekar - implementira metode kontrolera koje sluzi za funkcionalnosti lekara 
 * 
 *  @version 1.0
 */
class Lekar extends BaseController
{
     /**
     * Funkcija prikaz - sluzi za prikazivanje stranice sa nepromenljivim(header,sidebar,right,footer) i promenljivim delovima (right)
     * Promenjivi deo se menja u zavisnosti od pozicije na sajtu
     * 
     * @param string $page - stranica na koju se odlazi
     * @param string[] $data - podaci koji se prikazuju na stranici
     */
    protected function prikaz($page, $data) {
        $data['controller']='Lekar';
        $data['korisnik']=$this->session->get('korisnik');
        echo view("sablon/header_lekar.php");
		echo view("sablon/sidebar.php");
        echo view ("stranice/$page", $data);
        echo view("sablon/footer.php");
    }

    /** 
     * Metoda index - podrazumevana metoda za prikaz lekaru
     */
    public function index() {
         echo view('sablon/header_lekar.php');
         echo view('sablon/sidebar.php');
         echo view ("sablon/center.php");
         echo view('sablon/footer.php');
        // $this ->prikaz('center',[]);
    }

     /**
	 *  Funkcija koja se poziva pri odlasku na stranicu "Moji pacijenti" i koja ih prikazuje
     * 
     * @author Filip Kojic 0285/2018
     */
        public function prikaziPacijente(){
            $lekar = $this->session->get('korisnik');
             $korisnikModel = new KorisnikModel();
               $pacijenti = $korisnikModel->nadjiPacijente($lekar->IdK);
                  $this->prikaz('pacijenti.php', ['pacijenti'=>$pacijenti]);
        }
    
    /**
	 *  Funkcija koja se poziva pri kliku na dugme "Karton" na stranici "Moji pacijenti" i koja nalazi i prikazuje karton pacijenta
     * 
     * @param int $IdK - Id pacijenta u tabeli "Korisnik" ciji se karton prikazuje
     * 
     * @author Filip Kojic 0285/2018
     */
        public function prikaziKarton($IdK){
                  $korisnikModel = new KorisnikModel();
                  $terminModel = new TerminModel();
                  $pacijent = $korisnikModel->where('IdK',$IdK)->first();
                  $nalazi = $terminModel->nadjiNalaze($IdK);
                  $this->prikaz('karton.php', ['pacijent' => $pacijent,'nalazi'=>$nalazi]);
        }
    
    /**
	 *  Funkcija koja se poziva pri kliku na link "Link" i koja nalazi i prikazuje nalaz pacijenta
     * 
     *  @param int $IdT - Id termina u tabeli "Termin" iz koga se uzimaju podaci o tekstu nalaza i snimku
     * 
     *  @author Filip Kojic 0285/2018
     */
        public function prikaziNalaz($IdT){
            $terminModel = new TerminModel();
            $nalaz = $terminModel->where('IdT',$IdT)->first();
            $this->prikaz('nalaz.php', ['nalaz' => $nalaz]);
    }

}