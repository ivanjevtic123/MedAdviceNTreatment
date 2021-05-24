<?php

    #Ivan Jevtic 0550/2018
    #Filip Kojic 0285/2018
    #Filip Zaric 0345/2018

namespace App\Controllers;
use App\Models\KorisnikModel;
use App\Models\UslugaModel;

class Gost extends BaseController
{
     protected $data = [];

	    protected function prikaz($page, $data) {
        $data['controller']='Gost';
        echo view("sablon/header_gost.php");
		    echo view("sablon/sidebar.php");
        echo view ("stranice/$page", $data);
        echo view("sablon/footer.php");
    }

	 public function index() {
      echo view('sablon/header_gost.php');
	 	  echo view('sablon/sidebar.php');
      echo view ("sablon/center.php");
      echo view('sablon/footer.php');

       // echo view('stranice/test.php');
     }
   
    #Filip Kojic 0285/2018
	public function login($poruka=null){
        $this->prikaz('login', ['poruka'=>$poruka]);
    }

     #Filip Kojic 0285/2018
	public function loginSubmit(){
        if(!$this->validate(['username'=>'required','password'=>'required'])){
             	return $this->login("Unesite podatke!");
        }
               
				$korisnikModel = new KorisnikModel();
				$korisnik = $korisnikModel->where('KorisnickoIme',$this->request->getVar('username'))->where('NaCekanju',0)->first();
				if($korisnik==null){
					return $this->login("Korisnik ne postoji");
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
            if(!$this->validate(['name'=>'required'])){
                return $this->register("Unesite Ime!");
            }
            if(!$this->validate(['surname'=>'required'])){
              return $this->register("Unesite Prezime!");
            }

            if(!$this->validate(['username'=>'required'])){
                return $this->register("Unesite Korisničko ime!");
            }

            if(!$this->validate(['mail'=>'required'])){
                return $this->register("Unesite E-poštu!");
            }
            if(!$this->validate(['dateOfBirth'=>'required'])){
                return $this->register("Unesite Datum rođenja!");
            }
            if(!$this->validate(['placeOfBirth'=>'required'])){
                return $this->register("Unesite Mesto rođenja!");
            }
            if(!$this->validate(['placeOfLiving'=>'required'])){
                return $this->register("Unesite Mesto prebivalista!");
            }
            if(!$this->validate(['adressOfLiving'=>'required'])){
                return $this->register("Unesite Adresu prebivalista!");
            }
            if(!$this->validate(['jmbg'=>'required'])){
                return $this->register("Unesite JMBG!");
            }
            if(!$this->validate(['gender'=>'required'])){
                return $this->register("Izaberite Pol!");
            }
            if(!$this->validate(['password'=>'required'])){
                return $this->register("Unesite Lozinku!");
            }
            if(!$this->validate(['passAgain'=>'required'])){
                return $this->register("Unesite Potvdu lozinke!");
            }
            // if('password' != 'passAgain') {
            //     return $this->register("Lozinka i Potvrda lozinke moraju biti iste!");
            // }
            if(!$this->validate(['category'=>'required'])){
                return $this->register("Izaberite kategoriju!");
            }
            // if(!$this->validate(['speciality'=>'required'])){
            //     return $this->register("Izaberite specijalnost!");
            // }
            // if(!$this->validate(['resume'=>'required'])){
            //     return $this->register("Unesite Rezime!");
            // }
            // if(!$this->validate(['img'=>'required'])){
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
                'Rezime' => $this->request->getVar('resume'),
                'Slika' => $this->request->getVar('img'),
                'ZbirOcena' => 0,
                'BrojOcena' => 0,
                'Uloga' => $this->request->getVar('category'),
                'Specijalnost' => $this->request->getVar('speciality'),
            ]);

            /*$PruzaModel->save([

            ]);*/

            return redirect()->to(site_url('Gost'));
        }
		
    
}
