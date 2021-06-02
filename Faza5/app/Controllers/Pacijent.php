<?php

    #Ivan Jevtic 0550/2018
    #Filip Kojic 0285/2018
    #Filip Zaric 0345/2018

namespace App\Controllers;
use App\Models\KorisnikModel;
use App\Models\LecioModel;
use App\Models\UslugaModel;
use App\Models\TerminModel;
use App\Models\PruzaModel;
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
 /**
	 *  Funkcija koja se poziva iz metode noviKarton  ako pri kliku na link "Prikaz kartona " u navabar-u  karton pacijenta
     * je  već kreiran.
     * 
     * @author Filip Kojic 0285/2018
     * @coauthor Filip Zaric 0345/2018
     */
    public function prikaziPacijenta(){
        $pacijent = $this->session->get('korisnik');
        $pacijenti=[];
        array_push($pacijenti,$pacijent);
              $this->prikaz('pacijenti2.php', ['pacijenti'=>$pacijenti]);
    }
/**
 *  Funkcija koja se poziva pri kliku na dugme "Karton" na stranici "Pregled kartona" i koja nalazi i prikazuje karton pacijenta
 * 
 * @param int $IdK - parametar je redudantan ali je ostavljen kako prikaz ne bi morao da vodi računa da li poziva metodu
 * kontrolera pacijent ili kontrolera lekar 
 * 
 * @author Filip Kojic 0285/2018
 * @coauthor Filip Zaric 0345/2018
 */
    public function prikaziKarton($idk){
        $terminModel=new TerminModel();
        $pacijent = $this->session->get('korisnik');
              $nalazi = $terminModel->nadjiNalaze($pacijent->IdK);
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






     /**
 *  Funkcija koja se poziva pri kliku na link "Pregled kartona".Funkcija zove razlicite prikaze u zavisnosti od toga
 * da li karton pacijenta već postoji u bazi.
 * 
 *  @param string $poruka-poruka koja se prosledjuje prikazu koji metoda pozove i koju prikaz(view) ispisuje  
 *  @param int $vrsta-vrsta poruke koja se prosledjuje prikazu,takodje se promenljiva prosledjuje pogledu i na
 * osnovu nje prikaz zna kojom bojom prikazuje poruku
 *  @author Filip Zaric 0345/2018
 */
    public function noviKarton($poruka=null,$vrsta=0){
        $korisnikTrenutni=$this->session->get('korisnik');
        if($korisnikTrenutni->KrvnaGrupa ==null ){
            if($vrsta==5)   $this->prikaz('noviKarton', ['poruka'=>$poruka,'vrsta'=>$vrsta]);
          else
         $this->prikaz('nemateKarton',[]);
     
        }
        else{
            if($vrsta==1){ 
              return  $this->prikaz('noviKarton', ['poruka'=>$poruka,'vrsta'=>$vrsta]);
            }else{
                return $this->prikaziPacijenta();
            }
           
        }

     
    }
     /*   **
 *  Funkcija koja se poziva pri predaji forme na stranici "Novi karton" i koja proverava ispravnost podataka
 * predatih od strane korisnika putem forme.Funkcija nema povratnu vrednost vec na kraju izvrsavanja poziva metodu
 * noviKarton.
 * 
 *  
 *  
 *
 *  @author Filip Zaric 0345/2018
 */
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
        /*   **
 *  Funkcija koja se poziva pritiskom na dugme "Zakazi" pri pregledu profila doktora.Funkcija ne vraća povratnu
 * vrednost već na kraju izvrsavanja poziva metodu koja prikazuje stranicu "zakazivanjeTermina".
 * 
 * @param int $lekar-identifikator lekara kod koga se zakazuje termin
 * @param int $usluga-identifikator usluge za koju se zakazuje termin
 *  
 *  
 *
 *  @author Filip Zaric 0345/2018
 */
    public function zakazi($lekar,$usluga){
        
        $terminModel=new TerminModel();
       $pacijent=$this->session->get('korisnik');
       $pruzaModel=new PruzaModel();
       $pr=$pruzaModel->where('IdLek',$lekar)->where('IdU',$usluga)->findAll()[0];
       //return $vremena=$terminModel-> dohvatiZauzeteTermineLekara(($pr->IdPru));
     $vremena1=$terminModel-> dohvatiZauzeteTermineLekara(($pr->IdPru));
     $vremena2=$terminModel-> dohvatiZauzeteTerminePacijenta(($pacijent->IdK));
     //$this->session->set('vremena',$vremena);
    
    $this->session->set("IdPruzaZakazi",($pr->IdPru));
    $vremena=array_merge($vremena1,$vremena2);
    $this->session->set("vremena",$vremena);
       $this->zakazi_prikaz($vremena);

    }
            /*   **
 *  Funkcija koja poziv prikaz stranice "zakazivanjeTermina".
 *  @param string[] $podaci-podaci koji se prosledjuju stranici
    @param string $poruka-poruka koja se prosledjuje prikazu koji metoda pozove i koju prikaz(view) ispisuje  
 *  @param int $vrsta-vrsta poruke koja se prosledjuje prikazu,takodje se promenljiva prosledjuje pogledu i na
 * osnovu nje prikaz zna kojom bojom prikazuje poruku
 *  
 *  
 *
 *  @author Filip Zaric 0345/2018
 */

    public function zakazi_prikaz($podaci=null,$poruka=null,$vrsta=null){
        
        //$this->session->set('vremena',['2021-07-07 13:00:00']);
       $this->prikaz("zakazivanjeTermina",['poruka'=>$poruka,'vremena'=>$podaci,'vrsta'=>$vrsta]);
    }
       /*   **
 *  Funkcija koja se poziva sa stranice "zakazivanjeTermina" prilikom predaje forme.Funkcija vrši
 * ažuriranje baze i na kraju izvršavanja poziva metodu koja prikazuje stranicu "zakazivanjeTermina"/
 *  
 * @author Filip Zaric 0345/2018
 */


    public function zakaziTerminSubmit(){
     $datum=$this->request->getVar("datumSubmit");
     $sat=$this->request->getVar("timeOfExam");
     $stringSat="".$sat.":00:00";
     $stringDatum="".$datum;
     $timestamp=$stringDatum." ".$stringSat;
     $terminModel=new TerminModel();
     $pacijent=$this->session->get('korisnik');
     $terminModel->dodajTermin($pacijent->IdK,$this->session->get("IdPruzaZakazi"),$timestamp);
     $vremena=$this->session->get("vremena");
     $vremena2=["DatumIVreme"=>$timestamp];
     array_push($vremena,$vremena2);
     $this->session->set("vremena",$vremena);
     return $this->zakazi_prikaz($this->session->get("vremena"),"Uspesno ste zakazali termin",1);
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
        /*   **
 *  Funkcija koja se poziva asinhrono preko ajaxa i vraca timestampove zauzetih termina
 *  @author Filip Zaric 0345/2018
 */
 public function dohvatiVreme(){
     $vremena=$this->session->get("vremena");
    echo json_encode($vremena);
    
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