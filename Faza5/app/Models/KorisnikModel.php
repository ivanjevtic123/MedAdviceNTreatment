<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\KorisnikModel;

class KorisnikModel extends Model
{
        protected $table      = 'korisnik';
        protected $primaryKey = 'IdK';
        protected $returnType = 'object';
        protected $allowedFields = ['Ime', 'Prezime', 'KorisnickoIme', 'Lozinka', 'E-posta', 'DatumRodjenja' , 'MestoRodjenja', 'MestoPrebivalista' , 'AdresaPrebivalista' , 'JMBG', 'Pol'
    ,'NaCekanju','JeObrisan',  'KrvnaGrupa','IstorijaBolesti','HronicneBolesti','ZarazneBolesti','LekoviAlergije',
     'HiruskiZahvati','Rezime','Slika','ZbirOcena','BrojOcena','Uloga'];
    

}