<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Police Blotter</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="CodeForPittsburgh">
        <meta name="author" content="Mark Howe">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="icon" href="./img/myicon.png">
        <link rel="stylesheet" href="./css/bootstrap.css">
        <script src="./js/jquery-1.11.2.js"></script>
        <script src="./js/bootstrap.js"></script>
    </head>
    <body>

        <div class="container">
            <div class="jumbotron">
                <h1 class="text-center">Pittsburgh Police Blotter Index</h1>
                <?php
                include ('./resources/copyright.php');
                ?>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <h3>Navigation:</h3>
                    <a href="#Maps" class="btn btn-info btn-block" role="button">Map Section</a>
                    <a href="#Tables" class="btn btn-info btn-block" role="button">Table Section</a>
                    <a href="#Data" class="btn btn-info btn-block" role="button">Data Section</a>
                    <a href="#Reference" class="btn btn-info btn-block" role="button">Reference Section</a>

                </div>

                <div class="col-sm-5">
                    <h3>About the Police Blotter:</h3>
                    <?php
                    include './resources/AboutTheBlotter.php';
                    ?>
                </div>
                <div class="col-sm-3">

                    <h3>Message Area:</h3>

                    <?php
                    include './resources/BlotterLoadStatus.php';
                    ?>

                    <?php
                    include './resources/MessageFile.php';
                    ?>
                    <a href="./resources/PoliceBlotterUserManual.pdf">Police Blotter User Manual</a>

                </div>

            </div>
        </div>


        <div class="row">
            <div class="col-sm-3">
                <h4 id="Maps">Maps:</h4>

                <a href="./maps/PPBmap.php" class="btn btn-info btn-block" role="button">Open Blotter</a>
                <a href="./maps/PPBXMLAddressMarkerCreate.php?incidentdate=yesterday" class="btn btn-info btn-block" role="button">Open Blotter Group by Address</a>
                <a href="./maps/SelectionMapQuery.php" class="btn btn-info btn-block" role="button">Selection Map Query by Address</a>
                <a href="./maps/HeatMap.php" class="btn btn-info btn-block" role="button">Open Blotter Heat Map (R1.3.3a)</a> 
                <a href="./tests/MarkerTest.php" class="btn btn-info btn-block" role="button">Marker Description Test</a> 



            </div>
            <div class="col-sm-3">
                <h4 id="Tables">Tables:</h4>
                <!--
                                    <a href="../../PPBQuery/public_html/GenericQuery.php" class="btn btn-info btn-block" role="button">Generic Query</a> 
                
                <a href="./Tables/GenericQuery.php" class="btn btn-info btn-block" role="button">Generic Query</a> 
                -->
                <a href="./Tables/FileSelectionQuery.php" class="btn btn-info btn-block" role="button">File Download Query</a> 
                <a href="./Tables/SelectionQuery.php" class="btn btn-info btn-block" role="button">Selection Query</a> 
                <a href="./Tables/DescriptionsList.php" class="btn btn-info btn-block" role="button">Description Totals</a>
                <a href="./Tables/MonthlyDescriptions.php" class="btn btn-info btn-block" role="button">Monthly Description Totals</a>
                <a href="./Tables/GenericMonthlyDescriptions.php?column=neighborhood" class="btn btn-info btn-block" role="button">Neighborhood Monthly Description Totals</a>
                <a href="./Tables/GenericMonthlyDescriptions.php?column=councildistrict" class="btn btn-info btn-block" role="button">Council District Monthly Description Totals</a>

                <a href="./Tables/GenericMonthlyDescriptions.php?column=zone" class="btn btn-info btn-block" role="button">Police Zone Monthly Description Totals</a>


                <a href="./Tables/IncidentTotals.php" class="btn btn-info btn-block" role="button">Incident Totals</a>
                <a href="./Tables/YesterdayDescriptionCount.php" class="btn btn-info btn-block" role="button">Yesterday Description Totals</a>  

            </div>
            <div class="col-sm-3">
                <h4 id="Data">Data:</h4>

                <a href="https://github.com/codeforpittsburgh/jsonIncidents2014.git/" class="btn btn-info btn-block" role="button">Incident json data 2014</a>
                <a href="https://github.com/codeforpittburgh/jsonIncidents2015.git/" class="btn btn-info btn-block" role="button">Incident json data 2015</a>
                <a href="https://github.com/codeforpittsburgh/jsonIncidents2016.git/" class="btn btn-info btn-block" role="button">Incident json data 2016</a>

                <a href="https://github.com/codeforpgh/csvIncidents2015.git" class="btn btn-info btn-block" role="button">Incident csv data 2015</a>
                <a href="https://github.com/codeforpgh/csvIncidents2016.git" class="btn btn-info btn-block" role="button">Incident csv data 2016</a>    

            </div>
            <div class="col-sm-3">
                <h4 id="Reference">Reference:</h4>
                <a href="http://www.pacode.com/secure/data/204/chapter303/s303.15.html" class="btn btn-info btn-block" role="button">PA CRIMES CODE OFFENSES</a>
                <a href="http://pittsburghpa.gov/publicsafety/interactive-reports-intro" class="btn btn-info btn-block" role="button">Public Safety Reports</a>
                <a href="https://www.fbi.gov/about-us/cjis/ucr/crime-in-the-u.s/2011/crime-in-the-u.s.-2011/offense-definitions" class="btn btn-info btn-block" role="button">FBI Offense Definitions </a>
                <a href="https://www.fbi.gov/about-us/cjis/ucr/nibrs-quick-facts" class="btn btn-info btn-block" role="button">FBI NIBRS Definitions </a>
                <a href="http://www.codeforamerica.org/" class="btn btn-info btn-block" role="button">Code for America</a> 

            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <?php include './resources/Disclaimer.php'; ?>
                <!--
                <h3 class="text-center">Disclaimer</h3>

                <p>The Pittsburgh Bureau of Police csv file is processed every morning at 0300 for the previous day of the city's police incidents. The display is limited to the accuracy of the contents and the number of incidents provided by the police and might not include all incidents for the day. It is important that any decisions based on this data be confirmed using additional resources. As the city says, "The City of Pittsburgh has provided this information as a service. The City assumes no responsibility for the use of information posted on this site." Mark Howe and Sunil Mogadati are the current team. Tim Condello, Mark Howe, Andrew McGill, Andy Somerville are the Original CodeForPittsburgh Project Team Members.</p>
                <?php
                include ('./resources/copyright.php');
                ?>
                <h4 <a href="https://twitter.com/codeforpgh" target="_blank">@codeforpgh</a></h4>
                -->
            </div>
        </div>
    </div>
</body>
</html>

