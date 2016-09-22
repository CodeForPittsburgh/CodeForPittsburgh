<?php
include ('setup.php');

$incidentdate = "incidentdate";
$my_string = filter_input(INPUT_GET, $incidentdate, FILTER_SANITIZE_STRING);
//print_r($my_string);
//echo "</br>";
if ($my_string === "") {
    //echo "incidentdate is an empty string\n";
    //echo "</br>";
}
if ($my_string === false) {
    //echo "incidentdate is false\n";
    //echo "</br>";
}
if ($my_string === null) {
    echo "incidentdate is null\n";
    echo "</br>";
    $yesterday = date("Y-m-d", mktime(0, 0, 0, date("n", $time), date("j", $time) - 1, date("Y", $time)));
}
if (isset($my_string)) {
    //echo "incidentdate is set\n";
    //echo "</br>";
    $yesterday = $my_string;
}
if (!empty($my_string)) {
    //echo "incidentdate is not empty\n";
    //echo "</br>";
}
//$yesterday = date("Ymd", mktime(0, 0, 0, date("n", $time), date("j", $time) - 1, date("Y", $time)));
$from = " FROM \"PoliceBlotter2\".incident";
$where = " where incidentdate ='" . $yesterday . "'";
$orderby = " order by incidenttype desc";
//echo $yesterday;
//echo "\n";
$SQL = 'SELECT distinct "lat","lng","zone","incidentdate","incidenttime","incidentnumber","address","incidenttype","age","gender"' . $from . $where . $orderby;
//echo $SQL;
//echo "</br>";

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

$result = pg_query($dbconn, $SQL);


//header("Content-type: text/xml");
// Iterate through the rows, adding XML nodes for each
while ($row = pg_fetch_row($result)) {

    // ADD TO XML DOCUMENT NODE
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);


    $newnode->setAttribute("lat", $row[0]);
    $newnode->setAttribute("lng", $row[1]);
    $newnode->setAttribute("zone", rtrim($row[2]));
    $newnode->setAttribute("incidentdate", rtrim($row[3]));
    $newnode->setAttribute("incidenttime", rtrim($row[4]));
    $newnode->setAttribute("incidentnumber", rtrim($row[5]));
    $newnode->setAttribute("address", rtrim($row[6]));
    $type = rtrim($row[7]);
    if ($type == "OFFENSE 2.0") {
        $type = "OFFENSE";
    }
    $newnode->setAttribute("type", $type);
    $newnode->setAttribute("age", rtrim($row[8]));
    $newnode->setAttribute("gender", rtrim($row[9]));
    $myDescriptions = "*********************************************** <br/>";
    $result2 = pg_query($dbconn, 'select distinct "descriptionid" from "PoliceBlotter2".incidentdescription where "incidentnumber" = \'' . $row[5] . '\'');
    while ($incidentdescription = pg_fetch_row($result2)) {
        $result3 = pg_query($dbconn, 'select distinct "section","description" from "PoliceBlotter2".description where "descriptionid" = \'' . $incidentdescription[0] . '\'');
        while ($descriptions = pg_fetch_row($result3)) {
            $myDescriptions = $myDescriptions . rtrim($descriptions[0]) . ", " . rtrim($descriptions[1]) . "<br/>";
            //$node = $dom->createElement("descriptions");
            //$newnode = $parnode->appendChild($node);
            //$newnode->setAttribute("description", rtrim($descriptions[0]));
        }
    }
    $node = $dom->createElement("descriptions");
    //$newnode = $parnode->appendChild($node);
    $newnode->setAttribute("description", $myDescriptions);
}

//$time = time();
//$dow = strtolower(date("lYmd", mktime(0, 0, 0, date("n", $time), date("j", $time) - 1, date("Y", $time))));
//$yesterday2 =  date("Ymd", mktime(0,0,0,date("n", $time),date("j",$time)- 1 ,date("Y", $time)));
//echo "wednesday".$yesterday2.".xml";
//echo "</br>";
$filename = "xml/" . $yesterday . "marker.xml";
//$filename = $dow . "marker.xml";
//echo $filename;
//echo "</br>";

//echo $dom->saveXML();
$dom->save($filename);
$URLRedirection = '<script type="text/javascript"> document.location="PPBMap2.html?filename='.$filename.'";</script>';
echo $URLRedirection;

exit();