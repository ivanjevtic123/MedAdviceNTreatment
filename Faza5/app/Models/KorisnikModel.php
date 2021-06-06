<?php namespace App\Models;

    #Filip Kojic 0285/2018
    #Filip Zaric 0345/2018
    #Ivan Jevtic 0550/2018

use CodeIgniter\Model;
use App\Models\KorisnikModel;

/** 
 * Klasa KorisnikModel - sluzi za rad sa podacima iz tabele "Korisnik" u bazi podataka
 * 
 * @version 1.0
 */

class KorisnikModel extends Model
{       
        protected $table      = 'korisnik';
        protected $primaryKey = 'IdK';
        protected $returnType = 'object';
        protected $allowedFields = ['Ime', 'Prezime', 'KorisnickoIme', 'Lozinka', 'E_posta', 'DatumRodjenja' , 'MestoRodjenja', 'MestoPrebivalista' , 'AdresaPrebivalista' , 'JMBG', 'Pol'
    ,'NaCekanju','JeObrisan',  'KrvnaGrupa','IstorijaBolesti','HronicneBolesti','ZarazneBolesti','LekoviAlergije',
     'HiruskiZahvati','Rezime','Slika','ZbirOcena','BrojOcena','Uloga', 'Specijalnost'];
    
    /**
	   * Funkcija koja sluzi za uklanjanje korisnika iz baze
     * 
     * @param int $IdK - id korisnika u tabeli "Korisnik" koji se uklanja iz baze
     * 
     * @author Filip Kojic 0285/2018
     */
     public function obrisiKorisnika($IdK){
         $data = [
           'JeObrisan' => 1
         ];
        $this->update($IdK,$data);
     }
               /**
	   * Funkcija koja sluzi za azuriranje stanja korisnika u bazi,odnosno korisnik zaista postaje prepoznat
     * od platforme kao registrovani korisnik.
     * 
     * 
     * @param int $IdK - id korisnika u tabeli "Korisnik" koji postaje prepoznat
     * od platforme kao registrovani korisnik. 
     * 
     * @author Filip Zaric 0345/2018
     */
     public function odobriKorisnika($IdK){
         $data=[
             'NaCekanju' =>0
         ];
         $this->update($IdK,$data);
     }

     /**
	   * Funkcija koja sluzi za nadje korisnike iz baze
     * 
     * @return Object[]
     * 
     * @author Filip Kojic 0285/2018
     */
     public function nadjiKorisnike(){
     return $this->where('JeObrisan',0)->where('NaCekanju',0)->orderBy('KorisnickoIme','ASC')->findAll();
  }
            /**
	   * Funkcija koja sluzi za dohvatanje iz baze korisnika za koje menadzer jos uvek nije odlucio da li mogu
     * postati registrovani korisnici platforme.
     * 
     * 
     * @return Korisnik[]
     * 
     * @author Filip Zaric 0345/2018
     */
  public function korisniciCekaju(){
    return $this->where('JeObrisan',0)->where('NaCekanju',1)->orderBy('KorisnickoIme','ASC')->findAll();
  }

     /**
	   * Funkcija koja sluzi za nadje lekare iz baze za pacijenta sa prosledjenim id-jem
     * 
     * @param int $IdK  - id pacijenta u tabeli "Korisnik" ciji se lekari traze
     * 
     * @return Object[]
     * 
     * @author Filip Kojic 0285/2018
     */
     public function nadjiLekare($IdK){
       $db = \Config\Database::connect();
         $builder = $db->table('korisnik');
         $builder->select('*');
         $builder->join('lecio', 'lecio.IdLek = korisnik.Idk', 'inner');
         $builder->where('IdPac', $IdK);
         $query = $builder->get();
         $result = $query->getResult();
         return $result;
     }
 
   /**
	   * Funkcija koja sluzi da uveca zbir i broj ocena lekaru koji je ocenjen
     * 
     * @param int $IdK  - id lekara u tabeli "Korisnik" koji je ocenjen
     * @param int $ocenaVrednost  - vrednost za koju se uvecava kolona "ZbirOcena" u tabeli "Korisnik"
     * 
     * @author Filip Kojic 0285/2018
     */
     public function uvecajZbirIBrojOcena($IdK,$ocenaVrednost){
        $red = $this->where('IdK',$IdK)->first();
        $zbir = $red->ZbirOcena;
        $broj = $red->BrojOcena;
        $zbir = $zbir + $ocenaVrednost;
        $broj = $broj + 1;
            $data = [
               'ZbirOcena' => $zbir,
               'BrojOcena' => $broj
             ];
             $this->update($IdK,$data);
      }
	  
		 /**
	   * Funkcija koja sluzi da pronadje lekare iz baze za uslugu sa prosledjenim id-em
     * 
     * @param int $IdU  - id usluge u tabeli "Usluga" za koju se traze lekari
     * 
     * @return Object[]
     * 
     * @author Ivan Jevtic 0550/2018
     */
		public function nadjiLekareZaUslugu($IdU) {
			$db = \Config\Database::connect();
			$builder = $db->table('korisnik'); 
			$builder->select('*');

			$builder->join('pruza', 'pruza.IdLek = korisnik.IdK', 'inner');
			$builder->join('usluga', 'usluga.IdU = pruza.IdU', 'inner');
			$builder->where('usluga.IdU', $IdU);
			$builder->where('NaCekanju', 0);
			$builder->where('JeObrisan', 0);
			$query = $builder->get();
			$result = $query->getResult();
			return $result;
		}

		/**
	   * Funkcija koja sluzi da pronadje lekare iz baze za uslugu sa prosledjenim id-em
     * 
     * @param int $IdU  - id usluge u tabeli "Usluga" za koju se traze lekari
     * @param int $order - da li se radi opadajuce ili rastuce sortiranje
     * 
     * @return Object[]
     * 
     * @author Ivan Jevtic 0550/2018
     */
		public function nadjiLekareZaUsluguSortirano($IdU, $order) {
		  $db = \Config\Database::connect();
		  $builder = $db->table('korisnik'); 
		  $builder->select('*');

		  $builder->join('pruza', 'pruza.IdLek = korisnik.IdK', 'inner');
		  $builder->join('usluga', 'usluga.IdU = pruza.IdU', 'inner');
		  $builder->where('usluga.IdU', $IdU);
      $builder->where('NaCekanju', 0);
			$builder->where('JeObrisan', 0);
		  if($order == 1) {
			  $builder->orderBy('pruza.Cena', 'DESC');//SORT_DESC
		  } else {
			  $builder->orderBy('pruza.Cena', 'ASC');//SORT_ASC
		  }
		  $query = $builder->get();
		  $result = $query->getResult();
		  return $result;
		}
	  
	  
	  
	  
	  
	  
	  
}