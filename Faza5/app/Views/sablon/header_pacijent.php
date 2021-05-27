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