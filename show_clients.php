<?php
{
    $flag_dev=false;
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
    if ($flag_dev)
    {
        echo "<BR><BR>";
        echo "origClients (первые 250)";
        echo "<BR>";
        echo substr($origClients, 0, 250) . "...";
    }

    echo $origClients;
    $Result=$origClients;
}