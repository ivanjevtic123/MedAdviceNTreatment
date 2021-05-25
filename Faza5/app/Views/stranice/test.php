<?php
/**
 * @author Filip Kojic 0285/2018
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedAdviceNTreatment</title>
    <link rel="stylesheet" type="text/css" href="/fajlovi/bootstrap.min.css">
    <link rel="stylesheet" href="/fajlovi/style1.css">
    <link rel="stylesheet" href="/fajlovi/style_services.css">
    <script src="/fajlovi/bootstrap.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <!-- Header -->
        <div class="row" id="header">
            <div class="col-sm-12">
                <nav class="navbar navbar-expand-sm">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("#")?>">POCETNA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("#")?>">USLUGE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("Gost/login")?>">LOGIN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("#")?>">REGISTRACIJA</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="row">
            <!-- Left Div -->
           
            <!-- Left Div -->
            <div class="col-lg-2 col-md-2 left">
                <img src="/pictures/logo.png">
            </div>

            <!-- Right Div -->
<div class="col-lg-8 col-md-8 right">
                <h1 id="wellcomeMsg">Dobrodošli</h1>
                 <div class="alert alert-warning alert-dismissible ">
 <button type="button" class="close" datadismiss="alert">&times;</button>
 Kako biste mogli da zakažete termin i ostvarite medicinski tretman neophodno je da <br>
 popunjavanjem sledeće kreirate karton!
 <br>
 U polja koja biste ostavili prazna upišite- "/"
</div>   

  

            </div>
            </div>

            <div class="row">
            <div class="col-sm-12 footer lightbluebg">
                All rights reserved: FifoDevTeam
            </div>
        </div>
    </div>
</body>
</html>