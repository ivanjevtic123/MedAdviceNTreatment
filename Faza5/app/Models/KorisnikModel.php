<?php namespace App\Models;

    #Filip Kojic 0285/2018
    #Filip Zaric 0345/2018

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
     'HiruskiZahvati','Rezime','Slika','ZbirOcena','BrojOcena','Uloga'];
    
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
       #Filip Zaric 0345/2018
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
  #Filip Zaric 0345/2018
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
	   * Funkcija koja sluzi za nadje pacijente iz baze za lekara sa prosledjenim id-jem
     * 
     * @param int $IdK  - id lekara u tabeli "Korisnik" ciji se pacijenti traze
     * 
     *  @return Object[]
     * 
     * @author Filip Kojic 0285/2018
     */
      public function nadjiPacijente($IdK){
        $db = \Config\Database::connect();
          $builder = $db->table('korisnik');
          $builder->select('*');
          $builder->join('lecio', 'lecio.IdPac = korisnik.Idk', 'inner');
          $builder->where('IdLek', $IdK)->where('JeObrisan',0);
          $query = $builder->get();
          $result = $query->getResult();
          return $result;
      }
}