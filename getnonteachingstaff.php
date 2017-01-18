<?php
    require("head.inc");
    /*----------------------------------------------- TO SHOW CLASS LIST FOr TIME TABLE ------------------------------------------------------------*/
    if(isset($_POST['createtablebtn'])){
        $sql = "SELECT classid,classname FROM `class` where `InstituteId`='{$userid}'";
        $result=mysqli_query($con,$sql);
        echo '<div class="col-lg-4">Select the Class: <br /><select id="classid" name="classid" class="form-control"><option></option>';
        while($info=mysqli_fetch_array($result)){
            echo '<option value="'.$info["classid"].'">'.$info["classname"].'</option>';
        }
        echo '</select></div>';

    }

    /*----------------------------------------------- TO SHOW SECTION LIST FOr TIME TABLE ------------------------------------------------------------*/
    if(isset($_POST['createsectionbtn'])){
        $sql = "SELECT sectionid,sectionname FROM `section` where `ClassId`='{$_POST['classid']}'";
        $result=mysqli_query($con,$sql);
        echo '<div class="col-lg-4">Select the Section: <br /><select id="sectionid" name="sectionid" class="form-control"><option></option>';
        while($info=mysqli_fetch_array($result)){
            echo '<option value="'.$info["sectionid"].'">'.$info["sectionname"].'</option>';
        }
        echo '</select></div><div class="row"><div class="col-lg-2"><br /><input type="button" id="checkclasssection" class="btn btn-success" value="Check"></div></div>';
    }

    /*----------------------------------------------- TO DISPLAY VIEW TO CrEATE TIME TABLE ------------------------------------------------------------*/
    if(isset($_POST['createtimetablebtn'])){
        $sql = "SELECT count(timetableid) FROM `maintimetable` where `ClassId`='{$_POST['classid']}' and `SectionId`='{$_POST['sectionid']}' and `InstituteId`='{$userid}'";
        $result=mysqli_query($con,$sql);
        if ($info=mysqli_fetch_row($result)){                                  
            if($info[0]!=0){
                echo '<p class="well">Already a Table Exists for the Selected Class and the Section. Check it Once Again</p>';
            }
            else{
                echo '<p>Now You Can Create Time Table.<br /></p>';
                $sql = "SELECT `StaffId`,`StaffName` FROM `staffprofile` WHERE `StaffType`='teaching' and `InstituteId`='{$userid}'";
                $res=mysqli_query($con,$sql);
                $opt='<option></option>';
                while($info=mysqli_fetch_array($res)){
                    $opt.='<option value="'.$info["StaffId"].'">'.$info["StaffName"].'</option>';
                }
                $opt.='<option value="Break">Break</option>';
                $sql = "SELECT `SubjectId`,`SubjectName` FROM `subject` WHERE `InstituteId`='{$userid}'";
                $res=mysqli_query($con,$sql);
                $subjectopt='<option></option>';
                while($info2=mysqli_fetch_array($res)){
                    $subjectopt.='<option value="'.$info2["SubjectId"].'">'.$info2["SubjectName"].'</option>';
                }
                $subjectopt.='<option value="Break">Break</option>';                
                echo '<table id="maintimetable" class="table table-striped">
                <thead>
                <tr>
                <th></th>
                <th><input type="button" class="btn btn-primary" value="Period"></th>
                <th><input type="text" disabled="disabled" class="form-control" value="Monday"></th>
                <th><input type="text" disabled="disabled" class="form-control" value="Tuesday"></th>
                <th><input type="text" disabled="disabled" class="form-control" value="Wednesday"></th>
                <th><input type="text" disabled="disabled" class="form-control" value="Thursday"></th>
                <th><input type="text" disabled="disabled" class="form-control" value="Friday"></th>
                <th><input type="text" disabled="disabled" class="form-control" value="Saturday"></th>
                <th><input type="text" disabled="disabled" class="form-control" value="Sunday"></th>
                </tr>
                </thead>
                <tbody id="maintimetable_tbody">
                <tr>
                <td><button type="button" class="removebutton" title="Remove this row">X</button></td>
                <td><input type="text" placeholder="Time" required="required" class="form-control" name="time[]"></td>
                <td><select class="form-control" name="day[]">'.$subjectopt.'</select><select class="form-control" name="teacher[]">'.$opt.'</select></td>
                <td><select class="form-control" name="day[]">'.$subjectopt.'</select><select class="form-control" name="teacher[]">'.$opt.'</select></td>
                <td><select class="form-control" name="day[]">'.$subjectopt.'</select><select class="form-control" name="teacher[]">'.$opt.'</select></td>
                <td><select class="form-control" name="day[]">'.$subjectopt.'</select><select class="form-control" name="teacher[]">'.$opt.'</select></td>
                <td><select class="form-control" name="day[]">'.$subjectopt.'</select><select class="form-control" name="teacher[]">'.$opt.'</select></td>
                <td><select class="form-control" name="day[]">'.$subjectopt.'</select><select class="form-control" name="teacher[]">'.$opt.'</select></td>
                <td><select class="form-control" name="day[]">'.$subjectopt.'</select><select class="form-control" name="teacher[]">'.$opt.'</select></td>
                </tr>
                </tbody></table>                                          
                <div class="col-lg-1"><input type="button" value="Add Row" id="addrow" class="btn btn-primary"></div>
                <div class="row"><div class="col-lg-2"><input type="button" value="Save" id="savetimetable" class="btn btn-success"></div></div>';
            }
        }
    }

    /*----------------------------------------------- TO ADD SUBJECTS BUTTON ------------------------------------------------------------*/
    if(isset($_POST['addsubjectsbtn'])){
        echo '<div class="col-lg-4">Enter Subject Name: <br /><input type="text" name="subjectname" placeholder="Enter Subject Name" id="subjectname" class="form-control"></div><div class="col-lg-4">Select the Staff: <br /><select id="staffid" name="staffid" class="form-control"><option></option>';
        $sql = "SELECT staffid,staffname FROM staffprofile WHERE StaffType='teaching' and `InstituteId`='{$userid}'";
        $result=mysqli_query($con,$sql);
        while($info=mysqli_fetch_array($result)){
            echo '<option value="'.$info["staffid"].'">'.$info["staffname"].'</option>';
        }
        echo '</select></div></div><div class="row"><div class="col-lg-2"><br /><input type="button" value="Add" class="btn btn-success" id="addsubject"></div></div>';
    }

    /*----------------------------------------------- TO SAVE SUBJECTS BUTTON ------------------------------------------------------------*/
    if(isset($_POST['savesubjectsbtn'])){
        $uid=uniqid();
        $result=mysqli_query($con,"insert into subject values('{$uid}','{$userid}','{$_POST['staffid']}','{$_POST['subjectname']}')");
        if($result)
            echo '<div class="row"><div class="col-lg-2"><br /><input type="button" id="subaddsubjects" value="Subject Added Successfully" class="btn btn-success"></div></div>';
    }

    /*----------------------------------------------- TO SAVE TIME TABLE BUTTON ------------------------------------------------------------*/
    if(isset($_POST['savetimetablebtn'])){

        $uid=uniqid();
        $week=array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
        $sql="SELECT `TimeTableId` FROM `maintimetable` where `ClassId`='{$_POST['classid']}' and `SectionId`='{$_POST['sectionid']}';";
        $resset=mysqli_query($con,$sql);
        $res=mysqli_fetch_row($resset);
        if($res==null)
        {
            $result1=mysqli_query($con,"INSERT INTO `maintimetable` VALUES ('{$uid}','{$userid}','{$_POST['classid']}','{$_POST['sectionid']}')");
            if($result1){
                $z=0;$y=0;$t=-1;
                $totsize=sizeof($_POST['time']);
                while($z<$totsize*7)            // day loop loop 3nd loop
                {   
                    if($y==0)   $t++;            
                    if(($_POST['day'][$z]==null)||($_POST['teacher'][$z]==null))
                    {
                    }
                    else
                    {                                                                                                                   // subject id          teache id
                        //   echo 'Time['.$t.']= '.$_POST['time'][$t].' & Week ['.$y.']= '.$week[$y].' & Subject['.$z.']= '.$_POST['day'][$z].' & Teache['.$z.']= '.$_POST['teacher'][$z].'<br />';
                        $subresult=mysqli_query($con,"INSERT INTO `timetable` VALUES ('{$uid}','{$_POST['time'][$t]}','{$week[$y]}','{$_POST['day'][$z]}','{$_POST['teacher'][$z]}')");
                    }
                    if($y==6){ $y=0; }else   $y++;
                    $z++;
                }
            }
            else{
                echo '<p class="well">Already a Table Exists for the Selected Class and the Section. Check it Once Again</p>';
            }
            echo '<p class="well">Thanks for Entering the Time Table. Good Job</p>';

            /*
            $classid=$_POST['classid'][$id-1];
            Array ( [classid] => 572abc101 [sectionid] => 527abc501 
            [time] => Array ( [0] => 1:00 [1] => 2:00 ) 
            [monday] => Array ( [0] => 573c9a8f230bf [1] => 573c9a8f230bf ) 
            [mondayteacher] => Array ( [0] => 11 [1] => 11 ) 
            [tuesday] => Array ( [0] => 573c9ae43cce1 [1] => 573c9ae43cce1 ) 
            [tuesdayteacher] => Array ( [0] => 12 [1] => 12 ) 
            [wednesday] => Array ( [0] => 573c9b22677bc [1] => 573c9b22677bc ) 
            [wednesdayteacher] => Array ( [0] => 11 [1] => 11 ) 
            [thursday] => Array ( [0] => 573c9b307ee65 [1] => 573c9b307ee65 ) 
            [thursdayteacher] => Array ( [0] => 14 [1] => 14 ) 
            [friday] => Array ( [0] => 573c9a8f230bf [1] => 573c9a8f230bf ) 
            [fridayteacher] => Array ( [0] => 12 [1] => 12 ) 
            [saturday] => Array ( [0] => 573c9ae43cce1 [1] => 573c9ae43cce1 ) 
            [saturdayteacher] => Array ( [0] => 11 [1] => 11 ) 
            [sunday] => Array ( [0] => 573c9b22677bc [1] => 573c9b22677bc ) 
            [sundayteacher] => Array ( [0] => 15 [1] => 15 ) 
            [savetimetablebtn] => true )

            Array ( [classid] => 572abc101 [sectionid] => 527abc501 
            [time] => Array ( [0] => 1 [1] => 2 ) 
            [day] => Array ( [0] => 573c9a8f230bf [1] => 573c9ae43cce1 [2] => 573c9b22677bc [3] => 573c9b307ee65 [4] => 573c9a8f230bf [5] => 573c9ae43cce1 [6] => 573c9b22677bc 
            [7] => 573c9a8f230bf [8] => 573c9ae43cce1 [9] => 573c9b22677bc [10] => 573c9b307ee65 [11] => 573c9a8f230bf [12] => 573c9ae43cce1 [13] =>573c9b22677bc ) 

            [mondayteacher] => Array ( [0] => 11 [1] => 11 ) 
            [tuesdayteacher] => Array ( [0] => 12 [1] => 12 ) 
            [wednesdayteacher] => Array ( [0] => 14 [1] => 14 ) 
            [thursdayteacher] => Array ( [0] => 15 [1] => 15 ) 
            [fridayteacher] => Array ( [0] => 11 [1] => 11 ) 
            [saturdayteacher] => Array ( [0] => 12 [1] => 12 ) 
            [sundayteacher] => Array ( [0] => 14 [1] => 14 ) 
            [savetimetablebtn] => true ) 
            */
        }
    }

    /*----------------------------------------------- TO VIEW TIME TABLE CLASS BUTTON ------------------------------------------------------------*/
    if(isset($_POST['viewtimetableclassbtn'])){
        $sql = "SELECT classid,classname FROM `class` where `InstituteId`='{$userid}'";
        $result=mysqli_query($con,$sql);
        echo '<div class="col-lg-4">Select the Class: <br /><select id="viewclassid" name="viewclassid" class="form-control"><option></option>';
        while($info=mysqli_fetch_array($result)){
            echo '<option value="'.$info["classid"].'">'.$info["classname"].'</option>';
        }
        echo "</select></div>";
    }

    /*----------------------------------------------- TO VIEW TIME TABLE SECTION BUTTON ------------------------------------------------------------*/
    if(isset($_POST['viewtimetablesectionbtn'])){
        $sql = "SELECT sectionid,sectionname FROM `section` where `ClassId`='{$_POST['viewclassid']}'";
        $result=mysqli_query($con,$sql);
        echo '<div class="col-lg-4">Select the Section: <br /><select id="viewsectionid" name="viewsectionid" class="form-control"><option></option>';
        while($info=mysqli_fetch_array($result)){
            echo '<option value="'.$info["sectionid"].'">'.$info["sectionname"].'</option>';
        }
        echo '</select></div><div class="row"><div class="col-lg-2"><br /><input type="button" id="viewclasssection" class="btn btn-success" value="Check"></div></div>';
    }

    /*----------------------------------------------- TO VIEW TIME TABLE BUTTON ------------------------------------------------------------*/
    if(isset($_POST['viewtimetablebtn'])){
        $sql="SELECT `TimeTableId` FROM `maintimetable` where `ClassId`='{$_POST['viewclassid']}' and `SectionId`='{$_POST['viewsectionid']}' and `InstituteId`='{$userid}' ";
        $resset=mysqli_query($con,$sql);
        $res=mysqli_fetch_row($resset);

        if($res!=null){
            /*
            $sql="SELECT `Period`,`Day`,`SubjectId`,`StaffId` FROM `timetable` WHERE `TimeTableId`='{$res[0]}' order by Period ASC;";
            $res=mysqli_query($con,$sql);
            echo '<table class="table"><thead>
            <tr>
            <th><input type="button" class="btn btn-primary" value="Period"></th>
            <th><input type="text" disabled="disabled" class="form-control" value="Monday"></th>
            <th><input type="text" disabled="disabled" class="form-control" value="Tuesday"></th>
            <th><input type="text" disabled="disabled" class="form-control" value="Wednesday"></th>
            <th><input type="text" disabled="disabled" class="form-control" value="Thursday"></th>
            <th><input type="text" disabled="disabled" class="form-control" value="Friday"></th>
            <th><input type="text" disabled="disabled" class="form-control" value="Saturday"></th>
            <th><input type="text" disabled="disabled" class="form-control" value="Sunday"></th>
            </tr>
            </thead><tbody>';
            $week=array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
            $tablestring="";
            $pe=0;$d=0;
            $period=null;
            while($info=mysqli_fetch_row($res)){
            /*
            if($pe==0){
            $tablestring.='<tr><td><label class="form-control">'.$info['Period'].'</label></td>';
            }
            while(1)
            {
            if(strcasecmp($week[$d],$info['Day'])==0){
            $status=true;
            $subjectid=mysqli_query($con,"select SubjectName from subject where SubjectId='{$info['SubjectId']}'");
            $staffid=mysqli_query($con,"select StaffName from staffprofile where StaffId='{$info['StaffId']}'");
            $subject=mysqli_fetch_row($subjectid);
            $staff=mysqli_fetch_row($staffid);

            $tablestring.='<td><label class="form-control" title="'.$staff[0].'">'.$subject[0].'</label></td>';
            }
            else{
            $status=false;
            $d++;
            $pe++;
            $tablestring.='<td><label class="form-control" ></label></td>';
            }
            if($status==true)   break;
            }
            $pe++;
            if($pe==6)  $pe=0;

            if($d==6){
            $d=0;   
            $tablestring.="</tr>";
            }
            else    
            $d++;
            */               

            /*
            if(($period==null)||($period!=$info[0])){
            $period=$info[0];
            $tablestring.='<tr><td>'.$info[0].'</td>';
            }
            while(1){
            if(strcasecmp($week[$d],$info[1])==0){
            $status=true;
            $subjectid=mysqli_query($con,"select SubjectName from subject where SubjectId='{$info[2]}'");
            $staffid=mysqli_query($con,"select StaffName from staffprofile where StaffId='{$info[3]}'");
            $subject=mysqli_fetch_row($subjectid);
            $staff=mysqli_fetch_row($staffid);

            $tablestring.='<td><label class="form-control" title="'.$staff[0].'">'.$subject[0].'</label></td>';
            }
            else{          
            $tablestring.='<td><label class="form-control" ></label></td>';
            $status=false;
            }
            $d++;
            if($d==7){
            $tablestring.="</tr>";
            $d=0;
            }
            if($status)
            break;
            }

            */

            /*
            Array ( [0] => 11:00 [1] =>0 Monday [2] => 573c9a8f230bf [3] => 11 ) 
            Array ( [0] => 11:00 [1] =>1 Tuesday [2] => 573c9a8f230bf [3] => 11 ) 
            Array ( [0] => 11:00 [1] =>2 Wednesday [2] => 573c9a8f230bf [3] => 11 ) 
            Array ( [0] => 11:00 [1] =>4 Friday [2] => 573c9a8f230bf [3] => 12 ) 
            Array ( [0] => 11:00 [1] =>5 Saturday [2] => 573c9a8f230bf [3] => 11 ) 
            6 Sunday
            Array ( [0] => 12:00 [1] => Monday [2] => 573c9a8f230bf [3] => 11 ) 
            Array ( [0] => 12:00 [1] => Tuesday [2] => 573c9a8f230bf [3] => 11 )                                             

            }
            echo $tablestring.'</tbody></table>';*/
            /*        
            Array ( [0] => 90:00 [Period] => 90:00 [1] => Monday [Day] => Monday [2] => 573c9a8f230bf [SubjectId] => 573c9a8f230bf [3] => 11 [StaffId] => 11 ) 
            Array ( [0] => 90:00 [Period] => 90:00 [1] => Tuesday [Day] => Tuesday [2] => 573c9ae43cce1 [SubjectId] => 573c9ae43cce1 [3] => 12 [StaffId] => 12 ) 
            Array ( [0] => 90:00 [Period] => 90:00 [1] => Wednesday [Day] => Wednesday [2] => 573c9a8f230bf [SubjectId] => 573c9a8f230bf [3] => 11 [StaffId] => 11 ) 
            Array ( [0] => 90:00 [Period] => 90:00 [1] => Thursday [Day] => Thursday [2] => 573c9a8f230bf [SubjectId] => 573c9a8f230bf [3] => 12 [StaffId] => 12 ) 
            Array ( [0] => 90:00 [Period] => 90:00 [1] => Friday [Day] => Friday [2] => 573c9a8f230bf [SubjectId] => 573c9a8f230bf [3] => 12 [StaffId] => 12 ) 
            Array ( [0] => 90:00 [Period] => 90:00 [1] => Saturday [Day] => Saturday [2] => 573c9a8f230bf [SubjectId] => 573c9a8f230bf [3] => 11 [StaffId] => 11 ) 
            Array ( [0] => 91:00 [Period] => 91:00 [1] => Monday [Day] => Monday [2] => 573c9a8f230bf [SubjectId] => 573c9a8f230bf [3] => 12 [StaffId] => 12 ) 
            Array ( [0] => 91:00 [Period] => 91:00 [1] => Tuesday [Day] => Tuesday [2] => 573c9a8f230bf [SubjectId] => 573c9a8f230bf [3] => 11 [StaffId] => 11 ) 
            Array ( [0] => 91:00 [Period] => 91:00 [1] => Wednesday [Day] => Wednesday [2] => 573c9a8f230bf [SubjectId] => 573c9a8f230bf [3] => 11 [StaffId] => 11 ) 
            Array ( [0] => 91:00 [Period] => 91:00 [1] => Thursday [Day] => Thursday [2] => 573c9a8f230bf [SubjectId] => 573c9a8f230bf [3] => 11 [StaffId] => 11 ) 
            Array ( [0] => 91:00 [Period] => 91:00 [1] => Friday [Day] => Friday [2] => 573c9a8f230bf [SubjectId] => 573c9a8f230bf [3] => 11 [StaffId] => 11 ) Array ( [0] => 91:00 [Period] => 91:00 [1] => Saturday [Day] => Saturday [2] => 573c9a8f230bf [SubjectId] => 573c9a8f230bf [3] => 11 [StaffId] => 11 )
            */ 
            $sql="Select distinct Period from TimeTable where TimeTableId='{$res[0]}'";
            $subresset=mysqli_query($con,$sql);
            echo '<table class="table"><thead>
            <tr>
            <th><input type="button" class="btn btn-primary" value="Period"></th>
            <th><input type="text" disabled="disabled" class="form-control" value="Monday"></th>
            <th><input type="text" disabled="disabled" class="form-control" value="Tuesday"></th>
            <th><input type="text" disabled="disabled" class="form-control" value="Wednesday"></th>
            <th><input type="text" disabled="disabled" class="form-control" value="Thursday"></th>
            <th><input type="text" disabled="disabled" class="form-control" value="Friday"></th>
            <th><input type="text" disabled="disabled" class="form-control" value="Saturday"></th>
            <th><input type="text" disabled="disabled" class="form-control" value="Sunday"></th>
            </tr>
            </thead><tbody>';
            while($subres=mysqli_fetch_row($subresset))
            {
                if($subres==null){
                    echo '<p class="Well">There is no table. Plesae Create One.</p>';
                    break;
                }else{
                    echo "<tr><td>{$subres[0]}</td>";
                    $sql="Select Day,SubjectId,StaffId from timetable where Period='{$subres[0]}'";
                    $subsubresset=mysqli_query($con,$sql);
                    $week=array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
                    $newweek=array(false,false,false,false,false,false,false);
                    $staffiddata=array();
                    $subjectiddata=array();
                    while($info=mysqli_fetch_array($subsubresset)){
                        for($i=0;$i<7;$i++){
                            if(strcasecmp($week[$i],$info['Day'])==0){
                                $newweek[$i]=true;
                                $staffiddata[$i]=$info['StaffId'];
                                $subjectiddata[$i]=$info['SubjectId'];
                            }
                        }
                    }
                    for($i=0;$i<7;$i++){
                        if($newweek[$i]){
                            $subjectid=mysqli_query($con,"select SubjectName from subject where SubjectId='{$subjectiddata[$i]}'");
                            $staffid=mysqli_query($con,"select StaffName from staffprofile where StaffId='{$staffiddata[$i]}'");
                            $subject=mysqli_fetch_row($subjectid);
                            $staff=mysqli_fetch_row($staffid);

                            echo '<td><label class="form-control" title="'.$staff[0].'">'.$subject[0].'</label></td>';
                        }
                        else
                            echo '<td><label class="form-control"></label></td>';
                    }
                    echo "</tr>";
                }
            }
            echo "</tbody></table>";
        }
    }

    /*----------------------------------------------- TO LOAD CLASS DETAILS OF BILL ------------------------------------------------------------*/
    if(isset($_POST['paybillyearbtn'])){
        echo 'Select Year:<select class="form-control" id="billyearid" name="yearid"><option></option>';
        $sql="SELECT distinct `AcademicYear` FROM `academicdetails` WHERE `InstituteId`='{$userid}'";
        $res=mysqli_query($con,$sql);
        while($info=mysqli_fetch_array($res)){
            echo '<option>'.$info['AcademicYear'].'</option>';
        }        
        echo '</select><br />';
    }
    if(isset($_POST['paybillclassbtn'])){
        echo 'Select Class:<select class="form-control" id="billclassid" name="classid"><option></option>';
        $sql="select classid,classname from class where instituteid='{$userid}'";
        $res=mysqli_query($con,$sql);
        while($info=mysqli_fetch_array($res)){
            echo '<option value='.$info['classid'].'>'.$info['classname'].'</option>';
        }        
        echo '</select><br />';
    }
    if(isset($_POST['paybillsectionbtn'])){
        echo 'Select Section:<select class="form-control" id="billsectionid" name="sectionid"><option></option>';
        $sql="select sectionid,sectionname from section where classid='{$_POST['classid']}'";
        $res=mysqli_query($con,$sql);
        while($info=mysqli_fetch_array($res)){
            echo '<option value='.$info['sectionid'].'>'.$info['sectionname'].'</option>';
        }        
        echo '</select><br />';
    }
    if(isset($_POST['paybillstudentbtn'])){
        echo 'Select Student Name:<select class="form-control" id="billstudentid" name="studentid"><option></option>';
        $sql="SELECT `StudentId`,`StudentName`,`StudentRollNum` from studentprofile where `StudentId` IN (select studentid from academicdetails where instituteid='{$userid}' and classid='{$_POST['classid']}' and sectionid='{$_POST['sectionid']}' and AcademicYear='{$_POST['yearid']}')";
        $res=mysqli_query($con,$sql);
        while($info=mysqli_fetch_array($res)){
            echo '<option value='.$info['StudentId'].'>'.ucfirst($info['StudentName']).' <span class="htno">'.$info['StudentRollNum'].'</span></option>';
        }        
        echo '</select><br />';
    }
    if(isset($_POST['paybillsubmitbtn'])){
        /*
        Array ( 
        [billtype] => Hostel Bill 
        [yearid] => 2016 
        [classid] => 572abc101 
        [sectionid] => 527abc501 
        [studentid] => Stu101 
        [payableamount] => 9 
        [originalamount] => 15 
        [paybillsubmitbtn] => true )
        */
        $uid=uniqid();
        $today=date("Y-m-d");
        $sql="INSERT INTO `billings` VALUES ('{$uid}', '{$userid}', '{$_POST['studentid']}', '{$today}', '{$_POST['payableamount']}', '{$_POST['originalamount']}', '{$_POST['billtype']}');";
        $res=mysqli_query($con,$sql);
        if($res){
            echo '<p class="well">Well Done. The Bill Entered</p>';
        }
        else{
            echo '<p class="well">Something Went Wrong. Please Try Again</p>';
        }
    }
    if(isset($_POST['viewbillsubmitbtn'])){
        $sql="SELECT `BillId`,`BillType`,`AmountPaid`,`OriginalAmount`,`OriginalAmount`-`AmountPaid` as 'DueAmount',`Date`,`StudentId` from billings";
        $res=mysqli_query($con,$sql);
        $sno=1;
        echo '<table id="viewtable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead class="thead-inverse">
        <tr>
        <th>S. No</th>
        <th>Date</th>
        <th>Student Roll</th>
        <th>Student Name</th>
        <th>Bill Type</th>
        <th>Paid Amount</th>
        <th>Original Amount</th>
        <th>Due Amount</th>
        </tr>
        </thead>
        <tfoot class="thead-default">
        <tr>
        <th>S. No</th>
        <th>Date</th>
        <th>Student Roll</th>
        <th>Student Name</th>
        <th>Bill Type</th>
        <th>Paid Amount</th>
        <th>Original Amount</th>
        <th>Due Amount</th>
        </tr>
        </tfoot>
        <tbody>';
        while($info=mysqli_fetch_array($res)){
            $sql="SELECT `StudentName`,`StudentRollNum` from studentprofile where `StudentId`='{$info['StudentId']}'";
            $subres=mysqli_query($con,$sql);
            $subresopt=mysqli_fetch_row($subres);

            echo '<tr>
            <th scope="row">'.$sno.'</td>
            <td>'.$info['Date'].'</td>
            <td>'.$subresopt[1].'</td>
            <td>'.ucfirst($subresopt[0]).'</td>
            <td>'.$info['BillType'].'</td>
            <td>'.$info['AmountPaid'].'</td>
            <td>'.$info['OriginalAmount'].'</td>
            <td>'.$info['DueAmount'].'</td>
            </tr>';
            $sno++;
        }
        echo "</tbody></table>";
    }

    /*------------------------------------------------- TO CrEATE NOTICE BUTTON-----------------------------------------------------------------*/

    /*------------------------------------------------- TO VIEW NOTICE BUTTON-----------------------------------------------------------------*/
    if(isset($_POST['viewnoticebutton'])){
        $sql="SELECT `CircularId`,`Text`,`Date`,`CircularFilePath`,`Priority`,`StaffId` FROM `circular`;";
        $mainres=mysqli_query($con,$sql);
        $sno=1;
        echo '
        <div class="col-lg-8">
        <div class="panel panel-default">
        <div class="panel-heading">All The Notices & Cirulars</div>
        <div class="panel-body">
        <p>The Entire List of all Circulars up to Now</p>
        </div>
        <div class="table-responsive">
        <table id="viewtable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead class="thead-inverse">
        <tr>
        <th>S. No</th>
        <th>Date</th>
        <th>Circular Text</th>
        <th>Priority</th>
        <th>From</th>
        <th>Designation</th>
        <th>Viewers</th>
        <th>Download</th>
        </tr>
        </thead>
        <tfoot class="thead-default">
        <tr>
        <th>S. No</th>
        <th>Date</th>
        <th>Circular Text</th>
        <th>Priority</th>
        <th>From</th>
        <th>Designation</th>
        <th>Viewers</th>
        <th>Download</th>
        </tr>
        </tfoot>
        <tbody>';
        while($info=mysqli_fetch_array($mainres)){
            $sql="SELECT `StaffName`,`Designation` FROM `staffprofile` WHERE `StaffId`='{$info['StaffId']}'";
            $subres=mysqli_query($con,$sql);
            $subresopt=mysqli_fetch_row($subres);
            echo '<tr>
            <th scope="row">'.$sno.'</td>
            <td>'.$info['Date'].'</td>
            <td>'.$info['Text'].'</td>
            <td>'.$info['Priority'].'</td>
            <td>'.ucfirst($subresopt[0]).'</td>
            <td>'.ucfirst($subresopt[1]).'</td>';
            echo '<td><ul class="list-group">';
            $sql="select staffname,stafftype from staffprofile where instituteid='{$userid}' and staffid in (select userid from circularsenderlist where circularid='{$info['CircularId']}')";
            $res=mysqli_query($con,$sql);
            if($res!=false){
                while($subinfo=mysqli_fetch_array($res)){
                    echo '<li class="list-group-item" title="'.$subinfo['stafftype'].'">'.$subinfo['staffname'].'</li>';
                }
            }
            $sql="select classname,classid from class where instituteid='{$userid}' and classid in (select userid from circularsenderlist where circularid='{$info['CircularId']}')";
            $res=mysqli_query($con,$sql);
            if($res!=false){
                while($subinfo=mysqli_fetch_array($res)){
                    echo '<li class="list-group-item" title="Class">'.$subinfo['classname'].'</li>';
                    $sql="select sectionname from section where classid='{$subinfo['classid']}' and sectionid in (select userid from circularsenderlist where circularid='{$info['CircularId']}')";
                    $secres=mysqli_query($con,$sql);
                    if($secres!=false){
                        while($secinfo=mysqli_fetch_array($secres)){
                            echo '<li class="list-group-item" title="Section">&nbsp;&nbsp;&nbsp;'.$secinfo['sectionname'].'</li>';
                        }
                    }
                }

            }
            echo "</ul></td>";
            echo '<td><a href="'.$info['CircularFilePath'].'" target="_blank">Download</a></td>
            </tr>';
            $sno++;
        }
        echo "</tbody></table></div></div></div>";
    }

    if(isset($_POST['checksubjectbutton'])){
        echo "<br />";
        $string="<option></option>";
        $sql="select subjectid,subjectname from subject where instituteid='{$userid}'";
        $res=mysqli_query($con,$sql);
        while($info=mysqli_fetch_array($res)){
            $string.='<option value='.$info['subjectid'].'>'.$info['subjectname'].'</option>';            
        }
        for($i=0;$i<$_POST['subjectslist'];$i++){
            echo '<div class="row"><div class="col-lg-3">Subject Name<select name="subjects[]" class="form-control">'.$string.'<select></div>';
            echo '<div class="col-lg-2">Total Marks<input type="number" name="subtotmarks[]" class="form-control"></div>';
            echo '<div class="col-lg-1">Pass Marks<input type="number" name="subpassmarks[]" class="form-control"></div></div>';
        }
        echo '<div class="col-lg-2"><input type="button" class="btn btn-success" name="createexamsubmit"  id="createexamsubmit" value="Create Exam"></div>';
    }
                                                                   
    if(isset($_POST['createexamsubmit'])){
        /*
        Array ( [examname] => ghfgg [totalmarks] => 556 [subjectslist] => 4 [subjects] => Array ( [0] => 573c9ae43cce1 [1] => 573c9a8f230bf [2] => 573c9a8f230bf [3] => 573c9b22677bc ) [subtotmarks] => Array ( [0] => 55 [1] => 55 [2] => 55 [3] => 55 ) [subpassmarks] => Array ( [0] => 5 [1] => 5 [2] => 5 [3] => 5 ) [createexamsubmit] => true )
        */
        $uid=uniqid();
        $sql="INSERT into examdetails values('{$uid}','{$_POST['examname']}','{$userid}','{$_POST['totalmarks']}','0')";
        $res=mysqli_query($con,$sql);
        if($res!=FALSE){
            for($i=0;$i<$_POST['subjectslist'];$i++){
                $sql="INSERT into examsubject values('{$uid}','{$userid}','{$_POST['subjects'][$i]}','{$_POST['subtotmarks'][$i]}','{$_POST['subpassmarks'][$i]}')";
                $res=mysqli_query($con,$sql);
                if($res==FALSE) echo "Once Again Try Again";
            }    
        }
        echo '<p class="well">Exam Created Successfully</p>';
    }
    if(isset($_POST['viewexambtn'])){
        $sql="select ExamId,ExamName,TotalMarks,Result from examdetails where instituteid='{$userid}'";
        $res=mysqli_query($con,$sql);
        echo '<table class="table table-striped table-bordered table-hover">
        <caption>Exams List</caption>
        <thead><tr>
        <th>Sno</th>
        <th>Exam Id</th>
        <th>Exam Name</th>
        <th>Subjects List</th>
        <th>Total Marks</th>
        <th>Result Status</th>
        </tr></thead><tbody>
        ';
        $sno=1;
        while($info=mysqli_fetch_array($res)){
            $sql="select SubjectId,TotalMarks,PassMarks from examsubject where examid='{$info['ExamId']}' and instituteid='{$userid}'";
            $subres=mysqli_query($con,$sql);
            $subs=1;
            echo '<tr><td>'.$sno.'</td><td>'.$info['ExamId'].'</td><td>'.$info['ExamName'].'</td>
            <td>
            <table class="table">
            <thead>
            <tr>
            <th>S.No</th>
            <th>Subject Name</th>
            <th>Total Marks</th>
            <th>Pass Marks</th>
            </tr>
            </thead><tbody>';
            while($subinfo=mysqli_fetch_array($subres)){
                $sql="select subjectname from subject where subjectid='{$subinfo['SubjectId']}'";
                $subsubres=mysqli_query($con,$sql);
                $row=mysqli_fetch_array($subsubres);
                echo '<tr><td>'.$subs.'</td><td>'.$row[0].'</td><td>'.$subinfo['TotalMarks'].'</td><td>'.$subinfo['PassMarks'].'</td></tr>';
                $subs++;
            }
            echo'</tbody></table>
            </td><td>'.$info['TotalMarks'].'</td>';
            if($info['Result']=='0')    echo "<td>Not Yet Displayed</td></tr>";
            else    echo "<td>Results are Live</td></tr>";
            $sno++;
        }
        echo '</tbody></table>';
    }

    if(isset($_POST['viewstaffbtn'])){
        echo '<table class="table">
        <thead>
        <tr>
        <th>Sno</th>
        <th>Desgination</th>
        <th>Teacher Name</th>
        <th>Qualification</th>
        <th>Gender</th>
        <th>Cell</th>
        <th>Mail Id</th>
        <th>Staff Exp</th>
        <th>Date of Joining</th>
        <th>Date of Birth</th>
        <th>Other Details</th>
        <th>Staff Photo</th>
        <th>Curriculum Vitae</th>
        </tr>
        </thead>
        <tbody>';
        
        $sql="SELECT `StaffName`, `Designation`, `Qualification`, `StaffPhotoPath`, `CurriculumVitaePath`, `Gender`, `PhoneNum`, `MailId`, `StaffExperience`, `Dob`, `Doj`,`OtherDetails` FROM `staffprofile` WHERE instituteid='{$userid}'";
        $res=mysqli_query($con,$sql);
        $sno=1;
        while($info=mysqli_fetch_array($res)){
            if($info['Gender']=='0')   $gender='Female';   else    $gender='Male';
            echo '<tr><td>'.$sno.'</td><td>'.$info['Designation'].'</td><td>'.$info['StaffName'].'</td><td>'.$info['Qualification'].'</td><td>'.$gender.'</td><td>'.$info['PhoneNum'].'</td><td>'.$info['MailId'].'</td><td>'.$info['StaffExperience'].'</td><td>'.$info['Doj'].'</td><td>'.$info['Dob'].'</td><td>'.$info['OtherDetails'].'</td><td><a href="'.$info['StaffPhotoPath'].'" target="_blank">Download</a></td><td><a href="'.$info['CurriculumVitaePath'].'" target="_blank">Download</a></td></tr>';
            $sno++;
        }
        
        echo '
        </tbody>
        </table>';
    }
    if(isset($_POST['seecreatenoticebefore'])){

        /*
        echo '
        <div class="row">
        <div class="col-lg-5">
        Priority Level
        <select name="priority" class="form-control">
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

        <div class="form-group">
        <div class="col-sm-10">
        To Whom:<br />
        <select id="example-post" name="multiselect[]" multiple="multiple" required>
        <optgroup label="Opt1">
        <option value="1">Option 1</option>
        <option value="2">Option 2</option>
        </optgroup>
        <option value="3">Option 3</option>
        <option value="4">Option 4</option>
        <option value="5">Option 5</option>
        <option value="6">Option 6</option>
        </select>
        </div>
        </div>

        </div>           
        </div>           
        <div class="row">
        <div class="col-lg-2">
        <input type="submit" class="btn btn-success" value="Done" id="createnoticesubmitbtn1" name="createnoticesubmitbtn1">
        </div>
        </div>';

        echo '
        <div class="example">
        <form class="form-horizontal">
        <div class="form-group">
        <label class="col-sm-2 control-label">Multiselect</label>
        <div class="col-sm-10">
        <select id="example-post" name="multiselect[]" multiple="multiple" required>
        <option value="1">Option 1</option>
        <option value="2">Option 2</option>
        <option value="3">Option 3</option>
        <option value="4">Option 4</option>
        <option value="5">Option 5</option>
        <option value="6">Option 6</option>
        </select>
        </div>
        </div>
        </form>
        </div>
        ';
        */

        /*
        echo'
        <ul id="tree">
        <li>
        <label>
        <input type="checkbox" name="dataset[]"/>
        Level 1 - 2</label>
        <ul>
        <li>
        <label>
        <input type="checkbox"  name="dataset[]"/>
        Level 2 - 1</label>
        <ul>
        <li>
        <label>
        <input type="checkbox"  name="dataset[]"/>
        Level 3 - 1</label>
        </li>
        <li>
        <label>
        <input type="checkbox"  name="dataset[]"/>
        Level 3 - 2</label>
        <ul>
        <li>
        <label>
        <input type="checkbox"  name="dataset[]"/>
        Level 4 - 1</label>
        </li>
        </ul>
        </li>
        </ul>
        </li>
        </ul>
        <li>
        <label>
        <input type="checkbox"  name="dataset[]"/>
        Level 1 - 3</label>
        </li>
        </li>
        </ul>
        ';
        */

        /*
        <ul class="list-group">
        <li class="list-group-item">First item</li>
        <ul>
        <li class="list-group-item">First item1</li>
        <li class="list-group-item">First item2</li>
        </ul>
        <li class="list-group-item">Second item</li>
        <li class="list-group-item">Third item</li>
        </ul>

        */
        $i=1;
        $data='<div class="checkbox checkbox-info checkbox-circle"><ul class="list-group">';
        $data.='<li class="list-group-item"><input id="check'.$i.'" type="checkbox" class="styled" level="child" name="teaching"><label for="check'.$i.'">Teaching Staff</label></li>';      $i++;
        $data.='<li class="list-group-item"><input id="check'.$i.'" type="checkbox" class="styled" level="child" name="nonteaching"><label for="check'.$i.'">Non Teaching Staff</label></li>';    $i++;  
        $sql="select classid,classname from class where instituteid='{$userid}'";
        $res=mysqli_query($con,$sql);
        if($res!=false){
            while($info=mysqli_fetch_array($res)){
                $data.='<li class="list-group-item"><input id="check'.$i.'" class="styled level="child" type="checkbox" name='.$info['classid'].'><label for="check'.$i.'">'.$info['classname'].'</label>';   $i++;

                $sql="select sectionid,sectionname from section where classid='{$info['classid']}'";
                $secres=mysqli_query($con,$sql);
                if($secres!=false){
                    $data.='<ul>';
                    while($info2=mysqli_fetch_array($secres)){
                        $data.='<li class="list-group-item"><input id="check'.$i.'" class="styled" type="checkbox" name='.$info2['sectionid'].'><label for="check'.$i.'">'.$info2['sectionname'].'</label></li>';   $i++;
                    }
                    $data.='</ul></li>';
                }else
                    $data.='</li>';
            }
        }
        $data.='</ul></div>';

        echo $data;

    }

    mysqli_close($con);
?>
<script>
    var i=1;
    $("#addrow").on("click",function(){
        $("#maintimetable tr:last").clone().find("input").each(function () {
            $(this).val('').attr({
                'id': function (_, id) {
                    return id + i
                },
                'name': function (_, name) {
                    return name + i
                },
                'value': ''
            });
        }).end().appendTo("table");
        i++;
    });
    $(document).on('click', 'button.removebutton', function () {
        if(confirm("Are you Sure to Delete the Entire Row")){
            $(this).closest('tr').remove();
            return false;

        }
        return false;
    });
</script>