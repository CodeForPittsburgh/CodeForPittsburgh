<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <title>Police Blotter Map Selection Query</title>
            <meta name="description" content="">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="icon" href="../img/myicon.png">
            <link rel="apple-touch-icon" href="apple-touch-icon.png">
            <link rel="stylesheet" href="../css/bootstrap.css">

            <link rel="stylesheet" href="../css/main.css">
            <script src="../js/jquery-1.11.2.js"></script>
            <script src="../js/bootstrap.js"></script>


            <link rel="stylesheet" href="../jqwidgets/styles/jqx.base.css" type="text/css" />
            <script src="../jqwidgets/jqxcore.js"></script>
            <script src="../jqwidgets/jqxdata.js"></script>
        </head>
        <body>
            <!--[if lt IE 8]>
                <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->


            <!-- Main jumbotron for a primary marketing message or call to action -->
            <div class="jumbotron">  
                <h2><center>Police Blotter Map Selection Query</center></h2>
                <h4><center>Note: This is a query selection. Select your option and click the Add Button</center></h4>
                <h4><center>After you've made your selections click the Submit Button</center></h4>
                <h4><center>If you wish only one selection, pick your option and press Submit Button</center></h4>
                <h4><center>The process creates a map with your selected data</center></h4>
                <?php
                include ('../resources/copyright.php');
                ?>              
                <!--
                                <h5><center>CodeForPittsburgh &copy; 2016</center></h5>
                -->
            </div>

            <div class="container">
                <!-- Example row of columns -->
                <div class="row">  
                    <div class="col-md-3">
                        <h2>Calendar</h2>
                        <script type="text/javascript">
                            var parmlist = "";
                            var mindate;
                            var maxdate;
                            // var maptype = document.getElementById('mymaptype').value;
                            var url = "../includes/DateRange.php";
                            // prepare the data
                            var source =
                                    {
                                        datatype: "json",
                                        datafields: [
                                            {name: 'MinDate', type: 'string'},
                                            {name: 'MaxDate', type: 'string'}
                                        ],
                                        url: url,
                                        cache: false
                                    };
                            // alert("Before Adapter");
                            var length;
                            var records;
                            var record;
                            var mymindate;
                            var mymaxdate;
                            // var maptype ="pin";

                            var dataAdapter = new $.jqx.dataAdapter(source, {
                                loadComplete: function (records) {
                                    // get data records.
                                    records = dataAdapter.records;
                                    length = records.length;
                                    // perform Data Binding.
                                    //alert(length + " <<");
                                    record = records[length - 1];
                                    mindate = record.MinDate;
                                    maxdate = record.MaxDate;
                                    //alert(mindate + " " + maxdate);
                                    document.getElementById("daterange").innerHTML =
                                            'Enter a start date on or after: <br> '
                                            + '<input type="date" id="mindate" name="mindate" min="' + mindate + '" value="' + mindate + '"><br><br>'
                                            + 'Enter an ending date on or before: <br> '
                                            + '<input type="date" id="maxdate" name="maxdate" max="' + maxdate + '" value="' + maxdate + '"><br><br>'
                                            + '<input type="button" value="Next" onclick="msgme()">';
                                }
                            });
                            dataAdapter.dataBind();

                        </script>
                        <!-- need to create start end range as var -->
                        <form id="daterange">
                        </form>   


                        <p id="buttonhref"></p>


                    </div>         

                    <div class="col-md-3">
                        <h2>Council District</h2>
                        <p>You can select a Council District (1-9).</p>
                        <?php
                        include '../includes/CouncilDistrict.php';
                        ?>

<!-- <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p> -->
                    </div>
                    <div class="col-md-3">
                        <h2>Neighborhood</h2>
                        <p>You can select a Neighborhood</p>
                        <?php
                        include '../includes/Neighborhood.php';
                        ?>

                    <!-- <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p> -->
                    </div>
                    <div class="col-md-3">
                        <h2>Police Zone</h2>
                        <p>You can select a Police Zone.</p>
                        <?php
                        include '../includes/PoliceZones.php';
                        ?>
                        <!-- <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p> -->
                    </div>
                </div>
            </div>
            <hr>
            <div class="container">
                <h2>Incident Descriptions</h2>
                <p>Select a Description</p>
                <?php
                include '../includes/Description.php';
                ?>

                <h2>Address Entry</h2>
                <p>Enter an Address</p>
                <?php
                include '../includes/Address.php';
                ?>


            </div>
            <!-- /container --> 
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.js"></script>
            <script>window.jQuery || document.write('<script src="../js/jquery-1.11.2.js"><\/script>');</script>

            <script src="../js/bootstrap.min.js"></script>

            <script src="../js/main.js"></script>

            <script>
                            var startdate;
                            var enddate;
                            var openme;
                            function getdates()

                            {
                                startdate = document.getElementById('mindate').value;
                                enddate = document.getElementById('maxdate').value;
                            }
                            function createURLcall(parm)
                            {
                                getdates();
                                var val = document.getElementById(parm).value;
                                openme = "SelectionMapXMLAddressMarkerCreate.php?mindate=" + startdate + "&maxdate=" + enddate + "&" + parm + "=" + val;
                                //openme = "createTable.php?mindate=" + startdate + "&maxdate=" + enddate + "&" + parm + "=" + val;
                                //alert(openme);
                                window.open(openme, "_self");
                            }

                            function createURLBulkCall(parm)
                            {
                                if (parmlist === "")
                                {
                                    AddParm(parm);
                                }
                                getdates();
                                //var val = document.getElementById(parm).value;
                                openme = "SelectionMapXMLAddressMarkerCreate.php?mindate=" + startdate + "&maxdate=" + enddate + parmlist;
                                //openme = "createTable.php?mindate=" + startdate + "&maxdate=" + enddate + parmlist;
                                //alert(openme);
                                window.open(openme, "_self");
                            }

                            function msgme() {
                                var mymindate = document.getElementById('mindate').value;
                                var mymaxdate = document.getElementById('maxdate').value;
                                document.getElementById("buttonhref").innerHTML = '<a class="btn btn-default" role="button" href="SelectionMapXMLAddressMarkerCreate.php?mindate=' + mymindate + '&maxdate=' + mymaxdate + '" >View details &raquo;</a>';
                            }


                            function AddParm(parm)
                            {

                                var val = document.getElementById(parm).value;
                                parmlist += "&" + parm.trim() + "=" + val.trim();
                                //alert(parmlist);
                                //createURLBulkCall(parmlist);
                            }

                            //http://lenovo-pc/OpenPittsburghWeb/OpenPittsburgh/SelectionMapXMLAddressMarkerCreate.php?mindate=2016-08-11&maxdate=2016-08-11&neighborhood=Westwood
                            //http://lenovo-pc/OpenPittsburghWeb/OpenPittsburgh/SelectionMapXMLAddressMarkerCreate.php?mindate=2015-03-10&maxdate=2016-08-11&section=5510
                            //http://lenovo-pc/OpenPittsburghWeb/OpenPittsburgh/PPBXMLMarkerMap.php?filename=../xml/SelectionMapmarker.xml&query=where%20i.descriptionid%20=%20d.descriptionid%20%20and%20i.incidentdate%20between%20%272015-03-10%27%20and%20%272016-08-11%27%20and%20address%20like%20%27%Oakbrook%%27
                            //http://lenovo-pc/OpenPittsburghWeb/OpenPittsburgh/PPBXMLMarkerMap.php?filename=../xml/SelectionMapmarker.xml&query=from%202015-03-10%20to%202016-08-11%20and%20address%20like%20%27%Oakbrook%%27
            </script>

        </body>
    </html>
