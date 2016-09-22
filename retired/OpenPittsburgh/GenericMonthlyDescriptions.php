<!DOCTYPE html>
<html>
    <head>
        <title>Police Blotter Monthly Description Totals</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
//zone
//neighborhood
//councildistrict
$column = "column";
$sql_column = filter_input(INPUT_GET, $column, FILTER_SANITIZE_STRING);
//print_r($sql_column);
//echo "</br>";
if ($sql_column === "") {
//$sql_column ="zone";
}
if ($sql_column === false) {
    
}
if ($sql_column === null) {
    //echo "sql_column is null\n";
    //echo "</br>";
    $sql_column = "neighborhood";
}
if (isset($sql_column)) {
    
}
if (!empty($sql_column)) {
    
}
$sql = 'SELECT 
        d.' . $sql_column . ',d.Year, d.Section, d.description,
        SUM(CASE WHEN Month = 01 THEN Transactions ELSE 0 END) AS Jan,
        SUM(CASE WHEN Month = 02 THEN Transactions ELSE 0 END) AS Feb,
        SUM(CASE WHEN Month = 03 THEN Transactions ELSE 0 END) AS Mar,
        SUM(CASE WHEN Month = 04 THEN Transactions ELSE 0 END) AS Apr,
        SUM(CASE WHEN Month = 05 THEN Transactions ELSE 0 END) AS May,
        SUM(CASE WHEN Month = 06 THEN Transactions ELSE 0 END) AS Jun,
        SUM(CASE WHEN Month = 07 THEN Transactions ELSE 0 END) AS Jul,
        SUM(CASE WHEN Month = 08 THEN Transactions ELSE 0 END) AS Aug,
        SUM(CASE WHEN Month = 09 THEN Transactions ELSE 0 END) AS Sep,
        SUM(CASE WHEN Month = 10 THEN Transactions ELSE 0 END) AS Oct,
        SUM(CASE WHEN Month = 11 THEN Transactions ELSE 0 END) AS Nov,
        SUM(CASE WHEN Month = 12 THEN Transactions ELSE 0 END) AS Dec,
         SUM(Transactions) AS Total

   FROM ( 
         SELECT 
i.' . $sql_column . ',
de.section,
de.description,
                DATE_PART(\'year\', i.incidentdate) as Year,
                DATE_PART(\'month\', i.incidentdate) as Month,
                COUNT(*) as Transactions
           
           from "PoliceBlotter2".description de, "PoliceBlotter2".incident i
where de.descriptionid = i.descriptionid
          GROUP BY 
          i.' . $sql_column . ',
          de.section,
          de.description,
                   DATE_PART(\'year\', i.incidentdate),
                   DATE_PART(\'month\', i.incidentdate)
        ) d
  GROUP BY 
  d.' . $sql_column . ',
           d.Year,
           d.section,
           d.description

  ORDER BY 
           d.' . $sql_column . ',d.Year desc,d.description';

//echo $sql;
//echo "</br>";

$result = pg_query($dbconn, $sql);
BeginIncidentTable($sql_column);

while ($row = pg_fetch_row($result)) {
    //print $row[0] . ' ' . $row[1] . ' '.$row[2] . '</br>'; 
    PopulateIncidentTable($row);
}

EndIncidentTable();

function BeginIncidentTable($sql_column) {
    if($sql_column === "neighborhood")
    {
        $sql_column = "Neighborhood";
                
    }
    if($sql_column === "councildistrict"){
        $sql_column = "Council District";
    }
    if($sql_column === "zone"){
        $sql_column = "Police Zone";
    }
    /* Display the beginning of the search results table. */
    $headings = array($sql_column, "Year", "Section", "Description", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "Count");
    echo "<table class='sortable' align='center' cellpadding='5' border=1>";
    echo "<tr>";
    foreach ($headings as $heading) {
        echo "<th>$heading</th>";
    }
    echo "</tr>";
}

function PopulateIncidentTable($values) {
    /* Populate table with results. */
    echo "<tr>";
    foreach ($values as $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";
}

function EndIncidentTable() {
    echo "</table><br/>";
}
