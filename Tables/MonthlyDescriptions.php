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
include ('../includes/setup.php');


$sql = 'SELECT 
        d.Year, d.Section, d.description,
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
de.section,
de.description,
                DATE_PART(\'year\', i.incidentdate) as Year,
                DATE_PART(\'month\', i.incidentdate) as Month,
                COUNT(*) as Transactions
           
           from "PoliceBlotter2".incident i,"PoliceBlotter2".description de
where de.descriptionid = i.descriptionid
          GROUP BY 
          de.section,
          de.description,
                   DATE_PART(\'year\', i.incidentdate),
                   DATE_PART(\'month\', i.incidentdate)
        ) d
  GROUP BY 
           d.Year,
           d.section,
           d.description

  ORDER BY 
           d.Year desc,d.description';

$result = pg_query($dbconn, $sql);
BeginIncidentTable();

while ($row = pg_fetch_row($result)) {
    //print $row[0] . ' ' . $row[1] . ' '.$row[2] . '</br>'; 
    PopulateIncidentTable($row);
}

EndIncidentTable();

function BeginIncidentTable() {
    /* Display the beginning of the search results table. */
    $headings = array("Year", "Section", "Description", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "Count");
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
