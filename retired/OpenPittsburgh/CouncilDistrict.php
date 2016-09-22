<?php

 
include ('../setup.php');
$SQL = 'SELECT council, councilman FROM "PoliceBlotter2".testdistrict3 order by council';
$result = pg_query($dbconn, $SQL);

StartForm3();
//BeginIncidentTable();
$count = 1;
while ($row = pg_fetch_row($result)) {
    //$incidentnumber = $row[2];
    //Descriptiondata();
    //print $row[0] . ' ' . $row[1] . ' '.$row[2] . '</br>'; 
    //PopulateIncidentTable($row);
    BuildOptions3($row);
    $count++;
}

//EndIncidentTable();
//BuildOptions();
EndForm3();

function StartForm3() {
    //echo '<p>Select an Incident Description.</p>';
    echo '<form>';
    echo '<select id="CouncilDistrict">';
}

function EndForm3() {
    echo ' </select>';
    echo ' ';
    echo '<input type="button" value="Add" onclick="AddParm(\'CouncilDistrict\')">';
    echo '<input type="button" value="Submit" onclick="createURLBulkCall(\'CouncilDistrict\')" >';
    echo ' </form>';
}

function BuildOptions3($values) {

    echo '<option value=' . $values[0] . '>' . $values[0] . " " .$values[1] . '</option>';
}

//echo json_encode($names);

/* close connection */
pg_close();



