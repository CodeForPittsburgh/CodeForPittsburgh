<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Police Blotter</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="CodeForPittsburgh">
        <meta name="author" content="Mark Howe">
        <link rel="icon" href="../img/myicon.png">
        <link rel="stylesheet" href="../css/bootstrap.css">

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCb3EA0lfao273s6Jkp8tfTzJfUSkswpOw&signed_in=true&libraries=visualization"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!--
                <script src="js/jquery-1.11.2.js"></script>
        -->
        <script src="../js/bootstrap.js"></script>
        <!--
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCb3EA0lfao273s6Jkp8tfTzJfUSkswpOw"></script>
        -->

        <link rel="stylesheet" href="../css/detailreset.css">
    </head>
    <body>

        <div class="container">
            <div class="jumbotron">
                <h2 class="text-center">Pittsburgh Police Blotter</h2>
                <?php
                include ('../resources/copyright.php');
                ?>
            </div>
            <div class="row">


                <div class="col-sm-10">
                    <div id ="mapsection">
                    </div>

                </div>


                <div class="col-sm-2">

                    <div id="nav">
                        <input onclick="processGeoJson(0);" type=button value= "Council District" id ="CouncilDistrict">
                        <br>
                        <input onclick="processGeoJson(1);" type=button value= "Neighborhood" id = "Neighborhood">
                        <br>
                        <input onclick="processGeoJson(2);" type=button value= "Police Zone" id = "PoliceZone">
                        <br>
                        <input onclick="buildmarkers();" type=button value= "Reset Pins" id = "ResetPins">
                        <br>
                        <input onclick="incidentpins(2701);" type=button value= "Incident Pins" id = "IncdientPins">
                        <br>
                        <div id="info-box">?</div>
                        <br>
                        <div id="legend">
                            <h2>Legend</h2>
                            Arrests <img title="Arrests" src="../img/mm_20_blue.png" alt="Arrests" >
                            <br>
                            Offense 2.0 <img title="Offense 2.0" src="../img/mm_20_yellow.png" alt="Police Stations" >
                            <br>
                            Police Stations <img title="Police Stations" src="../img/PittsburghPolice.png" alt="Police Stations" >
                            <br>
                        </div>
                    </div>
                    <div id="descriptioncout" style="height:280px;width:220px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
                        <?php
                        include '../Tables/YesterdayDescriptionCount.php';
                        ?>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <?php include '../resources/Disclaimer.php'; ?>

                </div>
            </div>
        </div>


    </body>

    <script src="../js/detailreset.js"></script>
</html>

