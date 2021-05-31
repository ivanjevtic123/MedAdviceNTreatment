<!-- Ivan Jevtic 0550/2018 $doctors-->
<div class="col-lg-9 col-md-10 right" style="margin-top: 15px;margin-bottom: 15px;">
    <div class='offset-sm-2 col-sm-8 text-center' id="doctorsList">
        <div id="sort">
            <font size = 5px>Sortiranje(cena):</font>
            </br>
            <form name="sortForm" action="<?= site_url("{$controller}/doctorsListSorted/{$IdU}") ?>" method="post">
                &nbsp;
                <select name="sort" id="sort">
                    <option value="descending">Opadajuće</option>
                    <option value="ascending">Rastuće</option>
                </select>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-secondary">Sortiraj</button>
            </form>
        </div>
        <!-- Divovi koje getujem iz PHP -->
        <?php
            // Ako nema doktora
            if(sizeof($doctors) == 0) {
                echo "<font color='red'><br/><font color='red' size = 5px>Nema dostupnih lekara za datu uslugu</font></font>";
            }

            foreach($doctors as $doctor) {
                if($doctor != null){
					if($doctor->BrojOcena == 0) {
                        $rate = 0;
                    } else {
                        $rate = $doctor->ZbirOcena / $doctor->BrojOcena;
                        $rate = round($rate, 2);
                    }
                    echo "<div class='container'>
                    <div class='row'>
                        <div class='col-xs-6'>
                            <a href='../doctorProfile/{$doctor->IdK}/{$IdU}/{$doctor->Cena}'><img style='height: 300px; margin-top: 15px; margin-bottom: 15px; justify-content: space-around; text-align: left;' src='{$doctor->Slika}'></a>
                        </div>
                        <div class='col-xs-6'>
                            <table class='table' style='text-align: right;margin-top: 14px;'>
                                <tr>
                                    <td><h6>{$doctor->Specijalnost}</h6></td>
                                    <td><h6>Dr {$doctor->Prezime}&nbsp;{$doctor->Ime}</h6></td>
                                </tr>
                                <tr>
                                    <td>Ocena:</td>
                                    <td id='ocenaDr'>{$rate}</td>
                                </tr>
                                <tr>
                                    <td>Cena(rsd):</td>
                                    <td id='cenaDr'>{$doctor->Cena}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>";




                }
            }
        ?>
        


    </div>
</div>
</div>