<?php

# FileName="connect.php"
#$hostname = "localhost";
#$database = "people";
#$username = "root";
#$password = "";

$hostname[2] = "db-pblotter-v1-server2.cdtmqej4olqy.us-west-2.rds.amazonaws.com";
$port[2] = 5432;
$database[2] = "CfAPGHPoliceBlotter";
$username[2] = "cfapghpolicebltrrdr";
$password[2] = "B10tt34RDR";
$connect_timeout[2] = 60;

$hostname[1] = "cfapghpoliceblotter.cnsbqqmktili.us-east-1.rds.amazonaws.com";
$port[1] = 5432;
$database[1] = "CfAPGHPoliceBlotter";
$username[1] = "cfapghpolicebltrrdr";
$password[1] = "B10tt34RDR";
$connect_timeout[1] = 60;

#include 'connect.php';
#$connectstr = 'host='.$hostname . ' port='.$port . ' dbname='.$database.' user='.$username.' password='.$password . ' connect_timeout='.$connect_timeout;
#$dbconn = pg_connect($connectstr);

$database[0] = "postgres";
$hostname[0] = "howe-hp";
$username[0] = "postgres";
$password[0] = "win95sux";
$connect_timeout[0] = 60;
$port[0] = 5432;

$machine = 2;

$hostname = $hostname[$machine];
$port = $port[$machine];
$database = $database[$machine];
$username = $username[$machine];
$password = $password[$machine];
$connect_timeout = $connect_timeout[$machine];

