<?php
/**
 * @author Filip Kojic 0285/2018
 */
?>
<?php
/**
 * @author Filip Zaric 0345/2018
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedAdviceNTreatment</title>
    <!-- <link rel="stylesheet" type="text/css" href="/fajlovi/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/fajlovi/style1.css">
    <link rel="stylesheet" href="/fajlovi/style_services.css">
    <!-- <link rel="stylesheet" href="/fajlovi/odobravanjeZahteva.css"> -->
    <!-- <script src="fajlovi/bootstrap.min.js"></script> -->
    <script src="/fajlovi/skript_prikazKartona.js"></script>
</head>
<body>
    <div class="container-fluid">
        <!-- Header -->
        <div class="row" id="header">
            <div class="col-sm-12">
                <nav class="navbar navbar-expand-sm">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("Lekar/index")?>">POCETNA</a>
                        </li>
                        <li class="nav-item" >
                            <a class="nav-link" href="<?= site_url("Lekar/services")?>">USLUGE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("Lekar/prikaziPacijente")?>">MOJI PACIJENTI</a>
                        </li>
                        <li class="nav-item" >
                            <a class="nav-link" href="<?= site_url("Lekar/promenaLozinke")?>">PROMENI LOZINKU</a>
                        </li>
                        <li class="nav-item" >
                            <a class="nav-link" href="<?= site_url("Lekar/logout")?>">LOGOUT</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Center -->
        <div class="row">
            <!-- Left Div -->
           