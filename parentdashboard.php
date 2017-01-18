<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="jquery.modal.js" type="text/javascript" charset="utf-8"></script>
        <link rel="stylesheet" href="jquery.modal.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="docs/css/prettify.css" type="text/css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="bootstrap.css"/>
        <link rel="stylesheet" href="../bower_components/Font-Awesome/css/font-awesome.css"/>
        <link rel="stylesheet" href="build.css"/>
        <style>
            img {
                max-width: 100%;
                max-height: 100%;
            }
            /* The Modal (background) */
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                padding-top: 100px; /* Location of the box */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            }

            /* Modal Content */
            .modal-content {
                background-color: #fefefe;
                margin: auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
            }

            /* The Close Button */
            .close {
                color: #aaaaaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
            }
        </style>
        <title>Parent Dash Board</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

        <!-- Bootstrap Core CSS -->
        <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="bower_components/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body onload="dispay()">
        <div id="wrapper">
            <div class="navbar-default sidebar" >
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav list-group" id="side-menu">
                        <li>
                            <img src="smslogo.png" alt="" height="20%" width="100%"><br /><br />
                        </li>
                        <li class="list-item-group" align="center">
                            <p id="studentclick">Student Profile&nbsp;</p>
                        </li>
                        <li class="list-item-group" align="center">
                            <p id="attendanceclick">Attendance&nbsp;</p>
                        </li>
                        <li class="list-item-group" align="center">
                            <p id="notificationcircularclick">Notification&nbsp;&nbsp;&&nbsp;&nbsp;Circular</p>
                        </li>
                        <li class="list-item-group" align="center">
                            <p id="billclick">Bill`s&nbsp;</p>
                        </li>
                        <li class="list-item-group" align="center">
                            <p id="assignmentclick">Assignments&nbsp;</p>
                        </li>
                        <li class="list-item-group" align="center">
                            <p id="markclick">Marks&nbsp;</p>
                        </li>
                        <li class="list-item-group" align="center">
                            <p id="remarkclick">Remarks&nbsp;</p>
                        </li>
                    </ul> 
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
            <div id="page-wrapper" class="container-fluid">
                <div class="row">
                    <div align="right">
                        <a class="btn btn-success" href="logout.php">Log Out</a>
                    </div>
                    <h1 class="page-header">Parent Dashboard</h1>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form id="studentform">
                            <div id="studentdisplay">
                            
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form id="attendanceform">
                            <div id="attendancedisplay">
                            
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form id="notificationcircularform">
                            <div id="notificationcirculardisplay">
                            
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form id="billform">
                            <div id="billdisplay">
                            
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form id="markform">
                            <div id="markdisplay">
                            
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form id="remarkform">
                            <div id="remarkdisplay">
                            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function dispay(){
                $("#attendancedisplay").hide();
                $("#notificationcirculardisplay").hide();
                $("#billdisplay").hide();
                $("#markdisplay").hide();
                $("#remarkdisplay").hide();
                $("#studentdisplay").hide();
                
            }

            $(document).ready(function(){
                
                $(document).on('click', '#studentclick', function(){ 
                    $("#studentdisplay").show();
                    
                    $("#notificationcirculardisplay, #attendancedisplay, #billdisplay, #markdisplay, #remarkdisplay").hide();
                    
                    var data=$('#studentform').serializeArray();
                    data[data.length]={name: "studentclick", value: true};
                    $("#studentdisplay").load("getparentdashboard.php",data);
                });

                $(document).on('click', '#attendanceclick', function(){ 
                    $("#attendancedisplay").show();
                    
                    $("#notificationcirculardisplay, #billdisplay, #markdisplay, #remarkdisplay, #studentdisplay").hide();
                    
                    var data=$('#attendanceform').serializeArray();
                    data[data.length]={name: "attendanceclick", value: true};
                    $("#attendancedisplay").load("getparentdashboard.php",data);
                });

                $(document).on('click', '#notificationcircularclick', function(){ 
                    $("#notificationcirculardisplay").show();
                    
                    $("#attendancedisplay, #billdisplay, #markdisplay, #remarkdisplay, #studentdisplay").hide();
                    
                    var data=$('#notificationcircularform').serializeArray();
                    data[data.length]={name: "notificationcircularclick", value: true};
                    $("#notificationcirculardisplay").load("getparentdashboard.php",data);
                });

                $(document).on('click', '#billclick', function(){ 
                    $("#billdisplay").show();
                    
                    $("#attendancedisplay, #notificationcirculardisplay, #markdisplay, #remarkdisplay, #studentdisplay").hide();
                    
                    var data=$('#billform').serializeArray();
                    data[data.length]={name: "billclick", value: true};
                    $("#billdisplay").load("getparentdashboard.php",data);
                });
                
                $(document).on('click', '#markclick', function(){ 
                    $("#markdisplay").show();
                    
                    $("#attendancedisplay, #billdisplay, #notificationcirculardisplay, #remarkdisplay, #studentdisplay").hide();
                    
                    var data=$('#markform').serializeArray();
                    data[data.length]={name: "markclick", value: true};
                    $("#markdisplay").load("getparentdashboard.php",data);
                });
                
                $(document).on('click', '#remarkclick', function(){ 
                    $("#remarkdisplay").show();
                    
                    $("#attendancedisplay, #billdisplay, #notificationcirculardisplay, #markdisplay, #studentdisplay").hide();
                    
                    var data=$('#remarkform').serializeArray();
                    data[data.length]={name: "remarkclick", value: true};
                    $("#remarkdisplay").load("getparentdashboard.php",data);
                });

            });

        </script>
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>
        <!-- Morris Charts JavaScript -->
        <script src="bower_components/raphael/raphael-min.js"></script>
        <script src="bower_components/morrisjs/morris.min.js"></script>
        <script src="js/morris-data.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="dist/js/sb-admin-2.js"></script>
    </body>
</html>

