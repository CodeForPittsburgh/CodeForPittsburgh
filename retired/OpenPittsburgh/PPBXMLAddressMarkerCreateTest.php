<html>
    <head>
        <title>Police Blotter Description Totals</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="icon" href="../img/myicon.png">
    </head>
</html>
<?php
include ('../setup.php');

global $yesterday;
global $section;

$incidentdate = "incidentdate";
$section = "section";
//$address = "address";
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
    $yesterday = "";
    //$yesterday = date("Y-m-d", mktime(0, 0, 0, date("n", $time), date("j", $time) - 1, date("Y", $time)));
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
$my_string2 = filter_input(INPUT_GET, $section, FILTER_SANITIZE_STRING);
//print_r($my_string2);
//echo "</br>";
if ($my_string2 === "") {
    //echo "section is an empty string\n";
    //echo "</br>";
}
if ($my_string2 === false) {
    //echo "section is false\n";
    //echo "</br>";
}
if ($my_string2 === null) {
    //echo "section is null\n";
    //echo "</br>";
    $section = "";
    //$yesterday = date("Y-m-d", mktime(0, 0, 0, date("n", $time), date("j", $time) - 1, date("Y", $time)));
}
if (isset($my_string2)) {
    //echo "section is set\n";
    //echo "</br>";
    $section = $my_string2;
}
if (!empty($my_string2)) {
    //echo "section is not empty\n";
    //echo "</br>";
}

$searchAddress = "Faulkner";
//$yesterday = date("Ymd", mktime(0, 0, 0, date("n", $time), date("j", $time) - 1, date("Y", $time)));
//$from = " FROM \"PoliceBlotter2\".incident";


if ($yesterday != "" && $section == "") {
    $where = " where incidentdate = '" . $yesterday . "'";
    //echo $where;
    //echo "</br>";
} elseif ($section != "" && $yesterday == "") {
    $where = " where incidentnumber in (select incidentnumber from \"PoliceBlotter2\".incidentdescription where descriptionid = (select descriptionid from \"PoliceBlotter2\".description where section ='" . $section . "'))";
    //echo $where;
    //echo "</br>";
}
//
elseif ($yesterday != "" && $section != "") {
    $where = " where incidentdate = '" . $yesterday . "' and incidentnumber in (select incidentnumber from \"PoliceBlotter2\".incidentdescription where descriptionid = (select descriptionid from \"PoliceBlotter2\".description where section ='" . $section . "'))";
    //echo $where;
    //echo "</br>";
}

//$section = '9999';
$orderby = " order by lat,lng";
$select = "select distinct i.incidentnumber,i.incidenttype,i.incidentdate,i.incidenttime,i.age,i.gender,d.section,d.description,i.lat,i.lng,i.address ";
$from = " from \"PoliceBlotter2\".description d, \"PoliceBlotter2\".incident i ";
$where = " where d.section = '" . $section . "' and i.descriptionid = d.descriptionid";
$SQL = $select . $from . $where . $orderby;

