<?php

/*
 * {location: new google.maps.LatLng(37.782, -122.441), weight: 3}
 *  will have the same effect as adding google.maps.LatLng(37.782, -122.441) three times.
 * 
 */
include ('../setup.php');

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
    $where = " where neighborhood = '" . $my_neighborhood . "' and ";
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
    $where = " where councildistrict = '" . $my_string0 . "' and ";
    $my_string = "councildistrict" . $my_string0;
    $snl = 0;
    $description = $my_string;
}
if (!empty($my_string0)) {
    //echo "councildistrict is not empty\n";
    //echo "</br>";
}

$my_policezone = filter_input(INPUT_GET, $policezone, FILTER_SANITIZE_STRING);
print_r($my_policezone);
echo "</br>";
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
    $where = " where zone = '" . $my_policezone . "' and ";
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
    $where = " where ";
    $my_string = $my_section;
    $snl = 1;
    $description = " for section " . $my_section;
    //echo $description;
    //echo "</br>";
    $SQL2 = "select a.lat,a.lng,count(*) as weight, d.section, d.description,i.incidentnumber,i.incidentdate " .
            " from \"PoliceBlotter2\".incident as a,\"PoliceBlotter2\".description as d,\"PoliceBlotter2\".incidentdescription as i " .
            " where d.section = '" .
            $my_section .
            "' and i.incidentdate between '" .
            $startdate . "' " .
            " and '" .
            $enddate .
            "' " .
            " and d.descriptionid = i.descriptionid and a.incidentnumber = i.incidentnumber " .
            " group by a.lat,a.lng,d.section,d.description,i.incidentnumber,i.incidentdate " .
            " order by weight desc";
    //echo $SQL2;
    //echo "</br>";
    //$q = $my_string;
}
if (!empty($my_section)) {
    //echo "section is not empty\n";
    //echo "</br>";
}


//$where = " where incidentdate between '".$my_mindate . "' and '". $my_maxdate ."'";
$where = $where . " incidentdate between '" . $startdate . "' and '" . $enddate . "'";

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
$groupby = " group by lat, lng";
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
$SQL = "select lat,lng, count(*) as weight" . $from . $where . $groupby . $orderby;
echo $SQL;


//echo "</br>";

$dbconn = pg_connect('host=' . $hostname . ' port=' . $port . ' dbname=' . $database . ' user=' . $username . ' password=' . $password . ' connect_timeout=' . $connect_timeout);
//$dbconn = pg_connect('host=cfapghpoliceblotter.cnsbqqmktili.us-east-1.rds.amazonaws.com port=5432 dbname=CfAPGHPoliceBlotter user=CfAPGHPoliceBltr password=CfAPGH2015 connect_timeout=60');
//$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=win95sux");
//$result = pg_query($dbconn, 'SELECT "lat","lng","zone","incidentdate","incidentnumber","address","incidenttype" FROM "PoliceBlotter".incident where incidentdate = \'$yesterday\' ');
if (isset($my_section)) {
    $SQL = $SQL2;
}
$result = pg_query($dbconn, $SQL);
//header("Content-type: text/xml");
// Iterate through the rows, adding XML nodes for each
//$node = $dom->createElement("marker");
//$newnode = $parnode->appendChild($node);
$rowcount = 0;
$filename = "../xml/" . $my_string . "pittsburghData.txt";
//echo $filename;
//echo "<br>";
$myfile = fopen($filename, "w") or die("Unable to open file!");
while ($row = pg_fetch_row($result)) {
    if (isset($my_section)) {
        $description = $row[4];
       // echo "DESCRIPTION " . $description;
    }
    fwrite($myfile, $row[0] . ',' . $row[1] . ',' . $row[2] . ';' . PHP_EOL);
//fwrite($myfile, PHP_EOL);
//echo $row[0] . $row[1];
//echo "<br>";
    $rowcount++;
}
//echo "Row Count " . $rowcount;
//echo "<br>";
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

//echo "Start Date " . $startdate . "End Date " . $enddate;
//echo "<br>";
$daterange = " from " . $startdate . " to " . $enddate;
//echo "<br>";
//echo $description;
//echo "<br>";
//echo $snl;
//echo "<br>";

$URLRedirection = '<script type="text/javascript"> document.location="displaymap.html?filename=' . $filename . '&ShapeNameLocation=' . $snl . '&RowCount=' . $rowcount . '&Description=' . $description . '&DateRange=' . $daterange . '";</script>';
echo $URLRedirection;
//echo $heapdata;
//exit();

/*
 * select a.lat,a.lng,count(*) as weightd.section, d.description,i.incidentnumber,i.incidentdate
from "PoliceBlotter2".incident as a,"PoliceBlotter2".description as d,"PoliceBlotter2".incidentdescription as i  
where d.section = '9498'and i.incidentdate between '2016-02-01' 
and '2016-02-09',
and d.descriptionid = i.descriptionid and a.incidentnumber = i.incidentnumber
group by a.lat,a.lng,d.section,d.description,i.incidentnumber,i.incidentdate
order by weight desc;
 */
