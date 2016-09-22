<html>
    <head>
        <title>Police Blotter Yesterday Description Totals</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../img/myicon.png">
    </head>
</html>

<?php
include ('../setup.php');

global $total;
global $count;
$count = 0;
$total = 0;

$sql = 'select incidentdate, count(incidentdate) from "PoliceBlotter2".incident
group by incidentdate
order by incidentdate desc';


$result = pg_query($dbconn, $sql);
BeginIncidentTable();

while ($row = pg_fetch_row($result)) {
    //print $row[0] . ' ' . $row[1] . ' '.$row[2] . '</br>'; 
    PopulateIncidentTable($row);
}

EndIncidentTable();
IncidentTotals();

function BeginIncidentTable() {
    /* Display the beginning of the search results table. */
    $headings = array("Incident Date", "Count");
    echo "<table align='center' cellpadding='5' border=1>";
    echo "<tr>";
    foreach ($headings as $heading) {
        echo "<th>$heading</th>";
    }
    echo "</tr>";
}

function PopulateIncidentTable($values) {
    global $count;
    global $total;
    /* Populate table with results. */
    echo "<tr>"; {
        //echo "<td><a href='PPBCreateMarkerFile.php?incidentdate=$values[0]'>$values[0]</a></td>";
        echo "<td><a href='PPBXMLAddressMarkerCreate.php?incidentdate=$values[0]'>$values[0]</a></td>";
        //echo "<td><a href='PoliceBlotterCreateJSONFile.php?incidentdate=$values[0]'>$values[0]</a></td>";
        echo "<td>$values[1]</td>";
        $count++;
        $total = $total + $values[1];
    }
    echo "</tr>";
    //echo $count;
    //echo $total;
}

function EndIncidentTable() {
    //global $count;
    //global $total;
    echo "</table><br/>";
//    echo "Count " . $count . "<br/>";
//    echo "Total " . $total . "<br/>";
//    $average = $total / $count;
//    echo "Average ". $average . "<br/>";
}

function IncidentTotals() {
    global $count;
    global $total;
    $count = $count / 2;
    $total = $total / 2;
    $headings1 = array("Description", "Count");
    echo "<table align='center' cellpadding='5' border=1>";
    echo "<tr>";
    foreach ($headings1 as $heading) {
        echo "<th>$heading</th>";
    }
    echo "</tr>";
    echo "<tr>";
    echo "<td>Count</td>";
    echo "<td>$count</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Total</td>";
    echo "<td>$total</td>";
    echo "</tr>";
    $average = $total / $count;
    echo "<tr>";
    echo "<td>Average</td>";
    echo "<td>$average</td>";
    echo "</tr>";
    echo "</table>";
}
