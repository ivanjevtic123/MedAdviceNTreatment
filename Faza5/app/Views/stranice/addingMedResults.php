<!-- Ivan Jevtic 0550/2018 ['pacijent' => $pacijent, 'termini' => $termini]);-->
<div class="col-lg-9 col-md-10 right">
    <div class='offset-sm-2 col-sm-6 text-center'>
        <form name="medicalFinding" action="<?= site_url("Lekar/addingMedResultsSubmit/{$pacijent->IdK}") ?>" method="post" enctype= "multipart/form-data">
            <h2>DODAVANJE NALAZA</h2>
            <table class="table">
                <tr>
                    <select name="dateNTime" id="speciality">
                        <?php
                            foreach($termini as $termin) {
                                if($termin != null){
                                    echo "<option name='{$termin->DatumIVreme}'>{$termin->DatumIVreme}</option>";
                                }
                            }
                        ?>
                    </select>
                </tr>
                <tr>
                    <td>Tekst nalaza:</td>
                    <td>
                        <textarea id="resultText" name="resultText" rows="10" cols="50" placeholder="Tekst nalaza..." value="<?= set_value('resultText') ?>"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Snimak:</td>
                    <td>
                        <!-- <input type="file" id="img" name="img" accept="image/*"> -->
                        <input type="file" id="imgMed" name="imgMed">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <button type="submit" class="btn btn-secondary">Dodaj</button>
                    </td>
                </tr>
            </table>
        </form>
        <font color='red'><?php if(isset($poruka)) echo " </br><font color='red' size = 5px>$poruka</font>"; ?></font>
    </div>
</div>
</div>