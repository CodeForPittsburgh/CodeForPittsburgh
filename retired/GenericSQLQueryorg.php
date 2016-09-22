<?php

function build($section, $add) {

    include ('setup.php');


// Connect to the database
// connection String
//$dbconn = pg_connect('host=cfapghpoliceblotter.cnsbqqmktili.us-east-1.rds.amazonaws.com port=5432 dbname=CfAPGHPoliceBlotter user=cfapghpolicebltrrdr password=B10tt34RDR connect_timeout=60');
    $dbconn = pg_connect('host=' . $hostname . ' port=' . $port . ' dbname=' . $database . ' user=' . $username . ' password=' . $password . ' connect_timeout=' . $connect_timeout);
    /* fetch values */
//Description
    $SQLDescription = 'select section,description '
            . 'from "PoliceBlotter2".description '
            . 'order by description';
    $IDDescription = "Description";
    if ($section === "Description") {
        $SQL = $SQLDescription;
    }

//Neighborhood
    $SQLNeighborhood = 'select distinct neighborhood 
FROM "PoliceBlotter2".incident
order by neighborhood';
    $IDNeighborhood = "Neighborhood";
    if ($section === "Neighborhood") {
        $SQL = $SQLNeighborhood;
    }
//Police
    $SQLPoliceZone = 'select distinct zone
FROM "PoliceBlotter2".incident
order by zone;';
    $IDPoliceZone = "PoliceZone";
    if ($section === "PoliceZone") {
        $SQL = $SQLPoliceZone;
    }

    $SQLCouncilDistrict = 'SELECT council, councilman '
            . 'FROM "PoliceBlotter2".testdistrict3 '
            . 'order by council';
    $IDCouncilDistrict = "CouncilDistrict";
    if ($section === "CouncilDistrict") {
        $SQL = $SQLCouncilDistrict;
    }
//echo $SQL;
//echo "<br>";
    $result = pg_query($dbconn, $SQL);

    StartForm($section);
//BeginIncidentTable();
    $count = 1;
    while ($row = pg_fetch_row($result)) {
        //$incidentnumber = $row[2];
        //Descriptiondata();
        //print $row[0] . ' ' . $row[1] . ' '.$row[2] . '</br>'; 
        //PopulateIncidentTable($row);
        BuildOptions($row);
        $count++;
    }

//EndIncidentTable();
//BuildOptions();
    EndForm($add);
    pg_close();
}

function StartForm($section) {
    //echo '<p>Select an Incident Description.</p>';
    echo '<form>';
    echo '<select id=$section>';
}

function EndForm($add, $section) {
    echo ' </select>';
    echo ' ';
    //echo '<input type="submit">';
    if ($add === "true") {
        echo '<input type="button" value="Add" onclick="AddParm(\'$section\')">';
    }
    echo '<input type="button" value="Submit" onclick="createURLcall(\'$section\')" >';
    echo ' </form>';
}

function BuildOptions($values) {
    if (count($values) === 1) {
        echo '<option value=' . $values[0] . '>' . $values[0] . '</option>';
    } else {


        echo '<option value=' . $values[0] . '>' . $values[1] . '</option>';
    }
}

//echo json_encode($names);

/* close connection */
//pg_close();
