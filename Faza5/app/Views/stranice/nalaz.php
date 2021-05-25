<?php
/**
 * @author Filip Kojic 0285/2018
 */
?>
<!-- Right Div -->
<div class="col-lg-8 col-md-8 right">
            <table class="table">
                <tr>
                   <td>Tekst nalaza:</td>
                    <td>
                     <textarea id="resultText" name="resultText" rows="10" cols="50" readonly><?php echo "$nalaz->TekstNalaza" ?></textarea>
                    </td>
                </tr>
                <tr>
                  <td>Snimak:</td>
                    <td>
                    <?php $filepath=$nalaz->Snimak; if (isset($filepath) && $filepath!=''){
                   echo "<img src= $filepath width = 300 height = 300>";
                    }
                    ?>
                   </td>
                  </tr>
            </table>
            </div>
            </div>