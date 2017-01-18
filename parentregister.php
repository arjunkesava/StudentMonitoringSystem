<?php

    if(isset($_POST['submit'])){

        /*
        Array ( [parentname] => sdf
        [cell] => 6
        [email] => wefg
        [state] => Andhra Pradesh
        [district] => Anantapur
        [edutype] => intermediate
        [year] => sdf
        [branch] => M.P.C
        [instituteid] => smsinsttest01
        [classid] => 572abc101
        [studentid] => 11
        [password] => 12
        [confirmpassword] => 12
        [submit] => Register
        )
        */

        $data=true;
        $con=mysqli_connect("localhost","smssystem","tiger","sms_testing_total");
        // Check connection
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        //(`parentid`, `cell`, `mail`, `coparentname`, `state`, `district`, `edutype`, `year`, `branch`, `institutename`, `studentname`, `password`) VALUES (0xDFDF, 833, 'ak', 'sa', 'sd', 's', 'd', 'd', 'd', 's', 's', 'd');

        $uid=uniqid();
        $md=md5($_POST['password']);
        if($_POST['password']==$_POST['confirmpassword'])
        {
            $res=mysqli_query($con,"insert into `mainlogin` values('{$_POST['instituteid']}','{$uid}','{$_POST['email']}','{$_POST['cell']}','{$md}','Parent')");
            if($res==0) echo'<script>alert("Check the Data Once again")</script>';
            else
            {
                $res2=mysqli_query($con,"insert into `parentprofile` values('{$_POST['instituteid']}','{$uid}','{$_POST['studentid']}','{$_POST['parentname']}','{$_POST['address']}','{$_POST['district']}','{$_POST['state']}','{$_POST['edutype']}')");

                if($res2==0){    mysql_query("DELETE FROM `mainlogin` WHERE `userid`='{$uid}'");    echo'<script>alert("Check the Data Once Again")</script>'; }
                else
                    echo'<script>alert("Congratulations. U have been registered Sucessfully. You can Login now.");     window.location.assign("login.php?parent=Log+In");</script>';
            }
        }
        else
            echo'<script>alert("Passwords Unmatched. Try Again")</script>';
        //else
        //            echo'<script>alert("Please Select the Branch.")</script>';

        mysqli_close($con);
    }
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

        <title>Parent Registration Page</title>

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
        <div class="container"  style="background-color: white;">
            <div class="row">
                <div class="col-lg-3"><img src="smslogo.png" alt="" width="100%" height="100%"></div>
            </div>
            <div class="row">
                <div class="col-lg-12"><h1 class="page-header">Parent Registration Form</h1></div>
            </div>
            <form method="POST" class="form" id="parentform">
                <div class="row container">
                    <div class="row">
                        <div class="col-lg-8 col-sm-8 col-xs-8">
                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2">Full Name: </span>
                                <input type="text" class="form-control" placeholder="Enter your Full Name" id="parentname" name="parentname" required="required" value="<?php  if(isset($_GET['parentname'])) echo htmlspecialchars($_GET['parentname']);?>">
                            </div>
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2">Cell: </span>
                                <input type="number" class="form-control" id="cell" name="cell"  required="required" value="<?php  if(isset($_GET['cell'])) echo htmlspecialchars($_GET['cell']);?>">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2">Email: </span>
                                <input type="text" class="form-control" id="email" name="email" required="required" value="<?php  if(isset($_GET['email'])) echo htmlspecialchars($_GET['email']);?>">
                            </div>
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-lg-4">
                            Select State:
                            <select class="form-control" name="state" id="state" onchange="godistrict()" required="required" value="<?php  if(isset($_GET['state'])) echo htmlspecialchars($_GET['state']);?>">
                                <option></option>
                                <option>Andhra Pradesh</option>
                                <option>Telangana</option>
                                <option>Orrisa</option>
                                <option>Bihar</option>
                                <option>Karnataka</option>
                                <option>Tamil Nadu</option>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            Select District:
                            <select class="form-control" name="district" id="district" disabled="disabled" required="required" value="<?php  if(isset($_GET['district'])) echo htmlspecialchars($_GET['district']);?>">
                            </select>
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-lg-6">

                            Tick Type of Education:<br />
                            <input type="radio" name="edutype" id="school" onclick="goyear()" value="school">
                            <label for="school">School&nbsp;&nbsp;</label>

                            <input type="radio" name="edutype" id="intermediate" value="intermediate" onclick="goyear()">
                            <label for="intermediate">Intermediate&nbsp;&nbsp;</label>

                            <input type="radio" name="edutype" id="diploma" value="diploma" onclick="goyear()">
                            <label for="Diploma">Diploma&nbsp;&nbsp;</label>

                            <input type="radio" name="edutype" id="degree" value="degree" onclick="goyear()">
                            <label for="degree">Degree&nbsp;&nbsp;</label>

                            <input type="radio" name="edutype" id="engineering" value="enigineering" onclick="goyear()">
                            <label for="engineering">Engineering&nbsp;&nbsp;</label>

                            <input type="radio" name="edutype" id="master" value="master" onclick="goyear()">
                            <label for="master">Master&nbsp;&nbsp;</label>

                        </div>
                        <div class="col-lg-2">
                            Select Year:
                            <select class="form-control" name="year" id="year" required="required" value="<?php  if(isset($_GET['year'])) echo htmlspecialchars($_GET['year']);?>">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            Select Branch:
                            <select class="form-control" name="branch" id="branch" disabled="disabled" value="<?php  if(isset($_GET['branch'])) echo htmlspecialchars($_GET['branch']);?>">
                            </select>
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-lg-8">
                            <div id="institutecontentload">

                            </div>
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-lg-3">
                            <div id="yearcontentload">

                            </div>
                        </div>
                        <div class="col-lg-5">
                             <div id="classcontentload">

                            </div>
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-lg-8">
                            <div id="studentcontentload">
                            </div>
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2">Password: </span>
                                <input type="password" class="form-control" name="password" id="password" required="required">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2">Confirm Password: </span>
                                <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" required="required">
                            </div>
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-lg-8">
                        Enter Your Address:
                            <textarea cols="10" rows="8" class="form-control" name="address" id="address" required="required"></textarea>
                        </div><br /><br />
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <input type="submit" class="btn btn-success" value="Register" name="submit" required="required">
                        </div><br />
                    </div>
                </div>
                <br />
            </form>
        </div>
        <!-- /#page-wrapper -->
