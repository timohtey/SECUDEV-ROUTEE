<html lang = "en">

    <head>

        <meta charset="utf-8">
        <title>Routee</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="css/coco.css" rel="stylesheet">
        <link href="css/fonts.css" type = "text/css" rel = "stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
        <link rel= "shortcut icon" href="images/routee.png">

        <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDQFSdn0OTS5bgEVYvfGMBWmkC54uk-6PM&sensor=false&libraries=places"></script>        

        <?php
        session_start();

        $lat = $_REQUEST['lat'];
        $lon = $_REQUEST['lon'];
        try {
            if (!empty($_REQUEST['pType']) && !empty($_REQUEST['placeName']) && !empty($_REQUEST['pDesc'])) {
                $type = $_REQUEST['pType'];
                $place = $_REQUEST['placeName'];
                $Description = $_REQUEST['pDesc'];
            } else {
                $type = '';
                $place = '';
                $Description = '';
            }

            if (!empty($_REQUEST['sourceField']) && $_REQUEST['destinationField']) {
                $source = $_REQUEST['sourceField'];
                $destination = $_REQUEST['destinationField'];
            } else {
                $source = '';
                $destination = '';
            }
        } catch (Exception $e) {
            
        }
        ?>
        <script>
            var lat = '<?php echo $lat; ?>';
            var lon = '<?php echo $lon; ?>';

            function view(){
            console.log(lat);
            console.log(lon);
            }
            var map;
            var centerOfMap = new google.maps.LatLng(lat, lon);
            var geocoder;
            var startLocation;
            var destinationLocation;

            var renderers = [];

            //Existing points
            var events = new Array();
            var routes = [];
            var currResponse;
            var directionsDisplay;


            function initialize() {
                var paleDawn = [{"featureType": "water", "stylers": [{"visibility": "on"}, {"color": "#acbcc9"}]}, {"featureType": "landscape", "stylers": [{"color": "#f2e5d4"}]}, {"featureType": "road.highway", "elementType": "geometry", "stylers": [{"color": "#c5c6c6"}]}, {"featureType": "road.arterial", "elementType": "geometry", "stylers": [{"color": "#e4d7c6"}]}, {"featureType": "road.local", "elementType": "geometry", "stylers": [{"color": "#fbfaf7"}]}, {"featureType": "poi.park", "elementType": "geometry", "stylers": [{"color": "#c5dac6"}]}, {"featureType": "administrative", "stylers": [{"visibility": "on"}, {"lightness": 33}]}, {"featureType": "road"}, {"featureType": "poi.park", "elementType": "labels", "stylers": [{"visibility": "on"}, {"lightness": 20}]}, {}, {"featureType": "road", "stylers": [{"lightness": 20}]}];
                directionsDisplay = new google.maps.DirectionsRenderer();
                geocoder = new google.maps.Geocoder();
               
                var mapInitialize = {
                    center: centerOfMap,
                    zoom: 15,
                    disableDoubleClickZoom: true,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    styles: paleDawn

                };
                map = new google.maps.Map(document.getElementById('map-canvas'), mapInitialize);

                directionsDisplay.setMap(map);
                directionsDisplay.setOptions({suppressMarkers: true});

                var place = '<?php echo $place; ?>';
                var type = '<?php echo $type; ?>';
                var desc = '<?php echo $Description ?>';

                if (place !== '' && type !== '' && desc !== '')
                {
                    $.ajax({
                        url: "http://maps.googleapis.com/maps/api/geocode/json?address=" + place + "&sensor=false",
                        type: "POST",
                        success: function(res) {
                            console.log(res.results[0].geometry.location.lat);
                            console.log(res.results[0].geometry.location.lng);
                            var pos = new google.maps.LatLng(res.results[0].geometry.location.lat, res.results[0].geometry.location.lng);

                            map.setCenter(pos);
                            var typeConcat;
                            if (type === "Accident")
                            {
                                typeConcat = '<option value="Accident" selected= "selected">Accident</option>' +
                                        '<option value="Flood">Flood</option>' +
                                        '<option value="Construction">Construction</option>' +
                                        '<option value="Heavy Traffic">Heavy Traffic</option>' +
                                        '<option value="Others">Others</option>';
                            }
                            else if (type === "Flood")
                            {
                                typeConcat = '<option value="Accident" >Accident</option>' +
                                        '<option value="Flood" selected= "selected">Flood</option>' +
                                        '<option value="Construction">Construction</option>' +
                                        '<option value="Heavy Traffic">Heavy Traffic</option>' +
                                        '<option value="Others">Others</option>';
                            }
                            else if (type === "Construction")
                            {
                                typeConcat = '<option value="Accident" >Accident</option>' +
                                        '<option value="Flood" >Flood</option>' +
                                        '<option value="Construction" selected= "selected">Construction</option>' +
                                        '<option value="Heavy Traffic">Heavy Traffic</option>' +
                                        '<option value="Others">Others</option>';
                            }

                            else if (type === "Heavy Traffic")
                            {
                                typeConcat = '<option value="Accident" >Accident</option>' +
                                        '<option value="Flood" >Flood</option>' +
                                        '<option value="Construction" >Construction</option>' +
                                        '<option value="Heavy Traffic" selected= "selected">Heavy Traffic</option>' +
                                        '<option value="Others">Others</option>';
                            }
                            else
                            {
                                typeConcat = '<option value="Accident" >Accident</option><option value="Flood" >Flood</option>' +
                                        '<option value="Construction" >Construction</option><option value="Heavy Traffic" >Heavy Traffic</option>' +
                                        '<option value="Others" selected= "selected">Others</option>';
                            }

                            var Report_Form = '<p><div class="marker-edit">' +
                                    '<form action="ajax-save.php" method="POST" name="SaveMarker" id="SaveMarker">' +
                                    '<label for="pAddress"><span>Address :</span> <textarea disabled name="address_ta" class="save-add" maxlength="200" placeholder= "Address">' + place + '</textarea></label>' +
                                    '<label for="pType"><span>Area Type :</span> <select name="pType" class="save-type">' + typeConcat + '</select></label>' +
                                    '<label for="pDesc"><span>Event Details</span><textarea name="pDesc" class="save-desc" placeholder="Enter Details" maxlength="200">' + desc + '</textarea></label>' +
                                    '</form>' +
                                    '</div></p><button name="save-marker" class="save-marker">Save Report!</button>';

                            add_marker(pos, 'Report Area', Report_Form, true, false, true, "");
                        }


                    });
                }

                //Get the existing points
                $.get("dbControl.php", function(data) {
                    $(data).find("marker").each(function() {
                        var deleted = $(this).attr('deleted');
                        if (deleted != 'yes') {
                            var type = $(this).attr('type');
                            var date = $(this).attr('date');
                            date = date.split(" ");
                            var desc = '<h6> Date:  ' + date[0] + '  Time:  ' + date[1] + ' </h6>' + $(this).attr('Address') + '</p><hr>' + '<p>' + $(this).attr('description') + '</p>';
                            var point = new google.maps.LatLng(parseFloat($(this).attr('lat')), parseFloat($(this).attr('lng')));
                            var iconPath;

                            if (type === "Accident")
                                iconPath = "images/custom_markers/marker_accident.png";
                            else if (type === "Construction")
                                iconPath = "images/custom_markers/marker_construction.png";
                            else if (type === "Heavy Traffic")
                                iconPath = "images/custom_markers/marker_traffic.png";
                            else if (type === "Flood")
                                iconPath = "images/custom_markers/marker_flood.png";
                            else
                                iconPath = "images/custom_markers/marker_others.png";
                            events.push(point);
                            add_marker(point, type, desc, true, false, false, iconPath);
                        }
                    });
                });
                //Right Click to Drop a New Marker
                google.maps.event.addListener(map, 'click', function(event) {

                    geocoder.geocode({'latLng': event.latLng}, function(results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            var address = results[0].formatted_address;
                        }
                        else {
                            alert("Geocoder failed due to: " + status);
                        }
                        //form to be displayed with new marker
                        var Report_Form = '<p><div class="marker-edit">' +
                                '<form action="ajax-save.php" method="POST" name="SaveMarker" id="SaveMarker">' +
                                '<label for="pAddress"><span>Address :</span> <textarea disabled name="address_ta" class="save-add" maxlength="200" placeholder= "Address">' + address + '</textarea></label>' +
                                '<label for="pType"><span>Area Type :</span> <select name="pType" class="save-type"><option value="Accident">Accident</option><option value="Flood">Flood</option>' +
                                '<option value="Construction">Construction</option><option value="Heavy Traffic">Heavy Traffic</option><option value="Others">Others</option></select></label>' +
                                '<label for="pDesc"><span>What Happened here ?</span><textarea name="pDesc" class="save-desc" placeholder="Enter Details" maxlength="200"></textarea></label>' +
                                '</form>' +
                                '</div></p><button name="save-marker" class="save-marker">Save Report!</button>';

                        add_marker(event.latLng, 'Report Area', Report_Form, true, false, true, "");
                    });
                });

                // -------------- AUTCOMPLETE ----------------------//
                var sourceInput = document.getElementById('sourceTextBox');
                var destinationInput = document.getElementById('destinationTextBox');
                var pop_source = document.getElementById('sourceTextBox_pop');
                var pop_destination = document.getElementById('destinationTextBox_pop');


                var options = {
                    componentRestrictions: {country: "ph"}
                };
                var autocomplete = new google.maps.places.Autocomplete(sourceInput, options);
                var autocomplete2 = new google.maps.places.Autocomplete(destinationInput, options);
                var autocomplete3 = new google.maps.places.Autocomplete(pop_source, options);
                var autocomplete4 = new google.maps.places.Autocomplete(pop_destination, options);


                autocomplete.bindTo('bounds', map);
                autocomplete2.bindTo('bounds', map);
                autocomplete3.bindTo('bounds', map);
                autocomplete4.bindTo('bounds', map);

                autocomplete.setComponentRestrictions({country: 'ph'});
                autocomplete2.setComponentRestrictions({country: 'ph'});
                autocomplete3.setComponentRestrictions({country: 'ph'});
                autocomplete4.setComponentRestrictions({country: 'ph'});


                var infowindow = new google.maps.InfoWindow();

                google.maps.event.addListener(autocomplete, 'place_changed', function() {
                    infowindow.close();
                    var place = autocomplete.getPlace();
                });

                google.maps.event.addListener(autocomplete2, 'place_changed', function() {
                    infowindow.close();
                    var place = autocomplete2.getPlace();
                });
                google.maps.event.addListener(autocomplete3, 'place_changed', function() {
                    infowindow.close();
                    var place = autocomplete3.getPlace();
                });

                google.maps.event.addListener(autocomplete4, 'place_changed', function() {
                    infowindow.close();
                    var place = autocomplete4.getPlace();
                });
                setupClickListener('changetype-all', []);
                google.maps.event.addDomListener(window, 'load', initialize);
            }

            /*----------------- AUTO DELETION SCRIPTS  ------------------*/
            /*----------------- RUNS EVERY MIDNIGHT FOR TYPES [CONSTRUCTION, FLOOD AND OTHERS]  ------------------*/
            var now = new Date();
            var timeForRefresh = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 0, 0, 0, 0) - now;

            if (timeForRefresh < 0)
            {
                timeForRefresh += 86400000;
            }
            var six_hours = 21600000;

            /*Time function per 24 hours at 00:00*/
            setTimeout(function() {

                for (var i = 0; i < eventDates.length; i++)
                {
                    refreshDel(eventDates[i], i);
                }

            }, timeForRefresh);
            /*Interval function per 6 hours*/
            setInterval(function() {

                for (var i = 0; i < eventDates.length; i++)
                {
                    refreshDel(eventDates[i], i);
                }


            }, six_hours);

            /*----------------- DELETION SUPPORT FUNCTION ------------------*/
            function refreshDel(date_event, index)
            {
                var oneDay = 24 * 60 * 60 * 1000;
                date_event = date_event.split(" ");
                var parts_date = date_event[0].split("-");
                var parts_time = date_event[1].split(":");
                var query_date = new Date(parts_date[0], parts_date[1] - 1, parts_date[2], parts_time[0], parts_time[1], parts_time[2]);
                var diffDays = Math.round(Math.abs((now.getTime() - query_date.getTime()) / (oneDay)));

                var oneHour = 3600000;
                var diffHours = Math.round(Math.abs((now.getTime() - query_date.getTime()) / (oneHour)));


                type = date_event[2];

                if (diffDays >= 1 && (type === "Flood" || type === "Construction" || type === "Others"))
                {
                    var pos = events[index];
                    var marker = new google.maps.Marker({
                        position: pos,
                        draggable: false
                    });
                    remove_marker(marker);
                    events.pop(events[index]);
                    eventDates.pop(date_event);
                } else if (diffDays < 1 && diffHours >= 2 && type === "Heavy Traffic")
                {
                    var pos = events[index];
                    var marker = new google.maps.Marker({
                        position: pos,
                        draggable: false
                    });
                    remove_marker(marker);
                    events.pop(events[index]);
                    eventDates.pop(date_event);
                } else if (diffDays < 1 && diffHours >= 4 && type === "Accident")
                {
                    var pos = events[index];
                    var marker = new google.maps.Marker({
                        position: pos,
                        draggable: false
                    });
                    remove_marker(marker);
                    events.pop(events[index]);
                    eventDates.pop(date_event);
                }
            }

            //------------------ADD MARKER FUNCTION---------------------------
            function add_marker(MapPos, MapTitle, MapDesc, InfoOpenDefault, DragAble, Removable, iconPath)
            {

                var marker = new google.maps.Marker({
                    position: MapPos,
                    map: map,
                    draggable: DragAble,
                    animation: google.maps.Animation.DROP,
                    title: "Map Report",
                    icon: iconPath
                });

                //Content structure of info Window for the Markers
                var contentString = $('<div class="marker-info-win">' +
                        '<div class="marker-inner-win"><span class="info-content">' +
                        '<h3 class="marker-heading">' + MapTitle + '</h3>' +
                        MapDesc +
                        '</span><button name="remove-marker" class="remove-marker" title="Remove Marker">Remove Report</button>' +
                        '</div></div>');


                var markerinfowindow = new google.maps.InfoWindow();
                markerinfowindow.setContent(contentString[0]);

                var removeBtn = contentString.find('button.remove-marker')[0];
                var saveBtn = contentString.find('button.save-marker')[0];

                google.maps.event.addDomListener(removeBtn, "click", function(event) {
                    remove_marker(marker);
                });

                if (typeof saveBtn !== 'undefined')
                {
                    //add click listner to save marker button
                    google.maps.event.addDomListener(saveBtn, "click", function(event) {
                        var mReplace = contentString.find('span.info-content');
                        var mAddress = contentString.find('textarea.save-add')[0].value; // Address
                        var mType = contentString.find('select.save-type')[0].value; //type of marker
                        var mDesc = contentString.find('textarea.save-desc')[0].value; //description input field value

                        if (mDesc === '')
                        {
                            alert("Please enter Description!");
                        } else {
                            save_marker(marker, mDesc, mType, mReplace, mAddress);
                        }
                    });


                    if (InfoOpenDefault)
                    {
                        markerinfowindow.open(map, marker);
                    }
                }
                google.maps.event.addListener(marker, 'click', function() {
                    markerinfowindow.open(map, marker);
                });
            }


            //------------------SAVE MARKER TO DB FUNCTION---------------------------
            function save_marker(Marker, mDesc, mType, replaceWin, mAddress)
            {
                //Save new marker using jQuery Ajax
                var mLatLang = Marker.getPosition().toUrlValue();
                var date = new Date();
                date = date.getFullYear() + '-' +
                        ('00' + (date.getMonth() + 1)).slice(-2) + '-' +
                        ('00' + date.getDate()).slice(-2) + ' ' +
                        ('00' + date.getHours()).slice(-2) + ':' +
                        ('00' + date.getMinutes()).slice(-2) + ':' +
                        ('00' + date.getSeconds()).slice(-2);
                console.log(mLatLang);
                console.log(date);

                var myData = {description: mDesc, latlang: mLatLang, type: mType, address: mAddress, date: date, deleted: 'no'};
                var iconPath;
                if (mType === "Accident")
                    iconPath = "images/custom_markers/marker_accident.png";
                else if (mType === "Construction")
                    iconPath = "images/custom_markers/marker_construction.png";
                else if (mType === "Heavy Traffic")
                    iconPath = "images/custom_markers/marker_traffic.png";
                else if (mType === "Flood")
                    iconPath = "images/custom_markers/marker_flood.png";
                else
                    iconPath = "images/custom_markers/marker_others.png";
                console.log(replaceWin);
                $.ajax({
                    type: "POST",
                    url: "dbControl.php",
                    data: myData,
                    success: function(data) {
                        replaceWin.html(data);
                        Marker.setDraggable(false);
                        Marker.setIcon(iconPath);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                });
            }

            //------------------REMOVE MARKER FUNCTION---------------------------
            function remove_marker(Marker)
            {
                if (Marker.getDraggable())
                {
                    Marker.setMap(null); //just remove new marker
                }
                else
                {
                    var mLatLang = Marker.getPosition().toUrlValue(); //get marker position
                    var myData = {del: 'true', latlang: mLatLang}; //post variables
                    $.ajax({
                        type: "POST",
                        url: "dbControl.php",
                        data: myData,
                        success: function(data) {
                            Marker.setMap(null);
                            alert("Report Removed!");
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(thrownError); //throw any errors
                        }
                    });
                }
            }
            function displaySelectedRoute(row){
				document.getElementById('instruction-table').innerHTML = "";
                var instTableHeader = document.createElement('div');
                instTableHeader.className="row-fluid tableheader";
                document.getElementById('instruction-table').appendChild(instTableHeader);
                instTableHeader.innerHTML = "Directions";
				removePolylines();
				var color;
                switch (row.id - 1) {
                       case 0:
                               color = '#2ecc71';
                               break;
                       case 1:
                               color = '#2980b9';
                               break;
                       case 2:
                               color = '#9b59b6';
                               break;
                }


                var rendererOptions = {
                   preserveViewport: true,
                   polylineOptions: {
                        strokeColor: color,
                        strokeOpacity: .8,
                        strokeWeight: 7
                   }

                };
                
                directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
                directionsDisplay.setOptions({directions: currResponse, routeIndex: row.id - 1});
                directionsDisplay.setMap(map);
                displayInstructions(row.id-1);
                renderers.push(directionsDisplay);
				document.getElementById('directions-panel-small').innerHTML = document.getElementById('directions-panel-main').innerHTML;											
				
			}
            
            function displayInstructions(index){
				var instable = document.getElementById('instruction-table');
				var legs = routes[index].legs;
				var steps = legs[0].steps;
				for(var k = 0; k < steps.length; k++){
						var dRow = document.createElement('div');
						var dRowNum = document.createElement('div');
						var dRowInstruction = document.createElement('div');
						var dRowDistance = document.createElement('div');
						
						
						if(k == 0){
												
								var dRowStartLocation = document.createElement('div');
								var dRowStartLocationText = document.createElement('div');
								var dRowTotalDistance = document.createElement('div');
								var dRowStartLabel = document.createElement('div');
								
								dRowStartLocation.className ="row well start";
								dRowStartLabel.className = "col-fluid col-sm-2";
								dRowStartLocationText.className="col-fluid col-sm-8";
								dRowTotalDistance.className="col-fluid col-sm-2";
								
								dRowStartLabel.innerHTML = "<strong>Start</strong>";
								dRowStartLocationText.innerHTML = legs[0].start_address;
								dRowTotalDistance.innerHTML = legs[0].distance.text;
								dRowStartLocation.appendChild(dRowStartLabel);
								dRowStartLocation.appendChild(dRowStartLocationText);
								dRowStartLocation.appendChild(dRowTotalDistance);
								instable.appendChild(dRowStartLocation);
								
	
						}
									
								dRow.className = "row";
								dRowNum.className="col-fluid col-sm-2";
								dRowInstruction.className="col-fluid col-sm-8";
								dRowDistance.className = "col-fluid col-sm-2";
								dRowNum.innerHTML = "<strong>"+(k+1)+".</strong>";
								dRowInstruction.innerHTML = steps[k].instructions;
								dRowDistance.innerHTML = steps[k].distance.text;
								dRow.appendChild(dRowNum);
								dRow.appendChild(dRowInstruction);
								dRow.appendChild(dRowDistance);
								instable.appendChild(dRow);
												
								if(k == steps.length-1){
												
									var dRowEndLocation = document.createElement('div');
									var dRowEndLocationText = document.createElement('div');
									var dRowEndLabel = document.createElement('div');
									dRowEndLocation.className = "row well end";
									dRowEndLabel.className = "col col-sm-2";
									dRowEndLocationText.className = "col col-sm-10";
									
									dRowEndLocationText.innerHTML = legs[legs.length-1].end_address;
									dRowEndLabel.innerHTML = "<strong>End</strong>";
									dRowEndLocation.appendChild(dRowEndLabel);
									dRowEndLocation.appendChild(dRowEndLocationText);
									instable.appendChild(dRowEndLocation);
									
								}
												
				}
				
			}
			
			function removePolylines(){
				for (var i = 0; i < renderers.length; i++) {
                    renderers[i].setMap(null);
                }
                renderers = [];
			}
			

            //VARIABLES FROM INDEX PHP INPUT
            var source = '<?php echo $source; ?>';
            var destination = '<?php echo $destination; ?>';

            function routeAddress() {


                var directionsService = new google.maps.DirectionsService();

                //RESET PANEL
                document.getElementById('color-table').innerHTML = "";
                var colorTableHeader = document.createElement('div');
                colorTableHeader.className="row-fluid tableheader";
                
                
                
                document.getElementById('color-table').appendChild(colorTableHeader);
                
                document.getElementById('instruction-table').innerHTML = "";
                var instTableHeader = document.createElement('div');
                instTableHeader.className="row-fluid tableheader";
                document.getElementById('instruction-table').appendChild(instTableHeader);

                //REMOVE PREVIOUS POLYLINES
                removePolylines();

               var source;
                var destination;

                if (document.getElementById('sourceTextBox').value != "" && document.getElementById('destinationTextBox').value != "")
                {
                    source = document.getElementById('sourceTextBox').value;
                    destination = document.getElementById('destinationTextBox').value;
                } else if (document.getElementById('sourceTextBox_pop').value != "" && document.getElementById('destinationTextBox_pop').value != "")
                {
                    source = document.getElementById('sourceTextBox_pop').value;
                    destination = document.getElementById('destinationTextBox_pop').value;
                } else {
                    source = "";
                    destination = "";
                }


                geocoder.geocode({'address': source}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        startLocation = results[0].geometry.location;


                        geocoder.geocode({'address': destination}, function(results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {
                                destinationLocation = results[0].geometry.location;

                                var request = {
                                    origin: startLocation,
                                    destination: destinationLocation,
                                    provideRouteAlternatives: true,
                                    travelMode: google.maps.TravelMode.DRIVING
                                };

                                directionsService.route(request, function(response, status) {
                                    if (status == google.maps.DirectionsStatus.OK) {
                                        var index = 0;
                                        var bounds;
										currResponse = response;
                                        response.routes.forEach(function(route) {


                                            var request = {
                                                origin: startLocation,
                                                destination: destinationLocation,
                                                travelMode: google.maps.TravelMode.DRIVING
                                            };


                                            //polylines.push(response.routes[index].overview_path);
                                            var polyline = new google.maps.Polyline({
                                                path: []

                                            });
                                            bounds = new google.maps.LatLngBounds();

											routes = response.routes;
                                            var legs = response.routes[index++].legs;
                                            var steps;
											
                                            for (i = 0; i < legs.length; i++) {
                                                 steps = legs[i].steps;
                                                for (j = 0; j < steps.length; j++) {
                                                    var nextSegment = steps[j].path;
                                                    console.log(steps[j].instructions);
                                                    for (k = 0; k < nextSegment.length; k++) {
                                                        polyline.getPath().push(nextSegment[k]);
                                                        bounds.extend(nextSegment[k]);
                                                    }
                                                }
                                            }

											
                                            var count = 0;

                                            events.forEach(function(element, index) {

                                                if (google.maps.geometry.poly.isLocationOnEdge(element, polyline, .001)) {
                                                    console.log(element + " YES");
                                                    count++;
                                                } else {
                                                    console.log(element + " not on edge");
                                                }

                                            });

                                            var color;
                                            var colorimage = document.createElement('img');
                                            colorimage.style.height = "32px";
                                            colorimage.style.width = "32px";
                                            switch (index - 1) {
                                                case 0:
                                                    color = '#2ecc71';
                                                    colorimage.src = "images/green-colorpanel.png";
                                                    break;
                                                case 1:
                                                    color = '#2980b9';
                                                    colorimage.src = "images/blue-colorpanel.png";
                                                    break;
                                                case 2:
                                                    color = '#9b59b6';
                                                    colorimage.src = "images/purple-colorpanel.png";
                                                    break;
                                            }


                                            var rendererOptions = {
                                                preserveViewport: true,
                                                polylineOptions: {
                                                    strokeColor: color,
                                                    strokeOpacity: .8,
                                                    strokeWeight: 7
                                                }

                                            };
											
											
                                            var cRow = document.createElement('div');

                                            cRow.id = index;
                                            cRow.onclick = function(){
                                            	displaySelectedRoute(this);
                                            };
                                            cRow.className = "span2 crow";

                                            colorTableHeader.innerHTML = "Routes";
                                            instTableHeader.innerHTML = "Directions";
                                            document.getElementById('color-table').appendChild(cRow);
                                            cRow.appendChild(colorimage);
											if(count > 1 || count == 0)
												cRow.innerHTML += " has " + count + " obstructions. - "+legs[0].distance.text;
											else
												cRow.innerHTML += " has " + count + " obstruction. - "+legs[0].distance.text;
												
											displayInstructions(index-1);

											directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
											directionsDisplay.setOptions({directions:response,routeIndex:index-1});
							    			directionsDisplay.setMap(map);
							    			renderers.push(directionsDisplay);



                                        });
                                        //directionsDisplay.setPanel(document.getElementById('directions-panel'));
                                        document.getElementById('directions-panel-small').innerHTML = document.getElementById('directions-panel-main').innerHTML;
                                        map.fitBounds(bounds);
                                    } else
                                        alert("Routing failed!");
                                        
                                    

                                });

                            }
                        });

                    }
                });

            }
            window.onload = function() {
                view();
                document.getElementById('findItButton').onclick = function() {
                    routeAddress();
                };
                document.getElementById('findItButton_pop').onclick = function() {
                    routeAddress();
                };
            };

            google.maps.event.addDomListener(window, 'load', initialize);
            google.maps.event.addDomListener(window, "resize", function() {
                var center = map.getCenter();
                google.maps.event.trigger(map, "resize");
                map.setCenter(center);
            });
        </script>     

    </head>


    <body onload = "routeAddress();">

         <div class = "navbar navbar-default navbar-fixed-top visi">
                <a href = "index.php" class = "navbar-brand"><img src = "images/routee.png" class ="headpic"></a>
                <form class="navbar-form navbar-left appear" role="search" id="navRoute">
                    <div class="form-group">
                        <input id="sourceTextBox" type="text" class="form-control" placeholder = "Where did you come from?" value='<?php echo $source; ?>'>
                        <input id="destinationTextBox" type="text" class="form-control" placeholder = "Where do you want to go?" value='<?php echo $destination; ?>'>
                        <input id="findItButton" type="button" onclick="routeAddress();" class="btn btn-default" value="Show me the way!">
                    </div>                 
                </form>
                <a class = "navbar-brand navbar-right appear" id="helpbutton" href = "#getIns" data-toggle="modal"><img src = "images/quest.png" class = "headpic"></a>
        </div>


        <div class = "modal fade" id = "getIns" role = "dialog">
            <div class = "modal-dialog">
                <div class = "modal-content">

                    <div class = "modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class = "modal-title" align = "center"> Hello there!</h4>
                    </div>

                    <div class = "modal-body">
                        <p align = "center">Salutations, driver! Thank you for using Routee! I will show you some instructions on how to use this map module of Routee. First and foremost, if you want to know the routes available, just enter where you came from and where you are from in the forms respectively and to see these again, click the right-most help icon.<br><br>
                        </p>

                        <img src = "images/instruction.jpg" class="img-responsive">
                        <br><br> 

                        <p align = "center"> Another neat feature is the '<em>Reporting</em>' aspect of Routee! How do we do this? Just left-click on the location in the map and select the situation. Simple!<br><br>
                        </p>

                        <img src = "images/instruction2.jpg" class="img-responsive">

                        <br><br>

                        <p align = "center"> If you're using a tablet or phone, click on the '<em>Information</em>' tab and a slider should appear containing the <em> Instructions </em> and the two forms to do another routing query. Tapping on a location will allow you to report. </p>

                        <img src = "images/instruction3.jpg" class="img-responsive">
                        <br><br>

                        <p align = "center"> Here are the legends when reporting for a situation: </p>
                        <br>

                        <div class="media">

                            <a class="pull-left">
                                <img class="media-object" src="images/custom_markers/marker_accident.png">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Accident</h4>
                                <p>If a road accident had occured, this marker will represent that on the map. This type of event takes a while to resolve.</p>
                            </div>

                            <a class="pull-left">
                                <img class="media-object" src="images/custom_markers/marker_construction.png">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Construction</h4>
                                <p>When there is a construction project on-going, it will be represented by this marker. This event takes a very long time to resolve and should be avoided as much as possible.</p>
                            </div>

                            <a class="pull-left">
                                <img class="media-object" src="images/custom_markers/marker_flood.png">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Flood</h4>
                                <p>On days when there is heavy rain present, floods are likely to occur. Areas that are affected will be presented with this. Some areas are passable depending on the terrain.</p>
                            </div>

                            <a class="pull-left">
                                <img class="media-object" src="images/custom_markers/marker_traffic.png">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Traffic</h4>
                                <p>This is a common problem in the Philippines and is considered more of a nuisance. Areas with heavy traffic are represented by this marker.</p>
                            </div>

                            <a class="pull-left">
                                <img class="media-object" src="images/custom_markers/marker_others.png">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Others</h4>
                                <p>If a situation arises and it is not listed within the choices, you can present it using this marker.</p>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>


        <div class = "col-lg-3 appear">
            <div class = "well">
                <div id="directions-panel-main" class="directions-panel">
                	
                	<div id="color-table" class="container-fluid">
                		
                	</div>
                	<div id="instruction-table" class="container-fluid">
                		
                	</div>
                	
                </div>
            </div>
        </div>

        <div class = "hideslide">
            <div id="slideout">
                <img src="images/info.png" alt="Information" />
            </div>
            <div id="slideout_inner">
                <div class = "infoslide">
                    <div class="btn-group btn-group-justified">
                        <div class="btn-group">
                            <button name="submitPath" class="btn btn-info" data-toggle="modal" data-target="#getIns"><i class="fa fa-arrows"> </i>Instructions</button>
                        </div>
                    </div>
                    <hr class = "gdivider">
                    <form role="search">
                        <div class="form-group">
                            <input id="sourceTextBox_pop" name="sourceField" type="text" class="form-control" placeholder="Where did you come from?">
                            <br/>
                            <input id="destinationTextBox_pop" name="destinationField" type="text" class="form-control" placeholder="Where do you want to go?">
                            <br/>
                            <input id="findItButton_pop" type="button" onclick="routeAddress();" class="btn btn-success btn-group-justified" value="Show me the way!">                            
                        </div>

                    </form>
                    <hr class = "gdivider">
                    
                    <div id="directions-panel-small" class="directions-panel">
                	
	                	<div id="color-table" class="container-fluid">
	                		
	                	</div>
	                	<div id="instruction-table" class="container-fluid">
	                		
	                	</div>
                	
                	</div>
                </div>
            </div> 
        </div>   

        <div class = "col-lg-9 linkappear vis1">             
            <div id="map-canvas"></div>
        </div>




        <script src="js/jquery-1.10.2.js"></script>
        <script src = "js/bootstrap.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#slideout').click(function() {
                    var left = $('#slideout').css('left');
                    if (left == '0px')
                    {
                        $('#slideout_inner').animate({left: '0px'});
                        $('#slideout').animate({left: '250px'});
                        left = $('#slideout').css('left');
                    }
                    if (left == '250px')
                    {
                        $('#slideout_inner').animate({left: '-250px'});
                        $('#slideout').animate({left: '0px'});
                        left = $('#slideout').css('left');
                    }
                });
            });
        </script>

    </body>



</html>