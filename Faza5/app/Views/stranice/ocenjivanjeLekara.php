<?php
/**
 * @author Filip Kojic 0285/2018
 */
?>
<div class="col-lg-8 col-md-8 right">
    <?php if($lekari != null) {?> 
            <table class="table table-striped">
                <th>Ime i prezime</th>
                <th>Broj dozvoljenih ocenjivanja</th>
                <th>Ocena</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <?php
             
            foreach ($lekari as $lekar) {
                if($lekar != null){
                $ime = $lekar->Ime;
                $ime .= ' ';
                $ime .=  $lekar->Prezime;
                echo "<tr><td>{$ime}</td><td>{$lekar->PreostaloOcena}</td>";
                echo"<td>";
                ?>
                    <form method = "post" action = <?= site_url("Pacijent/ocenaSubmit/{$lekar->IdK}")?>
                    <?php
                    //echo "$lekar->IdK";
                    echo '>';
                    echo '
                        <select name="Ocena">
                        <option value="" disabled selected>Izaberi ocenu</option>
                        <option value="Jedan">1</option>
                        <option value="Dva">2</option>
                        <option value="Tri">3</option>
                        <option value="Cetiri">4</option>
                        <option value="Pet">5</option>
                       </select>
                  </td><td>
                    <button type="submit" class="btn btn-secondary" style = "width:100px">Oceni</button>
                </form>';
                echo"</td>";
            }
        }
    
            ?>
         </table>
         <?php }?>
         <font color='green'><?php if(isset($poruka) && strcmp($poruka ,"Uspesno ste ocenili lekara!") == 0 ) echo " </br><font color='green' size = 5px>$poruka</font>"; ?></font></td>
         <font color='red'><?php if(isset($poruka) && strcmp($poruka ,"Ne mozete vise ocenjivati lekara!") == 0) echo " </br><font color='red' size = 5px>$poruka</font>"; ?></font></td>
         <font color='red'><?php if(isset($poruka) && strcmp($poruka ,'Trenutno nema lekara za prikaz!') == 0) echo " </br><font color='red' size = 5px>$poruka</font>"; ?></font></td>
            </div>
        </div>