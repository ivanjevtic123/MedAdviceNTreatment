<?php

    #Ivan Jevtic 0550/2018
    #Filip Kojic 0285/2018
    #Filip Zaric 0345/2018

namespace App\Controllers;
use App\Models\KorisnikModel;

class Menadzer extends BaseController
{
    protected function prikaz($page, $data) {
        $data['controller']='Menadzer';
        $data['korisnik']=$this->session->get('korisnik');
        echo view("sablon/header_menadzer.php");
		echo view("sablon/sidebar.php");
        echo view ("stranice/$page", $data);
        echo view("sablon/footer.php");
    }



    public function index() {
        echo view('sablon/header_menadzer.php');
         echo view('sablon/sidebar.php');
        echo view ("sablon/center.php");
        echo view('sablon/footer.php');
    }
    #Filip Zaric 0345/2018
    public function promenaLozinke($poruka=null,$vrsta=0){
        
        $this->prikaz('promenaLozinke', ['poruka'=>$poruka,'vrsta'=>$vrsta]);
     
    }
       #Filip Zaric 0345/2018
    public function promenaLozinkeObrada(){

        if(!$this->validate(['staraLoz'=>'required','novaLoz1'=>'required','novaLoz2'=>'required'])){
            return $this->promenaLozinke("Morate popuniti sva polja!");
   }
   $staraLoz=$this->request->getVar('staraLoz');
   $novaLoz1=$this->request->getVar('novaLoz1');
   $novaLoz2=$this->request->getVar('novaLoz2');
   if($novaLoz1!=$novaLoz2){
     return $this->promenaLozinke("Niste uneli korektnu vrednost prilikom potvrde nove lozinke!");

   }
   $korisnikModel=new KorisnikModel();
   
   #	$korisnik = $korisnikModel->where('KorisnickoIme',$this->request->getVar('username'))->where('NaCekanju',0)->first();
   $korisnikTrenutni=$this->session->get('korisnik');
   if($korisnikTrenutni->Lozinka==$staraLoz){
    $upit_data = [
        'Lozinka' => $novaLoz1
        
    ];
    
    $korisnikModel->update($korisnikTrenutni->IdK, $upit_data);
     $korisnikTrenutni->Lozinka=$novaLoz1;
     $this->session->set('korisnik',$korisnikTrenutni); 
     return $this->promenaLozinke("Uspesno ste promenili Lozinku!",1);

   }else{
    return $this->promenaLozinke("Uneli ste neispravnu vrednost stare Lozinke!");
   }


    }


#Filip Zaric 2018/0345
public function odbijKorisnika($IdK){
    $korisnikModel=new KorisnikModel();
    // $korisnik = $korisnikModel->where('IdK',$IdK)->first();
     $korisnikModel->obrisiKorisnika($IdK);
     return $this->zahtev("Uspesno ste odbili zahtev!");
}
#Filip Zaric 2018/0345
public function zahtev($poruka=null){
    $korisnikModel = new KorisnikModel();
    $korisnici = $korisnikModel->korisniciCekaju();
       $this->prikaz('odobravanjeZahteva', ['poruka'=>$poruka,'korisnici'=>$korisnici]);
    
}
#Filip Zaric 0345/2018
public function odobriKorisnika($IdK){
    $korisnikModel=new KorisnikModel();
   // $korisnik = $korisnikModel->where('IdK',$IdK)->first();
    $korisnikModel->odobriKorisnika($IdK);
    return $this->zahtev("Uspesno ste odobrili zahtev!");
}



   #Filip Kojic 0285/2018
   public function ukloni($poruka=null){
    $korisnikModel = new KorisnikModel();
       $korisnici = $korisnikModel->nadjiKorisnike();
       if($korisnici != null)
          return $this->prikaz('ukloniKorisnika', ['poruka'=>$poruka,'korisnici'=>$korisnici]);
            return $this->prikaz('ukloniKorisnika', ['poruka'=>'Trenutno nema korisnika za prikaz!','korisnici'=>$korisnici]);
}

 #Filip Kojic 0285/2018
  public function ukloniKorisnika($IdK){
    $korisnikModel = new KorisnikModel();
      $korisnik = $korisnikModel->where('IdK',$IdK)->first();
      if($korisnik->JeObrisan == 0){
        $korisnikModel->obrisiKorisnika($IdK);
          return $this->ukloni('Uspesno ste uklonili korisnika!');
           }
            return $this->ukloni();
    }
















}