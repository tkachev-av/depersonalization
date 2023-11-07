<?php


    require_once "RndClient.php";
    $RndClient = new RndClient();

    for ($i = 1; $i <= 100; $i++)
    {
        echo($RndClient->getFam() . " " . $RndClient->getName() . " " . $RndClient->getOt() .
            $RndClient->getDocument() . $RndClient->getDocumentseries() . $RndClient->getDocumentnumber() .
            $RndClient->getDateofbirth() . $RndClient->getPhone() . $RndClient->getEmail() .
            $RndClient->getPatientstatus() . $RndClient->isLonely() . $RndClient->getRegistrationdate() .
            $RndClient->getCountry() . $RndClient->getRegion() . $RndClient->getCity() .
            "<BR><BR>");

    }

    $massiv2 = array();
