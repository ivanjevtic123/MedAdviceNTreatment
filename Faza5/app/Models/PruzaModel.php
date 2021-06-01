<?php namespace App\Models;

#Ivan Jevtic 0550/2018

use CodeIgniter\Model;
use App\Models\PruzaModel;

class PruzaModel extends Model
{
    protected $table = 'pruza';
    protected $primaryKey = 'IdPru';
    protected $returnType = 'object';
    protected $allowedFields = ['IdU','IdLek', 'Cena'];
    
    /**
     * Funkcija koja sluzi za pronalazak svih usluga koje su dostupne
     * 
     * @return Object[]
     * 
     * @author Ivan Jevtic 0550/2018
     */
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
