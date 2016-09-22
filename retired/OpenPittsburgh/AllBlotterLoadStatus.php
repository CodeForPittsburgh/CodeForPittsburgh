<?php

$timezone = "America/New_York";
date_default_timezone_set($timezone);
$seconds = 300;
set_time_limit($seconds);
$time = time();

$yesterday = date("Y-m-d", mktime(0, 0, 0, date("n", $time), date("j", $time) - 1, date("Y", $time)));

$SQL = "select zone,count(zone)
from \"PoliceBlotter2\".incident
where incidentdate = '" . $yesterday . "'
group by zone
order by zone;";

$hostname[2] = "db-pblotter-v1-server2.cdtmqej4olqy.us-west-2.rds.amazonaws.com";
$port[2] = 5432;
$database[2] = "CfAPGHPoliceBlotter";
$username[2] = "cfapghpolicebltrrdr";
$password[2] = "B10tt34RDR";
$connect_timeout[2] = 60;

$hostname[0] = "cfapghpoliceblotter.cnsbqqmktili.us-east-1.rds.amazonaws.com";
$port[0] = 5432;
$database[0] = "CfAPGHPoliceBlotter";
$username[0] = "cfapghpolicebltrrdr";
$password[0] = "B10tt34RDR";
$connect_timeout[0] = 60;

#include 'connect.php';
#$connectstr = 'host='.$hostname . ' port='.$port . ' dbname='.$database.' user='.$username.' password='.$password . ' connect_timeout='.$connect_timeout;
#$dbconn = pg_connect($connectstr);

$database[1] = "postgres";
$hostname[1] = "howe-hp";
$username[1] = "postgres";
$password[1] = "win95sux";
$connect_timeout[1] = 60;
$port[1] = 5432;

for ($machine = 0; $machine < 3; $machine++) {
    //echo $machine;
    //echo "<br>";
    $hostnamers = $hostname[$machine];
    $portrs = $port[$machine];
    $databasers = $database[$machine];
    $usernamers = $username[$machine];
    $passwordrs = $password[$machine];
    $connect_timeoutrs = $connect_timeout[$machine];

    //echo $hostnamers;
    //echo "<br>";
    //echo $portrs;
    //echo "<br>";
    //echo $usernamers;
    //echo "<br>";
    //echo $passwordrs;
    //echo "<br>";
    //echo $connect_timeoutrs;
    //echo "<br>";


    $dbconn = pg_connect('host=' . $hostnamers . ' port=' . $portrs . ' dbname=' . $databasers . ' user=' . $usernamers . ' password=' . $passwordrs . ' connect_timeout=' . $connect_timeoutrs);

    $result = pg_query($dbconn, $SQL);

    $rowcount = 0;
    $zone[] = array();
    $zonecounts[] = array();
    while ($row = pg_fetch_row($result)) {

        $zone[$rowcount] = $row[0];
        $zonecounts[$rowcount] = $row[1];


        $rowcount++;
    }
    $arrlength = count($zone);
    if ($arrlength < 6) {
        echo 'bad,';
        //echo '<p><b>Warning: Incomplete Data Load: ' . $arrlength . '</b></p>';
    } else {
        echo 'good,';
        //echo '<p>Normal Data Load</p>';
    }

//        for ($x = 0; $x < $arrlength; $x++) {
//            echo $zone[$x] . " " . $zonecounts[$x];
//            echo "<br>";
//        }

    pg_close();
}
