<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * http://code.stephenmorley.org/php/creating-downloadable-csv-files/
 */
// output headers so that the file is downloaded rather than displayed
include ('../includes/setup.php');
include ('../includes/URLParms.php');
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');
//include ('setup.php');
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

$rowcount = 0;
while ($row = pg_fetch_row($result)) {
    fputcsv($output, $row);
    $rowcount++;
}

