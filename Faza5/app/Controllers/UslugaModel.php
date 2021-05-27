<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\UslugaModel;

class UslugaModel extends Model
{
    protected $table = 'usluga';
    protected $primaryKey = 'IdU';
    protected $returnType = 'object';
    protected $allowedFields = ['IdU','Naziv'];


    #Ivan Jevtic 0550/2018
    #vrati sve usluge
    public function getUsluge() {
        $db = \Config\Database::connect();
        $builder = $db->table('usluga');
        //$builder->db->distinct();
        //$builder->distinct();
        $builder->select('*');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    
    #Ivan Jevtic 0550/2018
    public function getDoctorsForService($nameOfService) {
        $db = \Config\Database::connect();
        $builder = $db->table('usluga');
        $builder->select('');
    }



}
