<?php                    
    require("head.inc");
    GLOBAL $con,$gclassid;
?>
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
        <title>Teaching Staff Dash Board</title>

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
                    <ul class="nav" id="side-menu">
                        <li>
                            <img src="smslogo.png" alt="" height="20%" width="100%"><br /><br />
                        </li>
                        <li>
                            <img src="schoollogo.png" alt="" height="20%" width="100%"><br /><br />
                        </li>
                        <li>
                            <button id="timetablebtn" class="form-control">Class Time Tables</button>
                        </li>
                        <li>
                            <button id="attendancedisplaybtn" class="form-control">Attendance</button>
                        </li>
                        <li>
                            <button id="studentprofilebtn" class="form-control">Student Profile</button>
                        </li>
                        <li>
                            <button id="notificationbtn" class="form-control">Notifications & Circulars</button>
                        </li>
                        <li>
                            <button id="marksbtn" class="form-control">Marks</button>
                        </li>
                        <li>
                            <button id="remarkbtn"class="form-control">Remarks</button> <!-- not yet done -->
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
                    <h1 class="page-header">Teaching Staff Portal</h1>
                </div>
                <div class="row">
                    <div class="col-lg-10" style="background-color: #f8f8f8;">
                        <!-- Time Table Display -->
                        <div class="panel panel-primary" id="timetable">
                            <div class="panel-heading">
                                Class Time Table
                            </div>
                            <div class="panel-body">
                                <form id="timetablecreatecontentform">
                                    <div id="timetablecreatecontentformload"></div>
                                    <div id="timetablesectioncontentformload"></div>
                                    <div id="timetablefinal"></div>
                                    <input type="button" value="View table" id="createtable" class="btn btn-primary">
                                </form>
                                <div id="teachertimetableload">
                                </div> 
                            </div> 
                        </div>
                        <!-- Attendance Data Display -->
                        <div class="row">
                            <div class="col-lg-3">
                                <div id="attendancedisplayside">
                                    <ul class="nav" id="side-menu">
                                        <li><a class="btn btn-primary" id="takeattendance">Take Attendance</a><br /></li>
                                        <li><a class="btn btn-primary" id="viewattendance">View Attendance</a><br /></li>
                                        <li><a class="btn btn-primary" id="editattendance">Edit Attendance</a><br /></li>
                                    </ul>
                                </div>
                            </div>
                            <div id="attendancedisplay"  class="col-lg-6">
                                <div id="takeattendancedata">
                                    <form id="takeattendancedataform">
                                        <div id="takeattendancecontentclassload"></div>
                                        <div id="takeattendancecontentsectionload"></div>
                                        <div id="takeattendancecontentviewload"></div>
                                        <div class="col-lg-2">
                                            <input type="button" id="takeattendancebtn" value="Take Attendance Now" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                                <div id="viewattendancedata">
                                    <form id="viewattendancedataform">
                                        <div class="col-lg-6">
                                            Select Date:
                                            <input type="date" id="viewattendancebtn" name="attendancedate" class="form-control">
                                        </div>
                                        <div id="viewattendancecontentdateload"></div>
                                        <div id="viewattendancecontentclassload"></div>
                                        <div id="viewattendancecontentsectionload"></div>
                                        <div id="viewattendancecontentviewload"></div>
                                    </form>
                                </div>
                                <div id="editattendancedata">
                                    <p class="well">You Can Edit Attendance Here [Coming Soon].</p>
                                </div>
                            </div>
                        </div>
                        <!-- Billing Data Display -->
                        <div id="billdisplay">
                            <div class="row">
                                <h1 class="page-header">Teaching Staff Portal</h1>
                                <div class="col-lg-6">
                                    <h3>Enter Fee Particulars</h3>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="sizing-addon2">Type of the Fee: </span>
                                        <input type="text" class="form-control" placeholder="Enter Type of the Fee" id="feetype" name="feetype">
                                    </div><br />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="sizing-addon2">In the Name of: </span>
                                        <input type="text" class="form-control" placeholder="Enter Student Name" id="studentname" name="studentname">
                                    </div><br />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="sizing-addon2">Payable Amount [INR]: </span>
                                        <input type="number" class="form-control" id="amount" name="amount">
                                    </div><br />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <input type="submit" class="btn btn-success" name="submit" id="submit">
                                </div>
                            </div>
                        </div>
                        <!-- Notifications & Cirulars-->
                        <div id="notification">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3>Notifications & Cirulars</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <textarea class="form-control" rows="12" id="notice" name="notice"></textarea>
                                </div>
                            </div>           
                            <br />-Or-<br /><br />
                            <div class="row">
                                <div class="col-lg-2">
                                    <input class="form-control" type="file" accept=".pdf,.txt" name="noticefile" id="noticefile" value="Select pdf"><br />
                                    <input type="submit" class="btn btn-success" value="Done" name="submit" value="submit">
                                </div>
                            </div>
                        </div>
                        <!-- Student Profile -->
                        <div id="studentprofile">
                            <div class="row">
                                <!-- Class Zone -->
                                <div class="col-lg-2" style="background: #f8f8f8;"> 
                                    <table class="table">
                                        <tbody>
                                            <tr><td><a class="list-group-item active">Class</a></td></tr>
                                        </tbody>
                                    </table>
                                    <div id="studentprofile_class" class="list-group"  style="float:left; width:100%; overflow-y: auto; height: 600px;">
                                        <div id="classsaveload"></div>
                                        <form id="classsaveform">
                                            <table id="studentprofile_class_table" class="table">
                                                <tbody id="classcontentload">
                                                    <tr><td><div class="input-group"><input type="text" class="form-control" name="class_text[]" id="class_text"><span style="color: red;" class="input-group-addon" onclick="deleteRow(this)" id="basic-addon2">X</span></div></td></tr>
                                                </tbody>
                                            </table>
                                            <input type="button" class="btn btn-success" value="Add" onclick="insertrow()">
                                            <input type="button" class="btn btn-success" value="Save" id="classsave" name="classsave"><br /><br />
                                            <input type="button" class="btn btn-info btn-sm" id="delete_class" value="Delete Class">
                                        </form> 
                                    </div>
                                </div>
                                <!-- Section Zone -->
                                <div class="col-lg-2" style="background: #f8f8f8;">
                                    <table class="table">
                                        <tbody><tr><td><a class="list-group-item active">Section</a></td></tr></tbody>
                                    </table>
                                    <div id="studentprofile_class_section" class="list-group" style="float:left; width:100%; overflow-y: auto; height: 600px;">
                                        <div id="sectionsaveload"></div>
                                        <form id="sectionsaveform">
                                            <table id="studentprofile_class_section_table" class="table">
                                                <tbody id="sectioncontentload">
                                                    <tr><td><div class="input-group"><input type="text" class="form-control" name="section_text[]" id="section_text"><span style="color: red;" class="input-group-addon" onclick="sdeleteRow(this)" id="basic-addon2">X</span></div></td></tr>
                                                </tbody>
                                            </table>
                                            <input type="button" class="btn btn-success" value="Add" onclick="sinsertrow()">
                                            <input type="button" class="btn btn-success" value="Save" id="sectionsave" name="sectionsave"><br /><br />
                                            <button type="button" class="btn btn-info btn-sm" id="delete_section">Delete Section</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- Students List Zone -->
                                <div class="col-lg-2" style="background: #f8f8f8;">
                                    <table class="table">
                                        <tbody><tr><td><form><button class="list-group-item active">Student</button></td></tr></tbody>
                                    </table>
                                    <div id="studentprofile_class_section_student_list" class="list-group" style="float:left; width:100%; overflow-y: auto; height: 600px;">
                                        <div id="studentsaveload"></div>
                                        <form id="studentsaveform">
                                            <table id="studentprofile_class_section_student_list_table" class="table">
                                                <tbody id="studentcontentload">
                                                    <tr><td><div class="input-group"><input type="text" class="form-control" name="student_text[]" id="student_text"><span style="color: red;" class="input-group-addon" onclick="stdeleteRow(this)" id="basic-addon2">X</span></div></td></tr>
                                                </tbody>
                                            </table>
                                            <button type="button" class="btn btn-info btn-sm" id="add_student">Add Student</button><br /><br />
                                            <button type="button" class="btn btn-info btn-sm" id="delete_student">Delete Student</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- Students Display & Enter -->
                                <div id="studentdisplay">

                                </div>
                                <!-- Delete Class Modal-->
                                <div id="delete_class_modal" class="modal">
                                    <div class="modal-content" id="deleteclassload">

                                    </div>
                                </div>
                                <!-- Delete Section Modal-->
                                <div id="delete_section_modal" class="modal">
                                    <div class="modal-content" id="deletesectionload">

                                    </div>
                                </div>
                                <!-- Delete Student Modal-->
                                <div id="delete_student_modal" class="modal">
                                    <div class="modal-content" id="deletestudentload">

                                    </div>
                                </div>
                                <!-- Add Student Modal-->
                                <div id="add_student_modal" class="modal">
                                    <div class="modal-content" id="addstudentload">
                                        <div class="row">
                                            <span class="close">X</span>
                                            <div class="col-lg-4">
                                                <h3>Student Profile</h3>
                                                <!-- `StudentRollNum`, `StudentName`, `StudentPhotoPath`, `Gender`, `PhoneNum`, `MailId`, `Dob`, `Doa`, `OtherDetails`  -->
                                                <form id="addstudentform" enctype="multipart/form-data">
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="sizing-addon2">Student Roll No: </span>
                                                    <input type="text" class="form-control" id="studentrollno" name="studentrollno"  required="required">
                                                </div><br />
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="sizing-addon2">Student Name: </span>
                                                    <input type="text" class="form-control" id="name" name="name"  required="required">
                                                </div><br />
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="sizing-addon2">Doa: </span>
                                                    <input type="date" class="form-control" id="doa" name="doa"  required="required">
                                                </div><br />
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="sizing-addon2">Student Cell: </span>
                                                    <input type="number" class="form-control" id="cell" name="cell"  required="required">
                                                </div><br />
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="sizing-addon2">Student Mail: </span>
                                                    <input type="mail" class="form-control" id="mail" name="mail"  required="required">
                                                </div><br />
                                            </div>
                                            <div class="col-lg-4">
                                                <h3></h3>
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="sizing-addon2">Dob: </span>
                                                    <input type="date" class="form-control" id="dob" name="dob"  required="required">
                                                </div><br />
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="sizing-addon2">Photo: </span>
                                                    <input type="file" class="form-control" id="studentphoto" name="studentphoto[]"  required="required">
                                                </div><br />
                                                Select Gender:
                                                <select class="form-control" name="gender" id="gender">
                                                    <option></option>
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select><br />
                                                Other Details:
                                                <textarea class="form-control" cols="10" rows="5" name="otherdetails" id="otherdetails" placeholder="Enter Any Other Details of the Student"></textarea>
                                                <input type="submit" value="Add Student" id="add_student_modal_btn_notnow" class="btn btn-success" name="studentsubmit">
                                                </form>
                                            </div>
                                            <div class="col-lg-4">
                                                <div id="studentphotoresult">
                                                    Default Content;
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Marks Entry-->
                        <div class="row">
                            <div class="col-lg-2">
                                <div id="marksside">
                                    <ul class="nav" id="side-menu">
                                        <li><a class="btn btn-primary" id="entermarks">Enter Marks</a><br /></li>
                                        <li><a class="btn btn-primary" id="viewmarks">View Marks</a><br /></li>
                                        <li><a class="btn btn-primary" id="editmarks">Edit Marks</a><br /></li>
                                    </ul>
                                </div>
                            </div>
                            <div id="marksdisplay" class="col-lg-10">
                                <div id="entermarksdata">
                                    <form id="entermarksdataform">
                                        <div id="entermarkscontentexamload"></div>
                                        <div id="entermarkscontentclassload"></div>
                                        <div id="entermarkscontentsectionload"></div>
                                        <div id="entermarkscontentviewload"></div>
                                        <div class="col-lg-2">
                                            <input type="button" id="entermarksbtn" value="Enter Marks Now" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                                <div id="viewmarksdata">
                                    <form id="viewmarksdataform">
                                        <div id="viewmarkscontentexamload">
                                            <div class="col-lg-3">
                                                <input type="button" id="viewmarksbtn" value="View Marks Now" class="btn btn-primary">
                                            </div>
                                        </div>
                                        <div id="viewmarkscontentclassload"></div>
                                        <div id="viewmarkscontentsectionload"></div>
                                        <div id="viewmarkscontentviewload"></div>
                                    </form>
                                </div>
                                <div id="editmarksdata">
                                    <p class="well">You Can Edit Attendance Here [Coming Soon].</p>
                                </div>
                            </div>
                        </div>
                        <!-- remarks -->
                        <div id="remark">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3>Remarks</h3>
                                </div>
                            </div>
                            <div class="row">
                                <form id="remarksaveform">
                                    <div id="remarkformcontentload">
                                        <div class="col-lg-6">
                                            <textarea class="form-control" placeholder="Enter the remarks and select the candidates down" rows="12" id="remarktext" name="remarktext"></textarea><br />
                                        </div>
                                        <div class="col-lg-6">         
                                            <div id="remarkoptionload">
                                            </div>
                                            <div id="remarkoptionsectionload">
                                            </div>

                                            <div id="remarkoptionviewload">

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>           
                        </div>    
                    </div>

                </div>
            </div>
        </div>
        <script>
            var idname,idform;

            function stdeleteRow(btn) {
                var row = btn.parentNode.parentNode;
                row.parentNode.removeChild(row);
            }
            function stinsertrow(){
                var table = document.getElementById("studentprofile_class_section_student_list_table");
                var row = table.insertRow();
                var cell = row.insertCell(0);
                cell.innerHTML = '<div class="input-group"><input type="text" class="form-control" name="student_text[]" id="student_text"><span style="color: red;" class="input-group-addon" onclick="stdeleteRow(this)" id="basic-addon2">X</span></div>';
            }

            function sdeleteRow(btn) {
                var row = btn.parentNode.parentNode;
                row.parentNode.removeChild(row);
            }
            function sinsertrow(){
                var table = document.getElementById("studentprofile_class_section_table");
                var row = table.insertRow();
                var cell = row.insertCell(0);
                cell.innerHTML = '<div class="input-group"><input type="text" name="section_text[]" id="section_text" class="form-control"><span class="input-group-addon" onclick="sdeleteRow(this)" id="basic-addon2" style="color: red;">X</span></div>';
            }

            function deleteRow(btn) {
                var row = btn.parentNode.parentNode;
                row.parentNode.removeChild(row);
            }
            function insertrow(){
                var table = document.getElementById("studentprofile_class_table");
                var row = table.insertRow();
                var cell = row.insertCell(0);
                cell.innerHTML = '<div class="input-group"><input type="text" name="class_text[]" id="class_text" class="form-control"><span class="input-group-addon" onclick="deleteRow(this)" id="basic-addon2" style="color: red;">X</span></div>';
            }

            function dispay(){

                $("#timetable").show();
                $("#timetableside").show();

                $("#billdisplay").hide();
                $("#billdisplayside").hide();

                $("#attendancedisplay").hide();
                $("#attendancedisplayside").hide();

                $("#notification").hide();
                $("#notificationside").hide();

                $("#studentprofile").hide();
                $("#studentprofileside").hide();

                $("#remark").hide();
                $("#remarkside").hide();

                $("#marksside").hide();
                $("#marksdisplay").hide();


            }

            $(document).ready(function(){

                $("#studentprofilebtn").click(function(){
                    $("#studentprofile").show();
                    $("#studentprofileside").show();

                    $("#notification").hide();
                    $("#notificationside").hide();
                    $("#billdisplay").hide();
                    $("#billdisplayside").hide();
                    $("#timetable").hide();
                    $("#timetableside").hide();
                    $("#remark").hide();
                    $("#remarkside").hide();
                    $("#attendancedisplay").hide();
                    $("#attendancedisplayside").hide();
                    $("#marksside").hide();
                    $("#marksdisplay").hide();

                    var classdata=$("#classcontentform").serializeArray();
                    classdata[classdata.length]={name: "showclassbtn", value: true};
                    $("#classcontentload").load("getteachingstaff.php",classdata);
                });
                $("#notificationbtn").click(function(){
                    $("#notification").show();
                    $("#notificationside").show();

                    $("#studentprofile").hide();
                    $("#studentprofileside").hide();
                    $("#billdisplay").hide();
                    $("#billdisplayside").hide();
                    $("#timetable").hide();
                    $("#timetableside").hide();
                    $("#remark").hide();
                    $("#remarkside").hide();
                    $("#attendancedisplay").hide();
                    $("#attendancedisplayside").hide();
                    $("#marksside").hide();
                    $("#marksdisplay").hide();
                });
                $("#billdisplaybtn").click(function(){
                    $("#billdisplay").show();
                    $("#billdisplayside").show();

                    $("#studentprofile").hide();
                    $("#studentprofileside").hide();
                    $("#notification").hide();
                    $("#notificationside").hide();
                    $("#timetable").hide();
                    $("#timetableside").hide();
                    $("#remark").hide();
                    $("#remarkside").hide();
                    $("#attendancedisplay").hide();
                    $("#attendancedisplayside").hide();
                    $("#marksside").hide();
                    $("#marksdisplay").hide();
                });
                $("#attendancedisplaybtn").click(function(){
                    $("#attendancedisplay").show();
                    $("#attendancedisplayside").show();
                    $("#takeattendancedata, #viewattendancedata, #editattendancedata").hide();

                    $("#billdisplay").hide();
                    $("#billdisplayside").hide();
                    $("#studentprofile").hide();
                    $("#studentprofileside").hide();
                    $("#notification").hide();
                    $("#notificationside").hide();
                    $("#timetable").hide();
                    $("#timetableside").hide();
                    $("#remark").hide();
                    $("#remarkside").hide();
                    $("#marksside").hide();
                    $("#marksdisplay").hide();
                });
                $("#timetablebtn").click(function(){
                    $("#timetable").show();
                    $("#timetableside").show();

                    $("#billdisplay").hide();
                    $("#billdisplayside").hide();
                    $("#studentprofile").hide();
                    $("#studentprofileside").hide();
                    $("#notification").hide();
                    $("#notificationside").hide();
                    $("#remark").hide();
                    $("#remarkside").hide();
                    $("#attendancedisplay").hide();
                    $("#attendancedisplayside").hide();
                    $("#marksside").hide();
                    $("#marksdisplay").hide();
                });
                $("#remarkbtn").click(function(){
                    $("#remark").show();
                    $("#remarkside").show();

                    $("#timetable").hide();
                    $("#timetableside").hide();
                    $("#billdisplay").hide();
                    $("#billdisplayside").hide();
                    $("#studentprofile").hide();                                      
                    $("#studentprofileside").hide();
                    $("#notification").hide();
                    $("#notificationside").hide();
                    $("#attendancedisplay").hide();
                    $("#attendancedisplayside").hide();
                    $("#marksside").hide();
                    $("#marksdisplay").hide();
                });
                $("#marksbtn").click(function(){
                    $("#marksside").show();
                    $("#marksdisplay").show();
                    $("#entermarksdata").hide();
                    $("#viewmarksdata").hide();
                    $("#editmarksdata").hide();

                    $("#remark").hide();
                    $("#remarkside").hide();
                    $("#timetable").hide();
                    $("#timetableside").hide();
                    $("#billdisplay").hide();
                    $("#billdisplayside").hide();
                    $("#studentprofile").hide();                                      
                    $("#studentprofileside").hide();
                    $("#notification").hide();
                    $("#notificationside").hide();
                    $("#attendancedisplay").hide();
                    $("#attendancedisplayside").hide();
                });

                $(document).on('click','#entermarks',function(){
                    $("#entermarksdata").show();
                    $("#viewmarksdata,#editmarksdata").hide();
                });

                $(document).on('click','#viewmarks',function(){
                    $("#viewmarksdata").show();
                    $("#entermarksdata,#editmarksdata").hide();
                });

                $(document).on('click','#editmarks',function(){
                    $("#editmarksdata").show();
                    $("#entermarksdata,#viewmarksdata").hide();
                });

                $(document).on('click','#takeattendance',function(){
                    $("#takeattendancedata").show();
                    $("#viewattendancedata, #editattendancedata").hide();
                });

                $(document).on('click','#viewattendance',function(){
                    $("#viewattendancedata").show();
                    $("#takeattendancedata, #editattendancedata").hide();
                });

                $(document).on('click','#editattendance',function(){
                    $("#editattendancedata").show();
                    $("#takeattendancedata, #viewattendancedata").hide();
                });


                $(document).on('click', '#viewmarksbtn', function(){         
                    $('#viewmarksbtn').remove();
                    var data=$("#viewmarksdataform").serializeArray();
                    data[data.length]={name: "viewmarkexambtn", value: true};
                    $("#viewmarkscontentexamload").load("getteachingstaff.php",data);
                });

                $(document).on('change', '#vexamid', function(){         
                    var data=$("#viewmarksdataform").serializeArray();
                    data[data.length]={name: "viewmarkclassbtn", value: true};
                    $("#viewmarkscontentclassload").load("getteachingstaff.php",data);
                });

                $(document).on('change', '#vclassid', function(){ 
                    var data=$("#viewmarksdataform").serializeArray();
                    data[data.length]={name: "viewmarksectionbtn", value: true};
                    $("#viewmarkscontentsectionload").load("getteachingstaff.php",data);
                });

                $(document).on('click', '#checkviewmarks', function(){ 
                    var data=$("#viewmarksdataform").serializeArray();
                    data[data.length]={name: "checkviewmarks", value: true};
                    $("#viewmarkscontentviewload").load("getteachingstaff.php",data);
                });

                $(document).on('click', '#entermarksbtn', function(){         
                    $('#entermarksbtn').remove();
                    var data=$("#entermarksdataform").serializeArray();
                    data[data.length]={name: "entermarkexambtn", value: true};
                    $("#entermarkscontentexamload").load("getteachingstaff.php",data);
                });

                $(document).on('change', '#examid', function(){         
                    var data=$("#entermarksdataform").serializeArray();
                    data[data.length]={name: "entermarkclassbtn", value: true};
                    $("#entermarkscontentclassload").load("getteachingstaff.php",data);
                });

                $(document).on('change', '#mclassid', function(){ 
                    var data=$("#entermarksdataform").serializeArray();
                    data[data.length]={name: "entermarksectionbtn", value: true};
                    $("#entermarkscontentsectionload").load("getteachingstaff.php",data);
                });

                $(document).on('click', '#chekentermarks', function(){ 
                    var data=$("#entermarksdataform").serializeArray();
                    data[data.length]={name: "chekentermarksbtn", value: true};
                    $("#entermarkscontentviewload").load("getteachingstaff.php",data);
                });

                $(document).on('click', '#remarktext', function(){ 
                    var data=$("#remarksaveform").serializeArray();
                    data[data.length]={name: "remarkoptionbtn", value: true};
                    $("#remarkoptionload").load("getteachingstaff.php",data);
                });

                $(document).on('change', '#remarkclassid', function(){ 
                    var data=$("#remarksaveform").serializeArray();
                    data[data.length]={name: "remarkoptionsectionbtn", value: true};
                    $("#remarkoptionsectionload").load("getteachingstaff.php",data);

                });

                $(document).on('change', '#remarksectionid', function(){ 
                    var data=$("#remarksaveform").serializeArray();
                    data[data.length]={name: "remarkoptionview", value: true};
                    $("#remarkoptionviewload").load("getteachingstaff.php",data);
                });

                $(document).on('click', '#remarkclasssectionsubmit', function(){ 
                    var data=$("#remarksaveform").serializeArray();
                    data[data.length]={name: "remarkclasssectionsubmit", value: true};
                    $("#remarkformcontentload").load("getteachingstaff.php",data);
                });

                $(document).on('click', '#chekentermarksfinalbtn', function(){         
                    var data=$("#entermarksdataform").serializeArray();
                    data[data.length]={name: "chekentermarksfinalbtn", value: true};
                    $("#entermarksdata").load("getteachingstaff.php",data);
                });

                $(document).on('change', '#timetableclassid', function(){ 
                    var createtablesectiondata=$("#timetablecreatecontentform").serializeArray();
                    createtablesectiondata[createtablesectiondata.length]={name: "createsectionbtn", value: true};
                    $("#timetablesectioncontentformload").load("getteachingstaff.php",createtablesectiondata);
                });

                $(document).on('click', '#takeattendancebtn', function(){ 
                    $('#takeattendancebtn').remove();
                    var data=$("#takeattendancedataform").serializeArray();
                    data[data.length]={name: "takeattendancebtn", value: true};
                    $("#takeattendancecontentclassload").load("getteachingstaff.php",data);
                });

                $(document).on('change', '#classid', function(){ 
                    var data=$("#takeattendancedataform").serializeArray();
                    data[data.length]={name: "takeattendancesectionbtn", value: true};
                    $("#takeattendancecontentsectionload").load("getteachingstaff.php",data);
                });

                $(document).on('change', '#sectionid', function(){ 
                    var data=$("#takeattendancedataform").serializeArray();
                    data[data.length]={name: "takeattendanceviewbtn", value: true};
                    $("#takeattendancecontentviewload").load("getteachingstaff.php",data);
                });

                $(document).on('click', '#viewattendancebtn', function(){ 
                    var data=$("#viewattendancedataform").serializeArray();
                    data[data.length]={name: "viewattendancebtn", value: true};
                    $("#viewattendancecontentclassload").load("getteachingstaff.php",data);
                });

                $(document).on('change', '#vclassid', function(){ 
                    var data=$("#viewattendancedataform").serializeArray();
                    data[data.length]={name: "viewattendancesectionbtn", value: true};
                    $("#viewattendancecontentsectionload").load("getteachingstaff.php",data);
                });

                $(document).on('change', '#vsectionid', function(){ 
                    var data=$("#viewattendancedataform").serializeArray();
                    data[data.length]={name: "viewattendanceviewbtn", value: true};
                    $("#viewattendancecontentviewload").load("getteachingstaff.php",data);
                });

                $(document).on('click', '#submitattendence', function(){ 
                    var data=$("#takeattendancedataform").serializeArray();
                    data[data.length]={name: "takeattendancebeforebtn", value: true};
                    $("#takeattendancecontentviewload").load("getteachingstaff.php",data);
                });

                $(document).on('click', '#finalsubmitattendence', function(){ 
                    var data=$("#takeattendancedataform").serializeArray();
                    data[data.length]={name: "takeattendancefinalbtn", value: true};
                    $("#takeattendancecontentviewload").load("getteachingstaff.php",data);
                });

                $(document).on('click', '#studentsectionsave', function(){ 

                    var data=$("#takeattendancedataform").serializeArray();
                    data[data.length]={name: "studentsectionsavebtn", value: true};
                    $("#takeattendancecontentviewload").load("getteachingstaff.php",data);
                });

                $(document).on('click', '#btn-list .btn12', function(){ 
                    alert($(this).index);
                });

                var gclass,gsection,gstudent;

                $(document).on('click', 'input[id^="showsection"]', function(){ 
                    idname=this.id.match(/ .*/);
                    //idform="#showsectionform"+this.id.match(/\d+$/);
                    gclass=idname;

                    var data=$("#showsectionform").serializeArray();
                    data[data.length]={name: "classid", value: idname};
                    data[data.length]={name: "showsectionbtn", value: true};
                    $("#sectioncontentload").load("getteachingstaff.php",data);

                    //$('#btn-list').append('<div class="btn12">MyButton</div>');
                });


                $(document).on('click', 'input[id^="showstudent"]', function(){ 
                    idname=this.id.match(/ .*/);
                    //idform="#showsectionform"+this.id.match(/\d+$/);
                    //alert("I class id "+gclass+"I section id am working"+idname);
                    gsection=idname;
                    var data=$("#showstudentform").serializeArray();
                    data[data.length]={name: "classid", value: gclass};
                    data[data.length]={name: "sectionid", value: gsection};
                    data[data.length]={name: "showstudentbtn", value: true};

                    $("#studentcontentload").load("getteachingstaff.php",data);

                    //$('#btn-list').append('<div class="btn12">MyButton</div>');
                }); 

                $(document).on('click', 'input[id^="showdetailsstudent"]', function(){ 
                    idname=this.id.match(/ .*/);
                    //idform="#showsectionform"+this.id.match(/\d+$/);
                    var data=$("#studentdetailsdisplayform").serializeArray();
                    data[data.length]={name: "allid", value: idname};
                    data[data.length]={name: "showstudentdetailsbtn", value: true};

                    $("#studentdisplay").load("getteachingstaff.php",data);
                    //alert("I class id "+gclass+"I section id am working"+idname);
                    //$('#btn-list').append('<div class="btn12">MyButton</div>');
                });

                ////$("input[id^='showsection']").on("click",function(){
                //                    idnum="#showsection"+this.id.match(/\d+$/);
                //              });
                $("#createtable").on("click",function(){
                    $("#createtable").remove();
                    var createtabledata=$("#timetablecreatecontentform").serializeArray();
                    createtabledata[createtabledata.length]={name: "createtablebtn", value: true};
                    $("#timetablecreatecontentformload").load("getteachingstaff.php",createtabledata);
                });

                $(document).on('click', '#checkclasssection', function(){ 
                    var createtimetabledata=$("#timetablecreatecontentform").serializeArray();
                    createtimetabledata[createtimetabledata.length]={name: "viewtimetablebtn", value: true};

                    $("#timetablefinal").load("getteachingstaff.php",createtimetabledata);

                });

                $(document).on('click', '#classsave', function(){ 
                    var data=$('#classsaveform').serializeArray();
                    data[data.length]={name: "classsavebtn", value: true};
                    $("#classsaveload").load("getteachingstaff.php",data);
                    $("#studentprofile_class_table tbody tr").remove();
                });

                $(document).on('click', '#sectionsave', function(){
                    var data=$("#sectionsaveform").serializeArray();
                    data[data.length]={name: "classid", value: gclass};
                    data[data.length]={name: "sectionsavebtn", value: true};
                    $("#sectionsaveload").load("getteachingstaff.php",data);
                    $("#studentprofile_class_section_table tbody tr").remove();
                });

                $(document).on('click','#add_student',function(){
                    $("#add_student_modal").css("display", "block");
                });

                $(document).on('click', '#add_student_modal_btn', function(){
                    var data=$("#addstudentform").serializeArray();
                    data[data.length]={name: "addstudentbtn", value: true};
                    $("#add_student_modal").load("getteachingstaff.php",data);
                });

                $(document).on('click','#delete_student',function(){
                    var data=$("#showstudentdetailsform").serializeArray();
                    data[data.length]={name: "classid", value: gclass};
                    data[data.length]={name: "sectionid", value: gsection};
                    data[data.length]={name: "deletestudentbtn", value: true};
                    $("#deletestudentload").load("getteachingstaff.php",data);

                    $("#delete_student_modal").css("display", "block");
                });

                $(document).on('click','#finalstudentdelete',function(){
                    var data=$("#studentdeleteform").serializeArray();
                    data[data.length]={name: "finaldeletestudentbtn", value: true};
                    $("#deletestudentload").load("getteachingstaff.php",data);
                });

                $(document).on('click','#delete_class',function(){
                    var data=$("#classsaveform").serializeArray();
                    data[data.length]={name: "deleteclassbtn", value: true};
                    $("#deleteclassload").load("getteachingstaff.php",data);

                    $("#delete_class_modal").css("display", "block");
                });

                $(document).on('click','#finalclassdelete',function(){
                    var data=$("#classdeleteform").serializeArray();
                    data[data.length]={name: "finaldeleteclassbtn", value: true};
                    $("#deleteclassload").load("getteachingstaff.php",data);
                });

                $(document).on('click','#delete_section',function(){
                    var data=$("#sectionsaveform").serializeArray();
                    data[data.length]={name: "deletesectionbtn", value: true};
                    $("#deletesectionload").load("getteachingstaff.php",data);

                    $("#delete_section_modal").css("display", "block");
                });

                $(document).on('click','#finalsectiondelete',function(){
                    var data=$("#sectiondeleteform").serializeArray();
                    data[data.length]={name: "finaldeletesectionbtn", value: true};
                    $("#deletesectionload").load("getteachingstaff.php",data);
                });

                $(document).on('click','.close',function(){
                    $("#delete_class_modal").css("display", "none");
                    $("#delete_section_modal").css("display", "none");
                    $("#add_student_modal").css("display", "none");
                    $("#delete_student_modal").css("display", "none");
                });

                $("form#addstudentform").submit(function(event){

                    event.preventDefault();
                    var formData = new FormData($(this)[0]);
                    formData.append('classid',gclass);
                    formData.append('sectionid',gsection);

                    $.ajax({
                        url: 'imageonly.php',
                        type: 'POST',
                        data: formData,
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (returndata) {
                            $('#studentphotoresult').html(returndata);
                        }
                    });

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

