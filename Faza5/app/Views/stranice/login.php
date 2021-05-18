<!--Filip Kojic 0285/2018 -->
<div class col-lg-10 col-md-10 right>
             <div class = "container right" style = "margin-left: 200px">
                <form name="loginform"  action="<?= site_url("Gost/loginSubmit") ?>" method="post">
                  <div class="form-group">
                    <label for="usernamelabel">Korisnicko ime:</label>
                    <input type="text" class="form-control" name = "username" id="username" value="<?= set_value('username') ?>" placeholder = "Korisnicko ime...">
                </div>
                <div class="form-group">
                    <label for="passwordlabel">Sifra:</label>
                    <input type="password" class="form-control" name = "password" id="password" placeholder = "Sifra...">
                </div>
                <button type="submit" class="btn btn-secondary">Uloguj se</button>
                </form>
                <font color='red'><?php if(isset($poruka)) echo " </br><font color='red' size = 5px>$poruka</font>"; ?></font></td>
                <font color='red'> <?php if(!empty($errors['password'])) echo $errors['password'];?></font></td>
             </div>
           </div>
        </div>