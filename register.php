
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
            $(document).ready(function() {
                $("#btnRegister").click(function() {
                    $("#login").fadeOut("fast", function() {
                        $("#registration").fadeIn("5000");
                    });
                });
            });

            $(document).ready(function(){
                $("#btnBack").click(function(){
                    $("#registration").fadeOut("fast", function() {
                        $("#login").fadeIn("5000");
                    });
                });
            });

            $(document).ready(function(){
                $("#btnBack1").click(function(){
                    document.location.href = "index.php";
                });
            });

        </script>
    </head>


    <body>        
        <div class = "container">
            
            <div class = "col-md-4">
                <br>
            </div>
            <div class = "col-md-4">
                <div class = "dissidia" id = "login">
                    <h2 align = "center"> Login </h2>
                    <form method = "POST" id = "loginForm" action="index.php">
                        <input name ="loginUser" id ="loginUserText" type ="text" class="form-control" placeholder="Usermame">
                        <br/>
                        <input name="loginPass" id="loginPassText" type ="password" class="form-control" placeholder="Password">
                        <div class ="btn-group btn-group-justified">
                            <div class ="btn-group">
                                <button type="submit" class="btn btn-danger" id="btnLogin"><i class ="fa fa-check"> </i> Login</button>
                                <br/>
                                <br/>
                                <button type="button" class="btn btn-danger" id="btnRegister"><i class ="fa fa-check"> </i> Register</button>
                                <button type="button" class="btn btn-info" id="btnBack1"></i> Back</button>
                                
                            </div>
                        </div>
                    </form>
                </div>
                <div class = "dissidia" style="display:none;" id = "registration">
                    <h2 align = "center">Registration Form</h2>
                    <br>
                    <p align = "center"> Please complete this form to register </p>
                    <br>
                    <form method = "POST" id = "regform" action = "go.php">
                        <input name ="regUser" id = "regUserText" type = "text" class = "form-control" placeholder = "Username">
                        <br/>
                        <input name = "regPass" id = "regPassText" type = "password" class = "form-control" placeholder = "Password">
                        <br/>
                        <input name = "regMail" id = "regMailText" type = "text" class = "form-control" placeholder = "Email Address">
                        <br/>
                        <div class="btn-group btn-group-justified">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-danger" id = "btnConf"><i class="fa fa-check"> </i> Register</button>
                                <br/>
                                <br/>
                                <button type="button" class="btn btn-info" id="btnBack"> Back</button>
=======

            <div class = "col-md-4">
                <div class = "dissidia" id = "registration">
                    <h2 align = "center">Registration Form</h2>
                    <br>
                    <p align = "center"> Please complete this form to proceed </p>
                    <br>
                    <form method = "POST" id = "regform" action = "go.php">
                        <input name ="regUser" id = "regUserText" type = "text" class = "form-control" placeholder = "Desired Username">
                        <br/>
                        <input name = "regPass" id = "regPassText" type = "password" class = "form-control" placeholder = "Desired Password">
                        <br/>
                        <input name = "regMail" id = "regMailText" type = "text" class = "form-control" placeholder = "Your Email here">
                        <br/>
                        <div class="btn-group btn-group-justified">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-danger" id = "btnConf"><i class="fa fa-check"> </i> Complete Registration</button>
>>>>>>> f9e0624e4392a2158529991289fd21ed49a284eb
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