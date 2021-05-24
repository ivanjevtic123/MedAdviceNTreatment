<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\KorisnikModel;

class KorisnikModel extends Model
{
        protected $table      = 'korisnik';
        protected $primaryKey = 'IdK';
        protected $returnType = 'object';
        protected $allowedFields = ['Ime', 'Prezime', 'KorisnickoIme', 'Lozinka', 'E_posta', 'DatumRodjenja' , 'MestoRodjenja', 'MestoPrebivalista' , 'AdresaPrebivalista' , 'JMBG', 'Pol'
    ,'NaCekanju','JeObrisan',  'KrvnaGrupa','IstorijaBolesti','HronicneBolesti','ZarazneBolesti','LekoviAlergije',
     'HiruskiZahvati','Rezime','Slika','ZbirOcena','BrojOcena','Uloga'];
    
    #Filip Kojic 0285/2018
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

     #Filip Kojic 0285/2018
     public function nadjiKorisnike(){
     return $this->where('JeObrisan',0)->where('NaCekanju',0)->orderBy('KorisnickoIme','ASC')->findAll();
  }
  #Filip Zaric 0345/2018
  public function korisniciCekaju(){
    return $this->where('JeObrisan',0)->where('NaCekanju',1)->orderBy('KorisnickoIme','ASC')->findAll();
  }

     #Filip Kojic 0285/2018
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
 
   #Filip Kojic 0285/2018
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
}