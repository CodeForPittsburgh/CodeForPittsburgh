<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include ('connect.php');
$timezone = "America/New_York";
date_default_timezone_set($timezone);
$seconds = 300;
set_time_limit($seconds);
$time = time();
$neighborhood = "neighborhood";
$councildistrict = "CouncilDistrict";
$policezone = "PoliceZone";
$section = "section";
$mindate = "mindate";
$maxdate = "maxdate";
$startdate = "";
$enddate = "";
$snl = 0;
$description = "";
$where = "";
$whereneighborhood = "";
$wherecouncildistrict = "";
$wherepolicezone = "";
$wheresection = "";



$type = "BOTH";
$my_neighborhood = filter_input(INPUT_GET, $neighborhood, FILTER_SANITIZE_STRING);
//print_r($my_string);
//echo "</br>";
if ($my_neighborhood === "") {
    //echo "neighborhood is an empty string\n";
    //echo "</br>";
    //$my_string = 'Westwood';
}
if ($my_neighborhood === false) {
    //echo "neighborhood is false\n";
    //echo "</br>";
}
if ($my_neighborhood === null) {
    //echo "neighborhood is null\n";
    //echo "</br>";
    //$my_string1 = 'Westwood';
    //$yesterday = date("Y-m-d", mktime(0, 0, 0, date("n", $time), date("j", $time) - 1, date("Y", $time)));
}
if (isset($my_neighborhood)) {
    //echo "neighborhood is set\n";
    //echo "</br>";
    $whereneighborhood = " neighborhood = '" . $my_neighborhood . "' and ";
    $my_string = $my_neighborhood;
    $snl = 1;
    $description = " neighborhood " . $my_neighborhood;
    //$q = $my_string;
}
if (!empty($my_string1)) {
    //echo "neighborhood is not empty\n";
    //echo "</br>";
}


$my_string0 = filter_input(INPUT_GET, $councildistrict, FILTER_SANITIZE_STRING);
//print_r($my_string);
//echo "</br>";
if ($my_string0 === "") {
    //echo "councildistrict is an empty string\n";
    //echo "</br>";
    //$my_string2 = '1';
}
if ($my_string0 === false) {
    //echo "councildistrict is false\n";
    //echo "</br>";
}
if ($my_string0 === null) {
    //echo "councildistrict is null\n";
    //echo "</br>";
    //$my_string2 = '1';
    //$yesterday = date("Y-m-d", mktime(0, 0, 0, date("n", $time), date("j", $time) - 1, date("Y", $time)));
}
if (isset($my_string0)) {
    //echo "councildistrict is set\n";
    //echo "</br>";
    //$q = $my_string2;
    $wherecouncildistrict = " councildistrict = '" . $my_string0 . "' and ";
    $my_string = "councildistrict" . $my_string0;
    $snl = 0;
    $description = $my_string;
}
if (!empty($my_string0)) {
    //echo "councildistrict is not empty\n";
    //echo "</br>";
}

$my_policezone = filter_input(INPUT_GET, $policezone, FILTER_SANITIZE_STRING);
//print_r($my_policezone);
//echo "</br>";
if ($my_policezone === "") {
    //echo "policezone is an empty string\n";
    //echo "</br>";
    //$my_string3 = '1';
}
if ($my_policezone === false) {
    //echo "policezone is false\n";
    //echo "</br>";
}
if ($my_policezone === null) {
    //echo "policezone is null\n";
    //echo "</br>";
    //$my_string3 = '1';
    //$yesterday = date("Y-m-d", mktime(0, 0, 0, date("n", $time), date("j", $time) - 1, date("Y", $time)));
}
if (isset($my_policezone)) {
    //echo "policezone is set\n";
    //echo "</br>";
    //$q = $my_string3;
    $wherepolicezone = " zone = '" . $my_policezone . "' and ";
    $my_string = $my_policezone;
    $snl = 2;
    $description = " Police " . $my_policezone;
}
if (!empty($my_policezone)) {
    //echo "policezone is not empty\n";
    //echo "</br>";
}

