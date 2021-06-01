<?php namespace App\Models;

 #Ivan Jevtic 0550/2018

use CodeIgniter\Model;
use App\Models\UslugaModel;


/** 
 * Klasa UslugaModel - sluzi za rad sa podacima iz tabele "Usluga" u bazi podataka
 * 
 * @version 1.0
 */
class UslugaModel extends Model
{
    protected $table = 'usluga';
    protected $primaryKey = 'IdU';
    protected $returnType = 'object';
    protected $allowedFields = ['IdU','Naziv'];


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
        //$builder->distinct();
        $builder->select('*');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    
    /**
     * Funkcija koja sluzi za pronalazak svih lekara koji su dostupni za datu uslugu
     * 
     * @param string $nameOfService - naziv usluge u tabeli "usluga" za koju se traze lekari
     * 
     * @return Object[]
     * 
     * @author Ivan Jevtic 0550/2018
     */
    public function getDoctorsForService($nameOfService) {
        $db = \Config\Database::connect();
        $builder = $db->table('usluga');
        $builder->select('');
    }



}
