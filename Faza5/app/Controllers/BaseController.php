<?php

    #Ivan Jevtic 0550/2018
    #Filip Kojic 0285/2018
    #Filip Zaric 0345/2018

namespace App\Controllers;
use App\Models\KorisnikModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

/*
 * Klasa BaseController - sluzi za implementaciju metoda koje su zajednicke za sve korisnike
 * 
 * @version 1.0
 */


class BaseController extends Controller
{
	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form', 'url'];

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();
		$this->session = \Config\Services::session();
		$this->db = \Config\Database::connect();
	}

	  /**
	 *  Funkcija za odjavljivanje ulogovanog korisnika, vraca korisnika na pocetnu stranicu gosta
	 * 
     * @author Filip Kojic 0285/2018
     */
	public function logout(){
        $this->session->destroy();
        return redirect()->to(site_url('Gost'));
    }


	#Filip Zaric 0345/2018
	public function promenaLozinke($poruka=null,$vrsta=0){
        
        $this->prikaz('promenaLozinke', ['poruka'=>$poruka,'vrsta'=>$vrsta]);
     
    }
	#Filip Zaric 0345/2018
    public function promenaLozinkeObrada(){

        if(!$this->validate(['staraLoz'=>'required','novaLoz1'=>'required','novaLoz2'=>'required'])){
            return $this->promenaLozinke("Morate popuniti sva polja!");
   }
   $staraLoz=$this->request->getVar('staraLoz');
   $novaLoz1=$this->request->getVar('novaLoz1');
   $novaLoz2=$this->request->getVar('novaLoz2');
   if($novaLoz1!=$novaLoz2){
     return $this->promenaLozinke("Niste uneli korektnu vrednost prilikom potvrde nove lozinke!");

   }
   $korisnikModel=new KorisnikModel();
   
   #	$korisnik = $korisnikModel->where('KorisnickoIme',$this->request->getVar('username'))->where('NaCekanju',0)->first();
   $korisnikTrenutni=$this->session->get('korisnik');
   if($korisnikTrenutni->Lozinka==$staraLoz){
    $upit_data = [
        'Lozinka' => $novaLoz1
        
    ];
    
    $korisnikModel->update($korisnikTrenutni->IdK, $upit_data);
     $korisnikTrenutni->Lozinka=$novaLoz1;
     $this->session->set('korisnik',$korisnikTrenutni); 
     return $this->promenaLozinke("Uspesno ste promenili Lozinku!",1);

   }else{
    return $this->promenaLozinke("Uneli ste neispravnu vrednost stare Lozinke!");
   }


    }
	public function LozPoc(){
	return $this->promenaLozinkeObrada();
	}
}
