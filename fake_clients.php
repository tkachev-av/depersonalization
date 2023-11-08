<?php

$razdelitel = "";
require_once "generate_clients.php";

echo "<div style='overflow-x: visible;'>";
echo "<table border='0'>";
$first_row = true;

foreach ($massiv as $row)
{
    echo "<tr>";
    foreach ($row as $cell)
    {
//        if ($first_row)
//        {
//            echo "<td style='white-space: nowrap;'>$razdelitel$cell</td>";
//        }
        echo "<td style='white-space: nowrap;'>$razdelitel$cell</td>";
    }
    echo "</tr>";
    $first_row = false;
}
echo "</table>";
echo "</div>";