</div>
        <!-- /#wrapper -->
        <script>
            function goyear(){
                $('#year').empty().append('<option selected="selected" value=""></option>');
                $('#branch').empty().append('<option selected="selected" value=""></option>');
                var year=document.getElementById("year");
                var branch=document.getElementById("branch");

                if (document.getElementById('school').checked) {
                    document.getElementById("branch").setAttribute("disabled","disabled");
                    var data=["Nursery","Lkg","Ukg","1st Standard","2nd Standard","3rd Standard","4th Standard","5th Standard","6th Standard","7th Standard","8th Standard","9th Standard","10th Standard"];
                    for(var i=0;i<data.length;i++){
                        var opt = document.createElement("option");
                        opt.innerHTML=data[i];
                        year.appendChild(opt);
                    }
                }
                else if(document.getElementById("diploma").checked){
                    document.getElementById("branch").removeAttribute("disabled");
                    var data=["Ist Year","IInd Year","IIIrd Year"];
                    for(var i=0;i<data.length;i++){
                        var opt = document.createElement("option");
                        opt.innerHTML=data[i];
                        year.appendChild(opt);
                    }
                    var data2=["Diploma In Computer Engineering","Diploma In Electronics and Communication Engineering","Diploma In Electronics and Electrical Engineering","Diploma In Mechnical Engineering"];
                    for(var i=0;i<data2.length;i++){
                        var opt = document.createElement("option");
                        opt.innerHTML=data2[i];
                        branch.appendChild(opt);
                    }

                }
                else if(document.getElementById("degree").checked){
                    document.getElementById("branch").removeAttribute("disabled");
                    var data=["Ist Year","IInd Year","IIIrd Year"];
                    for(var i=0;i<data.length;i++){
                        var opt = document.createElement("option");
                        opt.innerHTML=data[i];
                        year.appendChild(opt);
                    }
                    var data2=["B.Sc","B.Hons","B.B.M."];
                    for(var i=0;i<data2.length;i++){
                        var opt = document.createElement("option");
                        opt.innerHTML=data2[i];
                        branch.appendChild(opt);
                    }
                }
                else if(document.getElementById("engineering").checked){
                    document.getElementById("branch").removeAttribute("disabled");
                    var data=["Ist Year","IInd Year","IIIrd Year","IVth Year"];
                    for(var i=0;i<data.length;i++){
                        var opt = document.createElement("option");
                        opt.innerHTML=data[i];
                        year.appendChild(opt);
                    }
                    var data2=["B.E. B.Tech in Computer Science Engineering","B.E. B.Tech in Electronics and Electrical Engineering","B.E. B.Tech in Electronics and Communication Engineering"];
                    for(var i=0;i<data2.length;i++){
                        var opt = document.createElement("option");
                        opt.innerHTML=data2[i];
                        branch.appendChild(opt);
                    }
                }
                else if(document.getElementById("intermediate").checked){
                    document.getElementById("branch").removeAttribute("disabled");
                    var data=["Ist Year","IInd Year"];
                    for(var i=0;i<data.length;i++){
                        var opt = document.createElement("option");
                        opt.innerHTML=data[i];
                        year.appendChild(opt);
                    }
                    var data2=["M.P.C","Bi.P.C","C.E.C","H.E.C","M.E.C"];
                    for(var i=0;i<data2.length;i++){
                        var opt = document.createElement("option");
                        opt.innerHTML=data2[i];
                        branch.appendChild(opt);
                    }
                }
                else if(document.getElementById("master").checked){
                    document.getElementById("branch").removeAttribute("disabled");
                    var data=["Ist Year","IInd Year"];
                    for(var i=0;i<data.length;i++){
                        var opt = document.createElement("option");
                        opt.innerHTML=data[i];
                        year.appendChild(opt);
                    }
                    var data2=["CSE","CCP","etc"];
                    for(var i=0;i<data2.length;i++){
                        var opt = document.createElement("option");
                        opt.innerHTML=data2[i];
                        branch.appendChild(opt);
                    }
                }
            }
            function godistrict(){
                $('#district').empty().append('<option selected="selected" value=""></option>');
                document.getElementById("district").removeAttribute("disabled");
                var state=document.getElementById("state").value;
                var district=document.getElementById("district");


                if(state=="Andhra Pradesh"){
                    var dsts=["Anantapur", "Chittoor", "East Godavari", "Guntur", "Kadapa", "Krishna", "Kurnool", "Nellore", "Prakasam", "Srikakulam", "Visakhapatnam", "Vizianagaram", "West Godavari"];
                    for(var i=0;i<dsts.length;i++){
                        var opt = document.createElement("option");
                        opt.innerHTML=dsts[i];
                        district.appendChild(opt);
                    }
                }
                else if(state=="Telangana"){
                    var dsts=["Adilabad", "Hyderabad", "Karimnagar", "Khammam", "Mahbubnagar", "Medak", "Nalgonda", "Nizamabad", "Ranga Reddy", "Warangal"];
                    for(var i=0;i<dsts.length;i++){
                        var opt = document.createElement("option");
                        opt.innerHTML=dsts[i];
                        district.appendChild(opt);
                    }
                }
            }

            $(document).ready(function(){
                $(document).on('click','#parentname', function(){
                    var data=$('#parentform').serializeArray();
                    data[data.length]={name: 'instituteclick', value: true};
                    $("#institutecontentload").load("getparentregister.php",data);
                });

                $(document).on('change','#instituteid', function(){
                    var data=$('#parentform').serializeArray();
                    data[data.length]={name: 'yearclick', value: true};
                    $("#yearcontentload").load("getparentregister.php",data);
                });

                $(document).on('change','#cyear', function(){
                    var data=$('#parentform').serializeArray();
                    data[data.length]={name: 'classclick', value: true};
                    $("#classcontentload").load("getparentregister.php",data);
                });

                $(document).on('change','#classid', function(){
                    var data=$('#parentform').serializeArray();
                    data[data.length]={name: 'studentclick', value: true};
                    $("#studentcontentload").load("getparentregister.php",data);
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
