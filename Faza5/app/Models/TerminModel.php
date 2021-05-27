<?php namespace App\Models;

 #Filip Kojic 0285/2018

use CodeIgniter\Model;
use App\Models\TerminModel;

/** 
 * Klasa TerminModel - sluzi za rad sa podacima iz tabele "Termin" u bazi podataka
 * 
 * @version 1.0
 */

class TerminModel extends Model
{
        protected $table      = 'termin';
        protected $primaryKey = 'IdT';
        protected $returnType = 'object';
        protected $allowedFields = ['IdPac', 'IdPru', 'DatumIVreme', 'Ostvaren', 'TekstNalaz', 'Snimak'];

     /**
	 * Funkcija koja sluzi za trazenje nalaza za pacijenta sa prosledjenim id-jem
     * 
     * @param int $IdPac - id pacijenta u tabeli "Termin" ciji se nalazi traze
     * 
     *  @return Object[]
     * 
     * @author Filip Kojic 0285/2018
     */
        public function nadjiNalaze($IdPac){
            $db = \Config\Database::connect();
            $builder = $db->table('termin');
            $builder->select('*');
            $builder->join('pruza', 'pruza.IdPru = termin.IdPru', 'inner');
            $builder->join('usluga', 'usluga.IdU = pruza.Idu', 'inner');
            $builder->join('korisnik', 'korisnik.IdK = pruza.IdLek', 'inner');
            $builder->where('IdPac', $IdPac)->where('Ostvaren',1);
            $query = $builder->get();
            $result = $query->getResult();
            return $result;
         }

		#Ivan Jevtic 0550/2018
        public function getNeostvareniTermini($IdPac) {
            $db = \Config\Database::connect();
            $builder = $db->table('termin');
            $builder->select('*');

            $builder->join('pruza', 'pruza.IdPru = termin.IdPru', 'inner');
            $builder->join('usluga', 'usluga.IdU = pruza.Idu', 'inner');
            $builder->join('korisnik', 'korisnik.IdK = pruza.IdLek', 'inner');
            $builder->where('IdPac', $IdPac)->where('Ostvaren',0);
            $query = $builder->get();
            $result = $query->getResult();
            return $result;
        }
		
		#Ivan Jevtic 0550/2018
        public function postaviSnimakINalaz($red,$tekst,$snimak){
            // $nesto = "ivanb";
            $podaci = [
            'TekstNalaza' => $tekst,
            'Snimak' => $snimak,
            'Ostvaren'=> 1
            ];
            $id = $red->IdT;
            $this->update($id,$podaci);
        }
              /**
 *  Funkcija dohvata zakazane  a jos uvek neostvarene termine pacijenta,odnosno njihove timestamp-ove.
 * @param int $idPac-identifikator pacijenta za koga se timestampovi termina dohvataju
 * 
 * @return string[]
 *  @author Filip Zaric 0345/2018
 */
        public function dohvatiZauzeteTerminePacijenta($idPac){
            $db = \Config\Database::connect();
            $builder = $db->table('termin');
            $builder->select('DatumIVreme');
            $builder->where('IdPac', $idPac)->where('Ostvaren',0);
            $query = $builder->get();
            $result = $query->getResult();
            return $result;
        }
                            /**
 *  Funkcija dohvata zakazane  a jos uvek neostvarene termine lekara koji pruza odredjenu uslugu,
 * odnosno njihove timestamp-ove.
 * @param int $idPru-identifikator u tabeli pruza za datu uslugu i datog lekara za koje se timestampovi termina dohvataju
 * 
 * @return string[]
 *  @author Filip Zaric 0345/2018
 */  

        public function dohvatiZauzeteTermineLekara($idPru){
            $db = \Config\Database::connect();
            $builder = $db->table('termin');
            $builder->select('DatumIVreme');
            $builder->where('IdPru', $idPru)->where('Ostvaren',0);
            $query = $builder->get();
            $result = $query->getResult();
            return $result;
        
        
           
        }
            /**
        *  Funkcija dodaje zakazan termin u bazu.
        * @param int $idpru-identifikator u tabeli pruza
        * @param int $idpac-identifikator pacijenta koji zakazuje termin
        * @param string $timestamp-timestamp,odnosno datum i cas termina koji je zakazan
        * @return string[]
        *  @author Filip Zaric 0345/2018
        */
        public function dodajTermin($idpac,$idpru,$timestamp){
            $data = [
                'IdPac' => $idpac,
                'IdPru'    => $idpru,
                'DatumIVreme'=>$timestamp,
                'Ostvaren' =>0,
                'TekstNalaza'=>'P'
            ];
            $this->insert($data);
        }



}