        <!-- Right Div -->
        <div class="col-lg-4 col-md-4 offset-2 right">
               <br>
               <br>
     
               <form action="<?= site_url("$controller/zakaziTerminSubmit") ?>" method="post" >
<table class="table table-light table-striped" cellspacing="15px" >
    <tr>
  <!-- <?php echo json_encode($vremena); ?>;-->
   <script>var times = <?php echo json_encode($vremena); ?>; </script>
        <td>Datum termina:</td>
        <td>
        <input   name="datumSubmit" id="dateExam" type="date" >
        </td>
        </tr>
        <tr>
        <td>Vreme termina:</td>
    
        <td>
        
       
            <select name="timeOfExam" id="fromTimeOfExam">
                <?php 
              
               
                $moguci=[];
                for($i=0;$i<2;$i++){
                    for($j=0;$j<10;$j++){
                    array_push($moguci,"$i$j");
                    
                    }  
                }
                array_push($moguci,"20");
                array_push($moguci,"21");
                array_push($moguci,"22");
                array_push($moguci,"23");
                foreach($moguci as $moguc){
                   
                        echo "<option> $moguc </option>";
                    
                }
                
                ?>
                
              </select>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center"> <input class="btn btn-secondary" type="submit" id="dugmeZakazi"value="Zakazi termin"></input>
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