<?php
/**
 * @author Filip Kojic 0285/2018
 */
?>
   <div class="col-lg-8 col-md-8 right">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <table cellpadding="20px">
                        <tr>
                        <?php $kg = $pacijent->KrvnaGrupa;
                        $ib = $pacijent->IstorijaBolesti;
                        $zb = $pacijent->ZarazneBolesti;
                        $hb = $pacijent->HronicneBolesti;
                        $ar = $pacijent->LekoviAlergije;
                        $phz = $pacijent->HirurskiZahvati;
                        ?>
                            <td>Krvna grupa:</td>
                                <!-- <td> <input type="text" readonly placeholder= "<?php echo "$kg" ?>"  </td> -->
                                <td> <input type = "text" name = "KG" id = "KG" readonly value = "<?php echo "$kg" ?>" ></td>
                                
                         </tr>
                        <tr>
                            <td>Istorija bolesti:</td>
                                <td><textarea name = "IB" id="IB" readonly cols="30" rows="6"><?php echo "$ib" ?></textarea> </td>
                         </tr>
                         <tr>
                            <td>Hronicne bolesti:</td>
                                <td><textarea name = "HB" id="HB" readonly cols="25" rows="3"><?php echo "$hb" ?></textarea> </td>
                         </tr>
                      </table>
                 </div>
                <div class="col-sm-6">
                     <table cellpadding="20px">
                         <tr>
                              <td padding-top="0px">Zarazne bolesti:</td>
                                <td><textarea name = "ZB" id="ZB" readonly cols="25" rows="3"><?php echo "$zb" ?></textarea> </td>
                         </tr>
                         <tr>
                              <td>Lekovi na koje ima alergijsku reakciju:</td>
                              <td><textarea name = "AR" id="AR" readonly cols="25" rows="3"><?php echo "$ar" ?></textarea> </td>
                         </tr>
                          <tr>
                             <td>Prethodni hirurski zahtevi:</td>
                             <td><textarea name = "PHZ" id="PHZ" readonly cols="25" rows="3"><?php echo "$phz" ?></textarea> </td>
                          </tr>   
                      </table>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped" cellpadding="20px">
                                <tr>
                                <th>Datum</th>
                                <th>Vreme</th>
                                <th>Lekar</th>
                                <th>Usluga</th>
                                <th>Nalaz</th>
                                </tr>
                                  <?php
                                   foreach($nalazi as $nalaz){
                                        if($nalaz!=null){
                                            $termin = $nalaz->IdT;
                                            $timestamp = strtotime($nalaz->DatumIVreme);
                                            $date = date('d/m/Y', $timestamp);
                                            $time = date('G:i', $timestamp);
                                            $lekar = $nalaz->Ime;
                                            $lekar.=' ';
                                            $lekar.=$nalaz->Prezime;
                                            $usluga = $nalaz->Naziv;
                                            $link = 'Link';
                                            echo '<tr>';
                                            echo '<td>';echo("$date");echo '</td>';
                                            echo '<td>';echo("$time");echo '</td>';
                                            echo '<td>';echo("$lekar");echo '</td>';
                                            echo '<td>';echo("$usluga");echo '</td>';
                                            echo '<td>';
                                            echo anchor("$controller/prikaziNalaz/{$termin}", "Link","style = color:blue");
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                   }
                                  ?>
                        </table>
                        </div>
                    </div>
                    <br><br><br><br>
                </div>
            </div>
        </div>