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

$neighborhood = "neighborhood";
$councildistrict = "CouncilDistrict";
$policezone = "PoliceZone";
$section = "section";
$mindate = "mindate";
$maxdate = "maxdate";
$address = "address";
$startdate = "";
$enddate = "";
$snl = 0;
$description = "";
$type = "BOTH";
$my_neighborhood = filter_input(INPUT_GET, $neighborhood, FILTER_SANITIZE_STRING);
//print_r($my_neighborhood);
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
$from = " from \"PoliceBlotter2\".description d, \"PoliceBlotter2\".incident i ";
//$from = " FROM \"PoliceBlotter2\".incident";

$where = "where i.descriptionid = d.descriptionid ";
$where = $where . " and i.incidentdate between '" . $startdate . "' and '" . $enddate . "'";
$where = $where . $addresswhere . $neighborhoodwhere . $councildistrictwhere . $policezonewhere . $sectionwhere;

$querymessage = "from " . $startdate . " to " . $enddate . " ". $my_address . " ".$my_neighborhood . " ".$my_councildistrict . " ".$my_policezone . " ".$my_section;

$orderby = " order by lat,lng";
$select = 'SELECT distinct "lat","lng","zone","address","incidentnumber"';

$SQL = $select . $from . $where . $orderby;

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
    $lat[$rowcount] = $row[0];
    $lng[$rowcount] = $row[1];
    $zone[$rowcount] = rtrim($row[2]);
    $addresses[$rowcount] = rtrim($row[3]);
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
    setnode($lat[$i], $lng[$i], $zone[$i], $addresses[$i], $description);
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
    echo "(" . $i . ") " . $lat[$i] . " " . $incidentnumber[$i];
    echo "<br>";

    setnode($lat[$i], $lng[$i], $zone[$i], $addresses[$i], $description);
    setupTable();
    //$myDescriptions = "************************************************************" . "<br>";
    createdescription($incidentnumber[$i]);
    closeTable();
    $newnode->setAttribute("descriptions", $myDescriptions);
}

function setnode($lat, $lng, $zone, $addresses, $description) {
// ADD TO XML DOCUMENT NODE
    global $dom;
    global $parnode;
    global $newnode;
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);


    $newnode->setAttribute("lat", $lat);
    $newnode->setAttribute("lng", $lng);
    $newnode->setAttribute("zone", $zone);
    $newnode->setAttribute("address", $addresses);
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

$filename = "../xml/" . "SelectionMapmarker.xml";
//echo "</br>";
//echo $filename;
//echo "</br>";
echo $dom->saveXML();
$dom->save($filename);
$URLRedirection = '<script type="text/javascript"> document.location="PPBXMLMarkerMap.php?filename=' . $filename . '&query=' . $querymessage .'";</script>';
echo $URLRedirection;
/*
 * Order that needs to be configured
 * lat/lng
 * address
 * incidents
 * descriptions
 */
exit();
