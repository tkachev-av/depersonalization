<?php
{
    $flag_dev = false;
    //============================================================================================
    $pathToOrigClients = __DIR__ . DIRECTORY_SEPARATOR . "source" . DIRECTORY_SEPARATOR . "clients50.csv";
    if ($flag_dev)
    {
        echo "path";
        echo "<BR>";
        echo $pathToOrigClients;
        echo "<BR>";
    }

    $origClients = file_get_contents($pathToOrigClients);
//    if ($flag_dev)
//    {
//        echo "<BR><BR>";
//        echo "origClients (первые 250)";
//        echo "<BR>";
//        echo substr($origClients, 0, 250) . "...";
//    }


//    require_once __DIR__ . DIRECTORY_SEPARATOR . "show_prices.php";
//    $price = $Result;

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


//    echo($RndClient->getFam() . " " . $RndClient->getName() . " " . $RndClient->getOt() . $RndClient->getDocument() . $RndClient->getDocumentseries() . $RndClient->getDocumentnumber() . $RndClient->getDateofbirth() . "\n\n");

//    echo $origClients;
//    $Result=$origClients;
}