//$my_string ="datetest";
$my_mindate = filter_input(INPUT_GET, $mindate, FILTER_SANITIZE_STRING);
//print_r($my_mindate);
//echo "</br>";
if ($my_mindate === "") {
   // echo "mindate is an empty string\n";
    //echo "</br>";
}
if ($my_mindate === false) {
   // echo "mindate is false\n";
   // echo "</br>";
}
if ($my_mindate === null) {
    //echo "mindate is null\n";
    //echo "</br>";
    //$yesterday = date("Y-m-d", mktime(0, 0, 0, date("n", $time), date("j", $time) - 1, date("Y", $time)));
}
if (isset($my_mindate)) {
    //echo "mindate is set\n";
    //echo "</br>";
    $startdate = $my_mindate;
    //echo "startdate " . $startdate;
    //echo "</br>";
}
if (!empty($my_mindate)) {
   // echo "mindate is not empty\n";
    //echo "</br>";
}
$my_maxdate = filter_input(INPUT_GET, $maxdate, FILTER_SANITIZE_STRING);
//print_r($my_maxdate);
//echo "</br>";
if ($my_maxdate === "") {
   // echo "maxdate is an empty string\n";
    //echo "</br>";
}
if ($my_maxdate === false) {
    //echo "maxdate is false\n";
    //echo "</br>";
}
if ($my_maxdate === null) {
   // echo "maxdate is null\n";
    //echo "</br>";
    //$yesterday = date("Y-m-d", mktime(0, 0, 0, date("n", $time), date("j", $time) - 1, date("Y", $time)));
}
if (isset($my_maxdate)) {
   // echo "maxdate is set\n";
   // echo "</br>";
    $enddate = $my_maxdate;
    //echo "enddate " . $enddate;
    //echo "</br>";
}
if (!empty($my_maxdate)) {
    //echo "maxdate is not empty\n";
    //echo "</br>";
}

$my_section = filter_input(INPUT_GET, $section, FILTER_SANITIZE_STRING);
//print_r($my_string);
//echo "</br>";
if ($my_section === "") {
    //echo "section is an empty string\n";
    //echo "</br>";
    //$my_string = 'Westwood';
}
if ($my_section === false) {
    //echo "section is false\n";
   // echo "</br>";
}
if ($my_section === null) {
    //echo "section is null\n";
    //echo "</br>";
    //$my_string1 = 'Westwood';
    //$yesterday = date("Y-m-d", mktime(0, 0, 0, date("n", $time), date("j", $time) - 1, date("Y", $time)));
}
if (isset($my_section)) {
    //echo "section is set\n";
    //echo "</br>";
    $wheresection = " section = '" . $my_section . "' and ";
    $my_string = $my_section;
    $snl = 1;
    $description = " for section " . $my_section;
    
    //$q = $my_string;
}
if (!empty($my_section)) {
    //echo "section is not empty\n";
    //echo "</br>";
}
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');
//
// output the column headings
$header = array("incidenttype,incidentnumber,section,description,incidentdate,incidenttime,address,zipcode,neighborhood,lat,lng,zone,age,gender,councildistrict");
//$output = fopen("contacts.csv", "w");
foreach ($header as $line) {
        fputcsv($output, explode(',', $line));
}

//set up SQL
$from = " FROM \"PoliceBlotter2\".incident";
$where = " where incidentdate between '" . $startdate . "' and '" . $enddate . "'";


$orderby = " order by incidentnumber";

$SQL = 'SELECT distinct "incidentnumber"' . $from . $where . $orderby;
//echo $SQL;
//echo "</br>";



// Connect to the database
// connection String
//$dbconn = pg_connect('host=cfapghpoliceblotter.cnsbqqmktili.us-east-1.rds.amazonaws.com port=5432 dbname=CfAPGHPoliceBlotter user=cfapghpolicebltrrdr password=B10tt34RDR connect_timeout=60');
$dbconn = pg_connect('host=' . $hostname . ' port=' . $port . ' dbname=' . $database . ' user=' . $username . ' password=' . $password . ' connect_timeout=' . $connect_timeout);

//recordcount($startdate, $enddate, $dbconn);

$result = pg_query($dbconn, $SQL);

$rowcount = 0;

while ($row = pg_fetch_row($result)) {

    $incidentnumber = rtrim($row[0]);
    $where2 = " where incidentnumber = '" . $incidentnumber . "' and incidentdate between '" . $startdate . "' and '" . $enddate . "' and "
        . $wherecouncildistrict
        . $whereneighborhood
        . $wherepolicezone 
        . $wheresection
        . " descriptionid in (select distinct id.descriptionid from \"PoliceBlotter2\".incidentdescription id, \"PoliceBlotter2\".description d  "
            . "where id.incidentnumber = '" . $incidentnumber . "' and id.incidentdate between '" . $startdate . "' and '" . $enddate . "' "
            . " and id.descriptionid = d.descriptionid order by id.descriptionid)";

    createdescription($where2);


    $rowcount++;
}
//echo "processed " .$rowcount . " records.";
//echo "<br>";
fclose($output);

