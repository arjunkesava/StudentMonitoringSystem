<?php
    require("head.inc");
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
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="docs/css/bootstrap-3.3.2.min.css" type="text/css">
        <link rel="stylesheet" href="docs/css/bootstrap-example.css" type="text/css">
        <link rel="stylesheet" href="docs/css/prettify.css" type="text/css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="build.css"/>
        <script type="text/javascript" src="docs/js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="docs/js/bootstrap-3.3.2.min.js"></script>
        <script type="text/javascript" src="docs/js/prettify.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
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
    <body onload="display()">
        <div id="wrapper">
            <div class="navbar-default sidebar" >
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <img src="smslogo.png" alt="" height="100%" width="100%"><br /><br />
                        </li>
                        <li>
                            <img src="schoollogo.png" alt="" height="100%" width="100%"><br /><br />
                        </li>
                        <li>
                            <button id="timetablebtn" class="form-control">Time Tables</button>
                        </li>
                        <li>
                            <button id="billdisplaybtn" class="form-control">Billings</button>
                        </li>
                        <li>
                            <button id="notificationbtn" class="form-control">Notifications & Circulars</button>
                        </li>
                        <li>
                            <button id="noticeboardbtn"class="form-control">Notice Board</button> <!-- not yet done -->
                        </li>
                        <li>
                            <button id="studentprofilebtn" class="form-control">Student Profile</button>
                        </li>
                        <li>
                            <button id="staffprofilebtn" class="form-control">Staff Profile</button>
                        </li>
                        <li>
                            <button id="examinationbtn" class="form-control">Examinations</button>
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
                    <h1 class="page-header">Non Teaching Staff</h1>
                </div>
                <div class="row" style="background: #f8f8f8;">
                    <div class="col-lg-12" style="background-color: #f8f8f8;">
                        <!-- Time Table Display -->
                        <div class="row">
                            <div class="col-lg-2">
                                <div id="timetableside">
                                    <ul class="nav" id="side-menu">
                                        <li><a class="btn btn-primary" id="createclass">Create Tables</a><br /></li>
                                        <li><a class="btn btn-primary" id="editclass">Edit Tables</a><br /></li>
                                        <li><a class="btn btn-primary" id="viewclass">View Tables</a><br /></li>
                                        <li><a class="btn btn-warning" id="addsubjects">Add Subjects</a><br /></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-10" id="timetablecontent">
                                <div class="timetablecreatecontent">
                                    <form id="timetablecreatecontentform">
                                        <div id="timetablecreatecontentformload"></div>
                                        <div id="timetablesectioncontentformload"></div>
                                        <div id="timetablefinal"></div>
                                        <input type="button" value="Create table" id="createtable" class="btn btn-primary">
                                    </form>
                                </div>
                                <div class="timetableeditcontent">
                                    <form id="timetableeditcontentform">
                                        timetableeditcontent
                                    </form>
                                </div>
                                <div class="timetableviewcontent">
                                    <form id="timetableviewcontentform">
                                        <div id="timetableviewcontentformload"></div>
                                        <div id="timetableviewclasscontentformload"></div>
                                        <div id="timetableviewsectioncontentformload"></div>
                                        <div id="timetableviewfinal"></div>
                                        <input type="button" value="View Table" id="viewtable" class="btn btn-primary">
                                    </form>    
                                </div>
                                <div class="addsubjectscontent">
                                    <form id="addsubjectscontentform">
                                        <div id="addsubjectscontentformload"></div>
                                        <input type="button" value="Add Subjects Now" id="subaddsubjects" class="btn btn-primary">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Billing Data Display -->
                        <div class="row">
                            <div class="col-lg-2">
                                <div id="billdisplayside">
                                    <ul class="nav" id="side-menu">
                                        <li><a class="btn btn-primary" id="paybill">Pay Bill</a><br /></li>
                                        <li><a class="btn btn-primary" id="viewbill">View Bill</a><br /></li>
                                        <li><a class="btn btn-primary" id="editbill">Edit Bill</a><br /></li>
                                    </ul>
                                </div>
                            </div>
                            <div id="billdisplay"  class="col-lg-10">
                                <div id="paybilldata">
                                    <form id="paybilldataform">
                                        <div class="row">
                                            <h3>Enter Fee Particulars</h3>
                                            <div class="col-lg-4">
                                                Select type of Bill:                                            
                                                <select class="form-control" id="billtype" name="billtype">
                                                    <option></option>
                                                    <option class="form-control">Hostel Bill</option>
                                                    <option class="form-control">Academic Bill</option>
                                                    <option class="form-control">Other Bill</option>
                                                </select>
                                                <br />
                                            </div>
                                            <div class="col-lg-2">
                                                <div id="paybillyearload"></div>                                                    
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3" id="classstatus">
                                                <div id="paybillclassload"></div>
                                            </div>
                                            <div class="col-lg-3" id="sectionstatus">
                                                <div id="paybillsectionload"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div id="paybillstudentload"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="input-group"><span class="input-group-addon" id="sizing-addon2">Payable Amount [INR]: </span><input type="number" min=0 class="form-control" id="payableamount" name="payableamount"></div>
                                                <br />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="input-group"><span class="input-group-addon" id="sizing-addon2">Original Amount [INR]: </span><input type="number" min=0 class="form-control" id="originalamount" name="originalamount"></div>
                                                <br />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2"><input type="button" class="btn btn-success" name="paybillsubmit" value="Pay Now" id="paybillsubmit"></div>
                                        </div>
                                    </form>
                                </div>
                                <div id="viewbilldata">
                                    <form id="viewbilldataform">      
                                        <div id="viewbillcontentload"></div>
                                        <div class="col-lg-2">
                                            <input type="button" id="viewbilltable" value="View All Bills" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                                <div id="editbilldata">
                                    <p class="well">You Can Edit Bills Here [Coming Soon].</p>
                                </div>
                            </div>
                        </div>
                        <!-- Notifications & Cirulars-->
                        <div class="row">
                            <div class="col-lg-2">
                                <div id="notificationside">
                                    <h3></h3>
                                    <ul class="nav" id="side-menu">
                                        <li><a class="btn btn-primary" id="createnotice">Create Notice</a><br /></li>
                                        <li><a class="btn btn-primary" id="viewnotice">View Notice</a><br /></li>
                                        <li><a class="btn btn-primary" id="editnotice">Edit Notice</a><br /></li>
                                    </ul>
                                </div>
                            </div>
                            <div id="notification">
                                <div id="createnoticedata">
                                    <div class="row">
                                        <h3>Create Notice</h3>
                                        <div class="col-lg-6">
                                            <form id="createnoticeform" enctype="multipart/form-data">
                                                <div class="col-lg-10">
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
                                                        <div class="col-lg-6">
                                                            Or Attach a File:<br />
                                                            <input type="file" name="circularfile" id="circularfile" class="form-control" accept=".pdf,.jpg">
                                                        </div>           
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            Enter the Notice
                                                            <textarea class="form-control" rows="12" id="notice" name="notice" placeholder="Enter the Text and Press Done"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12"> 
                                                            To Whom
                                                            <div id="createnoticecontentload">
                                                                <!--
                                                                <div class="form-group">
                                                                <div class="col-sm-10" id="towhomclick">
                                                                To Whom:<br />
                                                                <select id="example-post" name="multiselect[]" multiple="multiple">
                                                                <optgroup id="createnoticecontentload">
                                                                <option>F</option>
                                                                </optgroup>
                                                                <option>DAta Cliebt</option>
                                                                </select>
                                                                </div>
                                                                </div>
                                                                -->
                                                            </div>           
                                                        </div>           
                                                    </div>           
                                                    <div class="row">
                                                        <div class="col-lg-2">
                                                            <input type="submit" class="btn btn-success" value="Done" id="createnoticesubmitbtn" name="createnoticesubmitbtn">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="seefinalnoticecontentload">

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="viewnoticedata">
                                    <div class="row">
                                        <h3>View Notices</h3>
                                        <form id="viewnoticeform">
                                            <div id="viewnoticeformload"></div>
                                            <div class="col-lg-2">
                                                <input type="button" class="btn btn-primary" value="View Old Notices and Circulars" id="viewnoticebtn">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="editnoticedata">
                                    <div class="row">
                                        <h3>Edit Notice</h3>
                                        <div class="col-lg-6">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Student Profile -->
                        <div class="row">
                            <div id="studentprofileside">
                                <ul class="nav" id="side-menu">
                                    <li class="well">
                                        <a href="#">See u Soon</a> 
                                    </li>
                                </ul>
                            </div>
                            <div id="studentprofile">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3>Student Profile</h3>
                                    </div>
                                </div><br />
                                <div class="row">
                                    <div class="col-lg-3">
                                        <img src="female.jpg" cols="80%" rows="80%">
                                        Name: <strong>P. Shemala</strong><br />
                                        Age: <strong>20</strong><br />
                                        Class: <strong>10th Standard</strong><br />
                                        Gender: <strong>Female</strong><br />
                                    </div>
                                    <h4> <strong>Subjects</strong> </h4><br />
                                    <div class="col-lg-6">
                                        <table border="0" cellspacing="10">
                                            <tr>
                                                <td>
                                                    <p class="well">
                                                        <strong>English</strong><br />
                                                        Appa rao Sir
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="well">
                                                        <strong>Maths</strong><br />
                                                        rao Sir
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p class="well">
                                                        <strong>Java</strong><br />
                                                        Murthy Sir
                                                    </p>
                                                </td><td>                                        
                                                    <p class="well">
                                                        <strong>C++</strong><br />
                                                        Shyamala Madam
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p class="well">
                                                        <strong>Data Structures</strong><br />
                                                        Siva rama krishna
                                                    </p></td><td>                                        
                                                </td>
                                            </tr>
                                        </table>
                                    </div><br />
                                </div>
                            </div>
                        </div>
                        <!-- Staff Profile -->
                        <div class="row">
                            <div class="col-lg-2">
                                <div id="staffprofileside">
                                    <ul class="nav" id="side-menu">
                                        <li><a class="btn btn-primary" id="createstaff">Create Staff</a><br /></li>
                                        <li><a class="btn btn-primary" id="viewstaff">View Staff</a><br /></li>
                                        <li><a class="btn btn-primary" id="editstaff">Edit Staff</a><br /></li>
                                    </ul>
                                </div>
                            </div>
                            <div id="staffprofile" class="col-lg-10">
                                <div id="createstaffdata">
                                    <div class="row">
                                        <h3>Create Staff Profile</h3>
                                        <form id="createstaffform" enctype="multipart/form-data">
                                            <!--
                                            StaffId, InstituteId, StaffName, Designation, Qualification, StaffPhotoPath, CurriculumVitaePath, Gender, PhoneNum, MailId, StaffExperience, Dob, Doj, StaffType, OtherDetails
                                            -->
                                            <div class="row">
                                                <div class="col-lg-6"><br />
                                                    Staff Full Name:
                                                    <input class="form-control" type="text" name="staffname" id="staffname" required>
                                                </div>
                                                <div class="col-lg-3"><br />
                                                    Designation
                                                    <input class="form-control" type="text" name="designation" id="designation" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3"><br />
                                                    Staff Qualification:
                                                    <input class="form-control" type="text" name="qualification" id="qualification" required>
                                                </div>
                                                <div class="col-lg-3"><br />
                                                    Gender:
                                                    <select class="form-control" name="gender" id="gender" required>
                                                        <option></option>
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3"><br />
                                                    Phone Num:
                                                    <input type="number" min=0 class="form-control" id="phonenum" name="phonenum" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5"><br />    
                                                    Staff Profile Photo:
                                                    <input type="file" class="form-control" name="staffphoto" id="staffphoto"  accept=".jpg,.png,.gif" required>
                                                </div>
                                                <div class="col-lg-4"><br />
                                                    Curriculum Vitae:
                                                    <input type="file" class="form-control" name="curriculum" id="curriculum"  accept=".jpg,.docx,.pdf,.doc,.txt,.rtf" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3"><br />
                                                    Mail ID:
                                                    <input type="text" class="form-control" name="mailid" id="mailid" required>
                                                </div>
                                                <div class="col-lg-3"><br />
                                                    Staff Experience:
                                                    <input type="text" class="form-control" name="staffexperience" id="staffexperience" required>
                                                </div>
                                                <div class="col-lg-3"><br />
                                                    Date Of Birth:
                                                    <input type="date" class="form-control" name="dob" id="dob" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3"><br />
                                                    Date of Joining:
                                                    <input type="date" class="form-control" name="doj" id="doj" required>
                                                </div>
                                                <div class="col-lg-6"><br />
                                                    Other Details:
                                                    <textarea cols="10" rows="10" name="otherdetails" class="form-control" id="otherdetails"></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2"><br />
                                                    Add Staff:
                                                    <input type="submit" name="addstaff" id="addstaff" class="btn btn-primary" value="Done">
                                                </div>
                                            </div>
                                        </form>
                                    </div><br />
                                </div>
                                <div id="viewstaffdata">
                                    <div class="row">
                                        <h3>View Staff Profile</h3>
                                        <form id="viewstaffform">
                                            <div class="col-lg-12" id="viewstaffcontentload">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="editstaffdata">
                                    <div class="row">
                                        <h3>Edi Staff Profile</h3>
                                        <p class="well">Edit Staff Profile Content</p>
                                    </div><br />
                                </div>
                            </div>
                        </div>
                        <!-- Examinations -->
                        <div class="row">
                            <div class="col-lg-2">
                                <div id="examinationside">
                                    <ul class="nav" id="side-menu">
                                        <li><a class="btn btn-primary" id="createexam">Create Exam</a><br /></li>
                                        <li><a class="btn btn-primary" id="viewexam">View Exam</a><br /></li>
                                        <li><a class="btn btn-primary" id="editexam">Edit Exam</a><br /></li>
                                    </ul>
                                </div>
                            </div>
                            <div id="examination" class="col-lg-10">
                                <div id="createexamdata">
                                    <form id="createexamform">
                                        <div class="row">
                                            <h3>Create Exam</h3>
                                            <div class="col-lg-4">
                                                Exam Name:<br />
                                                <input type="text" name="examname" id="examname" class="form-control">
                                            </div>
                                            <div class="col-lg-2">
                                                Total Marks:<br />
                                                <input type="number" name="totalmarks" id="totalmarks" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                Number of Subjects:
                                                <input type="number" name="subjectslist" id="subjectslist" class="form-control">
                                            </div>
                                            <div class="col-lg-3">
                                                Click:<br />
                                                <input type="button" value="Check" id="checksubjectbutton" name="checksubjectbutton" class="btn btn-primary">
                                            </div>
                                        </div>
                                        <div id="subjectslistcontentload"></div>
                                    </form>
                                </div>
                                <div id="viewexamdata">
                                    <div class="row">
                                        <h3>View Exams</h3>
                                        <form id="viewexamform">
                                            <div id="viewexamformload"></div>
                                            <div class="col-lg-2">
                                                <input type="button" class="btn btn-primary" value="View Old Exams" id="viewexambtn">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="editexamdata">
                                    <div class="row">
                                        <h3>Edit Exam</h3>
                                        <div class="col-lg-6">
                                            <p class="well">Edit of Examinations    ...[Coming Soon]</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->
        <!-- /#wrapper -->
        <!-- jQuery --> 
        <script>
            function display(){
                $("#timetable").show();
                $("#timetableside").show();

                $("#billdisplay").hide();
                $("#billdisplayside").hide();

                $("#notification").hide();
                $("#notificationside").hide();
                $("#createnoticedata").hide();
                $("#viewnoticedata").hide();
                $("#editnoticedata").hide();

                $("#studentprofile").hide();
                $("#studentprofileside").hide();

                $("#staffprofile").hide();
                $("#staffprofileside").hide();
                $("#createstaffdata,#viewstaffdata,#editstaffdata").hide();

                $("#examination").hide();
                $("#examinationside").hide();
                $("#viewexamdata,#editexamdata").hide();

            }

            $("form#createstaffform").submit(function(event){

                event.preventDefault();
                var formData = new FormData($(this)[0]);
                formData.append('createstaffbtn',true);

                $.ajax({
                    url: 'imageonly.php',
                    type: 'POST',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (returndata) {
                        $('#createstaffdata').html(returndata);
                    }
                });

            });

            $("form#createnoticeform").submit(function(event){

                $("#createnoticesubmitbtn").remove();

                event.preventDefault();
                var formData = new FormData($(this)[0]);
                formData.append('createnoticecontentbtn',true);

                $.ajax({
                    url: 'imageonly.php',
                    type: 'POST',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (returndata) {
                        $('#seefinalnoticecontentload').html(returndata);
                    }
                });

            });

            /*
            var jq=$.noConflict();
            jq( document ).ready(function( $ ) {
            jq('#example-post').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true
            });
            // Code that uses jQuery's $ can follow here.
            });
            */

            var jq=$.noConflict();
            jq( document ).ready(function( $ ) {
                jq('#example-post').multiselect({
                    includeSelectAllOption: true,
                    enableFiltering: true
                });
            });

            $(document).ready(function(){


                $("#staffprofilebtn").click(function(){
                    $("#staffprofile").show();
                    $("#staffprofileside").show();

                    $("#studentprofile").hide();
                    $("#studentprofileside").hide();
                    $("#notification").hide();
                    $("#notificationside").hide();
                    $("#billdisplay").hide();
                    $("#billdisplayside").hide();
                    $("#timetable").hide();
                    $("#timetableside").hide();
                    $("#timetablecontent").hide();
                    $("#examination").hide();
                    $("#examinationside").hide();
                });
                $("#studentprofilebtn").click(function(){
                    $("#studentprofile").show();
                    $("#studentprofileside").show();

                    $("#staffprofile").show();
                    $("#staffprofileside").show();
                    $("#notification").hide();
                    $("#notificationside").hide();
                    $("#billdisplay").hide();
                    $("#billdisplayside").hide();
                    $("#timetable").hide();
                    $("#timetableside").hide();
                    $("#timetablecontent").hide();
                    $("#examination").hide();
                    $("#examinationside").hide();
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
                    $("#timetablecontent").hide();
                    $("#examination").hide();
                    $("#examinationside").hide();
                    $("#staffprofile").hide();
                    $("#staffprofileside").hide();

                    $("#createnoticedata").hide();
                    $("#viewnoticedata").hide();
                    $("#editnoticedata").hide();
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
                    $("#timetablecontent").hide();
                    $("#examination").hide();
                    $("#examinationside").hide();
                    $("#staffprofile").hide();
                    $("#staffprofileside").hide();

                    $("#paybilldata").hide();
                    $("#editbilldata").hide();
                    $("#viewbilldata").hide();
                });
                $("#timetablebtn").click(function(){
                    $("#timetable").show();
                    $("#timetableside").show();
                    $("#timetablecontent").show();

                    $("#billdisplay").hide();
                    $("#billdisplayside").hide();
                    $("#studentprofile").hide();
                    $("#studentprofileside").hide();
                    $("#notification").hide();
                    $("#notificationside").hide();
                    $("#examination").hide();
                    $("#examinationside").hide();
                    $("#staffprofile").hide();
                    $("#staffprofileside").hide();
                });
                $("#examinationbtn").click(function(){
                    $("#examination").show();
                    $("#examinationside").show();
                    $("#createexamdata").hide();
                    $("#viewexamdata").hide();
                    $("#editexamdata").hide();

                    $("#timetable").hide();
                    $("#timetableside").hide();
                    $("#timetablecontent").hide();
                    $("#billdisplay").hide();
                    $("#billdisplayside").hide();
                    $("#studentprofile").hide();
                    $("#studentprofileside").hide();
                    $("#notification").hide();
                    $("#notificationside").hide();
                    $("#staffprofile").hide();
                    $("#staffprofileside").hide();
                });

                if($("#timetable").show()){         
                    $("#timetablecreatecontentform").hide();
                    $("#timetableeditcontentform").hide();
                    $("#timetableviewcontentform").hide();
                    $("#addsubjectscontentform").hide();
                }

                $('#createstaff').click(function(){
                    $("#createstaffdata").show();
                    $("#viewstaffdata,#editstaffdata").hide();
                });

                $('#editstaff').click(function(){
                    $("#editstaffdata").show();
                    $("#viewstaffdata,#createstaffdata").hide();
                });

                $('#viewstaff').click(function(){
                    $("#viewstaffdata").show();
                    $("#editstaffdata,#createstaffdata").hide();

                    var data=$("#viewstaffform").serializeArray();
                    data[data.length]={name: "viewstaffbtn", value: true};
                    $("#viewstaffcontentload").load("getnonteachingstaff.php",data);
                });

                $('#createnotice').click(function(){
                    $("#createnoticedata").show();
                    $("#viewnoticedata,#editnoticedata").hide();

                });

                $('#viewnotice').click(function(){
                    $("#viewnoticedata").show();
                    $("#createnoticedata,#editnoticedata").hide();
                });

                $('#editnotice').click(function(){
                    $("#editnoticedata").show();
                    $("#createnoticedata,#viewnoticedata").hide();
                });

                $(document).on('click','#createexam',function(){
                    alert("What the shit");
                    $("#createexamdata").show();
                    $("#viewexamdata,#editexamdata").hide();
                });

                $('#viewexam').click(function(){
                    $("#viewexamdata").show();
                    $("#createexamdata,#editexamdata").hide();
                });

                $('#editexam').click(function(){
                    $("#editexamdata").show();
                    $("#createexamdata,#viewexamdata").hide();
                });

                $('#paybill').click(function(){
                    $("#paybilldata").show();
                    $("#viewbilldata,#editbilldata").hide();
                });

                $('#editbill').click(function(){
                    $("#editbilldata").show();
                    $("#viewbilldata,#paybilldata").hide();
                });

                $('#viewbill').click(function(){
                    $("#viewbilldata").show();
                    $("#editbilldata,#paybilldata").hide();
                });

                $('#createclass').click(function(){
                    $("#timetablecreatecontentform").show();
                    $("#timetableeditcontentform").hide();
                    $("#timetableviewcontentform").hide();
                    $("#addsubjectscontentform").hide();

                });

                $('#editclass').click(function(){
                    $("#timetableeditcontentform").show();
                    $("#timetablecreatecontentform").hide();
                    $("#timetableviewcontentform").hide();
                    $("#addsubjectscontentform").hide();
                });

                $('#viewclass').click(function(){
                    $("#timetableviewcontentform").show();
                    $("#timetablecreatecontentform").hide();
                    $("#timetableeditcontentform").hide();
                    $("#addsubjectscontentform").hide();
                });

                $('#addsubjects').click(function(){
                    $("#addsubjectscontentform").show();
                    $("#timetableviewcontentform").hide();
                    $("#timetablecreatecontentform").hide();
                    $("#timetableeditcontentform").hide();
                });

                $("#viewtable").on("click",function(){
                    $("#viewtable").remove();
                    var data=$("#timetableviewcontentform").serializeArray();
                    data[data.length]={name: "viewtimetableclassbtn", value: true};
                    $("#timetableviewcontentformload").load("getnonteachingstaff.php",data);
                });

                $(document).on("click","#createnoticebeforebtn",function(){
                    $("#createnoticebeforebtn").remove();
                    var data=$("#createnoticeform").serializeArray();
                    data[data.length]={name: "createnoticebeforebtn", value: true};
                    $("#createnoticecontentload").load("getnonteachingstaff.php",data);
                });

                $("#viewnoticebtn").on("click",function(){
                    $("#viewnoticebtn").remove();
                    var data=$("#viewnoticeform").serializeArray();
                    data[data.length]={name: "viewnoticebutton", value: true};
                    $("#viewnoticeformload").load("getnonteachingstaff.php",data);
                });

                $("#createtable").on("click",function(){
                    $("#createtable").remove();
                    var createtabledata=$("#timetablecreatecontentform").serializeArray();
                    createtabledata[createtabledata.length]={name: "createtablebtn", value: true};
                    $("#timetablecreatecontentformload").load("getnonteachingstaff.php",createtabledata);
                });

                /*
                $(document).on("click","#createnoticesubmitbtn",function(){
                var data=$("#createnoticeform").serializeArray();
                data[data.length]={name: "createnoticecontentbtn", value: true};
                $("#seefinalnoticecontentload").load("imageonly.php",data);
                }); 
                */

                $(document).on('click', '#createexamsubmit', function(){ 
                    var data=$("#createexamform").serializeArray();
                    data[data.length]={name: "createexamsubmit",value:true};
                    $("#createexamdata").load("getnonteachingstaff.php",data);    
                });

                $(document).on('click', '#viewexambtn', function(){ 

                    var data=$("#viewexamform").serializeArray();
                    data[data.length]={name: "viewexambtn",value:true};
                    $("#viewexamformload").load("getnonteachingstaff.php",data);    
                });

                $(document).on('click', '#checksubjectbutton', function(){ 
                    var data=$("#createexamform").serializeArray();
                    data[data.length]={name: "checksubjectbutton",value:true};
                    $("#subjectslistcontentload").load("getnonteachingstaff.php",data);    
                });

                $(document).on('change', '#billtype', function(){ 
                    var paybilldata=$("#paybilldataform").serializeArray();
                    paybilldata[paybilldata.length]={name: "paybillyearbtn",value:true};
                    $("#paybillyearload").load("getnonteachingstaff.php",paybilldata);    

                });

                $(document).on('change', '#billyearid', function(){ 
                    var data=$("#paybilldataform").serializeArray();
                    data[data.length]={name: "paybillclassbtn",value:true};
                    $("#paybillclassload").load("getnonteachingstaff.php",data);    
                });

                $(document).on('change', '#billclassid', function(){ 
                    var data=$("#paybilldataform").serializeArray();
                    data[data.length]={name: "paybillsectionbtn",value:true};
                    $("#paybillsectionload").load("getnonteachingstaff.php",data);    
                });

                $(document).on('change', '#billsectionid', function(){ 
                    var data=$("#paybilldataform").serializeArray();
                    data[data.length]={name: "paybillstudentbtn",value:true};
                    $("#paybillstudentload").load("getnonteachingstaff.php",data);    
                });

                $(document).on('click', '#paybillsubmit', function(){ 
                    var data=$("#paybilldataform").serializeArray();
                    data[data.length]={name: "paybillsubmitbtn",value:true};
                    $("#paybilldata").load("getnonteachingstaff.php",data);
                });

                $(document).on('click', '#viewbilltable', function(){ 

                    $('#viewbilltable').remove();
                    var data=$("#viewbilldataform").serializeArray();
                    data[data.length]={name: "viewbillsubmitbtn",value:true};
                    $("#viewbillcontentload").load("getnonteachingstaff.php",data);


                });

                $(document).on('change', '#viewclassid', function(){ 
                    var data=$("#timetableviewcontentform").serializeArray();
                    data[data.length]={name: "viewtimetablesectionbtn", value: true};
                    $("#timetableviewclasscontentformload").load("getnonteachingstaff.php",data);
                });

                $(document).on('click', '#viewclasssection', function(){ 
                    var data=$("#timetableviewcontentform").serializeArray();
                    data[data.length]={name: "viewtimetablebtn", value: true};
                    $("#timetableviewsectioncontentformload").load("getnonteachingstaff.php",data);
                });

                $(document).on("click","#subaddsubjects",function(){
                    $("#subaddsubjects").remove();
                    var subdata=$("#addsubjectscontentform").serializeArray();
                    subdata[subdata.length]={name: "addsubjectsbtn", value: true};
                    $("#addsubjectscontentformload").load("getnonteachingstaff.php",subdata);
                });

                $(document).on('click', '#addsubject', function(){
                    var data=$("#addsubjectscontentform").serializeArray();
                    data[data.length]={name: "savesubjectsbtn", value: true};
                    $("#addsubjectscontentformload").load("getnonteachingstaff.php",data);
                });

                $(document).on('change', '#classid', function(){ 
                    var createtablesectiondata=$("#timetablecreatecontentform").serializeArray();
                    createtablesectiondata[createtablesectiondata.length]={name: "createsectionbtn", value: true};
                    $("#timetablesectioncontentformload").load("getnonteachingstaff.php",createtablesectiondata);
                });

                $(document).on('click', '#checkclasssection', function(){ 
                    var createtimetabledata=$("#timetablecreatecontentform").serializeArray();
                    createtimetabledata[createtimetabledata.length]={name: "createtimetablebtn", value: true};

                    $("#timetablefinal").load("getnonteachingstaff.php",createtimetabledata);

                });

                $(document).on('click', '#savetimetable', function(){ 
                    var savetimetable=$("#timetablecreatecontentform").serializeArray();
                    savetimetable[savetimetable.length]={name: "savetimetablebtn", value: true};
                    $("#timetablefinal").load("getnonteachingstaff.php",savetimetable);
                });

                $(document).on('change', '#priority', function(){ 
                    var data=$("#createnoticeform").serializeArray();
                    data[data.length]={name: "seecreatenoticebefore", value: true};
                    $("#createnoticecontentload").load("getnonteachingstaff.php",data);
                });

                $(document).on('click', '#seefinalnotice', function(){ 
                    var data=$("#seefinalnoticeform").serializeArray();
                    data[data.length]={name: "seefinalnoticebtn", value: true};
                    $("#seefinalnoticecontentload").load("getnonteachingstaff.php",data);
                });

                $(document).on('click','input[id^="check"]',function () {
                    $(this).parent().find('li input[type=checkbox]').prop('checked', $(this).is(':checked'));
                    var sibs = false;
                    $(this).closest('ul').children('li').each(function () {
                        if($('input[type=checkbox]', this).is(':checked')) sibs=true;
                    })
                    $(this).parents('ul').prev().prop('checked', sibs);
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