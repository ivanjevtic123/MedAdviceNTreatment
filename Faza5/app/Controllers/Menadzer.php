<?php

    #Ivan Jevtic 0550/2018
    #Filip Kojic 0285/2018
    #Filip Zaric 0345/2018

namespace App\Controllers;
use App\Models\KorisnikModel;
use App\Models\UslugaModel;

/**
 * Klasa Menadzer - implementira metode kontrolera koje sluzi za funkcionalnosti menadzera 
 * 
 *  @version 1.0
 */
class Menadzer extends BaseController
{

      /**
     * Funkcija prikaz - sluzi za prikazivanje stranice sa nepromenljivim(header,sidebar,right,footer) i promenljivim delovima (right)
     * Promenjivi deo se menja u zavisnosti od pozicije na sajtu
     * 
     * @param string $page - stranica na koju se odlazi
     * @param string[] $data - podaci koji se prikazuju na stranici
     */
    protected function prikaz($page, $data) {
        $data['controller']='Menadzer';
        $data['korisnik']=$this->session->get('korisnik');
        echo view("sablon/header_menadzer.php");
		echo view("sablon/sidebar.php");
        echo view ("stranice/$page", $data);
        echo view("sablon/footer.php");
    }

     /** 
     * Metoda index - podrazumevana metoda za prikaz menadzeru
     */
    public function index() {
        echo view('sablon/header_menadzer.php');
        echo view('sablon/sidebar.php');
        echo view ("sablon/center.php");
        echo view('sablon/footer.php');
    }




   /**
	   * Funkcija koja se poziva pritiskom dugmeta "Odbij" na stranici "Zahtevi"
     * 
     * @param int $IdK - identifikator korisnika čiji se zahtev za registraciju odbacuje
     * 
     * @author Filip Zaric 0345/2018
     */  

public function odbijKorisnika($IdK){
    $korisnikModel=new KorisnikModel();
    // $korisnik = $korisnikModel->where('IdK',$IdK)->first();
     $korisnikModel->obrisiKorisnika($IdK);
     return $this->zahtev("Uspesno ste odbili zahtev!");
}
 /**
	   * Funkcija koja se poziva pri odlasku na stranicu "Zahtevi" i koja ih prikazuje
     * 
     * @param string $poruka - poruka koja se prikazuje na stranici
     * 
     * @author Filip Zaric 0345/2018
     */
public function zahtev($poruka=null){
    $korisnikModel = new KorisnikModel();
    $korisnici = $korisnikModel->korisniciCekaju();
    if($korisnici!=null)
       return $this->prikaz('odobravanjeZahteva', ['poruka'=>$poruka,'korisnici'=>$korisnici]);
       return $this->prikaz('odobravanjeZahteva', ['poruka'=>"Trenutno nema korisnika za prikaz!",'korisnici'=>$korisnici]);  
}
   /**
	   * Funkcija koja se poziva pritiskom dugmeta "Odobri" na stranici "Zahtevi"
     * 
     * @param int $IdK - identifikator korisnika čiji se zahtev za registraciju odobrava
     * 
     * @author Filip Zaric 0345/2018
     */  

public function odobriKorisnika($IdK){
    $korisnikModel=new KorisnikModel();
   // $korisnik = $korisnikModel->where('IdK',$IdK)->first();
    $korisnikModel->odobriKorisnika($IdK);
    return $this->zahtev("Uspesno ste odobrili zahtev!");
}



     /**
	   * Funkcija koja se poziva pri odlasku na stranicu "Ukloni Korisnika" i koja ih prikazuje
     * 
     * @param string $poruka - poruka koja se prikazuje na stranici
     * 
     * @author Filip Kojic 0285/2018
     */
   public function ukloni($poruka=null){
    $korisnikModel = new KorisnikModel();
       $korisnici = $korisnikModel->nadjiKorisnike();
       if($korisnici != null)
          return $this->prikaz('ukloniKorisnika', ['poruka'=>$poruka,'korisnici'=>$korisnici]);
            return $this->prikaz('ukloniKorisnika', ['poruka'=>'Trenutno nema korisnika za prikaz!','korisnici'=>$korisnici]);
}

  /**
	   * Funkcija koja se poziva pri kliku na dugme "Ukloni" i koja obradjuje zahtev za uklanjanje
     * 
     * @param int $IdK  - id korisnika u tabeli "Korisnik" koji se uklanja iz baze
     * 
     * @author Filip Kojic 0285/2018
     */
  public function ukloniKorisnika($IdK){
    $korisnikModel = new KorisnikModel();
      $korisnik = $korisnikModel->where('IdK',$IdK)->first();
      if($korisnik->JeObrisan == 0){
        $korisnikModel->obrisiKorisnika($IdK);
        return $this->ukloni('Uspesno ste uklonili korisnika!');
           }
            return $this->ukloni();
    }



	/**
    * Funkcija koja se poziva klikom na "Usluge" i koja nalazi i prikazuje dostupne usluge
    * @param string $poruka - poruka koja se prikazuje na stranici
    * @author Ivan Jevtic 0550/2018
    */
    public function services($poruka = null) {
        $uslugaModel = new UslugaModel();
        $usluge = $uslugaModel->getUsluge();
        $this->prikaz('services', ['poruka'=>$poruka,'usluge'=>$usluge]);
    }

    /**
    * Funkcija koja se poziva klikom na neku uslugu sa stranice "Usluge"
    * Ispisuje i nalazi lekare koji pruzaju datu uslugu
    * @param int IdU$ - Id ulusge koju je korisnik izabrao
    * @author Ivan Jevtic 0550/2018
    */
    public function doctorsList($IdU) {
        $korisnikModel = new KorisnikModel();
        $doctors = $korisnikModel->nadjiLekareZaUslugu($IdU);
        $this->prikaz('doctorsList', ['doctors'=>$doctors, 'IdU' => $IdU]);
    }

    /**
    * Funkcija koja se poziva klikom na sliku odredjenog lekara koji pruza odredjenu uslugu(stranica za prikaz lekara)
    * Ispisuje i nalazi lekare koji pruzaju datu uslugu
    * @param int $IdDoc - Id lekara kiji je izabran
    * @param int $IdU - Id ulusge koju je lekar pruza
    * @param int $cena - cena usluge
    * @author Ivan Jevtic 0550/2018
    */
    public function doctorProfile($IdDoc, $IdU, $cena) {
        $korisnikModel = new KorisnikModel();
        $doctor = $korisnikModel->where('IdK',$IdDoc)->first();
        $this->prikaz('doctorProfile', ['IdDoc' => $IdDoc ,'doctor' => $doctor, 'IdU' => $IdU, 'cena' => $cena]);
    }

    /**
    * Funkcija koja se poziva izborom nacina sortiranja i klikom na "Sortiraj" sa stranice "Usluge",
    * Ispisuje i nalazi lekare koji pruzaju datu uslugu sortirano po ceni po kojoj pruzaju datu uslugu
    * @param int IdU$ - Id ulusge koju je korisnik izabrao
    * @author Ivan Jevtic 0550/2018
    */
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