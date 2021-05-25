<?php
/**
 * @author Filip Kojic 0285/2018
 */
?>
     <div class="col-lg-8 col-md-8 right">
        <table class="table table-striped">
            <th>Ime</th>
            <th>Prezime</th>
            <th>JMBG</th>
            <th>&nbsp;</th>
             <?php
            foreach ($pacijenti as $pacijent) {
               if($pacijent!=null) {

                echo "<tr><td>{$pacijent->Ime}</td><td>{$pacijent->Prezime}</td><td>{$pacijent->JMBG}</td>";
                echo '<td>';
                echo anchor("Lekar/prikaziKarton/{$pacijent->IdK}", "Karton",'class="btn btn-secondary"');
                echo '</td>';

               //ZA DODAVANJE NALAZA
               // echo '<td>';
               // echo anchor("Lekar/dodajNalaz/{$pacijent->IdK}", "Dodaj Nalaz",'class="btn btn-secondary"');
               // echo '</td>';
            }
        }
            ?>
         </table>
     <br><br>
   </div>
   </div>