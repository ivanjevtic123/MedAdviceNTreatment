<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\LecioModel;

class LecioModel extends Model
{
        protected $table      = 'lecio';
        protected $primaryKey = 'IdLec';
        protected $returnType = 'object';
        protected $allowedFields = ['IdLek','IdPac','PreostaloOcena'];
    
        #Filip Kojic 0285/2018
        public function mozeDaSeOceni($IdPac,$IdLek){
         $red = $this->where('IdPac',$IdPac)->where('IdLek',$IdLek)->first();
         $preostalo = $red->PreostaloOcena;
         if($preostalo > 0) return true;
         return false;
        }

        #Filip Kojic 0285/2018
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