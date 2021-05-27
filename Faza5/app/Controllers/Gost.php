<?php

    #Ivan Jevtic 0550/2018
    #Filip Kojic 0285/2018
    #Filip Zaric 0345/2018

namespace App\Controllers;
use App\Models\KorisnikModel;
use App\Models\UslugaModel;
use App\Models\PruzaModel;

/**
 * Klasa Gost - implementira metode kontrolera koje sluzi za funkcionalnosti gosta 
 * 
 *  @version 1.0
 */

class Gost extends BaseController
{

     /**
     * Funkcija prikaz - sluzi za prikazivanje stranice sa nepromenljivim(header,sidebar,right,footer) i promenljivim delovima (right)
     * Promenjivi deo se menja u zavisnosti od pozicije na sajtu
     * 
     * @param string $page - stranica na koju se odlazi
     * @param string[] $data - podaci koji se prikazuju na stranici
     */
	    protected function prikaz($page, $data) {
        $data['controller']='Gost';
        echo view("sablon/header_gost.php");
		echo view("sablon/sidebar.php");
        echo view ("stranice/$page", $data);
        echo view("sablon/footer.php");
    }


     /** 
     * Metoda index - podrazumevana metoda za prikaz gostu
     */
	 public function index() {
      echo view('sablon/header_gost.php');
	  echo view('sablon/sidebar.php');
      echo view ("sablon/center.php");
      echo view('sablon/footer.php');

       // echo view('stranice/test.php');
     }
   
    /**
	 *  Funkcija koja se poziva pri odlasku na login deo stranice
	 * @param string $poruka - poruka koja se prikazuje na stranici
     * @author Filip Kojic 0285/2018
     */
	public function login($poruka=null){
        $this->prikaz('login', ['poruka'=>$poruka]);
    }

     /**
	 *  Funkcija koja se poziva pri pritisku na dugme "Uloguj se" koja odvodi korisnika na njegovu stranicu ili ispisuje gresku
     * @author Filip Kojic 0285/2018
     */
	public function loginSubmit(){
        if(!$this->validate(['username'=>'required','password'=>'required'])){
             	return $this->login("Unesite podatke!");
        }
               
				$korisnikModel = new KorisnikModel();
				$korisnik = $korisnikModel->where('KorisnickoIme',$this->request->getVar('username'))->where('NaCekanju',0)->where('JeObrisan',0)->first();
				if($korisnik==null || strcmp($korisnik->KorisnickoIme,$this->request->getVar('username')) != 0){
					return $this->login("Korisnik ne postoji!");
				}
				if($korisnik->Lozinka!=$this->request->getVar('password')){
					return $this->login("Pogresna lozinka!");
				}

                 $this->session->set('korisnik',$korisnik);
                 
                 if($korisnik->Uloga == "P")
                 return redirect()->to(site_url('Pacijent'));
                  else if($korisnik->Uloga == "L")
                      return redirect()->to(site_url('Lekar'));
                    else 
                      return redirect()->to(site_url('Menadzer'));

              //  return $this->login("Idemo!");
        }

        
		#Ivan Jevtic 0550/2018
        public function register($poruka = null) {
            $uslugaModel = new UslugaModel();
            $usluge = $uslugaModel->getUsluge();
            $this->prikaz('register', ['poruka'=>$poruka,'usluge'=>$usluge]);
        }

