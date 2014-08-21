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
        
        <script type="text/javascript">
            $(document).ready(function(){
                $("#btnBack").click(function(){
                    document.location.href="index.php";
                });
            });
        </script>

        <script>

            function RegistrationErrorHandlers() {
                var email = $(document).getElementById('regMailText');
                var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                alert(re.test(email));
                document.getElementById("regform").onsubmit = function() {

                    if (document.getElementById("regUserTexf").value === "")
                        {
                            $('#regUserTexf').qtip({
                                prerender: true,
                                content: {
                                    text: "Please enter a username."
                                },
                                position: {
                                    my: 'bottom right',
                                    at: 'top left',
                                    target: $('#regUserText'),
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
                        if (document.getElementById("regPassText").value === "")
                        {
                            $('#regPassText').qtip({
                                prerender: true,
                                content: {
                                    text: "Please enter a password."
                                },
                                position: {
                                    my: 'bottom right',
                                    at: 'top left',
                                    target: $('#regPassText'),
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

            // function validateEmail() {
            //     var email = $(document).getElementById('regMailText');
            //     var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            //     alert(re.test(email));
            // }

            window.onload = function() {
                RegistrationErrorHandlers();
            };
    </script>

    </head>


    <body>        
        <div class = "container">
            
            <div class = "col-md-4">
                <br>
            </div>

            <div class = "col-md-4">
                <div class = "dissidia" id = "registration">
                    <h2 align = "center">Registration Form</h2>
                    <br>
                    <p align = "center"> Please complete this form to proceed </p>
                    <br>
                    <form method = "POST" id = "regform" action = "registerController.php">
                        <input name ="regUser" id = "regUserText" type = "text" class = "form-control" placeholder = "Username">
                        <br/>
                        <input name = "regPass" id = "regPassText" type = "password" class = "form-control" placeholder = "Password">
                        <br/>
                        <input name = "regMail" id = "regMailText" type = "text" class = "form-control" placeholder = "Email Address">
                        <br/>
                        <div class="btn-group btn-group-justified">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-danger" id = "btnConf"><i class="fa fa-check"> </i> Register</button>
                            </div>
                        </div>
                        <div class="btn-group btn-group-justified">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info" id = "btnBack"></i> Back</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class = "col-md-4">
                <br>
            </div>
        
        </div>
    </body>


</html>

