     <!--Filip Kojic 0285/2018-->
        <div class="col-lg-8 col-md-8 right">
          <br>
        <table class="table table-striped">
            <th>Korisničko ime</th>
            <th>JMBG</th>
            <th>Kategorija</th>
            <th>&nbsp;</th>
             <?php
            foreach ($korisnici as $korisnik) {
               if($korisnik!=null) {
                if($korisnik->Uloga == "M") $tip="Menadzer";
                  if($korisnik->Uloga == "L") $tip="Lekar";
                    if($korisnik->Uloga == "P") $tip="Pacijent";

                echo "<tr><td>{$korisnik->KorisnickoIme}</td><td>{$korisnik->JMBG}</td><td>{$tip}</td>";
                echo '<td>';
                echo anchor("Menadzer/ukloniKorisnika/{$korisnik->IdK}", "Ukloni",'class="btn btn-secondary"');
                echo '</td>';
            }
        }
            ?>
         </table>
         <font color='green'><?php if(isset($poruka)) echo " </br><font color='green' size = 5px>$poruka</font>"; ?></font></td>
     <br><br>
   </div>
   </div>