<!-- Ivan Jevtic 0550/2018 $doctor-->
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
                <img src="/web/dr1.jpg" style='height: 400px;margin-top: 15px;margin-bottom: 15px;justify-content: space-around;'>
            </div>
            <div>
                <table class="table">
                    <tr>
                        <td style='align-items: center;'>Ocena:</td>
                        <td style='align-items: center;' id="ocenaDr"><?php echo "{$doctor->Prezime}"; ?></td>
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
                    echo "<button class='btn btn-secondary'><a style='color: white;' href='../zakazi/{$IdDoc}/{$IdU}'>ZAKAZI TERMIN</a></button>";
                }
            ?>

            
        </div>
    </div>
</div>
</div>