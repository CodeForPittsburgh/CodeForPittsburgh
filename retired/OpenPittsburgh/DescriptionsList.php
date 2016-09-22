<!DOCTYPE html>
<html>
    <head>
        <title>Police Blotter Description Totals</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="icon" href="../img/myicon.png">
        <script src="../js/sorttable.js"></script>
        <style type="text/css">/* Sortable tables */
            table.sortable thead {
                background-color:#eee;
                color:#666666;
                font-weight: bold;
                cursor: default;
            }</style>
    </head>
</html>

<?php
include ('../setup.php');
$sqlmin = 'select min(incidentdate) mindate,max(incidentdate)maxdate
from "PoliceBlotter2".incident';
$resultmin = pg_query($dbconn, $sqlmin);
while ($rowmin = pg_fetch_row($resultmin)) {
    //print $row[0] . ' ' . $row[1] . ' '.$row[2] . '</br>';

    $MinDate = $rowmin[0];
    $MaxDate = $rowmin[1];
}

$sql = 'select d.section,d.description,count(i.descriptionid) incident_count
from "PoliceBlotter2".incident i,"PoliceBlotter2".description d
where d.descriptionid = i.descriptionid
--and id.descriptionid in(2118,2139,2119,2121,2132,2122,2148,2166,2115,2129)
group by d.section,d.description,i.descriptionid
order by d.description';
//echo $sql;

$result = pg_query($dbconn, $sql);
BeginIncidentTable($MinDate, $MaxDate);

while ($row = pg_fetch_row($result)) {
    //print $row[0] . ' ' . $row[1] . ' '.$row[2] . '</br>'; 
    PopulateIncidentTable($row);
}

EndIncidentTable();

function BeginIncidentTable($MinDate, $MaxDate) {
    $names = array(
        "Section ",
        "Description Data from   $MinDate  to   $MaxDate  ",
        "Count"
    );
    //echo json_encode($names);
    //print_r($names);

    /* Display the beginning of the search results table. */
    //$headings = $names;
    //$msg = "Description Data from " . $MinDate . " to " . $MaxDate;
    //$headings = array("Section", $msg,"Count");
    echo "<table class='sortable' align='center' cellpadding='5' border=1>";
    echo "<tr>";
    foreach ($names as $heading) {
        echo "<th>$heading</th>";
    }
    echo "</tr>";
}

function PopulateIncidentTable($values) {
    /* Populate table with results. */
    echo "<tr>";
    //foreach ($values as $value) {       
    echo "<td><a href='PPBXMLAddressMarkerCreateTest.php?section=$values[0]'>$values[0]</a></td>";
    echo "<td>$values[1]</td>";
    echo "<td>$values[2]</td>";
    //}
    echo "</tr>";
}

function EndIncidentTable() {
    echo "</table><br/>";
}
