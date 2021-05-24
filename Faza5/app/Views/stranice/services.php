<!-- Ivan Jevtic 0550/2018 -->
<div class="col-lg-9 col-md-9 right">
    <div class='offset-sm-2 col-sm-6 text-center'>
        <table class="table">
            <?php 
            foreach($usluge as $usluga) {
                if($usluga != null){
                    echo "<tr><td><button style='width:500px' type='submit' class='btn btn-info'><a href='Gost/doctorsList/{$usluga->IdU}'>{$usluga->Naziv}</a></button></td></tr>";
                }
            }
            ?>
            
        </table>
    </div>
</div>
</div>