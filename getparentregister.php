<?php
    $con=mysqli_connect("localhost","smssystem","tiger","sms_testing_total");
    // Check connection
    if (mysqli_connect_errno())
        die("Failed to connect to MySQL: " . mysqli_connect_error());


    if(isset($_POST['instituteclick'])){
        $sql="select instituteid, institutename from institutedetails where instituteid IN (select distinct instituteid from academicdetails);";
        $res=mysqli_query($con,$sql);
        echo 'Select the Institute:<br />
        <select name="instituteid" id="instituteid" class="form-control"><option></option>';
            while($info=mysqli_fetch_array($res)){
                echo '<option value="'.$info['instituteid'].'">'.ucfirst($info['institutename']).'</option>';
            }
        echo'</select>';
    }
    
    if(isset($_POST['yearclick'])){
        $sql="select distinct academicyear from academicdetails where instituteid='{$_POST['instituteid']}';";
        $res=mysqli_query($con,$sql);
        echo 'Select the Current Year:<br />
        <select name="cyear" id="cyear" class="form-control"><option></option>';
            while($info=mysqli_fetch_array($res)){
                echo '<option>'.$info['academicyear'].'</option>';
            }
        echo'</select>';
    }
    
    if(isset($_POST['classclick'])){
        $sql="select classname,classid from class where classid IN ( select distinct classid from academicdetails where instituteid='{$_POST['instituteid']}' and academicyear='{$_POST['cyear']}');";
        $res=mysqli_query($con,$sql);
        echo 'Select the Class:<br />
        <select name="classid" id="classid" class="form-control"><option></option>';
            while($info=mysqli_fetch_array($res)){
                echo '<option value="'.$info['classid'].'">'.$info['classname'].'</option>';
            }
        echo'</select>';
    }
    
    if(isset($_POST['studentclick'])){
        $sql="select studentname,studentrollnum,studentid from studentprofile where studentid IN ( select distinct studentid from academicdetails where instituteid='{$_POST['instituteid']}' and academicyear='{$_POST['cyear']}' and classid='{$_POST['classid']}');";
        $res=mysqli_query($con,$sql);
        echo 'Select the Student:<br />
        <select name="studentid" id="studentid" class="form-control"><option></option>';
            while($info=mysqli_fetch_array($res)){
                echo '<option value="'.$info['studentid'].'"><strong>'.$info['studentrollnum'].'</strong> - '.ucfirst($info['studentname']).'</option>';
            }
        echo'</select>';
    }
?>