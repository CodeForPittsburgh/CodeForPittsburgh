<?php

include ('../setup.php');

$SQL = "select zone,count(zone)
from \"PoliceBlotter2\".incident
where incidentdate = '" . $yesterday . "'
group by zone
order by zone;";

$result = pg_query($dbconn, $SQL);

$rowcount = 0;
$zone[] = array();
$zonecounts[] = array();
while ($row = pg_fetch_row($result)) {

    $zone[$rowcount] = $row[0];
    $zonecounts[$rowcount] = $row[1];


    $rowcount++;
}
$arrlength = count($zone);
if ($arrlength < 6) {
    echo '<p><b>Warning: Incomplete Data Load: ' .$arrlength . '</b></p>';
} else {
    echo '<p>Normal Data Load</p>';
}

//        for ($x = 0; $x < $arrlength; $x++) {
//            echo $zone[$x] . " " . $zonecounts[$x];
//            echo "<br>";
//        }

pg_close();
