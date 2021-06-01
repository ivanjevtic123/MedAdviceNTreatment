<!-- Ivan Jevtic 0550/2018 -->
<div class="col-lg-8 col-md-8 right">
    <div class='offset-sm-3 col-sm-4 text-center'>
        <?php 
        if(isset($poruka) && ($poruka == "Uspesno ste poslali zahtev za registraciju")) echo " </br><font color='green' size = 5px>$poruka</font><br/><br/>";
        ?>
        <form name="registerForm" action="<?= site_url("Gost/registerSubmit") ?>" method="post" enctype= "multipart/form-data">
            <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REGISTRACIJA</h2>
            <table class="table" id="registerTable">
                <tr>
                    <td>Ime:</td>
                    <td>
                        <input type="text" name="name" placeholder="Ime..." value="<?= set_value('name') ?>">
                    </td>
                </tr>
                <tr>
                    <td>Prezime:</td>
                    <td>
                        <input type="text" name="surname" placeholder="Prezime..." value="<?= set_value('surname') ?>">
                    </td>
                </tr>
                <tr>
                    <td>Korisničko ime:</td>
                    <td>
                        <input type="text" name="username" placeholder="Korisničko ime..." value="<?= set_value('username') ?>">
                    </td>
                </tr>
                <tr>
                    <td>E-pošta:</td>
                    <td>
                        <input type="text" name="mail" placeholder="E-pošta..." value="<?= set_value('mail') ?>">
                    </td>
                </tr>
                <tr>
                    <td>Datum rođenja:</td>
                    <td>
                        <input type="date" name="dateOfBirth" value="<?= set_value('date') ?>">
                    </td>
                </tr>
                <tr>
                    <td>Mesto rođenja:</td>
                    <td>
                        <input type="text" name="placeOfBirth" placeholder="Mesto rođenja..." value="<?= set_value('placeOfBirth') ?>">
                    </td>
                </tr>
                <tr>
                    <td>Mesto prebivalista:</td>
                    <td>
                        <input type="text" name="placeOfLiving" placeholder="Mesto prebivalista..." value="<?= set_value('placeOfLiving') ?>">
                    </td>
                </tr>
                <tr>
                    <td>Adresa prebivalista:</td>
                    <td>
                        <input type="text" name="adressOfLiving" placeholder="Adresa prebivalista..." value="<?= set_value('adressOfLiving') ?>">
                    </td>
                </tr>
                <tr>
                    <td>JMBG:</td>
                    <td>
                        <input type="text" name="jmbg" placeholder="JMBG..." value="<?= set_value('jmbg') ?>">
                    </td>
                </tr>
                <tr>
                    <td>Pol:</td>
                    <td>
                        <input type="radio" id="Man" name="gender" value="M">
                        <label for="M">Muški</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" id="Z" name="gender" value="Z">
                        <label for="Z">Ženski</label>
                    </td>
                </tr>
                <tr>
                    <td>Lozinka:</td>
                    <td>
                        <input type="password" name="password" placeholder="Lozinka...">
                    </td>
                </tr>
                <tr>
                    <td>Potvrda lozinke:</td>
                    <td>
                        <input type="password" name="passAgain" placeholder="Potvrda lozinke...">
                    </td>
                </tr>
                <tr>
                    <td>Kategorija:</td>
                    <td>
                        <input type="radio" id="P" name="category" value="P">
                        <label for="P">Pacijent</label><br>
                        <input type="radio" id="L" name="category" value="L">
                        <label for="L">Lekar</label><br>
                        <input type="radio" id="M" name="category" value="M">
                        <label for="M">Menadžer</label>
                    </td>
                <tr class="sakrivanje">
                    <td>Specijalnost(lekar):</td>
                    <td>
                        <select name="speciality" id="speciality">
                        <?php
                            foreach($usluge as $usluga) {
                                if($usluga != null){
                                    echo "<option name='{$usluga->Naziv}'>{$usluga->Naziv}</option>";
                                }
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr class="sakrivanje">
                    <td>Rezime(lekar):</td>
                    <td>
                        <textarea id="resume" name="resume" rows="4" cols="50" placeholder="Rezime..." value="<?= set_value('resume') ?>"></textarea>
                    </td>
                </tr>
                <tr class="sakrivanje">
                    <td>Slika(lekar):</td>
                    <td>
                        <!-- <input type="file" id="img" name="img" accept="image/*"> -->
                        <input type="file" id="img" name="img">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <button type="submit" class="btn btn-secondary">Dodaj</button>
                    </td>
                </tr>
                </tr>
                
            </table>
        </form>
        <font color='red'>
        <?php 
        if(isset($poruka) && ($poruka != "Uspesno ste poslali zahtev za registraciju")) echo " </br><font color='red' size = 5px>$poruka</font>"; 
        
        ?>
        </font>

    </div>
</div>
</div><!--Div koji zatvara glavni -->