<!DOCTYPE html>
<html>
    <head>
        <title>Incident Markers</title>
        <link rel="icon" href="../img/myicon.png">
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCb3EA0lfao273s6Jkp8tfTzJfUSkswpOw"></script>
        <script src="../js/jquery-1.11.2.js"></script>
        <script src="../js/PoliceZoneInformation.js"></script>
        <script src="../js/citymapoverlays.js"></script>

        <style>
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
            #map {
                height: 100%;
            }
            #floating-panel {
                position: absolute;
                top: 10px;
                left: 25%;
                z-index: 5;
                background-color: #fff;
                padding: 5px;
                border: 1px solid #999;
                text-align: center;
                font-family: 'Roboto','sans-serif';
                line-height: 30px;
                padding-left: 10px;
            }
            #descriptioncout {
                position:absolute;
                top: 440px;
                left: 10px;
                height:180px;
                width:520px;
                border:1px solid #ccc;
                font:16px/26px Georgia, Garamond, Serif;
                overflow:auto;  
            }
        </style>
    </head>
    <body>
        <div id="floating-panel">
            <input onclick="buildmarkers();" type=button value="Reset Markers">
            <input onclick="processGeoJson(0);" type=button value= "Council District" id ="CouncilDistrict">
            <input onclick="processGeoJson(1);" type=button value= "Neighborhood" id = "Neighborhood">
            <input onclick="processGeoJson(2);" type=button value= "Police Zone" id = "PoliceZone">
            <div id="info-box">?</div>
        </div>
        <div id="map"></div>
        <div id="descriptioncout">
            <?php
            include '../Tables/MarkerDescriptionCount.php';
            ?>
        </div>

        <script>


            // In the following example, markers appear when the user clicks on the map.
            // The markers are stored in an array.
            // The user can then click an option to hide, show or delete the markers.
            var map;
            var markers = [];
            var mmarkers;
            var infoWindow = new google.maps.InfoWindow;
            var customIcons = {
                ARREST: {
                    icon: '../img/mm_20_blue.png'
                            //icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
                },
                OFFENSE: {
                    icon: '../img/mm_20_yellow.png'
                },
                BOTH: {
                    icon: '../img/mm_20_red.png'
                }
            };
            var section = '9999';
            function initMap() {
                var Pittsburgh = {lat: 40.435467, lng: -79.996404};

                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 12,
                    center: Pittsburgh,
                    mapTypeControl: true,
                    mapTypeControlOptions: {
                        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                        mapTypeIds: ['roadmap', 'terrain', 'hybrid', 'satellite']
                    }

                });

                // This event listener will call addMarker() when the map is clicked.
                //map.addListener('click', function (event) {
                //    addMarker(event.latLng);
                //});

                // Adds a marker at the center of the map.
                // addMarker(Pittsburgh);
                downloadUrl("../maps/PoliceBlotterMap2_1.php", function (data) {
                    xml = data.responseXML;
                    //alert(" In DOWNLOAD " + xml);
                    buildmarkers();
                    //alert(" After DOWNLOAD " + xml);
                });
                processGeoJson(2);
                setPPMarkers(map, stations);
            }
            function buildmarkers()
            {
                //alert("Build markers");
                deleteMarkers();
                mmarkers = xml.documentElement.getElementsByTagName("marker");

                for (var i = 0; i < mmarkers.length; i++) {
                    var zone = mmarkers[i].getAttribute("zone");
                    var address = mmarkers[i].getAttribute("address");
                    var type = mmarkers[i].getAttribute("type");
                    var incidentdate = mmarkers[i].getAttribute("incidentdate");
                    var incidenttime = mmarkers[i].getAttribute("incidenttime");
                    if (incidenttime === null)
                    {
                        incidenttime = "N/A";
                    }
                    var age = mmarkers[i].getAttribute("age");
                    if (age === "")
                    {
                        age = "N/A";
                    }
                    var gender = mmarkers[i].getAttribute("gender");
                    if (gender === "")
                    {
                        gender = "N/A";
                    }
                    var incidentnumber = mmarkers[i].getAttribute("incidentnumber");
                    var description = mmarkers[i].getAttribute("description");
                    var point = new google.maps.LatLng(
                            parseFloat(mmarkers[i].getAttribute("lat")),
                            parseFloat(mmarkers[i].getAttribute("lng")));
                    var html = "<b>" + incidentnumber + "</b> <br/>" + type + "<br/>" + incidentdate + " " + incidenttime + "<br/>" + zone + "<br/>" + address + "<br/>Age: " + age + " Gender: " + gender + "<br/>" + description;

                    var icon = customIcons[type];

                    //bindInfoWindow(addMarker(point), map, infoWindow, html);
                    addMarker(point, infoWindow, html, icon);

                }

            }
            function bindInfoWindow(marker, map, infoWindow, html, icon) {

                google.maps.event.addListener(marker, 'click', function () {
                    infoWindow.setContent(html);
                    infoWindow.open(map, marker);
                    //infoWindow.open(marker.get('map'), marker);

                });
            }
            // Adds a marker to the map and push to the array.
            function addMarker(location, infoWindow, html, icon) {
                var marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    icon: icon.icon
                });
                markers.push(marker);
                bindInfoWindow(marker, map, infoWindow, html);
            }

            // Sets the map on all markers in the array.
            function setMapOnAll(map) {
                for (var i = 0; i < markers.length; i++) {
                    markers[i].setMap(map);
                }
            }

            // Removes the markers from the map, but keeps them in the array.
            function clearMarkers() {
                setMapOnAll(null);
            }

            // Shows any markers currently in the array.
            function showMarkers() {
                setMapOnAll(map);
            }

            // Deletes all markers in the array by removing references to them.
            function deleteMarkers() {
                clearMarkers();
                markers = [];
            }
            function addSectionMarkers()
            {
                var count = 0;
                //alert("add Section Markers " + mmarkers.length + " looking for "+ section);
                for (var i = 0; i < mmarkers.length; i++) {
                    var description = mmarkers[i].getAttribute("description");
                    if (description.includes(section))
                    {
                        type = 2;
                        var icon = customIcons[type];
                        markers[i].setIcon(icon);
                        markers[i].setMap(map);
                        count++;
                    }
                }
                //alert("Count of " + section + " is " + count);
            }
            function downloadUrl(url, callback) {
                var request = window.ActiveXObject ?
                        new ActiveXObject('Microsoft.XMLHTTP') :
                        new XMLHttpRequest;

                request.onreadystatechange = function () {
                    if (request.readyState === 4) {
                        request.onreadystatechange = doNothing;
                        callback(request, request.status);
                    }
                };

                request.open('GET', url, true);
                //request.setRequestHeader();
                request.send(null);
            }

            function doNothing() {
            }
            $(document).ready(function () {
                $("button").click(function () {
                    //alert("Button Clicked ");
                    var me = $(this);
                    //alert("Me "+ me.val());
                    section = me.val();
                    //alert("Section is " + section);
                    addSectionMarkers();
                    //$("#test").hide();
                });
            });
            google.maps.event.addDomListener(window, 'load', initMap);
        </script>

    </body>

</html>
