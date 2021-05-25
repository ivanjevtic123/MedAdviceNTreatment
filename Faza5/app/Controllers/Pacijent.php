<?php

    #Ivan Jevtic 0550/2018
    #Filip Kojic 0285/2018
    #Filip Zaric 0345/2018

namespace App\Controllers;
use App\Models\KorisnikModel;
use App\Models\LecioModel;

/**
 * Klasa Pacijent - implementira metode kontrolera koje sluzi za funkcionalnosti menadzera 
 * 
 *  @version 1.0
 */

class Pacijent extends BaseController
{

   /**
     * Funkcija prikaz - sluzi za prikazivanje stranice sa nepromenljivim(header,sidebar,right,footer) i promenljivim delovima (right)
     * Promenjivi deo se menja u zavisnosti od pozicije na sajtu
     * 
     * @param string $page - stranica na koju se odlazi
     * @param string[] $data - podaci koji se prikazuju na stranici
     */
    protected function prikaz($page, $data) {
        $data['controller']='Pacijent';
        $data['korisnik']=$this->session->get('korisnik');
        echo view("sablon/header_pacijent.php");
		    echo view("sablon/sidebar.php");
        echo view ("stranice/$page", $data);
        echo view("sablon/footer.php");
    }


     /** 
     * Metoda index - podrazumevana metoda za prikaz pacijentu
     */
    public function index() {
        echo view('sablon/header_pacijent.php');
         echo view('sablon/sidebar.php');
        echo view ("sablon/center.php");
        echo view('sablon/footer.php');
    }


     /**
	   * Funkcija koja se poziva pri odlasku na stranicu "Moji Lekari" i koja ih prikazuje
     * 
     * @param string $poruka - poruka koja se prikazuje na stranici
     * 
     * @author Filip Kojic 0285/2018
     */
 public function oceni($poruka=null){
    $pacijent = $this->session->get('korisnik');
    $korisnikModel = new KorisnikModel();
      $lekari = $korisnikModel->nadjiLekare($pacijent->IdK);
      if($lekari != null)
         return $this->prikaz('ocenjivanjeLekara.php', ['poruka'=>$poruka,'lekari'=>$lekari]);
         return $this->prikaz('ocenjivanjeLekara.php', ['poruka'=>'Trenutno nema lekara za prikaz!','lekari'=>$lekari]);
}


 /**
	   * Funkcija koja se poziva pri kliku na dugme "Oceni" i koja ih obradjuje ocenjivanje lekara
     * 
     * @param int $IdK - id lekara u tabeli "Korisnik" koji se ocenjuje
     * 
     * @author Filip Kojic 0285/2018
     */
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
    #Filip Zaric 0345/2018
    public function noviKarton($poruka=null,$vrsta=0){
        $korisnikTrenutni=$this->session->get('korisnik');
        if($korisnikTrenutni->KrvnaGrupa ==null && $poruka == null){
        //    $this->prikaz('noviKarton', ['poruka'=>$poruka,'vrsta'=>$vrsta]);
         $this->prikaz('nemateKarton',[]);
     
        }
        else{

            $this->prikaz('noviKarton', ['poruka'=>$poruka,'vrsta'=>$vrsta]);
        }

     
    }
    #Filip Zaric 0345/2018
    public function noviKartonSubmit(){
        if(!$this->validate(['krvnaGrupa'=>'required|in_list[A-,A+,B-,B+,0+,0-,AB+,AB-]']))  return $this->noviKarton("Krvna grupa losa");

      if(!$this->validate(['krvnaGrupa'=>'required|in_list[A-,A+,B-,B+,0+,0-,AB+,AB-]','istorijaBolesti'=>'required','hronicneBolesti'=>'required',
      'zarazneBolesti'=>'required','lekoviReakcija'=>'required','hirurskiZahvati'=>'required'
      
      ]))
          return $this->noviKarton("Morate popuniti sva polja adekvatnim vrednostima!");

       
           $krvnaGrupa=$this->request->getVar("krvnaGrupa");
           $istorijaBolesti=$this->request->getVar("istorijaBolesti");
           $hronicneBolesti=$this->request->getVar("hronicneBolesti");
           $zarazneBolesti=$this->request->getVar("zarazneBolesti");
           $lekoviReakcija=$this->request->getVar("lekoviReakcija");
           $hirurskiZahvati=$this->request->getVar("hirurskiZahvati");
           $upit_data=[  'KrvnaGrupa'=>$krvnaGrupa,'IstorijaBolesti'=>$istorijaBolesti,'HronicneBolesti'=>$hronicneBolesti,
           'ZarazneBolesti'=>$zarazneBolesti,'LekoviAlergije'=>$lekoviReakcija,'HirurskiZahvati'=>$hirurskiZahvati    ];



           $korisnikModel=new KorisnikModel();
           $korisnikTrenutni=$this->session->get('korisnik');
           $korisnikModel->update($korisnikTrenutni->IdK,$upit_data);
           $this->session->set('korisnik',$korisnikModel->find($korisnikTrenutni->IdK));

           return $this->noviKarton("Uspesno ste uneli karton!",1);
           

    }
    #Filip Zaric 0345/2018
    public function zakazi($poruka=null){
      //  $this->prikaz()l
    }
    #Filip Zaric 0345/2018
    public function zakaziTermin($IdLek){
       $this->zakazi();

    }



}