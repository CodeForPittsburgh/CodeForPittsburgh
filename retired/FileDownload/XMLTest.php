<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//include ('setup.php');
//$from = " FROM \"PoliceBlotter2\".incident i, \"PoliceBlotter2\".description d";
//$where = " where incidentdate ='" . $yesterday . "' and i.descriptionid = d.descriptionid";
//$orderby = " order by incidentnumber";
//echo $yesterday;
//echo "\n";
//$SQL = 'SELECT  lat,lng,zone,incidentdate,incidenttime,incidentnumber,address,incidenttype,age,gender,councildistrict,i.descriptionid, d.section, d.description' . $from . $where . $orderby;
//echo $SQL;
//echo "</br>";
//$result = pg_query($dbconn, $SQL);
//$count = pg_num_rows($result);
//echo "Row count is " . $count;
//echo "</br>";
//while ($rows = pg_fetch_row($result)) {
//foreach ($rows as $row) {
//echo $row;
//echo "</br>";
//}
echo "****************************";
echo "</br>";
//}
$count = 1;
$incidentnumber = "160376751";
$lat = "40.373500639348507";
$lng = "-80.05481320023317";
$address = "1400 block Preston St ";
$zone = "Zone 6";
$date = "2016-03-01";
$time = "00:15:00";
$councildistrict = "2";
$section = "2701";
$descriptiondetail = "Simple Assault.";
$incidenttype = "ARREST";
$age = "21";
$gender = "M";

$description = array(
    "section" => $section,
    "descriptionname" => $descriptiondetail
);
$descriptions = array(
    "description" => $description
);

$types = array(
    "type" => $incidenttype,
    "age" => $age,
    "gender" => $gender,
        "descriptions" => $descriptions
);

$incident = array(
    "incident" => $incidentnumber,
    "lat" => $lat,
    "lng" => $lng,
    "address" => $address,
    "zone" => $zone,
    "date" => $date,
    "time" => $time,
    "concildistrict" => $councildistrict,
        "types" => $types
);







$is = array(
    "total_incidents" => $count,
    "incidents" => $incident,
);


$incidents_array = array(
    "total_incidents" => 3,
    "incidents" => array(
        array(
            "incident" => "160376751",
            "lat" => "40.373500639348507",
            "lng" => "-80.05481320023317",
            "address" => "1400 block Preston St ",
            "zone" => "Zone 6",
            "date" => "2016-03-01",
            "time" => "00:15:00",
            "concildistrict" => "2",
            "incidenttype" => array(
                "type" => "OFFENSE 2.0 ",
                "age" => "",
                "gender" => "",
                "descriptions" => array(
                    "description" => array(
                        "section" => "2701",
                        "description" => "Simple Assault."
                    )
                )
            )
        ),
        array(
            "incident" => "160376751",
            "lat" => "40.373500639348507",
            "lng" => "-80.05481320023317",
            "address" => "1400 block Preston St ",
            "zone" => "Zone 6",
            "date" => "2016-03-01",
            "time" => "00:15:00",
            "concildistrict" => "2",
            "incidenttype" => array(
                "type" => "OFFENSE 2.0 ",
                "age" => "",
                "gender" => "",
                "description" => array(
                    "section" => "",
                    "description" => ""
                )
            )
        ),
        array(
            "incident" => "160376751",
            "lat" => "40.373500639348507",
            "lng" => "-80.05481320023317",
            "address" => "1400 block Preston St ",
            "zone" => "Zone 6",
            "date" => "2016-03-01",
            "time" => "00:15:00",
            "concildistrict" => "2",
            "incidenttype" => array(
                "type" => "OFFENSE 2.0 ",
                "age" => "",
                "gender" => "",
                "description" => array(
                    "section" => "",
                    "description" => ""
                )
            )
        ),
    )
);

function array_to_xml($array, &$xml_user_info) {
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            if (!is_numeric($key)) {
                $subnode = $xml_user_info->addChild("$key");
                array_to_xml($value, $subnode);
            } else {
                $subnode = $xml_user_info->addChild("item$key");
                array_to_xml($value, $subnode);
            }
        } else {
            $xml_user_info->addChild("$key", htmlspecialchars("$value"));
        }
    }
}

//creating object of SimpleXMLElement
$xml_incident_info = new SimpleXMLElement("<?xml version=\"1.0\"?><incidents_info></incidents_info>");

//function call to convert array to xml
array_to_xml($is, $xml_incident_info);

//saving generated xml file
$xml_file = $xml_incident_info->asXML('is.xml');

//success and error message based on xml creation
if ($xml_file) {
    echo 'XML file have been generated successfully.';
} else {
    echo 'XML file generation error.';
}