function printrow($output, $row) {
    //foreach ($row as $line) {
        //fputcsv($file, explode(',', $line));
        //fputcsv($file, $row);
        fwrite($output, $row);
    //}
}



function createdescription($where) {
    //global $dom;
    global $dbconn;
    global $output;

    $from = " from \"PoliceBlotter2\".description d, \"PoliceBlotter2\".incident i";
    //$where = " where incidentnumber = '" . $incidentnumber . "' and incidentdate between '" . $startdate . "' and '" . $enddate . "' and descriptionid in (select distinct descriptionid from \"PoliceBlotter2\".incidentdescription  where incidentnumber = '" . $incidentnumber . "' order by descriptionid)";
    $orderby = " order by i.incidentnumber, i.incidenttype ";
    $SQL2 = 'SELECT distinct i.incidenttype, i.incidentnumber,d.section,d.description,i.incidentdate,i.incidenttime,i.address,i.zipcode,i.neighborhood,i.lat,i.lng,i.zone,i.age,i.gender,i.councildistrict' . $from . $where . $orderby;
    //echo $SQL2;
    //echo "</br>";

    $result2 = pg_query($dbconn, $SQL2);


    while ($row = pg_fetch_row($result2)) {
        $newdescription = $row[3];
        $commacount = strpos(rtrim($newdescription), ",");
        if ($commacount > 0) {
            //echo "Found comma " . $commacount ." " . $newdescription;
            //echo "</br>";

            //$newdescription = str_ireplace(",", '&#44;', $newdescription);
            //$newdescription = str_ireplace(",", '\\,', $newdescription);
            //echo "New Description " . $newdescription;
            $description = "\"" . rtrim($newdescription) . "\"";
            //echo "Updated Description " . $description;
        } else {
            $description = rtrim($newdescription);
        }
        //OFFENSE 2.0,16028242,3929(a)(1),'Retail Theft; takes possession of, carries away, or transfers displayed merchandise',2016-02-15,23:45:00,1700 block Saw Mill Run Blvd,15210,Carrick,40.396046875547555,-79.998465431862968,Zone 3,,,4
        //incidenttype,incidentnumber,section,description,incidentdate,incidenttime,address,zipcode,neighborhood,lat,lng,zone,age,gender,councildistrict
        //OFFENSE 2.0,16028242,3929(a)(1),"Retail Theft; takes possession of, carries away, or transfers displayed merchandise",2016-02-15,23:45:00,1700 block Saw Mill Run Blvd,15210,Carrick,40.396046875547555,-79.998465431862968,Zone 3,,,4

        //$detail = array(rtrim($row[0]) . "," . rtrim($row[1]) . "," . rtrim($row[2]) . "," . $description . "," . rtrim($row[4]) . "," . rtrim($row[5]) . "," . rtrim($row[6]) . "," . rtrim($row[7]) . "," . rtrim($row[8]) . "," . $row[9] . "," . $row[10] . "," . rtrim($row[11]) . "," . rtrim($row[12]) . "," . rtrim($row[13]) . "," . rtrim($row[14]));
        $detail = rtrim($row[0]) . "," . rtrim($row[1]) . "," . rtrim($row[2]) . "," . $description . "," . rtrim($row[4]) . "," . rtrim($row[5]) . "," . rtrim($row[6]) . "," . rtrim($row[7]) . "," . rtrim($row[8]) . "," . $row[9] . "," . $row[10] . "," . rtrim($row[11]) . "," . rtrim($row[12]) . "," . rtrim($row[13]) . "," . rtrim($row[14]) . PHP_EOL;
        //print_r($detail);
        //echo "</br>";
        printrow($output, $detail);
    }
}
function recordcount($startdate,$enddate,$dbconn)
{
  $from = " FROM \"PoliceBlotter2\".incident";
$where = " where incidentdate between '" . $startdate . "' and '" . $enddate . "'";


$SQL = 'SELECT count(incidentnumber)' . $from . $where ;  
echo $SQL;
$result = \pg_query($dbconn, $SQL);
$recordcount = pg_fetch_row($result);
echo $recordcount[0];
}