<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\TerminModel;

class TerminModel extends Model
{
        protected $table      = 'termin';
        protected $primaryKey = 'IdT';
        protected $returnType = 'object';
        protected $allowedFields = ['IdPac', 'IdPru', 'DatumIVreme', 'Ostvaren', 'TekstNalaz', 'Snimak'];

        #Filip Kojic 0285/2018
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