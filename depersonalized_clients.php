<?php

$razdelitel = "";
require_once "generate_clients.php";

echo "<div style='overflow-x: visible;'>";
echo "<table border='0'>";
$first_row = true;
sleep(1);

foreach ($massiv as $row)
{
    echo "<tr>";
    foreach ($row as $cell)
    {
        echo "<td style='white-space: nowrap;'>$cell$razdelitel</td>";
    }
    echo "</tr>";
    $first_row = false;
}
echo "</table>";
echo "</div>";