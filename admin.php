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

        <title>Admin Dash Board</title>

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
        <div id="wrapper">
            <div class="navbar-default sidebar" >
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <img src="smslogo.png" alt="" height="100%" width="100%">
                        </li>
                        <li>
                            <img src="<?php echo 'logos/'.$_COOKIE['instituteid'].'_logo.png';?>" alt="" height="100%" width="100%">
                        </li>
                         <!-- /input-group 
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                           
                        </li>
                        -->
                        <li>
                            <a id="homepage">Home Page</a>
                        </li>
                        <li>
                            <a id="staff">Staff<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a id="teachingstaff">Teaching Staff</a></li>
                                <li><a id="nonteachingstaff">Non Teaching Staff</a></li>
                            </ul>
                        </li>
                        <li>
                            <a id="addnonteachingstaff">Add Non Teaching Staff</a>
                        </li>
                        <li>
                            <a id="noticeboard">Notice Board</a>
                        </li>
                        <li>
                            <a id="hostel">Hostel<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a id="boyshostel">Boys</a></li>
                                <li><a id="girlshostel">Girls</a></li>
                            </ul>
                        </li>
                        <li>
                            <a id="bill">Fees</a>
                        </li>
                        <li>
                            <a id="timetable"><i class="fa fa-table fa-fw"></i> Tables</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
                <div class="row">
                    <div align="right">
                        <a class="btn btn-success" href="logout.php">Log Out</a>
                    </div>
                    <div class="col-lg-12"><h1 class="page-header">Administrator Panel</h1></div>
                </div>
                <div class="row">
                    <form id="maincontentform">
                        <div id="maincontentload">
                        </div>
                    </form>
                    <div id="createstaffdata">
                    <form id="createstaffform" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-10">
                                <h4>Add Non Teaching Staff</h4>
                            </div>
                        </div>
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
                                Add Staff:<br />
                                <input type="submit" name="addstaff" id="addstaff" class="btn btn-primary" value="Done">
                            </div>
                        </div>
                    </form> 
                    </div>
                </div>

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <script>
            $("form#createstaffform").submit(function(event){
                
                event.preventDefault();
                var formData = new FormData($(this)[0]);
                formData.append('createnonstaffbtn',true);

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
            $(document).ready(function(){
                $("#createstaffdata").hide();

                var data=$("#maincontentform").serializeArray();
                data[data.length]={name: "viewhome", value: true};
                $("#maincontentload").load("getadmin.php",data);

                $('#homepage').click(function(){
                    $('#maincontentform').show();
                    $("#createstaffdata").hide();

                    var data=$("#maincontentform").serializeArray();
                    data[data.length]={name: "viewhome", value: true};
                    $("#maincontentload").load("getadmin.php",data);
                });

                $('#teachingstaff').click(function(){
                    $('#maincontentform').show();
                    $("#createstaffdata").hide();

                    var data=$("#maincontentform").serializeArray();
                    data[data.length]={name: "viewteachingstaffbtn", value: true};
                    $("#maincontentload").load("getadmin.php",data);
                });

                $('#nonteachingstaff').click(function(){
                    $("#createstaffdata").hide();       
                    $('#maincontentform').show();

                    var data=$("#maincontentform").serializeArray();
                    data[data.length]={name: "viewnonteachingstaffbtn", value: true};
                    $("#maincontentload").load("getadmin.php",data);
                });

                $('#noticeboard').click(function(){
                    $('#maincontentform').show();
                    $("#createstaffdata").hide();

                    var data=$("#maincontentform").serializeArray();
                    data[data.length]={name: "viewnoticeboardbtn", value: true};
                    $("#maincontentload").load("getadmin.php",data);
                });
                $('#boyshostel').click(function(){
                    $('#maincontentform').show();
                    $("#createstaffdata").hide();

                    var data=$("#maincontentform").serializeArray();
                    data[data.length]={name: "viewboyshostelbtn", value: true};
                    $("#maincontentload").load("getadmin.php",data);
                });
                $('#girlshostel').click(function(){
                    $('#maincontentform').show();
                    $("#createstaffdata").hide();

                    var data=$("#maincontentform").serializeArray();
                    data[data.length]={name: "viewgirlshostelbtn", value: true};
                    $("#maincontentload").load("getadmin.php",data);
                });

                $('#bill').click(function(){
                    $('#maincontentform').show();
                    $("#createstaffdata").hide();

                    var data=$("#maincontentform").serializeArray();
                    data[data.length]={name: "viewbillbtn", value: true};
                    $("#maincontentload").load("getadmin.php",data);
                });

                $('#addnonteachingstaff').click(function(){
                    $('#createstaffdata').show();
                    $('#maincontentform').hide();
                });
            });
        </script>

        <!-- jQuery -->
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <script src="../bower_components/raphael/raphael-min.js"></script>
        <script src="../bower_components/morrisjs/morris.min.js"></script>
        <script src="../js/morris-data.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../dist/js/sb-admin-2.js"></script>

    </body>

</html>
