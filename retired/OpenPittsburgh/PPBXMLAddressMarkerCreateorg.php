<html>
    <head>
        <title>PPB XML Address Marker Create</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../img/myicon.png">
    </head>
</html>
<?php
include ('../setup.php');

$incidentdate = "incidentdate";
$type = "BOTH";
$table;
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
    //echo "incidentdate is null\n";
    //echo "</br>";
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

$searchAddress = "Faulkner";
$from = " FROM \"PoliceBlotter2\".incident";
$where = " where incidentdate ='" . $yesterday . "'";
$orderby = " order by lat,lng";

$SQL = 'SELECT distinct "lat","lng","zone","address","incidentnumber"' . $from . $where . $orderby;
echo $SQL;
echo "</br>";

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);
$newnode;
$myDescriptions;

$result = pg_query($dbconn, $SQL);


//header("Content-type: text/xml");
// Iterate through the rows, adding XML nodes for each
//$node = $dom->createElement("marker");
//$newnode = $parnode->appendChild($node);
$rowcount = 0;
while ($row = pg_fetch_row($result)) {
    $lat[$rowcount] = $row[0];
    $lng[$rowcount] = $row[1];
    $zone[$rowcount] = rtrim($row[2]);
    $address[$rowcount] = rtrim($row[3]);
    $incidentnumber[$rowcount] = rtrim($row[4]);
    $rowcount++;
}
echo $rowcount;
echo "<br>";
$description = "Incidents ";
$dom->createElement("descriptions");
//$i;
for ($i = 0; $i < $rowcount - 1; $i++) {
    echo "(" . $i . ") " . $lat[$i] . " " . $incidentnumber[$i];
    echo "<br>";
    setnode($lat[$i], $lng[$i], $zone[$i], $address[$i], $description);
    setupTable();
    if ($lat[$i] !== $lat[$i + 1]) {
        //setnode($lat[$i], $lng[$i], $zone[$i], $address[$i]);
        //setupTable();
        //$myDescriptions = "************************************************************" . "<br>";
        createdescription($incidentnumber[$i]);
        //closeTable();
    } else {
        //setupTable();
        while ($lat[$i] === $lat[$i + 1]) {
            //$myDescriptions = "************************************************************" . "<br>";
            echo "(" . $i . ") " . $incidentnumber[$i] . "<br>";
            createdescription($incidentnumber[$i]);
            //createdescription($incidentnumber[$i + 1]);
            $i++;
        }
        createdescription($incidentnumber[$i]);
        //closeTable();
    }

    closeTable();
    $newnode->setAttribute("descriptions", $myDescriptions);
}

if ($i == $rowcount - 1) {
    echo "Last record <br>";
    echo $i . " " . $rowcount . "<br>";
    echo "(" . $i . ") " . $address[$i] . " " . $incidentnumber[$i];
    echo "<br>";

    setnode($lat[$i], $lng[$i], $zone[$i], $address[$i], $description);
    setupTable();
    //$myDescriptions = "************************************************************" . "<br>";
    createdescription($incidentnumber[$i]);
    closeTable();
    $newnode->setAttribute("descriptions", $myDescriptions);
}

function setnode($lat, $lng, $zone, $address, $description) {
// ADD TO XML DOCUMENT NODE
    global $dom;
    global $parnode;
    global $newnode;
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);


    $newnode->setAttribute("lat", $lat);
    $newnode->setAttribute("lng", $lng);
    $newnode->setAttribute("zone", $zone);
    $newnode->setAttribute("address", $address);
    $newnode->setAttribute("description", $description);
}

