     <!--Filip Kojic 0285/2018-->
     <div class="col-lg-8 col-md-8 right">
          <br>
          <?php if($korisnici != null) {?> 
        <table class="table table-striped">
            <th>Korisničko ime</th>
            <th>JMBG</th>
            <th>Kategorija</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
             <?php
            foreach ($korisnici as $korisnik) {
               if($korisnik!=null) {
                   if($korisnik->NaCekanju==1){

                   
                if($korisnik->Uloga == "M") $tip="Menadzer";
                  if($korisnik->Uloga == "L") $tip="Lekar";
                    if($korisnik->Uloga == "P") $tip="Pacijent";

                echo "<tr><td>{$korisnik->KorisnickoIme}</td><td>{$korisnik->JMBG}</td><td>{$tip}</td>";
                echo '<td>';
                echo anchor("Menadzer/odobriKorisnika/{$korisnik->IdK}", "Odobri",'class="btn btn-secondary"');
                echo '</td>';
                echo '<td>';
                echo anchor("Menadzer/odbijKorisnika/{$korisnik->IdK}", "Odbij",'class="btn btn-secondary"');
                echo '</td>';
            }
            }


        }
            ?>
         </table>
         <?php }?>
         <font color='green'><?php if(isset($poruka) && strcmp($poruka ,"Uspesno ste odobrili zahtev!") == 0 ) echo " </br><font color='green' size = 5px>$poruka</font>"; ?></font></td>
         <font color='green'><?php if(isset($poruka) && strcmp($poruka ,"Uspesno ste odbili zahtev!") == 0) echo " </br><font color='green' size = 5px>$poruka</font>"; ?></font></td>
         <font color='red'><?php if(isset($poruka) && strcmp($poruka ,'Trenutno nema korisnika za prikaz!') == 0) echo " </br><font color='red' size = 5px>$poruka</font>"; ?></font></td>
     <br><br>
   </div>
   </div>