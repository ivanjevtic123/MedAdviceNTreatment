 <!-- Filip Zaric 0345/2018 -->
 <!-- Right Div -->

 <div class="col-lg-8 col-md-8 right">
   <form action="<?= site_url("$controller/promenaLozinkeObrada") ?>" name="formChange" method="post">
                <table class="table table-light table-striped">
                    <tr>
                        <td cellpadding="10px">Lozinka:</td>
                        <td><input type="password" name="staraLoz" id="" placeholder="Lozinka..."></td>
                    </tr>
                    <tr>
                        <td  cellpadding="10px">Nova lozinka:</td>
                        <td><input type="password" name="novaLoz1" id="" placeholder="Nova lozinka..."> </td>
                    </tr>
                    <tr>
                        <td  cellpadding="10px">Ponovite lozinku: </td>
                        <td><input type="password" name="novaLoz2" id="" placeholder="Ponovite lozinku..."></td>
                        
                        
                    </tr>
                    <tr>
                        <td colspan="2" align="center"> <input type="submit" value="Predaj">
                    <?php  
                    if(isset($vrsta) && $vrsta==1){
                        $color="green";

                    }  else $color="red";
                    ?>

                        <?php if(isset($poruka)) echo " </br><font color=$color size = 5px>$poruka</font>"; ?>
                        </td>
                    </tr>
                </table>
                </form>


            </div>
</div>
        