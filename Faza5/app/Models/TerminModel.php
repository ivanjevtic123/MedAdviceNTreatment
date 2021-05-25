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
        }