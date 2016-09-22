<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Police Blotter</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="CodeForPittsburgh">
        <meta name="author" content="Mark Howe">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="icon" href="img/myicon.png">
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

                </div>

            </div>
        </div>


        <div class="row">
            <div class="col-sm-3">
                <h4 id="Maps">Maps:</h4>

                <a href="./PPBmap.php" class="btn btn-info btn-block" role="button">Open Blotter</a>
                <a href="./PPBXMLAddressMarkerCreate.php" class="btn btn-info btn-block" role="button">Open Blotter Group by Address</a>
                <a href="../PPBQorg/index.php" class="btn btn-info btn-block" role="button">Open Blotter Heat Map (R1.3.2a)</a> 



            </div>
            <div class="col-sm-3">
                <h4 id="Tables">Tables:</h4>

                <a href="../PPBQorg/GenericQuery.php" class="btn btn-info btn-block" role="button">Generic Query</a> 
                <a href="../FileDownload/SelectionQuery.php" class="btn btn-info btn-block" role="button">File Download Query</a> 
                <a href="./SelectionQuery.php" class="btn btn-info btn-block" role="button">Selection Query</a> 
                <a href="./DescriptionsList.php" class="btn btn-info btn-block" role="button">Description Totals</a>
                <a href="./MonthlyDescriptions.php" class="btn btn-info btn-block" role="button">Monthly Description Totals</a>
                <a href="./GenericMonthlyDescriptions.php?column=neighborhood" class="btn btn-info btn-block" role="button">Neighborhood Monthly Description Totals</a>
                <a href="./GenericMonthlyDescriptions.php?column=councildistrict" class="btn btn-info btn-block" role="button">Council District Monthly Description Totals</a>

                <a href="./GenericMonthlyDescriptions.php?column=zone" class="btn btn-info btn-block" role="button">Police Zone Monthly Description Totals</a>


                <a href="./IncidentTotals.php" class="btn btn-info btn-block" role="button">Incident Totals</a>
                <a href="./YesterdayDescriptionCount.php" class="btn btn-info btn-block" role="button">Yesterday Description Totals</a>  

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

            </div>
        </div>
    </div>
</body>
</html>

