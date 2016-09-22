<?php

include ('setup.php');
$from = " FROM \"PoliceBlotter2\".incident i, \"PoliceBlotter2\".description d";
$where = " where incidentdate ='" . $yesterday . "' and i.descriptionid = d.descriptionid";
$orderby = " order by incidenttype desc";
//echo $yesterday;
//echo "\n";
$select = 'SELECT distinct i.lat,i.lng,i.zone,i.incidentdate,i.incidenttime,i.incidentnumber,i.address,i.incidenttype,i.age,i.gender,i.councildistrict,i.zipcode,i.neighborhood,d.section,d.description';
$SQL = $select . $from . $where . $orderby;
echo $SQL;
echo "<br>";

$result = pg_query($dbconn, $SQL);
$count = pg_num_rows($result);
echo "Row count is " . $count;
echo "<br>";
//if ($count > 0) {
//
    $dom = new DOMDocument("1.0");
    $node = $dom->createElement("incidents");
    $parnode = $dom->appendChild($node);
    header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
    while ($row = pg_fetch_row($result)) {

        // ADD TO XML DOCUMENT NODE
        $node1 = $dom->createElement("incident");
        $newnode = $parnode->appendChild($node1);


        $newnode->setAttribute("lat", $row[0]);
        $newnode->setAttribute("lng", $row[1]);
        $newnode->setAttribute("zone", rtrim($row[2]));
        $newnode->setAttribute("incidentdate", rtrim($row[3]));
        $newnode->setAttribute("incidenttime", rtrim($row[4]));
        $newnode->setAttribute("incidentnumber", rtrim($row[5]));
        $newnode->setAttribute("address", rtrim($row[6]));

        $newnode->setAttribute("councildistrict", rtrim($row[10]));
        $newnode->setAttribute("zipcode", rtrim($row[11]));
        $newnode->setAttribute("neighborhood", rtrim($row[12]));
        $newnode->setAttribute("type", rtrim($row[7]));
        $newnode->setAttribute("age", rtrim($row[8]));
        $newnode->setAttribute("gender", rtrim($row[9]));
        $newnode->setAttribute("section", rtrim($row[13]));
        $newnode->setAttribute("descriptions", rtrim($row[14]));
    }

    $time = time();
    $dow = strtolower(date("lYmd", mktime(0, 0, 0, date("n", $time), date("j", $time) - 1, date("Y", $time))));
    $filename = $dow . ".xml";
    echo $filename;
    echo "</br>";
    $dom->saveXML();
    //echo $dom->saveXML();
    $dom->save($filename);


pg_close($dbconn);
