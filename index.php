<?php
{
    $flag_dev = false;
    if ($flag_dev)
    {
        $text = "depersonalization";
        $text .= mt_rand(1, 100);
        $text .= " <br>";
        $text .= date("F j, Y, g:i a");
        echo "$text";
        echo "<BR>";
        echo "v.1.0";
        echo "<BR>";
    }

    $CONTENT = file_get_contents("index.html");


    require_once __DIR__ . DIRECTORY_SEPARATOR . "show_clients.php";
    $price = $Result;
    $CONTENT = str_replace("[%CLIENTS%]", $price, $CONTENT);

//    ===============================
    echo $CONTENT;
}