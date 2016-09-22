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
            <title>Police Blotter Map Query 1.0</title>
            <meta name="description" content="">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="icon" href="img/myicon.png">
            <link rel="apple-touch-icon" href="apple-touch-icon.png">

            <link rel="stylesheet" href="css/bootstrap.min.css">

            <link rel="stylesheet" href="css/bootstrap-theme.min.css">
            <link rel="stylesheet" href="css/main.css">

            <link rel="stylesheet" href="jqwidgets/styles/jqx.base.css" type="text/css" />
            <script type="text/javascript" src="scripts/jquery-1.11.1.min.js"></script>
            <script type="text/javascript" src="jqwidgets/jqxcore.js"></script>
            <script type="text/javascript" src="jqwidgets/jqxdata.js"></script>

        </head>
        <body>
            <!--[if lt IE 8]>
                <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->


            <!-- Main jumbotron for a primary marketing message or call to action -->
            <div class="jumbotron">  
                <h2><center>Police Blotter Map Queries 1.0</center></h2>
                <h5><center>&copy; CodeForPittsburgh 2016</center></h5>

            </div>

            <div class="container">
                <!-- Example row of columns -->
                <div class="row">  
                    <div class="col-md-3">
                        <h2>Calendar</h2>
                        <script type="text/javascript">
                            var mindate;
                            var maxdate;
                            // var maptype = document.getElementById('mymaptype').value;
                            var url = "DateRange.php";
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
                        include 'CouncilDistrict.php';
                        ?>
                        <!-- <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p> -->
                    </div>
                    <div class="col-md-3">
                        <h2>Neighborhood</h2>
                        <p>You can select a Neighborhood</p>
                        <?php
                        include 'Neighborhood.php';
                        ?>

                    <!-- <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p> -->
                    </div>
                    <div class="col-md-3">
                        <h2>Police Zone</h2>
                        <p>You can select a Police Zone.</p>
                        <?php
                        include 'PoliceZones.php';
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
                include 'Description.php';
                ?>
            </div

        </div>
        <!-- /container --> 
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.js"><\/script>');</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/main.js"></script>

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
                                openme = "createHeatLatLng.php?mindate=" + startdate + "&maxdate=" + enddate + "&" + parm + "=" + val;
                                //alert(openme);
                                window.open(openme, "_self");
                            }

                            function msgme() {
                                var mymindate = document.getElementById('mindate').value;
                                var mymaxdate = document.getElementById('maxdate').value;
                                //var maptype = getRadioVal(document.getElementById('mymaptype'), 'maptype');
                                //var maptype = "TBD";
                                //var val = getRadioVal(document.getElementById('mymaptype').innerHTML, 'maptype');
                                //alert(val);

                                //alert("Parm List" + mymindate + " " + mymaxdate + " " + maptype);
                                document.getElementById("buttonhref").innerHTML = '<a class="btn btn-default" role="button" href="SearchTest.php?mindate=' + mymindate + '&maxdate=' + mymaxdate + '" >View details &raquo;</a>';
                            }

                            function getRadioVal(form, name) {
                                var val;
                                //alert(form);
                                //alert(name);//

                                // get list of radio buttons with specified name

                                var radios = form.elements[name];
                                //alert(radios);

                                // loop through list of radio buttons
                                for (var i = 0, len = radios.length; i < len; i++) {
                                    if (radios[i].checked) { // radio checked?
                                        val = radios[i].value; // if so, hold its value in val
                                        break; // and break out of for loop
                                    }
                                }
                                //alert(val);
                                return val; // return value of checked radio or undefined if none checked
                            }
        </script>

    </body>
</html>
