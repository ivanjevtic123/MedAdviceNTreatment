<?php

    #Ivan Jevtic 0550/2018
    #Filip Kojic 0285/2018
    #Filip Zaric 0345/2018

namespace App\Controllers;
use App\Models\KorisnikModel;
use App\Models\TerminModel;
use App\Models\UslugaModel;
use App\Models\LecioModel;
   
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
	
	#Ivan Jevtic 0550/2018
    public function addingMedResults($IdPac ,$poruka = null) {
        $korisnikModel = new KorisnikModel();
        $terminModel = new TerminModel();
        $pacijent = $korisnikModel->where('IdK',$IdPac)->first();
    
        $termini = $terminModel->getNeostvareniTermini($IdPac);
        $this->prikaz('addingMedResults.php', ['poruka'=>$poruka, 'pacijent' => $pacijent, 'termini' => $termini]);
        
    }
    
    #Ivan Jevtic 0550/2018
    public function addingMedResultsSubmit($IdPac) {
        if(!$this->validate(['dateNTime'=>'required'])){
            return $this->addingMedResults($IdPac, "Izaberite Datum i Vreme termina!");//dodaj 1. arg
        }
        if(!$this->validate(['resultText'=>'required'])){
            return $this->addingMedResults($IdPac, "Unesite Tekst nalaza!");
        }
        // if(!$this->validate(['imgMed'=>'required'])){
        //     return $this->addingMedResults($IdPac, "Unesite Putanju snimka!");
        // }
//****************************
        $file = $_FILES['imgMed'];
        $fileName = $_FILES['imgMed']['name'];
        $fileTmpName = $_FILES['imgMed']['tmp_name'];
        $fileSize = $_FILES['imgMed']['size'];
        $fileError = $_FILES['imgMed']['error'];
        $fileType = $_FILES['imgMed']['type'];
        $fileExt = explode('.',$fileName);
        $fileActualExtension = strtolower(end($fileExt));

        $allowed = array('jpg','png','jpeg','jfif');

        if(!in_array( $fileActualExtension,$allowed))
        return $this->addingMedResults("Fajl koji ste izabrali nije slika!");

        if(!($fileError===0))
        return $this->addingMedResults("Greska pri postavljanju fajla!");

        if($fileSize > 1000000)
        return $this->addingMedResults("Preveliki fajl!");

        $fileNameNew = uniqid('',true)."."."$fileActualExtension";
        $fileDestination = "web/".$fileNameNew;


        move_uploaded_file($fileTmpName,$fileDestination);
        $path = "/web/".$fileNameNew;
//****************************

        $terminModel = new TerminModel();
        $time = $this->request->getVar('dateNTime');
        $red = $terminModel->where('IdPac', $IdPac)->where('DatumIVreme', $time)->first();
    
        $tekst = $this->request->getVar('resultText');
        // $snimak = $this->request->getVar('imgMed');
        // if($snimak == '') $snimak = null;
    
        $terminModel->postaviSnimakINalaz($red,$tekst,$path);

        $lecioModel = new LecioModel();

        $lekar = $this->session->get('korisnik');
        //prvi put Lekar i Pacijent saradjuju => insert u Lecio
        if($lecioModel->postojiLecio($IdPac, $lekar->IdK) == false) {
            $lecioModel->save([
                'IdPac' => $this->request->getVar('name'),
                'IdLek' => $this->request->getVar('surname'),
            ]);
        }
        $lecioModel->inkrementirajPreostaloOcena($IdPac, $lekar->IdK);
        return $this->prikaziPacijente();
    }
	
	#Ivan Jevtic 0550/2018
    public function services($poruka = null) {
        $uslugaModel = new UslugaModel();
        $usluge = $uslugaModel->getUsluge();
        $this->prikaz('services', ['poruka'=>$poruka,'usluge'=>$usluge]);
    }

    #Ivan Jevtic 0550/2018
    public function doctorsList($IdU) {
        $korisnikModel = new KorisnikModel();
        $doctors = $korisnikModel->nadjiLekareZaUslugu($IdU);
        $this->prikaz('doctorsList', ['doctors'=>$doctors, 'IdU' => $IdU]);
    }

    #Ivan Jevtic 0550/2018
    public function doctorProfile($IdDoc, $IdU, $cena) {
        $korisnikModel = new KorisnikModel();
        $doctor = $korisnikModel->where('IdK',$IdDoc)->first();
        $this->prikaz('doctorProfile', ['IdDoc' => $IdDoc ,'doctor' => $doctor, 'IdU' => $IdU, 'cena' => $cena]);
    }

    #Ivan Jevtic 0550/2018
    public function doctorsListSorted($IdU) {
      $korisnikModel = new KorisnikModel();

      $sort = $this->request->getVar('sort');
      switch ($sort) {
          case "descending":
              $sortiranje = 1;break;
          case "ascending":
              $sortiranje = 0; break;
          default:$sortiranje = null; break;
      }

      if($sortiranje == 1) {
        $doctors = $korisnikModel->nadjiLekareZaUsluguSortirano($IdU, 1);
        $this->prikaz('doctorsList', ['doctors'=>$doctors, 'IdU' => $IdU]);
      } else if($sortiranje == 0) {
        $doctors = $korisnikModel->nadjiLekareZaUsluguSortirano($IdU, 0);
        $this->prikaz('doctorsList', ['doctors'=>$doctors, 'IdU' => $IdU]);
      }
    }
	
	
	

}