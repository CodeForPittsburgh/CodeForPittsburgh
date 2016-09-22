<!DOCTYPE html>
<html>
    <head>
        <title>Police Blotter Table Data</title>
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
            }
            caption {
               font-weight: bold;
               font-size: larger;
            }
        </style>
    </head>
</html>
<?php
include ('../includes/setup.php');
include ('../includes/URLParms.php');

$neighborhoodwhere = "";
if (isset($my_neighborhood)) {
    $neighborhoodwhere = " and neighborhood = '" . $my_neighborhood . "'";
    $my_string = $my_neighborhood;
    $snl = 1;
    $description = " Neighborhood " . $my_neighborhood;
}

$addresswhere = "";
if (isset($my_address)) {
    $addresswhere = " and address like '%" . $my_address . "%'";
    $my_string = $my_address;
    $snl = 1;
    $description = " Address " . $my_address;
}

$councildistrictwhere = "";
if (isset($my_councildistrict)) {
    $councildistrictwhere = " and councildistrict = '" . $my_councildistrict . "'";
    $snl = 0;
    $description = "Council District" . $my_councildistrict;
}

$policezonewhere = "";
if (isset($my_policezone)) {
    $policezonewhere = " and zone = '" . $my_policezone . "'";
    $my_string = $my_policezone;
    $snl = 2;
    $description = " Police " . $my_policezone;
}

if (isset($my_mindate)) {
    $startdate = $my_mindate;
}

if (isset($my_maxdate)) {
    $enddate = $my_maxdate;
}

$sectionwhere = "";
if (isset($my_section)) {
    $sectionwhere = " and d.section in ('" . $my_section . "')";
    $my_string = $my_section;
    $snl = 1;
    $description = " Section " . $my_section;
}

$where = "where i.descriptionid = d.descriptionid ";
$where = $where . " and i.incidentdate between '" . $startdate . "' and '" . $enddate . "'";
$where = $where . $addresswhere . $neighborhoodwhere . $councildistrictwhere . $policezonewhere . $sectionwhere;




$orderby = " order by i.incidentnumber";
$select = "select distinct i.incidentnumber,i.incidenttype,i.incidentdate,i.incidenttime,i.age,i.gender,d.section,d.description,i.lat,i.lng,i.address,i.neighborhood,i.zone,i.zipcode,i.councildistrict ";
$from = " from \"PoliceBlotter2\".description d, \"PoliceBlotter2\".incident i ";

$SQL = $select . $from . $where . $orderby;
//echo $SQL;
//echo "</br>";
//echo "*******************************************************************************************";
$names = array(
    "Incident Number",
    "Incident Type",
    "Incident Date",
    "Incident Time",
    "Age",
    "Gender",
    "Section ",
    "Description",
    "Lat",
    "Lng",
    "Address",
    "Neighborhood",
    "Zone",
    "Zipcode",
    "Council District"
);

$result = pg_query($dbconn, $SQL);


BeginIncidentTable($startdate, $enddate,$names,$description);

while ($row = pg_fetch_row($result)) {

    PopulateIncidentTable($row);
}

EndIncidentTable();

//i.incidentnumber,i.incidenttype,i.incidentdate,i.incidenttime,i.age,i.gender,d.section,d.description,i.lat,i.lng,i.address,i.zone,i.zipcode,i.councildistrict ";
function BeginIncidentTable($MinDate, $MaxDate, $names,$description) {


    echo "<table class='sortable' align='center' cellpadding='5' border=1>";
    echo "<caption> $description from   $MinDate  to   $MaxDate </caption>";
    echo "<tr>";
    foreach ($names as $heading) {
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

//$URLRedirection = '<script type="text/javascript"> document.location="displaymap.html?filename=' . $filename . '&ShapeNameLocation=' . $snl . '&RowCount=' . $rowcount . '&Description=' . $description . '&DateRange=' . $daterange . '";</script>';
//echo $URLRedirection;
