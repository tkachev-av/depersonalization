<?php


require_once "RndClient.php";
$RndClient = new RndClient();
$massiv = array();
$razd = "";
//$razdelitel = "|";

for ($stroka = 0; $stroka < 100; $stroka++)
{
    if ($stroka == 0) $id = "id пациента";
    else $id = $RndClient->getId();
    $massiv[$stroka][0] = $id . $razd;

    if ($stroka == 0) $card_id = "Номер карты";
    else $card_id = $RndClient->getCardNum();
    $massiv[$stroka][1] = $card_id . $razd;

    /**
     * true - М
     * false - Ж
     */
    $gender = rand(true, false);

    if ($stroka == 0) $fam = "Фамилия";
    else  $fam = $RndClient->getFam($gender);
    $massiv[$stroka][2] = $fam . $razd;

    if ($stroka == 0) $name = "Имя";
    else $name = $RndClient->getName($gender);
    $massiv[$stroka][3] = $name . $razd;

    if ($stroka == 0) $ot = "Отчество";
    else $ot = $RndClient->getOt($gender);
    $massiv[$stroka][4] = $ot . $razd;

    if ($stroka == 0) $doc = "Документ";
    else $doc = $RndClient->getDocument();
    $massiv[$stroka][5] = $doc . $razd;

    if ($stroka == 0) $doc_ser = "Серия";
    else $doc_ser = $RndClient->getDocumentseries();
    $massiv[$stroka][6] = $doc_ser . $razd;

    if ($stroka == 0) $doc_num = "Номер документа";
    else $doc_num = $RndClient->getDocumentnumber();
    $massiv[$stroka][7] = $doc_num . $razd;

    if ($stroka == 0) $date_birth = "Дата рождения";
    else $date_birth = $RndClient->getDateofbirth();
    $massiv[$stroka][8] = $date_birth . $razd;

    if ($stroka == 0) $phone = "Телефон";
    else $phone = $RndClient->getPhone();
    $massiv[$stroka][9] = $phone . $razd;

    if ($stroka == 0) $email = "Почта";
    else $email = $RndClient->getEmail();
    $massiv[$stroka][10] = $email . $razd;

    if ($stroka == 0) $p_status = "Статус пациента";
    else $p_status = $RndClient->getPatientstatus();
    $massiv[$stroka][11] = $p_status . $razd;

    if ($stroka == 0) $lonely = "Связь с другим пациентом";
    else $lonely = $RndClient->isLonely();
    $massiv[$stroka][12] = $lonely . $razd;

    if ($stroka == 0) $reg_date = "Дата регистрации";
    else $reg_date = $RndClient->getRegistrationdate();
    $massiv[$stroka][13] = $reg_date . $razd;

    if ($stroka == 0) $country = "Страна";
    else $country = $RndClient->getCountry();
    $massiv[$stroka][14] = $country . $razd;

    if ($stroka == 0) $adress = "Регион, город, улица, дом";
    else $adress = $RndClient->getRegion();
    $massiv[$stroka][15] = $adress . $razd;

//    if($stroka == 0)
//    else $massiv[$stroka][15] = $RndClient->getRegion() . $razd;
//
//    if($stroka == 0)
//    else $massiv[$stroka][16] = $RndClient->getCity() . $razd;
//
//    if($stroka == 0)
//    else $massiv[$stroka][17] = $RndClient->getStreet() . $razd;

    if ($stroka == 0) $gender = "Пол";
    else $gender = $RndClient->getGender($gender);
    $massiv[$stroka][18] = $gender . $razd;

    if ($stroka == 0) $place_birth = "Место рождения";
    else $place_birth = $RndClient->getPlaceofbirth();
    $massiv[$stroka][19] = $place_birth . $razd;

    if ($stroka == 0) $referral_s = "Откуда узнал";
    else $referral_s = $RndClient->getReferralsource();
    $massiv[$stroka][20] = $referral_s . $razd;

    if ($stroka == 0) $referral_doct = "Врач, от которого узнал";
    else $referral_doct = $RndClient->getReferringdoctor();
    $massiv[$stroka][21] = $referral_doct . $razd;

//        $massiv[$stroka][18] = $RndClient->() . $razd;
}

//echo "<table border='0'>";
//foreach ($massiv as $row) {
//    echo "<tr>";
//    foreach ($row as $cell) {
//        echo "<td>$cell</td>";
//    }
//    echo "</tr>";
//}
//echo "</table>";


//print($massiv[10][10]);
//print(count($massiv));
//var_dump($massiv[0]);
//print(count($massiv[0]));

//print($massiv);

