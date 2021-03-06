<!DOCTYPE html>
<html lang = "en">

    <head>
        <meta charset="utf-8">
        <title>Routee</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Towards road less obstructed">
        <meta name="author" content="Shawarma Proteges">


        <link href="css/cover.css" rel="stylesheet" type="text/css">
        <link href="css/fonts.css" type = "text/css" rel = "stylesheet">
        <link href="css/jquery.qtip.css" type="text/css" rel="stylesheet" />
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
        <link rel= "shortcut icon" href="images/routee.png">

        <script src="js/jquery-1.10.2.js"></script>     
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>  
        <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDQFSdn0OTS5bgEVYvfGMBWmkC54uk-6PM&sensor=false&libraries=places&region=ph"></script>                
        <script type="text/javascript" src="js/jquery.qtip.js"></script>
        <script type="text/javascript" src="js/jquery.imagesloaded.pkg.min.js"></script>

        <script>
        <?php
            session_start();
            echo ''. isset($_SESSION['username']);
        ?>
        </script>

        <script type="text/javascript">
        var sStr = '<?php echo isset($_SESSION['username']); ?>';

            $(document).ready(function() {
                $("#btnReporting").click(function() {
                    $("#routing").fadeOut("fast", function() {
                        $("#reporting").fadeIn("5000");
                    });
                });
            });

            $(document).ready(function() {
                $("#btnRerouting").click(function() {
                    $("#reporting").fadeOut("fast", function() {
                        $("#routing").fadeIn("5000");
                    });
                });
            });
        </script>

        <script>
            var username = '<?php echo isset($_SESSION['username']); ?>';
            console.log(username);
            var a;
            var b;
            var address;

            var rememberme = 'y';
            

            function requestCurrentPosition(){
                if (navigator.geolocation)
                {
                  navigator.geolocation.getCurrentPosition(useGeoData);
                }
                else
                {
                 console.log("not avaliable");
                }
            }   
            
            function useGeoData(position){
                a = position.coords.longitude;
                b = position.coords.latitude;
                document.getElementById('lat').value = b;
                document.getElementById('lon').value = a;
                populate();
            }
    


            function populate()
            {
                var geocoder; 
                geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(b,a);
                    geocoder.geocode({'latLng': latlng}, function(results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            var address = results[0].formatted_address;
                            $('#eventSearchText').val(address);
                            console.log(address);
                        }
                        else {
                            alert("Geocoder failed due to: " + status);
                        }
                    });           

            } 


            function initialize() {
                
                var sourceInput = document.getElementById('sourceSearchText');
                var destinationInput = document.getElementById('destinationSearchText');
                var eventInput = document.getElementById('eventSearchText');
                var options = {
                    componentRestrictions: {country: "ph"}
                };
                var autocomplete = new google.maps.places.Autocomplete(sourceInput, options);
                var autocomplete2 = new google.maps.places.Autocomplete(destinationSearchText, options);

                autocomplete.bindTo('bounds', map);
                autocomplete2.bindTo('bounds', map);
                autocomplete3.bindTo('bounds', map);

                autocomplete.setComponentRestrictions({country: 'ph'});
                autocomplete2.setComponentRestrictions({country: 'ph'});
                autocomplete3.setComponentRestrictions({country: 'ph'});


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

                setupClickListener('changetype-all', []);
            }

            function ReportingErrorHandlers() {
                document.getElementById("reportForm").onsubmit = function() {

                    if (document.getElementById("eventSearchText").value === "" || document.getElementById("description").value === "") {

                        if (document.getElementById("eventSearchText").value === "")
                        {
                            $('#eventSearchText').qtip({
                                prerender: true,
                                content: {
                                    text: "We need to know the place"
                                },
                                position: {
                                    my: 'bottom right',
                                    at: 'top left',
                                    target: $('#eventSearchText'),
                                    viewport: $(window)
                                },
                                show: {
                                    ready: true
                                },
                                hide: {
                                    event: false,
                                    inactive: 4000
                                }

                            });
                        }
                        if (document.getElementById("description").value === "")
                        {
                            $('#description').qtip({
                                prerender: true,
                                content: {
                                    text: "Please do provide details"
                                },
                                position: {
                                    my: 'bottom right',
                                    at: 'top left',
                                    target: $('#description'),
                                    viewport: $(window)
                                },
                                show: {
                                    ready: true
                                },
                                hide: {
                                    event: false,
                                    inactive: 4000
                                }

                            });
                        }


                        return false;
                    }
                };
            }

            function RoutingErrorHandlers() {
                document.getElementById("routingForm").onsubmit = function() {
                    if (document.getElementById("sourceSearchText").value === "" || document.getElementById("destinationSearchText").value === "") {
                        if (document.getElementById("sourceSearchText").value === "")
                        {
                            $('#sourceSearchText').qtip({
                                prerender: true,
                                content: {
                                    text: "We need to know where you came from"
                                },
                                position: {
                                    my: 'bottom right',
                                    at: 'top left',
                                    target: $('#sourceSearchText'),
                                    viewport: $(window)
                                },
                                show: {
                                    ready: true
                                },
                                hide: {
                                    event: false,
                                    inactive: 4000
                                }

                            });
                        }

                        if (document.getElementById("destinationSearchText").value === "")
                        {
                            $('#destinationSearchText').qtip({
                                prerender: true,
                                content: {
                                    text: "We need to know where you want to go"
                                },
                                position: {
                                    my: 'bottom right',
                                    at: 'top left',
                                    target: $('#destinationSearchText'),
                                    viewport: $(window)
                                },
                                show: {
                                    ready: true
                                },
                                hide: {
                                    event: false,
                                    inactive: 4000
                                }

                            });
                        }
                        return false;
                    }
                };

            }
            function LoginErrorHandlers() {
                document.getElementById("loginform").onsubmit = function() {
                    if (document.getElementById("loginUserText").value === "" || document.getElementById("loginPassText").value === "") {
                        $('#loginUserText').qtip({
                                prerender: true,
                                content: {
                                    text: "Invalid username or password."
                                },
                                position: {
                                    my: 'bottom right',
                                    at: 'top left',
                                    target: $('#loginUserText'),
                                    viewport: $(window)
                                },
                                show: {
                                    ready: true
                                },
                                hide: {
                                    event: false,
                                    inactive: 4000
                                }

                        });
                        return false;
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "loginController.php",
                            data: myData,
                            success: function(data) {
                                alert("Login successful!");
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                $('#loginUserText').qtip({
                                    prerender: true,
                                    content: {
                                        text: "Invalid username or password."
                                    },
                                    position: {
                                        my: 'bottom right',
                                        at: 'top left',
                                        target: $('#loginUserText'),
                                        viewport: $(window)
                                    },
                                    show: {
                                        ready: true
                                    },
                                    hide: {
                                        event: false,
                                        inactive: 4000
                                    }
                                });
                            }
                });
            }

        }

    }
            google.maps.event.addDomListener(window, 'load', initialize);
            window.onload = function() {
                LoginErrorHandlers();
                ReportingErrorHandlers();
                RoutingErrorHandlers();
                requestCurrentPosition();
            };

        </script>
    </head>


    <body>        
        <div class = "container">            
            <div class = "row">                
                <div class = "col-md-4">
                    <h2 align="center" id = "me"><img src ="images/routee.png" align = "center"></h2>
                    <div class = "intros">                        
                        <h3 align="center" style="font-weight: bold;">Need some routing assistance?</h3>
                        <p>Routee can help you scout out the routes with less obstructions to allow you to pass with ease.</p>
                        <h3 align="center" style="font-weight: bold">Encountered problems on the road?</h3>
                        <p>Routee encourages users to participate in contributing reports regarding what is happening on the road.
                            This ignites the people's willingness to help inform their fellow drivers to avoid obstructions on the road.</p>                                                  
                    </div>
                </div>

                <br/>

                <div class = "col-md-4">
                    <div class = "dissidia" id="login">

                        <h2 align = "center" id = "welcomeHeader"> Welcome, Router <?php 
                            if(isset($_SESSION['username']) != null && isset($_SESSION['username']) != ""){
                                echo $_SESSION['username'];
                            }
                        ?>! </h2>

                        <p align = "center" id = "logMes"> Please enter your username and password to be able to report! </p>
                        <br/>
                        <form method = "POST" id = "loginform" action = "loginController.php">
                            <input name ="loginUser" id = "loginUserText" type = "text" class = "form-control" placeholder = "Username">
                            <br/>
                            <input name = "loginPass" id = "loginPassText" type = "password" class = "form-control" placeholder = "Password">
                            <br/>
                            <div class="btn-group btn-group-justified">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-info" id = "btnLogin"><i class="fa fa-user"> </i> Login</button>
                            </div>
                        </div> <!-- end btn-group --> 
                        </form>
                        <form method = "POST" id = "registerform" action = "register.php">
                            <div class="btn-group btn-group-justified">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary" id = "btnRegister"><i class="fa fa-pencil"> </i> Register</button>
                            </div>
                        </div> <!-- end btn-group --> 
                        </form>

                        <form method = "POST" id = "logoutForm" action = "logoutController.php">
                            <div class="btn-group btn-group-justified">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-danger" id = "btnLogout"></i> Logout</button>
                            </div>
                        </div> <!-- end btn-group --> 
                        </form>

                    </div> <!-- end dissidia -->
                </div> <!-- end col-md-4 -->
                
                <div class = "col-md-4">
                    <div class = "dissidia" id="routing">
                        <h2 align = "center"> Routing </h2>
                        <p align = "center"> Routee will assist you in finding the best routes possible.</p>
                        <br>
                        <form method="POST" id="routingForm" action="routee.php">
                            <input name="sourceField" id = "sourceSearchText" type="text" class="form-control" placeholder="Where did you come from?">
                            <br/>
                            <input name="destinationField" id = "destinationSearchText" type="text" class="form-control" placeholder="Where do you want to go?">
                            <br/>
                            <div class="btn-group btn-group-justified">
                                <div class="btn-group">
                                    <button type="submit" name="submitRouting" class="btn btn-success"><i class="fa fa-arrows"> </i> Get Directions</button>
                                </div>
                            </div>

                        </form>
                        <div class = "panel" id ="memonly">
                        <hr class = "gdivider">
                        <p align = "center">If there is a situation going on, please do not hesitate to tell us.</p>
                        <div class="btn-group btn-group-justified">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info" id = "btnReporting"><i class="fa fa-map-marker"> </i> Reporting</button>
                            </div>
                        </div>
                        </div>

                    </div> <!--dissidia routing-->
                    <br/>
                    <div class ="dissidia" style  = "display:none;" id = "reporting">
                        <h2 align = "center"> Reporting </h2>
                        <p align = "center">Let us know what is going on.</p><br>
                        <!--Reporting form-->
                        <form method="POST" id="reportForm" action="routee.php">
                            <select name="pType" class="form-control">
                                <option value="Accident">Accident</option>
                                <option value="Flood">Flood</option>
                                <option value="Construction">Construction</option>
                                <option value="Heavy Traffic">Heavy Traffic</option>
                                <option value="Others">Others</option>
                            </select>
                            <br/>
                            <input type = "text" id="eventSearchText" name ="placeName" class = "form-control" readonly="true" />
                            <br/>
                            <input type = "hidden" id= "lat" name = "lat"class = "form-control"/>
                            <input type = "hidden" id= "lon" name = "lon" class = "form-control"/>
                            <textarea id="description" name="pDesc" style = "width:100%;" placeholder="What's going on?" class="form-control"></textarea>
                            <br/>                            
                            <div class="btn-group btn-group-justified">
                                <div class="btn-group" >                                                       
                                    <button type="submit" name="submitReport" class="btn btn-success"> <i class="fa fa-map-marker"></i> Report</button>
                                </div>
                            </div> <!-- justified buttons end -->
                            <hr class = "gdivider">                 
                            <p align = "center"> If you want to find the fastest way to your destination, just ask us.</p>
                            <div class="btn-group btn-group-justified">
                                <div class="btn-group" >                                                       
                                    <button type="button" class="btn btn-info" id="btnRerouting"> <i class="fa fa-arrows"></i> Routing</button>
                                </div>
                            </div> <!-- justified buttons end -->

                        </form> <!-- form post end -->      
                    </div> <!--dissidia reporting-->

                </div><!--col-lg-5-end-->   

                <br/>
            </div> <!-- row end -->
        </div> <!-- container-end -->        

<script>
        if(sStr == '')
        {
            document.getElementById('memonly').style.display = "none";
            document.getElementById('registerform').style.display = "block";   
            document.getElementById('loginform').style.display = "block";
            document.getElementById('logoutForm').style.display = "none";     
            document.getElementById('logMes').innerHTML =  "Please enter your username and password to be able to report!" ;      
        }
        else
        {
            document.getElementById('memonly').style.display = "block";   
            document.getElementById('registerform').style.display = "none";
            document.getElementById('loginform').style.display = "none"; 
            document.getElementById('logMes').innerHTML =  "You are now logged in. Have fun contributing!" ;       
        }
</script>


    </body>


</html>

