<?php

    #Ivan Jevtic 0550/2018
    #Filip Kojic 0285/2018
    #Filip Zaric 0345/2018

namespace App\Controllers;
use App\Models\KorisnikModel;

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
    
}
