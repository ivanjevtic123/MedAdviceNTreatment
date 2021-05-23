            <!-- Filip Zaric 0345/2018 -->
            <!-- Right Div -->
   
            <div class="col-lg-4 col-md-4 right">
    

                <br>
                <form name="loginform"  action="<?= site_url("Pacijent/noviKartonSubmit") ?>" method="post">
<table cellpadding="20px">
    <tr>
        <td>Krvna grupa:</td>
        <td> <input type="text" name="krvnaGrupa" placeholder="Krvna grupa...">  </td>
    </tr>
    <tr>
        <td>Istorija bolesti:</td>
        <td> <textarea name="istorijaBolesti" id="" cols="30" rows="6" placeholder="Istorija bolesti..."></textarea> </td>
    </tr>
    <tr>
        <td>Hronicne bolesti:</td>
        <td> <textarea name="hronicneBolesti" id="" cols="25" rows="3" placeholder="Hronicne bolesti..."></textarea> </td>
    </tr>
</table>


            </div>
            <div class="col-lg-4 col-md-4 right">
<table cellpadding="20px">
    <tr>
        <td padding-top="0px">Zarazne bolesti:</td>
        <td> <textarea name="zarazneBolesti" id="" cols="25" rows="3" placeholder="Zarazne bolesti..."></textarea></td>
    </tr>
    <tr>
        <td>Lekovi na koje ima alergijsku reakciju:</td>
        <td>  <textarea name="lekoviReakcija" id="" cols="25" rows="3" placeholder="Lekovi na koje ima alergijsku reakciju..."></textarea></td>
    </tr>
    <tr>
        <td>Prethodni hirurski zahvati:</td>
        <td> <textarea name="hirurskiZahvati" id="" cols="25" rows="3" placeholder="Prethodni hirurski zahvati..."></textarea></td>
    </tr>
    <tr>
        <td align="center" colspan="2"> <button class="btn btn-secondary" type="submit">Predaj</button> 
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
        