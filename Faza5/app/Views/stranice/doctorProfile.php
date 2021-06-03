<!-- Ivan Jevtic 0550/2018 -->
<div class="col-lg-9 col-md-10 right" style='margin-top: 20px; margin-bottom: 200px;'>
    <div class='offset-sm-1 col-sm-8 text-center'>
        <div id="nameOfDoc">
            <p>
                <h2><?php echo "{$doctor->Specijalnost}"; ?></h2>
                <br>
                <h2>Dr <?php echo "{$doctor->Prezime}"; ?>&nbsp;<?php echo "{$doctor->Ime}"; ?></h2>
                <hr>
            </p>
        </div>
        <div id="picAndInfo">
            <div>
                <img src=<?php echo "{$doctor->Slika}"; ?> style='height: 400px;margin-top: 15px;margin-bottom: 15px;justify-content: space-around;'>
            </div>
            <div>
                <table class="table">
                    <tr>
						<?php 
                            if($doctor->BrojOcena == 0) {
                                $rate = 0;
                            } else {
                                $rate = $doctor->ZbirOcena / $doctor->BrojOcena;
                                $rate = round($rate, 2);
                            }
                        ?>
                        <td style='align-items: center;'>Ocena:</td>
                        <td style='align-items: center;' id="ocenaDr"><?php echo "{$rate}"; ?></td>
                    </tr>
                    <tr>
                        <td style='align-items: center;'>Cena(rsd):</td>
                        <td style='align-items: center;' id="cenaDr"><?php echo "{$cena}"; ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div id="resume">
            <hr>
            <?php echo "{$doctor->Rezime}"; ?>
        </div>
        <div id="schedule">
            <hr>
            <?php 
                if($controller == "Pacijent") {                   
                    if ($pacijent->KrvnaGrupa!=null){
                   // echo "<button class='btn btn-secondary'><a style='color: white;' href='Pacijent/zakazi/{$IdDoc}/{$IdU}'>ZAKAZI TERMIN</a></button>";
                    echo anchor("Pacijent/zakazi/{$IdDoc}/{$IdU}", "Zakazi termin",'class="btn btn-secondary"');
                 } 
                else {
                    $poruka = "Da biste zakazali termin kod lekara prvo popunite karton!";
                    echo " </br><font color='green' size = 5px>$poruka</font>";}} ?>
                    
        </div>
    </div>
</div>
</div>