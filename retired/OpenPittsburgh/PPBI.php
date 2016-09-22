<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Police Blotter</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="CodeForPittsburgh">
        <meta name="author" content="Mark Howe">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="icon" href="../img/myicon.png">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <script src="../js/jquery-1.11.2.js"></script>
        <script src="../js/bootstrap.js"></script>
    </head>
    <body>

        <div class="container">
            <div class="jumbotron">
                <h1 class="text-center">Pittsburgh Police Blotter Index</h1>
                <h4 class="text-center">CodeForPittsburgh © 2016</h4>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <h3>Navigation:</h3>
                    <a href="#Maps" class="btn btn-info btn-block" role="button">Map Section</a>
                    <a href="#Tables" class="btn btn-info btn-block" role="button">Table Section</a>
                    <a href="#Data" class="btn btn-info btn-block" role="button">Data Section</a>
                    <a href="#Reference" class="btn btn-info btn-block" role="button">Reference Section</a>
                    <!--
                                        <a href="./PPBmap.html" class="btn btn-info btn-block" role="button">Open Blotter</a>
                                        <a href="./PPBXMLAddressMarkerCreate.php" class="btn btn-info btn-block" role="button">Open Blotter Group by Address</a>
                                        <a href="../../PPBQ/index.php" class="btn btn-info btn-block" role="button">Open Blotter Heat Map (R1.3.1a)</a>
                    
                                        <a href="./Descriptions.php" class="btn btn-info btn-block" role="button">Description Totals</a>
                                        <a href="./MonthlyDescriptions.php" class="btn btn-info btn-block" role="button">Monthly Description Totals</a>
                                        <a href="./GenericMonthlyDescriptions.php?column=neighborhood" class="btn btn-info btn-block" role="button">Neighborhood Monthly Description Totals</a>
                                        <a href="./GenericMonthlyDescriptions.php?column=councildistrict" class="btn btn-info btn-block" role="button">Council District Monthly Description Totals</a>
                    
                                        <a href="./GenericMonthlyDescriptions.php?column=zone" class="btn btn-info btn-block" role="button">Police Zone Monthly Description Totals</a>
                    
                    
                                        <a href="./IncidentTotals.php" class="btn btn-info btn-block" role="button">Incident Totals</a>
                                        <a href="./YesterdayDescriptionCount.php" class="btn btn-info btn-block" role="button">Yesterday Description Totals</a>
                    -->
                    <!--                   <a href="http://communitysafety.pittsburghpa.gov/Blotter.aspx" class="btn btn-info btn-block" role="button">Pittsburgh Police Blotter PDF/csv Web site</a> -->
                    <!--
                    <a href="https://github.com/codeforpgh/jsonIncidents2014.git/" class="btn btn-info btn-block" role="button">Incident json data 2014</a>
                    <a href="https://github.com/codeforpgh/jsonIncidents2015.git/" class="btn btn-info btn-block" role="button">Incident json data 2015</a>
                    <a href="https://github.com/codeforpgh/jsonIncidents2016.git/" class="btn btn-info btn-block" role="button">Incident json data 2016</a>

                    <a href="https://github.com/codeforpgh/csvIncidents2015.git" class="btn btn-info btn-block" role="button">Incident csv data 2015</a>
                    <a href="https://github.com/codeforpgh/csvIncidents2016.git" class="btn btn-info btn-block" role="button">Incident csv data 2016</a>

                    <a href="http://pittsburghpa.gov/publicsafety/interactive-reports-intro" class="btn btn-info btn-block" role="button">Public Safety Reports</a>
                    <a href="https://www.fbi.gov/about-us/cjis/ucr/crime-in-the-u.s/2011/crime-in-the-u.s.-2011/offense-definitions" class="btn btn-info btn-block" role="button">FBI Offense Definitions </a>

                    <a href="http://www.codeforamerica.org/" class="btn btn-info btn-block" role="button">Code for America</a>
                    -->
                </div>

                <div class="col-sm-5">
                    <h3>About the Police Blotter:</h3>
                    <?php
                    include 'AboutTheBlotter.php';
                    ?>
                </div>
                <div class="col-sm-3">

                    <h3>Message Area:</h3>

                    <?php
                    include 'BlotterLoadStatus.php';
                    ?>

                    <?php
                    include 'MessageFile.php';
                    ?>
