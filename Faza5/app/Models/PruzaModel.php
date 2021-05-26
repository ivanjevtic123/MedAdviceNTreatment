<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\PruzaModel;

class PruzaModel extends Model
{
    protected $table = 'pruza';
    protected $primaryKey = 'IdPru';
    protected $returnType = 'object';
    protected $allowedFields = ['IdU','IdLek', 'Cena'];
    
    #Ivan Jevtic 0550/2018
    #vrati sve usluge
    public function getUsluge() {
        $db = \Config\Database::connect();
        $builder = $db->table('usluga');
        //$builder->db->distinct();
        $builder->distinct();
        $builder->select('Naziv');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }



}
