<?php
    // je recupere le JSON
    @$json = file_get_contents('vacanceZoneC.json');
    if ($json === false) {
        echo 'erreur technique';
        exit;
    }

    //je le transforme en tableau
    $vacanceZoneC = json_decode($json, true);
    $dateDebut = [];
    foreach ($vacanceZoneC as $value) {
       array_push($dateDebut,($value['start_date']));
    }
    
?>