//order by i.lat,i.lng
//$SQL = 'SELECT distinct "lat","lng","zone","address","incidentnumber"' . $from . $where . $orderby;
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
    $incidentnumber[$rowcount] = rtrim($row[0]); // incidentnumber
    $incidenttype[$rowcount] = rtrim($row[1]); // incidenttype
    $incidentdates[$rowcount] = $row[2];
    // echo "row 2 " . $row[2] . " ";
    $incidenttime[$rowcount] = $row[3];
    $age[$rowcount] = $row[4];
    $gender[$rowcount] = $row[5];
    $section[$rowcount] = rtrim($row[6]);
    $description[$rowcount] = rtrim($row[7]);


    $lat[$rowcount] = $row[8];
    $lng[$rowcount] = $row[9];
    $address[$rowcount] = rtrim($row[10]);
    // echo "incident date " . $incidentdates[$rowcount] . " ";
    $rowcount++;
}
echo "Row count " . $rowcount;
echo "<br>";
$dom->createElement("descriptions");
//$i;
for ($i = 0; $i < $rowcount - 1; $i++) {
    echo "(" . $i . ") " . $lat[$i] . "," . $lng[$i] . " " . $address[$i] . " " . $description[$i];
    echo "<br>";
    setnode($lat[$i], $lng[$i], $address[$i], $description[$i]);
    setupTable();
    if ($lat[$i] !== $lat[$i + 1]) {
        //setnode($lat[$i], $lng[$i], $zone[$i], $address[$i]);
        //setupTable();
        //$myDescriptions = "************************************************************" . "<br>";
        createdescription($incidentnumber[$i], $incidenttype[$i], $incidentdates[$i], $incidenttime[$i], $age[$i], $gender[$i]);
        //closeTable();
    } else {
        //setupTable();
        createdescription($incidentnumber[$i], $incidenttype[$i], $incidentdates[$i], $incidenttime[$i], $age[$i], $gender[$i]);
        //echo "*I* " . $i . "<br>";
        //echo "rowcount " . $rowcount . "<br>";
        //if($i + 1 != $rowcount) {
        while ($lat[$i] === $lat[$i + 1]) {
            //$myDescriptions = "************************************************************" . "<br>";
            echo "(" . ($i + 1) . ") " . $lat[$i + 1] . "," . $lng[$i + 1] . " " . $address[$i + 1] . " " . $description[$i + 1];
            echo "<br>";
            createdescription($incidentnumber[$i + 1], $incidenttype[$i + 1], $incidentdates[$i + 1], $incidenttime[$i + 1], $age[$i + 1], $gender[$i + 1]);

            //createdescription($incidentnumber[$i + 1]);
            $i++;

            if ($i === $rowcount - 1) {
                break;
            }
        }
        // }
        //createdescription($incidentnumber[$i],$incidenttype[$i],$incidentdates[$i],$incidenttime[$i],$age[$i],$gender[$i]);
        //closeTable();
    }
//createdescription($incidentnumber[$i],$incidenttype[$i],$incidentdates[$i],$incidenttime[$i],$age[$i],$gender[$i]);
    closeTable();
    $newnode->setAttribute("descriptions", $myDescriptions);
}
//echo "Row count " . $rowcount . "<br>";
//echo $i . " " . $rowcount . "<br>";
if (($rowcount - $i) === 1) {
    echo "Last record <br>";
    echo $i . " " . $rowcount . "<br>";
    echo "(" . $i . ") " . $lat[$i] . "," . $lng[$i] . " " . $address[$i] . " " . $description[$i];
    echo "<br>";

    setnode($lat[$i], $lng[$i], $address[$i], $description[$i]);
    setupTable();
    //$myDescriptions = "************************************************************" . "<br>";
    createdescription($incidentnumber[$i], $incidenttype[$i], $incidentdates[$i], $incidenttime[$i], $age[$i], $gender[$i]);
    //createdescription($incidentnumber[$i]);
    closeTable();
    $newnode->setAttribute("descriptions", $myDescriptions);
}

function setnode($lat, $lng, $address, $description) {
// ADD TO XML DOCUMENT NODE
    global $dom;
    global $parnode;
    global $newnode;
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);


    $newnode->setAttribute("lat", $lat);
    $newnode->setAttribute("lng", $lng);

    $newnode->setAttribute("address", $address);
    $newnode->setAttribute("description", $description);
}

function createdescription($incidentnumber, $incidenttype, $incidentdates, $incidenttime, $age, $gender) {
    global $myDescriptions;
    global $table;

    $myDescriptions = $myDescriptions . rtrim($incidentnumber) . ", ";
    $myDescriptions = $myDescriptions . rtrim($incidenttype) . ", ";
    $myDescriptions = $myDescriptions . rtrim($incidentdates) . ", ";
    $myDescriptions = $myDescriptions . rtrim($incidenttime) . ", ";
    $myDescriptions = $myDescriptions . rtrim($age) . ", ";
    $myDescriptions = $myDescriptions . rtrim($gender) . "<br/>";
    //$myDescriptions = $myDescriptions . rtrim($descriptions[6]) . "," . rtrim($descriptions[7]) . " <br/>";


    $table = $table . "<tr>";
    $table = $table . "<td>";
    $table = $table . rtrim($incidentnumber);
    $table = $table . "</td>";
    $table = $table . "<td>";
    $table = $table . rtrim($incidenttype);
    $table = $table . "</td>";
    $table = $table . "<td>";
    $table = $table . rtrim($incidentdates);
    $table = $table . "</td>";
    $table = $table . "<td>";
    $table = $table . rtrim($incidenttime);
    $table = $table . "</td>";
    $table = $table . "<td>";
    $table = $table . rtrim($age);
    $table = $table . "</td>";
    $table = $table . "<td>";
    $table = $table . rtrim($gender);
    $table = $table . "</td>";

    $table = $table . "</tr>";
}

function setupTable() {
    global $table;
    $table = "<html> <head></head><body><table border=\"1\"> <tr> <th> Incident Number</th> <th> Incident type</th> <th> Incident Date </th> <th> Incident Time </th> <th> Age </th> <th> Gender </th></tr>";
}

function closeTable() {
    global $table;
    global $myDescriptions;
    $table = $table . "</table></body></html>";
    $myDescriptions = $table;
    echo "My Descriptions " . $myDescriptions . "<br>";
}

$filename = "../xml/testmarker.xml";
//echo "</br>";
echo $filename;
echo "</br>";
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
