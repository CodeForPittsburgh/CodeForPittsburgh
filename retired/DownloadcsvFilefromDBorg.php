<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * http://code.stephenmorley.org/php/creating-downloadable-csv-files/
 */
// output headers so that the file is downloaded rather than displayed
include ('./setup.php');
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');
//include ('setup.php');
$neighborhood = "Neighborhood";
$councildistrict = "CouncilDistrict";
$policezone = "PoliceZone";
$section = "Description";
$mindate = "mindate";
$maxdate = "maxdate";
$address = "address";
$startdate = "";
$enddate = "";
$snl = 0;
$description = "";


$type = "BOTH";
$my_neighborhood = filter_input(INPUT_GET, $neighborhood, FILTER_SANITIZE_STRING);
//print_r($my_string);
//echo "</br>";
$neighborhoodwhere = "";
if (isset($my_neighborhood)) {
    //echo "neighborhood is set\n";
    //echo "</br>";
    $neighborhoodwhere = " and neighborhood = '" . $my_neighborhood . "'";
    $my_string = $my_neighborhood;
    $snl = 1;
    $description = " Neighborhood " . $my_neighborhood;
    //$q = $my_string;
}

$my_address = filter_input(INPUT_GET, $address, FILTER_SANITIZE_STRING);
//print_r($my_string);
//echo "</br>";
$addresswhere = "";
if (isset($my_address)) {

    $addresswhere = " and address like '%" . $my_address . "%'";
    $my_string = $my_address;
    $snl = 1;
    $description = " Address " . $my_address;
    //$q = $my_string;
}

$my_councildistrict = filter_input(INPUT_GET, $councildistrict, FILTER_SANITIZE_STRING);
//print_r($my_string);
//echo "</br>";
$councildistrictwhere = "";
if (isset($my_councildistrict)) {
    //echo "councildistrict is set\n";
    //echo "</br>";
    //$q = $my_string2;
    $councildistrictwhere = " and councildistrict = '" . $my_councildistrict . "'";
    
    $snl = 0;
    $description = "Council District" . $my_councildistrict;
}


$my_policezone = filter_input(INPUT_GET, $policezone, FILTER_SANITIZE_STRING);
//print_r($my_policezone);
//echo "</br>";
$policezonewhere = "";
if (isset($my_policezone)) {
    //echo "policezone is set\n";
    //echo "</br>";
    //$q = $my_string3;
    $policezonewhere = " and zone = '" . $my_policezone . "'";
    $my_string = $my_policezone;
    $snl = 2;
    $description = " Police " . $my_policezone;
}


//$my_string ="datetest";
$my_mindate = filter_input(INPUT_GET, $mindate, FILTER_SANITIZE_STRING);
//print_r($my_mindate);
//echo "</br>";

if (isset($my_mindate)) {
    //echo "mindate is set\n";
    //echo "</br>";
    $startdate = $my_mindate;
    //echo "startdate " . $startdate;
    //echo "</br>";
}

$my_maxdate = filter_input(INPUT_GET, $maxdate, FILTER_SANITIZE_STRING);
//print_r($my_maxdate);
//echo "</br>";

if (isset($my_maxdate)) {
    // echo "maxdate is set\n";
    // echo "</br>";
    $enddate = $my_maxdate;
    //echo "enddate " . $enddate;
    //echo "</br>";
}


$my_section = filter_input(INPUT_GET, $section, FILTER_SANITIZE_STRING);
//print_r($my_string);
//echo "</br>";

$sectionwhere = "";
if (isset($my_section)) {
    //echo "section is set\n";
    //echo "</br>";
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

// output the column headings
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
fputcsv($output, $names);

$result = pg_query($dbconn, $SQL);


//header("Content-type: text/xml");
// Iterate through the rows, adding XML nodes for each
//$node = $dom->createElement("marker");
//$newnode = $parnode->appendChild($node);
$rowcount = 0;
while ($row = pg_fetch_row($result)) {
    //$lat[$rowcount] = $row[0];
    //$lng[$rowcount] = $row[1];
    //$zone[$rowcount] = rtrim($row[2]);
    //$address[$rowcount] = rtrim($row[3]);
    //$incidentnumber[$rowcount] = rtrim($row[4]);
    fputcsv($output, $row);
    $rowcount++;
}
//echo $rowcount;
//echo "<br>";

// fetch the data
//mysql_connect('localhost', 'username', 'password');
//mysql_select_db('database');
//$rows = mysql_query('SELECT field1,field2,field3 FROM table');

// loop over the rows, outputting them
//while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);

