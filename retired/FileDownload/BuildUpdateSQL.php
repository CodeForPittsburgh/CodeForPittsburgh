<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * Open File status.csv
 * Read rows until end of file
 * ignore first row
 * Format output
 * UPDATE "PoliceBlotter2".description SET status='N/A' where section = '9498';
 * Write sql file statusupdate.sql
 * end
 */


$fd = fopen ("status.csv", "r");

    while(!feof($fd)) {
        $buffer = fgetcsv($fd);
        //echo $buffer[0] . " " .$buffer[1] . PHP_EOL;
        $update = "UPDATE \"PoliceBlotter2\".description SET status='".$buffer[1] ."' where section = '".$buffer[0] ."';";
        echo $update . "</br>";
    }

fclose ($fd);

