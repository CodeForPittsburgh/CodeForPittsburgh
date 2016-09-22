<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Search Test</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="icon" href="img/myicon.png">
    </head>
    <body>

    </body>
</html>
<?php
include 'setup.php';
//header('Content-type: application/json');
//header('Content-type: application/xml,text/html,text/javascript');
//header('Content-type: application/xml');
//header("Content-type: text/xml,text/html");
//header("Content-type: text/html");
// globals



$snl = 0;
$mindate = "mindate";
$maxdate = "maxdate";
$startdate = "";
$enddate = "";
$maptype = "maptype";
$type = "BOTH";
$table;
$my_string = "datetest";
$my_mindate = filter_input(INPUT_GET, $mindate, FILTER_SANITIZE_STRING);
//print_r($my_mindate);
//echo "</br>";
if ($my_mindate === "") {
    //echo "mindate is an empty string\n";
    //echo "</br>";
}
if ($my_mindate === false) {
    //echo "mindate is false\n";
    //echo "</br>";
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
    //echo "mindate is not empty\n";
    //echo "</br>";
}
$my_maxdate = filter_input(INPUT_GET, $maxdate, FILTER_SANITIZE_STRING);
//print_r($my_maxdate);
//echo "</br>";
if ($my_maxdate === "") {
    //echo "maxdate is an empty string\n";
    //echo "</br>";
}
if ($my_maxdate === false) {
    //echo "maxdate is false\n";
    //echo "</br>";
}
if ($my_maxdate === null) {
    //echo "maxdate is null\n";
    //echo "</br>";
    //$yesterday = date("Y-m-d", mktime(0, 0, 0, date("n", $time), date("j", $time) - 1, date("Y", $time)));
}
if (isset($my_maxdate)) {
    //echo "maxdate is set\n";
    //echo "</br>";
    $enddate = $my_maxdate;
    //echo "enddate " . $enddate;
    //echo "</br>";
}
if (!empty($my_maxdate)) {
    //echo "maxdate is not empty\n";
    //echo "</br>";
}


$my_maptype = filter_input(INPUT_GET, $maptype, FILTER_SANITIZE_STRING);
//print_r($my_maptype);
//echo "</br>";
if ($my_maptype === "") {
    //echo "maptype is an empty string\n";
    //echo "</br>";
}
if ($my_maptype === false) {
    //echo "maptype is false\n";
    //echo "</br>";
}
if ($my_maptype === null) {
    //echo "maptype is null\n";
    //echo "</br>";
}
if (isset($my_maptype)) {
    //echo "maptype is set\n";
    //echo "</br>";
}
if (!empty($my_maptype)) {
    //echo "maptype is not empty\n";
    //echo "</br>";
}



$from = " FROM \"PoliceBlotter2\".incident";
$where = " where incidentdate between '" . $my_mindate . "' and '" . $my_maxdate . "'";
$orderby = " order by weight desc";
$groupby = " group by lat, lng";
$SQL = "select lat,lng, count(*) as weight" . $from . $where . $groupby . $orderby;
$result = pg_query($dbconn, $SQL);
$rowcount = 0;
$filename = "xml/" . $my_string . "pittsburghData.txt";
//echo $filename;
//echo "<br>";
$myfile = fopen($filename, "w") or die("Unable to open file!");
while ($row = pg_fetch_row($result)) {
    fwrite($myfile, $row[0] . ',' . $row[1] . ',' . $row[2] . ';' . PHP_EOL);
    //fwrite($myfile, PHP_EOL);
    //echo $row[0] . $row[1];
    //echo "<br>";

    $rowcount++;
}
/*
  while ($row = pg_fetch_row($result)) {
  fwrite($myfile, $row[0] . ',' . $row[1] . ';');
  fwrite($myfile, "\r");
  //echo $row[0] . $row[1];
  //echo "<br>";

  $rowcount++;
  }

 */
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
$description = "";
$daterange = "from " . $startdate . " to " . $enddate;
//$URLRedirection = '<script type="text/javascript"> document.location="displayheatmap.html?filename=' . $filename . '&ShapeNameLocation=' . $snl . '&daterange=' . $my_mindate . ' to ' . $my_maxdate .'";</script>';
//$URLRedirection = '<script type="text/javascript"> document.location="displaymap.html?filename=' . $filename . '&ShapeNameLocation=' . $snl .'";</script>';
$URLRedirection = '<script type="text/javascript"> document.location="displaymap.html?filename=' . $filename . '&ShapeNameLocation=' . $snl . '&RowCount=' . $rowcount . '&Description=' . $description . '&DateRange=' . $daterange . '";</script>';
echo $URLRedirection;
//echo $heapdata;
//exit();

