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
    <link rel="stylesheet" type="text/css" href="/fajlovi/bootstrap.min.css">
    <link rel="stylesheet" href="/fajlovi/style1.css">
    <link rel="stylesheet" href="/fajlovi/style_services.css">
    <link rel="stylesheet" href="/fajlovi/odobravanjeZahteva.css">
    <link rel="stylesheet" href="promenaBoot.css">
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
                            <a class="nav-link" href="<?= site_url("Menadzer/index")?>">POCETNA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("Menadzer/services")?>">USLUGE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("Menadzer/ukloni")?>">UKLONI KORISNIKA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("Menadzer/zahtev")?>">ZAHTEVI</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("Menadzer/promenaLozinke")?>">PROMENI LOZINKU</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url("Menadzer/logout")?>">LOGOUT</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Center -->
        <div class="row">
            <!-- Left Div -->
           