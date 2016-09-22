<?php

$timezone = "America/New_York";
date_default_timezone_set($timezone);
$seconds = 300;
set_time_limit($seconds);
$time = time();
$neighborhood = "neighborhood";
$councildistrict = "CouncilDistrict";
$policezone = "PoliceZone";
$snl = 0; 


$type = "BOTH";
$my_string1 = filter_input(INPUT_GET, $neighborhood, FILTER_SANITIZE_STRING);
//print_r($my_string);
//echo "</br>";
if ($my_string1 === "") {
    echo "neighborhood is an empty string\n";
    echo "</br>";
    //$my_string = 'Westwood';
}
if ($my_string1 === false) {
    echo "neighborhood is false\n";
    echo "</br>";
}
if ($my_string1 === null) {
    echo "neighborhood is null\n";
    echo "</br>";
    //$my_string1 = 'Westwood';
    //$yesterday = date("Y-m-d", mktime(0, 0, 0, date("n", $time), date("j", $time) - 1, date("Y", $time)));
}
if (isset($my_string1)) {
    echo "neighborhood is set\n";
    echo "</br>";
    $where = " where neighborhood = '" . $my_string1 . "'";
    $my_string = $my_string1;
    $snl = 1;
    //$q = $my_string;
}
if (!empty($my_string1)) {
    echo "neighborhood is not empty\n";
    echo "</br>";
}


$my_string0 = filter_input(INPUT_GET, $councildistrict, FILTER_SANITIZE_STRING);
//print_r($my_string);
//echo "</br>";
if ($my_string0 === "") {
    echo "councildistrict is an empty string\n";
    echo "</br>";
    //$my_string2 = '1';
}
if ($my_string0 === false) {
    echo "councildistrict is false\n";
    echo "</br>";
}
if ($my_string0 === null) {
    echo "councildistrict is null\n";
    echo "</br>";
    //$my_string2 = '1';
    //$yesterday = date("Y-m-d", mktime(0, 0, 0, date("n", $time), date("j", $time) - 1, date("Y", $time)));
}
if (isset($my_string0)) {
    echo "councildistrict is set\n";
    echo "</br>";
    //$q = $my_string2;
    $where = " where councildistrict = '" . $my_string0 . "'";
    $my_string = "councildistrict" .$my_string0;
    $snl = 0;
}
if (!empty($my_string0)) {
    echo "councildistrict is not empty\n";
    echo "</br>";
}

$my_string2 = filter_input(INPUT_GET, $policezone, FILTER_SANITIZE_STRING);
//print_r($my_string);
//echo "</br>";
if ($my_string2 === "") {
    echo "policezone is an empty string\n";
    echo "</br>";
    //$my_string3 = '1';
}
if ($my_string2 === false) {
    echo "policezone is false\n";
    echo "</br>";
}
if ($my_string2 === null) {
    echo "policezone is null\n";
    echo "</br>";
    //$my_string3 = '1';
    //$yesterday = date("Y-m-d", mktime(0, 0, 0, date("n", $time), date("j", $time) - 1, date("Y", $time)));
}
if (isset($my_string2)) {
    echo "policezone is set\n";
    echo "</br>";
    //$q = $my_string3;
    $where = " where zone = 'Zone " . $my_string2 . "'";
    $my_string = "policezone" . $my_string2;
    $snl = 2;
}
if (!empty($my_string2)) {
    echo "policezone is not empty\n";
    echo "</br>";
}


$table;
$searchAddress = "2nd Ave";
//$yesterday = date("Ymd", mktime(0, 0, 0, date("n", $time), date("j", $time) - 1, date("Y", $time)));
$from = " FROM \"PoliceBlotter2\".incident";
//$where = " where incidentdate ='" . $yesterday . "'";
//$where = " where address like '%" . $searchAddress ."%'";
//if ($my_string === 'All') {
//    $where = "";
//} else {
//    $where = " where neighborhood = '" . $my_string . "'";
//}
//$where = " where zone = 'Zone 6'";
//$orderby = " order by neighborhood";
$orderby = " order by lat,lng";
//echo $yesterday;
//echo "\n";

/*
 * select 'new google.maps.LatLng('||lat||','||lng||'),' as array
  from "PoliceBlotter2".incident
  where neighborhood = 'Homewood North'
  order by lat;
 * 
 */
//$SQL = "select 'new google.maps.LatLng('||lat||','||lng||');'" . $from . $where . $orderby;
$SQL = "select lat,lng" . $from . $where . $orderby;
echo $SQL;
echo "</br>";
$dbconn = pg_connect('host=cfapghpoliceblotter.cnsbqqmktili.us-east-1.rds.amazonaws.com port=5432 dbname=CfAPGHPoliceBlotter user=CfAPGHPoliceBltr password=CfAPGH2015 connect_timeout=60');
//$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=win95sux");
//$result = pg_query($dbconn, 'SELECT "lat","lng","zone","incidentdate","incidentnumber","address","incidenttype" FROM "PoliceBlotter".incident where incidentdate = \'$yesterday\' ');
$result = pg_query($dbconn, $SQL);


//header("Content-type: text/xml");
// Iterate through the rows, adding XML nodes for each
//$node = $dom->createElement("marker");
//$newnode = $parnode->appendChild($node);
$rowcount = 0;
$filename = "xml/" . $my_string . "pittsburghData.txt";
echo $filename;
echo "<br>";
$myfile = fopen($filename, "w") or die("Unable to open file!");


while ($row = pg_fetch_row($result)) {
    fwrite($myfile, $row[0] . ',' . $row[1] . ';');
    fwrite($myfile, "\r");
    //echo $row[0] . $row[1];
    //echo "<br>";

    $rowcount++;
}
echo "Row Count " . $rowcount;
echo "<br>";
fclose($myfile);

//$filename = "xml/".$my_string . "pittsburghData.xml";
//echo "</br>";
//echo $filename;
//echo "</br>";
//echo $dom->saveXML();
//$dom->save($filename);
//echo $heapdata;
//$dl = "document.location=displaymap.html?filename=' . $filename . '&ShapeNameLocation=' . $snl .'";
//echo $dl;

$URLRedirection = '<script type="text/javascript"> document.location="displaymap.html?filename=' . $filename . '&ShapeNameLocation=' . $snl .'";</script>';
echo $URLRedirection;
//echo $heapdata;
//exit();
