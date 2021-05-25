<?php namespace App\Models;

    #Filip Kojic 0285/2018

use CodeIgniter\Model;
use App\Models\LecioModel;

/** 
 * Klasa LecioModel - sluzi za rad sa podacima iz tabele "Lecio" u bazi podataka
 * 
 * @version 1.0
 */

class LecioModel extends Model
{
        protected $table      = 'lecio';
        protected $primaryKey = 'IdLec';
        protected $returnType = 'object';
        protected $allowedFields = ['IdLek','IdPac','PreostaloOcena'];
    
     /**
	   * Funkcija koja sluzi za ispitivanje da li je ostalo jos prilika za ocenjivanje lekara iz baze
     * 
     * @param int $IdPac - id pacijenta u tabeli "Korisnik" koji ocenjuje lekara
     * @param int $IdLek - id lekara u tabeli "Korisnik" koji se ocenjuje
     * 
     *  @return Boolean
     * 
     * @author Filip Kojic 0285/2018
     */
        public function mozeDaSeOceni($IdPac,$IdLek){
         $red = $this->where('IdPac',$IdPac)->where('IdLek',$IdLek)->first();
         $preostalo = $red->PreostaloOcena;
         if($preostalo > 0) return true;
         return false;
        }

     /**
	   * Funkcija koja sluzi da dekrementiranje broja preostalih ocena za lekara
     * 
     * @param int $IdPac  - id pacijenta u tabeli "Korisnik" koji ocenjuje lekara
     * @param int $IdLek  - id lekara u tabeli "Korisnik" koji se ocenjuje
     * 
     * @author Filip Kojic 0285/2018
     */
        public function dekrementriajPreostaloOcena($IdPac,$IdLek){
           $red = $this->where('IdPac',$IdPac)->where('IdLek',$IdLek)->first();
           $IdLec = $red->IdLec;
           $broj = $red->PreostaloOcena;
           $broj--;
         $data = [
            'PreostaloOcena' => $broj
          ];

         $this->update($IdLec,$data);
        }


}