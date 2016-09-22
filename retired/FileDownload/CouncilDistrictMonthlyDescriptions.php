<!DOCTYPE html>
<html>
    <head>
        <title>Police Blotter Council District Monthly Description Totals</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/myicon.png">
        <script src="./js/sorttable.js"></script>
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
include ('connect.php');

// Connect to the database
// connection String
//$dbconn = pg_connect('host=cfapghpoliceblotter.cnsbqqmktili.us-east-1.rds.amazonaws.com port=5432 dbname=CfAPGHPoliceBlotter user=cfapghpolicebltrrdr password=B10tt34RDR connect_timeout=60');
$dbconn = pg_connect('host=' . $hostname . ' port=' . $port . ' dbname=' . $database . ' user=' . $username . ' password=' . $password . ' connect_timeout=' . $connect_timeout);

/*
 * select id.descriptionid,d.section,d.description,count(id.descriptionid) incident_count
  from "PoliceBlotter2".incidentdescription id,"PoliceBlotter2".description d
  where d.descriptionid = id.descriptionid
  --and id.descriptionid in(2118,2139,2119,2121,2132,2122,2148,2166,2115,2129)
  group by d.section,d.description,id.descriptionid
  order by d.section;
 */

$sql = 'SELECT 
        d.councildistrict,d.Year, d.Section, d.description,
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
i.councildistrict,
de.section,
de.description,
                DATE_PART(\'year\', id.incidentdate) as Year,
                DATE_PART(\'month\', id.incidentdate) as Month,
                COUNT(*) as Transactions
           
           from "PoliceBlotter2".incidentdescription id,"PoliceBlotter2".description de, "PoliceBlotter2".incident i
where de.descriptionid = id.descriptionid and i.incidentdate = id.incidentdate and i.incidentnumber = id.incidentnumber
          GROUP BY 
          i.councildistrict,
          de.section,
          de.description,
                   DATE_PART(\'year\', id.incidentdate),
                   DATE_PART(\'month\', id.incidentdate)
        ) d
  GROUP BY 
  d.councildistrict,
           d.Year,
           d.section,
           d.description

  ORDER BY 
           d.councildistrict,d.Year desc,d.description';

$result = pg_query($dbconn, $sql);
BeginIncidentTable();

while ($row = pg_fetch_row($result)) {
    //print $row[0] . ' ' . $row[1] . ' '.$row[2] . '</br>'; 
    PopulateIncidentTable($row);
}

EndIncidentTable();

function BeginIncidentTable() {
    /* Display the beginning of the search results table. */
    $headings = array("Council District","Year", "Section", "Description", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "Count");
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