        #Ivan Jevtic 0550/2018
        public function registerSubmit() {
            if(!$this->validate(['name'=>'required|min_length[1]|max_length[50]'])){
                return $this->register("Unesite Ime!");
            }
            if(!$this->validate(['surname'=>'required|min_length[1]|max_length[50]'])){
              return $this->register("Unesite Prezime!");
            }

            if(!$this->validate(['username'=>'required|min_length[1]|max_length[50]'])){
                return $this->register("Unesite Korisničko ime!");
            }

            if(!$this->validate(['mail'=>'required|valid_email|min_length[3]|max_length[50]'])){
                return $this->register("Unesite E-poštu!");
            }
            if(!$this->validate(['dateOfBirth'=>'required'])){
                return $this->register("Unesite Datum rođenja!");
            }
            if(!$this->validate(['placeOfBirth'=>'required|min_length[1]|max_length[50]'])){
                return $this->register("Unesite Mesto rođenja!");
            }
            if(!$this->validate(['placeOfLiving'=>'required|min_length[1]|max_length[50]'])){
                return $this->register("Unesite Mesto prebivalista!");
            }
            if(!$this->validate(['adressOfLiving'=>'required|min_length[1]|max_length[50]'])){
                return $this->register("Unesite Adresu prebivalista!");
            }
            if(!$this->validate(['jmbg'=>'required|min_length[13]|max_length[13]'])){
                return $this->register("Unesite JMBG!");
            }
            if(!$this->validate(['gender'=>'required'])){
                return $this->register("Izaberite Pol!");
            }
            if(!$this->validate(['password'=>'required|min_length[1]|max_length[50]'])){
                return $this->register("Unesite Lozinku!");
            }
            if(!$this->validate(['passAgain'=>'required|min_length[1]|max_length[50]'])){
                return $this->register("Unesite Potvdu lozinke!");
            }
            if(!$this->validate(['category'=>'required'])){
                return $this->register("Izaberite kategoriju!");
            }

            //provera za lekara:
            $vrsta = $this->request->getVar('category');
            if((!$this->validate(['speciality'=>'required'])) && ($vrsta == 'L')){
                return $this->register("Izaberite specijalnost!");
            }
            if((!$this->validate(['resume'=>'required'])) && ($vrsta == 'L')){
                return $this->register("Unesite Rezime!");
            }
            // if((!$this->validate(['img'=>'required'])) && ($vrsta == 'L')){
            //     return $this->register("Unesite Putanju slike!");
            // }

            //da li postoji korisnik:
            $korisnikModel = new KorisnikModel();
            $korisnik = $korisnikModel->where('KorisnickoIme',$this->request->getVar('username'))->first();
            if($korisnik!=null){ // vec postoji
                return $this->register("Korisnicko ime vec postoji!");
                
            }
            if($this->request->getVar('password')!=$this->request->getVar('passAgain')){
                return $this->register("Lozinka i Potvrda lozinke moraju biti iste");
                
            }

            $file = $_FILES['img'];
            $fileName = $_FILES['img']['name'];
            $fileTmpName = $_FILES['img']['tmp_name'];
            $fileSize = $_FILES['img']['size'];
            $fileError = $_FILES['img']['error'];
            $fileType = $_FILES['img']['type'];
            $fileExt = explode('.',$fileName);
            $fileActualExtension = strtolower(end($fileExt));

            $allowed = array('jpg','png','jpeg','jfif');

            if(!in_array( $fileActualExtension,$allowed))
            return $this->register("Fajl koji ste izabrali nije slika!");

            if(!($fileError===0))
            return $this->register("Greska pri postavljanju fajla!");

            if($fileSize > 1000000)
            return $this->register("Preveliki fajl!");

            $fileNameNew = uniqid('',true)."."."$fileActualExtension";
            $fileDestination = "web/".$fileNameNew;


            move_uploaded_file($fileTmpName,$fileDestination);
            $path = "/web/".$fileNameNew;
            
            $zbir = 0;
            $broj = 0;

            //$vrsta = $this->request->getVar('category');

            $spec = $this->request->getVar('speciality');
            switch ($spec) {
                case "Kardiologija":
                    $uslugaVrednost = "Kardiologija";break;
                case "Radiologija":
                    $uslugaVrednost = "Radiologija"; break;
                case "Dermatologija":
                    $uslugaVrednost = "Dermatologija"; break;
                case "Onkologija":
                    $uslugaVrednost = "Onkologija"; break;
                case "Anesteziologija":
                    $uslugaVrednost = "Anesteziologija"; break;
                default:$ocenaVrednost = null; break;
            }

            
            $rezime = $this->request->getVar('resume');

            if($vrsta == 'P' || $vrsta == 'M') {
                $zbir = null;
                $broj = null;
                $path = null;
                $uslugaVrednost = null;
                $rezime = null;
            }
            //$uslugaVrednost = "Radiologija";
            
            $korisnikModel->save([
                'Ime' => $this->request->getVar('name'),
                'Prezime' => $this->request->getVar('surname'),
                'KorisnickoIme'=> $this->request->getVar('username'),
                'Lozinka'=> $this->request->getVar('password'),
                'E_posta' => $this->request->getVar('mail'),
                'DatumRodjenja' => $this->request->getVar('dateOfBirth'),
                'MestoRodjenja' => $this->request->getVar('placeOfBirth'),
                'MestoPrebivalista' => $this->request->getVar('placeOfLiving'),
                'AdresaPrebivalista' => $this->request->getVar('adressOfLiving'),
                'JMBG'=> $this->request->getVar('jmbg'),
                'Pol' => $this->request->getVar('gender'),
                'Rezime' => $rezime,
                'Slika' => $path,
                'ZbirOcena' => $zbir,
                'BrojOcena' => $broj,
                'Uloga' => $this->request->getVar('category'),
                'Specijalnost' => $uslugaVrednost,
            ]);

            if($this->request->getVar('category') == "L"){
                $uslugamodel = new UslugaModel();
                $redU = $uslugamodel->where('Naziv', $uslugaVrednost)->first();
                $idU = $redU->IdU;
                $korIme = $this->request->getVar('username');
                $korisnikModel = new KorisnikModel();
                $red = $korisnikModel->where('KorisnickoIme', $korIme)->first();
                $idLek = $red->IdK;
                $pruzaModel = new PruzaModel();
                $podaci = [
                    'IdU' => $idU,
                    'IdLek'=> $idLek,
                ]; 
                $pruzaModel->save($podaci);
            }

            return redirect()->to(site_url('Gost'));
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