function createdescription($incidentnumber) {
    //global $dom;
    global $dbconn;
    //global $newnode;
    global $myDescriptions;
    global $table;

    //$myDescriptions = "*************** " . $incidentnumber . " ******************************** " . $myDescriptions;
    /*
     * select distinct i.incidentnumber,i.incidenttype,i.incidentdate,incidenttime,i.age,i.gender,d.section,d.description 
      from "PoliceBlotter2".description d, "PoliceBlotter2".incident i
      where descriptionid = (select distinct descriptionid from "PoliceBlotter2".incidentdescription where incidentnumber = 14249564)
      and incidentnumber = 14249564;
     */
    $sql2 = 'select distinct i.incidentnumber,i.incidenttype,i.incidentdate,i.incidenttime,i.age,i.gender,d.section,d.description,i.lat,i.lng from "PoliceBlotter2".description d, "PoliceBlotter2".incident i'
            . ' where i.descriptionid = d.descriptionid '
            . 'and i.incidentnumber = ' . $incidentnumber . ' order by i.lat,i.lng';
    echo $sql2;
    echo "<br>";

    $result2 = pg_query($dbconn, $sql2);
//$i = 0;
    /*
     * <table>
     * <tr>
     * <th>
     * </th>
     * </tr>
     * <tr>
     * <td>
     * </td>
     * </tr>
     * </table>
     */
    //$table = "<html> <head></head><body><table border=\"1\"> <tr> <th> Incident Number</th> <th> Incident type</th> <th> Incident Date </th> <th> Incident Time </th> <th> Age </th> <th> Gender </th> <th> Section </th><th> Description </th></tr>";


    while ($descriptions = pg_fetch_row($result2)) {

        //incidentnumber
        //incidenttype
        //incidentdate
        //incidenttime
        //age 
        //gender
        //section
        //description

        $myDescriptions = $myDescriptions . rtrim($descriptions[0]) . ", ";
        $myDescriptions = $myDescriptions . rtrim($descriptions[1]) . ", ";
        $myDescriptions = $myDescriptions . rtrim($descriptions[2]) . ", ";
        $myDescriptions = $myDescriptions . rtrim($descriptions[3]) . ", ";
        $myDescriptions = $myDescriptions . rtrim($descriptions[4]) . ", ";
        $myDescriptions = $myDescriptions . rtrim($descriptions[5]) . ", ";
        $myDescriptions = $myDescriptions . rtrim($descriptions[6]) . "," . rtrim($descriptions[7]) . " <br/>";

        //$node = $dom->createElement("descriptions");
        //$newnode = $parnode->appendChild($node);
        //$newnode->setAttribute("description", rtrim($descriptions[0]));
//        $node = $dom->createElement("descriptions");
//        //$newnode = $parnode->appendChild($node);
//        $newnode->setAttribute("description", $myDescriptions);
        $table = $table . "<tr>";
        $table = $table . "<td>";
        $table = $table . rtrim($descriptions[0]);
        $table = $table . "</td>";
        $table = $table . "<td>";
        $table = $table . rtrim($descriptions[1]);
        $table = $table . "</td>";
        $table = $table . "<td>";
        $table = $table . rtrim($descriptions[2]);
        $table = $table . "</td>";
        $table = $table . "<td>";
        $table = $table . rtrim($descriptions[3]);
        $table = $table . "</td>";
        $table = $table . "<td>";
        $table = $table . rtrim($descriptions[4]);
        $table = $table . "</td>";
        $table = $table . "<td>";
        $table = $table . rtrim($descriptions[5]);
        $table = $table . "</td>";
        $table = $table . "<td>";
        $table = $table . rtrim($descriptions[6]);
        $table = $table . "</td>";
        $table = $table . "<td>";
        $table = $table . rtrim($descriptions[7]);
        $table = $table . "</td>";
        $table = $table . "</tr>";
    }
//    $table = $table . "</table></body></html>";
//    $myDescriptions = $table;
//    echo "My Descriptions " . $myDescriptions . "<br>";
}

function setupTable() {
    global $table;
    $table = "<html> <head></head><body><table border=\"1\"> <tr> <th> Incident Number</th> <th> Incident type</th> <th> Incident Date </th> <th> Incident Time </th> <th> Age </th> <th> Gender </th> <th> Section </th><th> Description </th></tr>";
}

function closeTable() {
    global $table;
    global $myDescriptions;
    $table = $table . "</table></body></html>";
    $myDescriptions = $table;
    echo "My Descriptions " . $myDescriptions . "<br>";
}

$filename = "../xml/" . $yesterday . "marker.xml";
//echo "</br>";
//echo $filename;
//echo "</br>";
echo $dom->saveXML();
$dom->save($filename);
$URLRedirection = '<script type="text/javascript"> document.location="PPBXMLMarkerMap.php?filename=' . $filename . '";</script>';
echo $URLRedirection;
/*
 * Order that needs to be configured
 * lat/lng
 * address
 * incidents
 * descriptions
 */
exit();
