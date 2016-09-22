<!DOCTYPE html >
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <script src="../js/markerclusterer.js"></script>
    <title>XML Marker Map</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="CodeForPittsburgh">
    <meta name="author" content="Mark Howe">

    <link rel="icon" href="../img/myicon.png">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/maptemplate.css">

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCb3EA0lfao273s6Jkp8tfTzJfUSkswpOw&signed_in=true&libraries=visualization"></script>
    <script src="../js/jquery-1.11.2.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/maptemplate.js"></script>

    <script type="text/javascript">
        var baz = getParameterByName('filename'); // "" (present with no value)
        var qux = getParameterByName('query'); // null (absent
        var queryresults = qux;

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

</head>

<body>

    <div class="container">
        <div class="jumbotron">
            <h2  class="text-center">Pittsburgh Police Query Results</h2>
            <h3 id="localdescription" class="text-center"> </h3>
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
                    <input onclick="processGeoJson(0);" type=button value= "CouncilDistrict" id ="CouncilDistrict">
                    <br>
                    <input onclick="processGeoJson(1);" type=button value= "Neighborhood" id = "Neighborhood">
                    <br>
                    <input onclick="processGeoJson(2);" type=button value= "PoliceZone" id = "PoliceZone">
                    <br>

                    <div id="info-box">?</div>
                    <br>
                    <div id="legend">
                        <h2>Legend</h2>

                        Multiple <img title="Multiple" src="../img/mm_20_red.png" alt="Multiple" >
                        <br>
                        Police Stations <img title="Police Stations" src="../img/PittsburghPolice.png" alt="Police Stations" >
                        <br>
                    </div>
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
<script>
    document.getElementById("localdescription").innerHTML = queryresults;
</script>
</html>