<a href="PoliceBlotterUserManual.pdf">Police Blotter User Manual</a>

                </div>
                    <!--
                                        <p><a href="./HumptyDumpty.html" target="_blank">Humpty Dumpty is coming</a></p>
                    
                    <p><b>I think the problem has been corrected</b> <p> 
                    -->

                    <!--<p><b>Geo coding service is down. No map data</b> <p> -->
                    <!--<p>Open Blotter Heat Map Beta added.</p>
                                        <p>Open Blotter by Address added.</p>
                                        <p>Links to 2014 and 2015 Incident data in json format published on GitHub.</p>
                                        <p>Link to 2015 Incident data in the new csv format published on GitHub.</p>
                                        <p>Incident totals link to selected data.</p>
                    -->
                </div>
            </div>
            <!--
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="text-center">Disclaimer</h3>

                    <p>The Pittsburgh Bureau of Police csv file is processed every morning at 0300 for the previous day of the city's police incidents. The display is limited to the accuracy of the contents and the number of incidents provided by the police and might not include all incidents for the day. It is important that any decisions based on this data be confirmed using additional resources. As the city says, "The City of Pittsburgh has provided this information as a service. The City assumes no responsibility for the use of information posted on this site." Mark Howe and Sunil Mogadati are the current team. Tim Condello, Mark Howe, Andrew McGill, Andy Somerville are the Original CodeForPittsburgh Project Team Members.</p>
                    <h4  class="text-center">Copyright © 2016 <a href="https://twitter.com/codeforpgh" target="_blank">@codeforpgh</a></h4>
                </div>
            </div>
            -->

            <div class="row">
                <div class="col-sm-3">
                    <h4 id="Maps">Maps:</h4>

                    <a href="./PPBmap.php" class="btn btn-info btn-block" role="button">Open Blotter</a>
                    <a href="./PPBXMLAddressMarkerCreate.php" class="btn btn-info btn-block" role="button">Open Blotter Group by Address</a>
                    <a href="./SelectionMapQuery.php" class="btn btn-info btn-block" role="button">Selection Map Query by Address</a>
                    <a href="../PPBQorg/index.php" class="btn btn-info btn-block" role="button">Open Blotter Heat Map (R1.3.2a)</a> 



                </div>
                <div class="col-sm-3">
                    <h4 id="Tables">Tables:</h4>
<!--
                    <a href="../../PPBQuery/public_html/GenericQuery.php" class="btn btn-info btn-block" role="button">Generic Query</a> 
                    -->
                    <a href="GenericQuery.php" class="btn btn-info btn-block" role="button">Generic Query</a> 
                    <a href="./FileDownload/SelectionQuery.php" class="btn btn-info btn-block" role="button">File Download Query</a> 
                    <a href="SelectionQuery.php" class="btn btn-info btn-block" role="button">Selection Query</a> 
                    <a href="DescriptionsList.php" class="btn btn-info btn-block" role="button">Description Totals</a>
                    <a href="MonthlyDescriptions.php" class="btn btn-info btn-block" role="button">Monthly Description Totals</a>
                    <a href="GenericMonthlyDescriptions.php?column=neighborhood" class="btn btn-info btn-block" role="button">Neighborhood Monthly Description Totals</a>
                    <a href="GenericMonthlyDescriptions.php?column=councildistrict" class="btn btn-info btn-block" role="button">Council District Monthly Description Totals</a>

                    <a href="GenericMonthlyDescriptions.php?column=zone" class="btn btn-info btn-block" role="button">Police Zone Monthly Description Totals</a>


                    <a href="IncidentTotals.php" class="btn btn-info btn-block" role="button">Incident Totals</a>
                    <a href="YesterdayDescriptionCount.php" class="btn btn-info btn-block" role="button">Yesterday Description Totals</a>  

                </div>
                <div class="col-sm-3">
                    <h4 id="Data">Data:</h4>

                    <a href="https://github.com/codeforpgh/jsonIncidents2014.git/" class="btn btn-info btn-block" role="button">Incident json data 2014</a>
                    <a href="https://github.com/codeforpgh/jsonIncidents2015.git/" class="btn btn-info btn-block" role="button">Incident json data 2015</a>
                    <a href="https://github.com/codeforpgh/jsonIncidents2016.git/" class="btn btn-info btn-block" role="button">Incident json data 2016</a>

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
                    <?php include 'Disclaimer.php'; ?>
                    <!--
                    <h3 class="text-center">Disclaimer</h3>

                    <p>The Pittsburgh Bureau of Police csv file is processed every morning at 0300 for the previous day of the city's police incidents. The display is limited to the accuracy of the contents and the number of incidents provided by the police and might not include all incidents for the day. It is important that any decisions based on this data be confirmed using additional resources. As the city says, "The City of Pittsburgh has provided this information as a service. The City assumes no responsibility for the use of information posted on this site." Mark Howe and Sunil Mogadati are the current team. Tim Condello, Mark Howe, Andrew McGill, Andy Somerville are the Original CodeForPittsburgh Project Team Members.</p>
                    <h4  class="text-center">Copyright © 2016 <a href="https://twitter.com/codeforpgh" target="_blank">@codeforpgh</a></h4>
                    -->
                </div>
            </div>
        </div>
    </body>
</html>

