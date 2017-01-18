<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="docs/css/bootstrap-3.3.2.min.css" type="text/css">
        <link rel="stylesheet" href="docs/css/bootstrap-example.css" type="text/css">
        <link rel="stylesheet" href="docs/css/prettify.css" type="text/css">

        <script type="text/javascript" src="docs/js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="docs/js/bootstrap-3.3.2.min.js"></script>
        <script type="text/javascript" src="docs/js/prettify.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

        <link rel="stylesheet" href="dist/css/bootstrap-multiselect.css" type="text/css">
        <script type="text/javascript" src="dist/js/bootstrap-multiselect.js"></script>
        <!--
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        -->

        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <title>Non Teaching Staff Dash Board</title>

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

    </head>
    <body>

        <form id="myf">
            <div class="row">
                <div class="col-lg-5">
                    Priority Level
                    <select name="priority" id="priority" class="form-control">
                        <option></option>
                        <option value="urgent">Urgent</option>
                        <option value="important">Important</option>
                        <option value="ordinary">Ordinary</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <input type="button" value="fuck" id="clickit">
                    <div class="form-group">
                        <div class="col-sm-10" id="towhomclick">
                            To Whom:<br />
                            <select id="selecttag" name="multiselect[]" multiple="multiple">
                                <optgroup id="contentload">
                                    <option>F</option>
                                </optgroup>
                                <option>DAta Cliebt</option>
                            </select>
                        </div>
                    </div>

                </div>           
            </div>           
        </form>
        <!--
        <form id="myf">
        <input type="button" value="fuck" id="clickit">
        <select id="selecttag">
        <option>Client</option>
        <optgroup id="contentload">
        </optgroup>
        </select>
        </form>
        -->
        <script>

            $(document).ready(function(){
$(document).on('change', '#priority', function(){ 
                    var data=$("#myf").serializeArray();
                    data[data.length]={name: "towhomclickbtn", value: true};
                    $("#contentload").load("getnonteachingstaff.php",data);
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

