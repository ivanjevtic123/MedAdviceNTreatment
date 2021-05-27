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
    <link rel="stylesheet" href="/fajlovi/odobravanjeZahteva.css">
    <link rel="stylesheet" href="/fajlovi/newKarton.css">
    <script src="/fajlovi/bootstrap.min.js"></script>

   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/fajlovi/zakazivanjeTermina.js"></script>



</head>
<body>
    <div class="container-fluid">
        <!-- Header -->
        <div class="row" id="header">
            <div class="col-sm-12">
                <nav class="navbar navbar-expand-sm">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("Pacijent/index")?>">POCETNA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("Pacijent/services")?>">USLUGE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("Pacijent/noviKarton")?>">PREGLED KARTONA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("Pacijent/oceni")?>">MOJI LEKARI</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("Pacijent/promenaLozinke")?>">PROMENI LOZINKU</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("Pacijent/logout")?>">LOGOUT</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="row">
            <!-- Left Div -->