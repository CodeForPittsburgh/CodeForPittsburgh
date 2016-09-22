<html>
    <head>
        <title>Police Blotter Yesterday Description Totals</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../img/myicon.png">
    </head>
</html>

<?php
include ('../includes/setup.php');
$from = " from \"PoliceBlotter2\".incidentdescription id,\"PoliceBlotter2\".description d";
//$where = " where i.incidentnumber = id.incidentnumber
//and d.descriptionid = id.descriptionid
//and i.incidentdate ='" . $yesterday . "'";
$where = " where d.descriptionid = id.descriptionid and id.incidentdate ='" . $yesterday . "'";
$orderby = " order by incident_count desc ";
$groupby = " group by d.section,d.description,id.descriptionid";
//echo $yesterday;
//echo "\n";
$SQL = 'select distinct d.section,d.description,count(id.descriptionid) as incident_count' . $from . $where . $groupby . $orderby;
//echo $SQL;
$result = pg_query($dbconn, $SQL);


BeginDescriptionTable($yesterday);

while ($row = pg_fetch_row($result)) {
    //print $row[0] . ' ' . $row[1] . ' '.$row[2] . '</br>'; 
    PopulateDescriptionTable($row);
}

EndDescriptionTable();

function BeginDescriptionTable($yesterday) {
    /* Display the beginning of the search results table. */
    $description = "Descriptions for " . $yesterday;
    $headings = array("Section", $description, "Count");
    echo "<table align='center' cellpadding='5' border=1>";
    echo "<tr>";
    foreach ($headings as $heading) {
        echo "<th>$heading</th>";
    }
    echo "</tr>";
}

function PopulateDescriptionTable($values) {
    /* Populate table with results. */

    echo "<tr>";


        echo "<td> <button value=$values[0]>$values[0]</button></td>";
        echo "<td> $values[1]</td>";
        echo "<td> $values[2]</td>";
    
//    foreach ($values as $value) {
//        echo "<td>$value</td>";
//    }
    echo "</tr>";
}

function EndDescriptionTable() {
    echo "</table><br/>";
}
