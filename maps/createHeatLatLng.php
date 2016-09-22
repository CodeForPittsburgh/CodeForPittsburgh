<?php

/*
 * {location: new google.maps.LatLng(37.782, -122.441), weight: 3}
 *  will have the same effect as adding google.maps.LatLng(37.782, -122.441) three times.
 * 
 */
include ('../includes/setup.php');
include ('../includes/URLParms.php');

$neighborhoodwhere = "";
if (isset($my_neighborhood)) {
//    //echo "neighborhood is set\n";
//    //echo "</br>";
    $neighborhoodwhere = " and neighborhood = '" . $my_neighborhood . "'";
    $my_string = $my_neighborhood;
    $snl = 1;
    $description = " Neighborhood " . $my_neighborhood;
}

$addresswhere = "";
if (isset($my_address)) {
//
    $addresswhere = " and address like '%" . $my_address . "%'";
    $my_string = $my_address;
    $snl = 1;
    $description = " Address " . $my_address;
}

$councildistrictwhere = "";
if (isset($my_councildistrict)) {

    $councildistrictwhere = " and councildistrict = '" . $my_councildistrict . "'";
//    
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

    $sectionwhere = " and d.section in ('" . $my_section . "') and d.descriptionid = i.descriptionid";
    $my_string = $my_section;
    $snl = 1;
    $description = " Section " . $my_section;
}

$from = " from \"PoliceBlotter2\".description d, \"PoliceBlotter2\".incident i ";
//$from = " FROM \"PoliceBlotter2\".incident";

$where = "where i.incidentdate between '" . $startdate . "' and '" . $enddate . "'";
$where = $where . $addresswhere . $neighborhoodwhere . $councildistrictwhere . $policezonewhere . $sectionwhere;

$querymessage = "from " . $startdate . " to " . $enddate . " " . $my_address . " " . $my_neighborhood . " " . $my_councildistrict . " " . $my_policezone . " " . $my_section;
$groupby = " group by lat,lng";
$orderby = " order by weight desc";
$select = 'select lat,lng, count(*) as weight';

$SQL = $select . $from . $where . $groupby . $orderby;

//$SQL = 'SELECT distinct "lat","lng","zone","address","incidentnumber"' . $from . $where . $orderby;
echo $SQL;
echo "</br>";


$dbconn = pg_connect('host=' . $hostname . ' port=' . $port . ' dbname=' . $database . ' user=' . $username . ' password=' . $password . ' connect_timeout=' . $connect_timeout);
$result = pg_query($dbconn, $SQL);
$rowcount = 0;
$filename = "../xml/HeatMapData.txt";

$myfile = fopen($filename, "w") or die("Unable to open file!");
while ($row = pg_fetch_row($result)) {

    fwrite($myfile, $row[0] . ',' . $row[1] . ',' . $row[2] . ';' . PHP_EOL);

    $rowcount++;
}

fclose($myfile);
$daterange = " from " . $startdate . " to " . $enddate;
$URLRedirection = '<script type="text/javascript"> document.location="displaymap.html?filename=' . $filename . '&ShapeNameLocation=' . $snl . '&RowCount=' . $rowcount . '&Description=' . $description . '&DateRange=' . $daterange . '";</script>';
echo $URLRedirection;