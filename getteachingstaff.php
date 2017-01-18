<?php
    //    print_r($_POST);
    //    echo "<br /><br /><br />";
    //error_reporting(0);
    include("head.inc");
    date_default_timezone_set('Asia/Kolkata'); 
    /*--------------------------------------------------------DISPLAY CLASS LIST---------------------------------------------------------------------------------*/
    if(isset($_POST['showclassbtn'])){
        $sql = "SELECT `classid`,`classname` FROM `class` where instituteid='{$userid}' ORDER BY `classid` ASC ";
        if($class_op=mysqli_query($con,$sql)){  
            echo '<form id="showsectionform">';
            while($info=mysqli_fetch_array($class_op)){
                echo '<tr><td>
                <input type="button" class="list-group-item" id="showsection '.$info['classid'].'" name="showsection" value="'.$info['classname'].'">
                </td></tr>';
            }
            echo '</form>';
        }
        else
            echo '<tr><td><input type="button" class="list-group-item" value="No Sections to Show"></td></tr>';
    }

    /*--------------------------------------------------------CLASS SAVE---------------------------------------------------------------------------------*/

    if(isset($_POST['classsavebtn'])){
        $data=$_POST['class_text'];
        $count=0;
        for($i=0;$i<sizeof($data);$i++){
            $uid=uniqid();
            $sql=mysqli_query($con,"INSERT INTO `class` (`instituteid`, `classid`, `classname`) VALUES('{$userid}','{$uid}','{$data[$i]}')");
            if($sql==1) $count++;
            //echo "$i= ".$_POST['class_text['.$i.']'];
        }
        $_POST['classcontentbtn']="true";
        $_POST['classsavebtn']="false";
        echo'<script>alert("CLASS Created. Click on the StudentProfile Tab Again to See the Created Class");</script>';
    }

    /*--------------------------------------------------------SHOW SECTION---------------------------------------------------------------------------------*/
    if(isset($_POST['showsectionbtn'])){

        $id=trim($_POST['classid']);
        //$classid=$_POST['classid'][$id-1];
        //echo '<script>alert("i ma ok '.$classid.' & id= '.$id.' ")</script>;';
        if($section_op=mysqli_query($con,"SELECT `sectionid`,`sectionname` FROM `section` where classid='".$id."';")){
            $show=0;
            $i=1;
            echo '<form id="showstudentform">';
            while($info=mysqli_fetch_array($section_op)){
                echo '
                <tr><td>
                <input type="button" class="list-group-item" id="showstudent '.$info["sectionid"].'" name="showstudent" value="'.$info["sectionname"].'">
                </td></tr>';
                $i++;
            }
            echo '<input type="hidden" id="classid" name="classid" value="'.$id.'"></form>';
        }
    }

    /*--------------------------------------------------------SAVE SECTION---------------------------------------------------------------------------------*/

    if(isset($_POST['sectionsavebtn'])){
        $data=$_POST['section_text'];
        $cid=trim($_POST['classid']);
        $count=0;
        for($i=0;$i<sizeof($data);$i++){
            $uid=uniqid();
            if($data[$i]!=null)
                $sql=mysqli_query($con,"INSERT INTO `section` VALUES ('{$uid}','{$data[$i]}','{$cid}')");
            if(!$sql)
                echo "Get the f";
            //echo "$i= ".$_POST['class_text['.$i.']'];
        }
        echo'<script>alert("SECTION Created. Click on the Class Again to See the Created Section");</script>';
    }

    if(isset($_POST['studentsavebtn'])){
        $data=$_POST['section_text'];
        $id=$_POST['classid'];
        $sql = "SELECT `classid` FROM `class` where instituteid='{$userid}' ORDER BY `classid` ASC ";
        $res=mysqli_query($con,$sql);
        $sno=1;
        while($info=mysqli_fetch_array($res))
        {
            if($sno==$id){
                $classid=$info['classid'];
                break;
            }
            $sno++;
        }

        $count=0;
        for($i=0;$i<sizeof($data);$i++){
            $uid=uniqid();
            $sql=mysqli_query($con,"INSERT INTO `section` VALUES ('{$uid}','{$data[$i]}','{$classid}')");
            //echo "$i= ".$_POST['class_text['.$i.']'];
        }
        echo'<script>alert("SECTION Created. Click on the Class Again to See the Created Section");</script>';
    }

    /*--------------------------------------------------------SHOW STUDENT---------------------------------------------------------------------------------*/

    if(isset($_POST['showstudentbtn'])){

        $classid=trim($_POST['classid']);
        $sectionid=trim($_POST['sectionid']);

        $year=date("Y");
        $sql = "SELECT `studentid`,`studentname` from studentprofile where `studentid` IN (select `studentid` FROM `academicdetails` where instituteid='{$userid}' and classid='{$classid}' and sectionid='{$sectionid}' and `academicyear`='{$year}')";
        if($student_op=mysqli_query($con,$sql)){
            $show=0;
            echo '<form id="showstudentdetailsform">';
            while($info=mysqli_fetch_array($student_op)){
                echo '
                <tr><td>
                <input type="button" class="list-group-item" id="showdetailsstudent '.$info["studentid"].' '.$classid.' '.$sectionid.' '.$year.'" name="showstudent" value="'.ucfirst($info["studentname"]).'">
                </td></tr>';
            }
            echo '<input type="hidden" id="classid" name="classid" value="'.$classid.'"><input type="hidden" id="sectionid" name="sectionid" value="'.$sectionid.'"></form>';
        }

    }

    if(isset($_POST['showstudentdetailsbtn'])){
        $data=explode(" ",$_POST['allid']);
        $studentid=$data[1];
        $classid=$data[2];
        $sectionid=$data[3];
        $year=$data[4];
        //          0           1               2               3           4           5        6       7      8           
        $sql="SELECT `StudentRollNum`, `StudentName`, `StudentPhotoPath`, `Gender`, `PhoneNum`, `MailId`, `Dob`, `Doa`, `OtherDetails` FROM `studentprofile` WHERE studentid='{$studentid}' and `CurrentYear`='{$year}'";
        $res=mysqli_query($con,$sql);
        $info=mysqli_fetch_row($res);
        if($info!=null){
            if($info[3]==0)$gender='Male';
            else    $gender='Female';
            echo '
            <div class="row"><div class="col-lg-4"><h3> Student Profile </h3><br />
            <tr><td><img src="'.$info[2].'" cols="100%" rows="100%" alt="i will pink you"></td></tr>
            <tr><td>Name: <strong>'.ucfirst($info[1]).'</strong><br /></td></tr>
            <tr><td>roll No: <strong>'.$info[0].'</strong><br /></td></tr>
            <tr><td>Date Of Birth: <strong>'.$info[6].'</strong><br /></td></tr>
            <tr><td>Gender: <strong>'.$gender.'</strong><br /></td></tr>
            <tr><td>Phone Number: <strong>'.$info[4].'</strong><br /></td></tr>
            <tr><td>Mail ID: <strong>'.$info[5].'</strong><br /></td></tr>
            <tr><td>Date Of Admission: <strong>'.$info[7].'</strong><br /></td></tr>
            <tr><td>Other Details: <strong>'.$info[8].'</strong><br /></td></tr></div></div>';
        }
    }

    /*--------------------------------------------------------SHOW STUDENT---------------------------------------------------------------------------------*/
    if(isset($_POST['createtablebtn'])){
        $sql = "SELECT classid,classname FROM `class` where `InstituteId`='{$userid}'";
        $result=mysqli_query($con,$sql);
        echo '<div class="col-lg-4">Select the Class: <br /><select id="timetableclassid" name="timetableclassid" class="form-control"><option></option>';
        while($info=mysqli_fetch_array($result)){
            echo '<option value="'.$info["classid"].'">'.$info["classname"].'</option>';
        }
        echo '</select></div>';

    }

    /*----------------------------------------------- TO SHOW SECTION LIST FOr TIME TABLE ------------------------------------------------------------*/
    if(isset($_POST['createsectionbtn'])){
        $sql = "SELECT sectionid,sectionname FROM `section` where `ClassId`='{$_POST['timetableclassid']}'";
        $result=mysqli_query($con,$sql);
        echo '<div class="col-lg-4">Select the Section: <br /><select id="timetablesectionid" name="timetablesectionid" class="form-control"><option></option>';
        while($info=mysqli_fetch_array($result)){
            echo '<option value="'.$info["sectionid"].'">'.$info["sectionname"].'</option>';
        }
        echo '</select></div><div class="row"><div class="col-lg-2"><br /><input type="button" id="checkclasssection" class="btn btn-success" value="Check"></div></div>';
    }

    /*----------------------------------------------- TO VIEW STAFF TIME TABLE ------------------------------------------------------------*/ 
    if(isset($_POST['viewtimetablebtn'])){
        $sql="SELECT `TimeTableId` FROM `maintimetable` where `ClassId`='{$_POST['timetableclassid']}' and `SectionId`='{$_POST['timetablesectionid']}' and `InstituteId`='{$userid}' ";
        $resset=mysqli_query($con,$sql);
        $res=mysqli_fetch_row($resset);

        if($res!=null){
            $sql="Select distinct Period from TimeTable where TimeTableId='{$res[0]}' and `StaffId`='{$_COOKIE['userid']}'";
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
                    $sql="Select Day,SubjectId,StaffId from timetable where Period='{$subres[0]}' and `StaffId`='{$_COOKIE['userid']}'";
                    $subsubresset=mysqli_query($con,$sql);
                    $week=array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
                    $newweek=array(false,false,false,false,false,false,false);
                    $staffiddata=array();
                    $subjectiddata=array();
                    while($info=mysqli_fetch_array($subsubresset)){
                        for($i=0;$i<7;$i++){
                            if(strcasecmp($week[$i],$info['Day'])==0){
                                $newweek[$i]=true;
                                $subjectiddata[$i]=$info['SubjectId'];
                            }
                        }
                    }
                    for($i=0;$i<7;$i++){
                        if($newweek[$i]){
                            $subjectid=mysqli_query($con,"select SubjectName from subject where SubjectId='{$subjectiddata[$i]}'");
                            $subject=mysqli_fetch_row($subjectid);

                            echo '<td><label class="form-control">'.$subject[0].'</label></td>';
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

    /*----------------------------------------------- TAKE ATTENDANCE CLASS BTN------------------------------------------------------------*/ 
    if(isset($_POST['takeattendancebtn'])){
        $sql = "SELECT classid,classname FROM `class` where `InstituteId`='{$userid}'";
        $result=mysqli_query($con,$sql);
        echo '<div class="col-lg-4">Select the Class: <br /><select id="classid" name="classid" class="form-control"><option></option>';
        while($info=mysqli_fetch_array($result)){
            echo '<option value="'.$info["classid"].'">'.$info["classname"].'</option>';
        }
        echo '</select></div>';
    }

    /*----------------------------------------------- TAKE ATTENDANCE SECTION BTN------------------------------------------------------------*/ 
    if(isset($_POST['takeattendancesectionbtn'])){
        $sql = "SELECT sectionid,sectionname FROM `section` where `ClassId`='{$_POST['classid']}'";
        $result=mysqli_query($con,$sql);
        echo '<div class="col-lg-4">Section: <br /><select id="sectionid" name="sectionid" class="form-control"><option></option>';
        while($info=mysqli_fetch_array($result)){
            echo '<option value="'.$info["sectionid"].'">'.$info["sectionname"].'</option>';
        }
        echo '</select></div>';
    }

    /*----------------------------------------------- TAKE ATTENDANCE VIEW BTN------------------------------------------------------------*/ 
    if(isset($_POST['takeattendanceviewbtn'])){
        $today=date("Y-m-d");
        $sql = "SELECT distinct `Date` FROM `attendance` where `Date`='{$today}'";
        $res=mysqli_query($con,$sql);
        $resset=mysqli_fetch_row($res);
        if($resset==FALSE)
        {
            $date=date("Y");
            $sql = "SELECT studentid FROM `academicdetails` where `ClassId`='{$_POST['classid']}' and `SectionId`='{$_POST['sectionid']}' and `InstituteId`='{$userid}' and `AcademicYear`='{$date}'";
            $result=mysqli_query($con,$sql);
            echo '<div class="row"><div class="col-lg-10"><table class="table"><thead>
            <tr>
            <th>S.No</th>
            <th>Student Name</th>
            <th>Present</th>
            </tr>
            </thead><tbody>';
            $sno=1;
            while($info=mysqli_fetch_array($result)){
                $sql="select studentname,studentrollnum from studentprofile where studentid='{$info['studentid']}' order by `studentrollnum` asc";
                $res=mysqli_query($con,$sql);
                $resset=mysqli_fetch_row($res);
                echo '<tr><td>'.$sno.'</td><td colspan="2" title="roll num is '.$resset[1].'"><div class="input-group"><input type="hidden" name="studentid[]" value="'.$info['studentid'].'"><input type="text" value="'.ucfirst($resset[0]).'" readonly="readonly" id="stuname" class="form-control"><span class="input-group-addon"><input class="checkboxdata" type="checkbox" id="checkbox" name="presentstatus[]" value="'.$sno.'"></span></td></tr>';
                $sno++;                          
            }
            echo '</tbody></table></div>
            <input type="button" class="form-control" id="submitattendence" name="submitattendence" value="Done">
            </div>
            ';
        }
        else{
            echo '<div class="col-lg-6"><br />Thats all for Today. You took attendence for this Class and Section Before. <br />Or <br />There are no students in this class</div>';
        }
    }

    if(isset($_POST['takeattendancebeforebtn'])){
        $date=date("Y");
        $sql = "SELECT studentid FROM `academicdetails` where `ClassId`='{$_POST['classid']}' and `SectionId`='{$_POST['sectionid']}' and `InstituteId`='{$userid}' and `AcademicYear`='{$date}'";
        $result=mysqli_query($con,$sql);
        echo '<div class="row"><div class="col-lg-10"><table class="table">
        <caption>Total Present Students</caption>
        <thead>
        <tr>
        <th>S.No</th>
        <th>Student Name</th>
        <th>Present</th>
        </tr>
        </thead><tbody>';
        $countsql = "SELECT count(studentid) FROM `academicdetails` where `ClassId`='{$_POST['classid']}' and `SectionId`='{$_POST['sectionid']}' and `InstituteId`='{$userid}' and `AcademicYear`='{$date}'";
        $countresult=mysqli_query($con,$countsql);
        $countrow=mysqli_fetch_row($countresult);
        $sno=1; 
        $arr=array();
        for($i=0;$i<$countrow[0];$i++)   $arr[$i]=0;
        $x=-1;
        while($info=mysqli_fetch_array($result)){
            $sql="select studentname,studentrollnum from studentprofile where studentid='{$info['studentid']}' order by `studentrollnum` asc";
            $res=mysqli_query($con,$sql);
            $resset=mysqli_fetch_row($res);
            $x++;
            for($i=0;$i<sizeof($_POST['presentstatus']);$i++){
                if($sno==$_POST['presentstatus'][$i]){
                    $arr[$x]=$sno;
                    echo '<tr><td>'.$sno.'</td><td colspan="2" title="roll num is '.$resset[1].'"><input type="hidden" name="presentstatus[]" value="'.$_POST['presentstatus'][$i].'">';
                    echo'<input type="text" value="'.ucfirst($resset[0]).'" readonly="readonly" id="stuname" class="form-control">';
                    echo '</td></tr>';
                    break;
                }
            }

            $sno++;                          
        }
        echo '</tbody></table></div></div>';
        echo '<div class="row"><div class="col-lg-10"><table class="table">
        <caption>Total Absent Students</caption>
        <thead>
        <tr>
        <th>S.No</th>
        <th>Student Name</th>
        <th>Present</th>
        </tr>
        </thead><tbody>';

        $sql = "SELECT studentid FROM `academicdetails` where `ClassId`='{$_POST['classid']}' and `SectionId`='{$_POST['sectionid']}' and `InstituteId`='{$userid}' and `AcademicYear`='{$date}'";
        $result=mysqli_query($con,$sql);      
        $sno=1; 
        $x=0;
        while($info=mysqli_fetch_array($result)){
            $sql="select studentname,studentrollnum from studentprofile where studentid='{$info['studentid']}' order by `studentrollnum` asc";
            $res=mysqli_query($con,$sql);
            $resset=mysqli_fetch_row($res);
            if($arr[$x]==0){
                echo '<tr><td>'.$sno.'</td><td colspan="2" title="roll num is '.$resset[1].'">';
                echo'<input type="text" value="'.ucfirst($resset[0]).'" readonly="readonly" id="stuname" class="form-control">';
                echo '</td></tr>';
            }
            $sno++;                          
            $x++;
        }

        echo '</tbody></table></div><input type="button" class="form-control" id="finalsubmitattendence" name="finalsubmitattendence" value="Done"></div>';
    }

    if(isset($_POST['takeattendancefinalbtn'])){
        $date=date("Y");
        $today=date("Y-m-d");
        $sql = "SELECT studentid,academicid FROM `academicdetails` where `ClassId`='{$_POST['classid']}' and `SectionId`='{$_POST['sectionid']}' and `InstituteId`='{$userid}' and `AcademicYear`='{$date}'";
        $result=mysqli_query($con,$sql);
        echo '<div class="row"><div class="col-lg-10">';

        $countsql = "SELECT count(studentid) FROM `academicdetails` where `ClassId`='{$_POST['classid']}' and `SectionId`='{$_POST['sectionid']}' and `InstituteId`='{$userid}' and `AcademicYear`='{$date}'";
        $countresult=mysqli_query($con,$countsql);
        $countrow=mysqli_fetch_row($countresult);
        $sno=1; 
        $arr=array();
        for($i=0;$i<$countrow[0];$i++)   $arr[$i]=0;
        $x=-1;
        while($info=mysqli_fetch_array($result)){
            $sql="select studentname,studentrollnum from studentprofile where studentid='{$info['studentid']}' order by `studentrollnum` asc";
            $res=mysqli_query($con,$sql);
            $resset=mysqli_fetch_row($res);
            $x++;
            for($i=0;$i<sizeof($_POST['presentstatus']);$i++){
                if($sno==$_POST['presentstatus'][$i]){
                    $arr[$x]=$sno;
                    $sql="INSERT into attendance values ('{$info['studentid']}','1','{$today}','{$info['academicid']}');";
                    $subres=mysqli_query($con,$sql);
                    if($subres==FALSE)  echo "Try Again ...!";
                    break;
                }
            }

            $sno++;                          
        }
        echo '</tbody></table></div></div>';
        echo '<div class="row"><div class="col-lg-10">';

        $sql = "SELECT studentid,academicid FROM `academicdetails` where `ClassId`='{$_POST['classid']}' and `SectionId`='{$_POST['sectionid']}' and `InstituteId`='{$userid}' and `AcademicYear`='{$date}'";
        $result=mysqli_query($con,$sql);      
        $sno=1; 
        $x=0;
        while($info=mysqli_fetch_array($result)){
            $sql="select studentname,studentrollnum from studentprofile where studentid='{$info['studentid']}' order by `studentrollnum` asc";
            $res=mysqli_query($con,$sql);
            $resset=mysqli_fetch_row($res);
            if($arr[$x]==0){
                $sql="INSERT into attendance values ('{$info['studentid']}','0','{$today}','{$info['academicid']}');";
                $subres=mysqli_query($con,$sql);
                if($subres==FALSE)  echo "Try Again ...!";
            }
            $sno++;                          
            $x++;
        }
        echo '</div></div>';

    }

    /*----------------------------------------------- VIEW ATTENDANCE CLASS BTN------------------------------------------------------------*/ 
    if(isset($_POST['viewattendancebtn'])){
        $sql = "SELECT classid,classname FROM `class` where `InstituteId`='{$userid}'";
        $result=mysqli_query($con,$sql);
        echo '<div class="col-lg-4">Select the Class: <br /><select id="vclassid" name="classid" class="form-control"><option></option>';
        while($info=mysqli_fetch_array($result)){
            echo '<option value="'.$info["classid"].'">'.$info["classname"].'</option>';
        }
        echo '</select></div>';
    }

    /*----------------------------------------------- VIEW ATTENDANCE SECTION BTN------------------------------------------------------------*/ 
    if(isset($_POST['viewattendancesectionbtn'])){
        $sql = "SELECT sectionid,sectionname FROM `section` where `ClassId`='{$_POST['classid']}'";
        $result=mysqli_query($con,$sql);
        echo '<div class="col-lg-4">Section: <br /><select id="vsectionid" name="sectionid" class="form-control"><option></option>';
        while($info=mysqli_fetch_array($result)){
            echo '<option value="'.$info["sectionid"].'">'.$info["sectionname"].'</option>';
        }
        echo '</select></div>';
    }

    if(isset($_POST['viewattendanceviewbtn'])){ 
        $date=date("Y");
        $sql = "SELECT studentid,status FROM `attendance` where Date='{$_POST['attendancedate']}' and `AcademicId` IN (select AcademicId from academicdetails where classid='{$_POST['classid']}' and `SectionId`='{$_POST['sectionid']}' and `InstituteId`='{$userid}')";
        $result=mysqli_query($con,$sql);
        echo '<div class="row"><div class="col-lg-10"><table class="table"><thead>
        <tr>
        <th>S.No</th>
        <th>Student Name</th>
        <th>Present</th>
        </tr>
        </thead><tbody>';
        $sno=1;
        while($info=mysqli_fetch_array($result)){
            $sql="select studentname,studentrollnum from studentprofile where studentid='{$info['studentid']}' order by `studentrollnum` asc";
            $res=mysqli_query($con,$sql);
            $resset=mysqli_fetch_row($res);
            echo '<tr><td>'.$sno.'</td><td colspan="1" title="roll num is '.$resset[1].'">
            <input type="text" value="'.ucfirst($resset[0]).'" readonly="readonly" class="form-control">
            </td><td>';
            if($info['status']=='1')    
                echo "Yes";
            else    
                echo "No";
            echo'</td></tr>';
            $sno++;                          
        }
        echo '</tbody></table></div>
        <input type="button" class="form-control" id="submitattendence" name="submitattendence" value="Done">
        </div>
        ';
    }

    /*----------------------------------------------- MArKS DEPT BTN------------------------------------------------------------*/
    if(isset($_POST['entermarkexambtn'])){
        $sql = "SELECT examid,examname FROM `examdetails` where `InstituteId`='{$userid}'";
        $result=mysqli_query($con,$sql);
        echo '<div class="col-lg-2">Select the Exam: <br /><select id="examid" name="examid" class="form-control"><option></option>';
        while($info=mysqli_fetch_array($result)){
            echo '<option value="'.$info["examid"].'">'.$info["examname"].'</option>';
        }
        echo '</select></div>';      
    }
    if(isset($_POST['entermarkclassbtn'])){
        $sql = "SELECT classid,classname FROM `class` where `InstituteId`='{$userid}'";
        $result=mysqli_query($con,$sql);
        echo '<div class="col-lg-2">Select the Class: <br /><select id="mclassid" name="classid" class="form-control"><option></option>';
        while($info=mysqli_fetch_array($result)){
            echo '<option value="'.$info["classid"].'">'.$info["classname"].'</option>';
        }
        echo '</select></div>';      
    }

    if(isset($_POST['entermarksectionbtn'])){
        $sql = "SELECT sectionid,sectionname FROM `section` where `ClassId`='{$_POST['classid']}'";
        $result=mysqli_query($con,$sql);
        echo '<div class="col-lg-2">Select the Section: <br /><select id="sectionid" name="sectionid" class="form-control"><option></option>';
        while($info=mysqli_fetch_array($result)){
            echo '<option value="'.$info["sectionid"].'">'.$info["sectionname"].'</option>';
        }
        echo '</select></div><div class="col-lg-2">Click Check:<input type="button" name="chekentermarks" id="chekentermarks" value="Check" class="btn btn-primary"></div>';
    }

    if(isset($_POST['chekentermarksbtn'])){
        $sql = "SELECT distinct `ExamID` FROM `marks` WHERE `ExamId`='{$_POST['examid']}' and `ClassId`='{$_POST['classid']}' and `SectionId`='{$_POST['sectionid']}'";
        $res=mysqli_query($con,$sql);
        $resset=mysqli_fetch_row($res);
        if($resset==FALSE)
        {

            $sql="select studentid,studentrollnum,studentname from studentprofile where studentid IN (select studentid from academicdetails where classid='{$_POST['classid']}' and sectionid='{$_POST['sectionid']}' and instituteid='{$userid}')";
            $studentres=mysqli_query($con,$sql);

            $sql="select subjectname,subjectid from subject where subjectid IN (select subjectid from examsubject where examid='{$_POST['examid']}' and instituteid='{$userid}')";
            $examres=mysqli_query($con,$sql);

            $string="<table><tbody>";
            while($subinfo=mysqli_fetch_array($examres))
                $string.='<tr><td>'.$subinfo['subjectname'].'</td><td><input type="number" min=-1 name="marks[]" class="form-control" placeholder="Marks"></td></tr>';
            $string.='</tbody></table>';

            echo '<table class="table"><thead><tr><th>S.No</th><th>Student ID</th><th>Student Name</th><th>Subject Name & Marks</th></tr></thead><tbody>';
            $sno=1;

            while($info=mysqli_fetch_array($studentres)){
                echo '<tr><td>'.$sno.'</td><td>'.$info['studentrollnum'].' <input type="hidden" value="'.$info['studentid'].'" name="studentid[]"></td><td>'.ucfirst($info['studentname']).'</td><td>'.$string.'</td></tr>';
                $sno++;
            }
            echo '</tbody></table><div class="col-lg-2"><input type="button" class="form-control" name="chekentermarksfinalbtn" id="chekentermarksfinalbtn" value="Done"></div>';
        }
        else{
            echo '<div class="col-lg-10"><br />Thats all for Today. You had already Updated the Marks for this Class and Section Before. <br />Or <br />There are no students in this class</div>';
        }
    }

    if(isset($_POST['chekentermarksfinalbtn'])){
        /*
        Array ( [examid] => 5743b45e8a482 [classid] => 572abc101 [sectionid] => 527abc501 
        [studentid] => Array ( [0] => Stu101 [1] => Stu102 [2] => Stu103 [3] => Stu104 [4] => Stu105 [5] => Stu106 ) 
        [marks] =>     Array ( 
        [0] => 0 [1] => -1 [2] => -1 [3] => -1 
        [4] => -1 [5] => -1 [6] => -1 [7] => -1 
        [8] => -1 [9] => -2 [10] => -1 [11] => -1 
        [12] => -1 [13] => -1 [14] => -1 [15] => -1 
        [16] => [17] => -1 [18] => -2 [19] => -1 
        [20] => -1 [21] => -1 [22] => -1 [23] => -1 )
        [chekentermarksfinalbtn] => true )

        $date=date("Y-m-d");

        $sql="select subjectid from subject where subjectid IN (select subjectid from examsubject where examid='{$_POST['examid']}' and instituteid='{$userid}')";
        $examres=mysqli_query($con,$sql);

        $count="select count(subjectid) from subject where subjectid IN (select subjectid from examsubject where examid='{$_POST['examid']}' and instituteid='{$userid}')";        
        $countres=mysqli_query($con,$count);
        $count=mysqli_fetch_row($countres);
        $sno=0;$m=0;
        while($info=mysqli_fetch_array($examres)){
        for($i=0;$i<$count[0];$i++){
        $m+=$count[0];
        $sql="INSERT INTO `marks` VALUES ('{$_POST['studentid'][$sno]}', '{$_COOKIE['userid']}','{$_POST['classid']}','{$_POST['sectionid']}','{$info['subjectid']}',{$_POST['marks'][$m]}, '{$date}', '{$_POST['examid']}', '0');";
        $insres=mysqli_query($con,$sql);
        if($insres==false){echo "F it up";}
        }
        $sno++;
        $m=$sno;
        }
        */


        $sql="select studentid from academicdetails where classid='{$_POST['classid']}' and sectionid='{$_POST['sectionid']}' and instituteid='{$userid}'";
        $studentres=mysqli_query($con,$sql);

        $today=date("Y-m-d");
        $sno=1;
        $i=0;
        while($info=mysqli_fetch_array($studentres))
        {
            $sql="select subjectid from examsubject where examid='{$_POST['examid']}' and instituteid='{$userid}'";
            $examres=mysqli_query($con,$sql);


            while($subinfo=mysqli_fetch_array($examres))
            {

                if($_POST['marks'][$i]==null)   $m=0;   else    $m=$_POST['marks'][$i];
                $sql="insert into marks values ('{$info['studentid']}','{$_COOKIE['userid']}','{$_POST['classid']}','{$_POST['sectionid']}','{$subinfo['subjectid']}',{$m},'{$today}','{$_POST['examid']}','0')";
                $i++;
                $res=mysqli_query($con,$sql);
                if($res==false) echo "you are dead<br />";
            }
            $sno++;
        }
    }

    /*----------------- VIEW Marks BUTTON------------------------*/

    if(isset($_POST['viewmarkexambtn'])){
        $sql = "SELECT examid,examname FROM `examdetails` where `InstituteId`='{$userid}'";
        $result=mysqli_query($con,$sql);
        echo '<div class="col-lg-2">Select the Exam: <br /><select id="vexamid" name="examid" class="form-control"><option></option>';
        while($info=mysqli_fetch_array($result)){
            echo '<option value="'.$info["examid"].'">'.$info["examname"].'</option>';
        }
        echo '</select></div>';      
    }

    if(isset($_POST['viewmarkclassbtn'])){
        $sql = "SELECT classid,classname FROM `class` where `InstituteId`='{$userid}'";
        $result=mysqli_query($con,$sql);
        echo '<div class="col-lg-2">Select the Class: <br /><select id="vclassid" name="classid" class="form-control"><option></option>';
        while($info=mysqli_fetch_array($result)){
            echo '<option value="'.$info["classid"].'">'.$info["classname"].'</option>';
        }
        echo '</select></div>';      
    }

    if(isset($_POST['viewmarksectionbtn'])){
        $sql = "SELECT sectionid,sectionname FROM `section` where `ClassId`='{$_POST['classid']}'";
        $result=mysqli_query($con,$sql);
        echo '<div class="col-lg-2">Select the Section: <br /><select id="vsectionid" name="sectionid" class="form-control"><option></option>';
        while($info=mysqli_fetch_array($result)){
            echo '<option value="'.$info["sectionid"].'">'.$info["sectionname"].'</option>';
        }
        echo '</select></div><div class="col-lg-2">Click Check:<input type="button" name="checkviewmarks" id="checkviewmarks" value="Check" class="btn btn-primary"></div>';
    }

    if(isset($_POST['checkviewmarks'])){
        //StudentId     StaffId     ClassId     SectionId       SubjectId       Marks       Date    ExamId      Result
        $sql="select studentid,studentrollnum,studentname from studentprofile where studentid IN (select studentid from marks where classid='{$_POST['classid']}' and sectionid='{$_POST['sectionid']}' and examid='{$_POST['examid']}')";
        $studentres=mysqli_query($con,$sql); // gives student details

        $sql="select subjectname,subjectid from subject where subjectid IN (select distinct subjectid from marks where examid='{$_POST['examid']}' and instituteid='{$userid}')";
        $examres=mysqli_query($con,$sql);   // gives subject details

        $sql="select TotalMarks from examdetails where examid='{$_POST['examid']}' and instituteid='{$userid}';";
        $examtot=mysqli_query($con,$sql);   // gives subject details
        $totmarks=mysqli_fetch_row($examtot);

        echo '<table class="table"><thead><tr><th>S.No</th><th>Student ID</th><th>Student Name</th>';
        while($subinfo=mysqli_fetch_array($examres))
            echo '<th>'.$subinfo['subjectname'].'</th>';
        echo '<th>Marks Gained</th><th>Total Marks</th><th>Average</th></tr></thead><tbody>';

        $sno=1;
        while($info=mysqli_fetch_array($studentres)){
            echo '<tr><td>'.$sno.'</td><td>'.$info['studentrollnum'].'</td><td>'.ucfirst($info['studentname']).'</td>';
            $sql="select marks from marks where studentid='{$info['studentid']}' and examid='{$_POST['examid']}' and classid='{$_POST['classid']}' and sectionid='{$_POST['sectionid']}'";
            $subnameres=mysqli_query($con,$sql);
            $count=0;
            while($subnameinfo=mysqli_fetch_array($subnameres)){
                echo '<td>'.$subnameinfo['marks'].'</td>';
                $count+=$subnameinfo['marks'];
            }
            $avg=number_format((float)($count/$totmarks[0])*100, 2, '.', '');  // Outputs -> 105.00
            echo'</td><td>'.$count.'</td><td>'.$totmarks[0].'</td><td>'.$avg.'</td></tr>';
            $sno++;
        }
        echo '</tbody></table>';
    }

    if(isset($_POST['deleteclassbtn'])){
        echo '
        <div class="row">
        <span class="close">X</span>
        <p>Select a Class to Delete:</p>
        <div class="col-lg-4">
        <form id="classdeleteform">
        <select name="classid" class="form-control">
        <option></option>';
        $sql="select classid,classname from class where instituteid='{$userid}'";
        $res=mysqli_query($con,$sql);
        while($info=mysqli_fetch_array($res)){
            echo '<option value='.$info['classid'].'>'.$info['classname'].'<option>';
        }
        echo '
        </select><br />
        <input type="button" class="btn btn-warning" value="Delete" id="finalclassdelete"><br />
        </form></div></div>';
    }

    if(isset($_POST['finaldeleteclassbtn'])){
        $sql="DELETE FROM `class` WHERE `ClassId` ='{$_POST['classid']}'";
        $res=mysqli_query($con,$sql);
        if($res)    
            echo '
            <div class="row">
            <span class="close">X</span>
            <div class="col-lg-4">
            Class Was Successfully Deleted. Click on the Student Profile Tab to refresh. Click on the `X` to Close this   
            </div></div>';
        else
            echo '
            <div class="row">
            <span class="close">X</span>
            <div class="col-lg-4">
            Delete all the Sections First, and then Delete the Class
            </div></div>';

    }
    if(isset($_POST['deletesectionbtn'])){
        echo '
        <div class="row">
        <span class="close">X</span>
        <p>Select a Section to Delete:</p>
        <div class="col-lg-4">
        <form id="sectiondeleteform">
        <select name="sectionid" class="form-control">
        <option></option>';
        $sql="select sectionid,sectionname from section where classid='{$_POST['classid']}'";
        $res=mysqli_query($con,$sql);
        while($info=mysqli_fetch_array($res)){
            echo '<option value='.$info['sectionid'].'>'.$info['sectionname'].'<option>';
        }
        echo '
        </select><br />
        <input type="button" class="btn btn-warning" value="Delete" id="finalsectiondelete"><br />
        </form></div></div>';
    }

    if(isset($_POST['finaldeletesectionbtn'])){
        $sql="DELETE FROM `section` WHERE `sectionid` ='{$_POST['sectionid']}'";
        $res=mysqli_query($con,$sql);
        if($res)    
            echo '
            <div class="row">
            <span class="close">X</span>
            <div class="col-lg-4">
            Section Was Successfully Deleted. Click on the Class Tab to refresh. Click on the `X` to Close this   
            </div></div>';
        else
            echo '
            <div class="row">
            <span class="close">X</span>
            <div class="col-lg-4">
            Sections was not Deleted. Try Again.
            </div></div>';
    }

    if(isset($_POST['deletestudentbtn'])){
        echo '
        <div class="row">
        <span class="close">X</span>
        <p>Select a Student to Delete:</p>
        <div class="col-lg-4">
        <form id="studentdeleteform">
        <select name="studentid" class="form-control">
        <option></option>';
        $classid=trim($_POST['classid']);
        $sectionid=trim($_POST['sectionid']);
        $year=date("Y");
        $sql = "SELECT `studentid`,`studentname` from studentprofile where `studentid` IN (select `studentid` FROM `academicdetails` where instituteid='{$userid}' and classid='{$classid}' and sectionid='{$sectionid}' and `academicyear`='{$year}')";
        $res=mysqli_query($con,$sql);
        while($info=mysqli_fetch_array($res)){
            echo '<option value='.$info['studentid'].'>'.$info['studentname'].'<option>';
        }
        echo '
        </select><br />
        <input type="button" class="btn btn-warning" value="Delete" id="finalstudentdelete"><br />
        </form></div></div>';
    }

    if(isset($_POST['finaldeletestudentbtn'])){
        $sql="DELETE FROM `studentprofile` WHERE `studentid` ='{$_POST['studentid']}'";
        $res=mysqli_query($con,$sql);
        if($res)    
            echo '
            <div class="row">
            <span class="close">X</span>
            <div class="col-lg-4">
            Student Was Successfully Deleted. Click on the Section Tab to refresh. Click on the `X` to Close this   
            </div></div>';
        else
            echo '
            <div class="row">
            <span class="close">X</span>
            <div class="col-lg-4">
            Student was not Deleted. Try Again.
            </div></div>';
    }

    if(isset($_POST['addstudentdisplaybtn'])){
        echo '
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
        <textarea class="form-control" cols="10" rows="5" name="otherdetails" id="otherdetails" placeholder="Enter Any Other Details of the Student"></textarea><br />
        <input type="hidden" name="classid" value="'.$_POST['classid'].'">
        <input type="hidden" name="sectionid" value="'.$_POST['sectionid'].'">
        <input type="submit" value="Add Student" id="add_student_modal_btn_notnow" class="btn btn-success" name="studentsubmit">
        </form>
        </div>
        <div class="col-lg-4">
        <div id="studentphotoresult">
        </div>
        </div>
        </div>
        ';
    }
    
    if(isset($_POST['remarkoptionbtn'])){
        $sql = "SELECT classid,classname FROM `class` where `InstituteId`='{$userid}'";
        $result=mysqli_query($con,$sql);
        echo 'Select the Class: <br /><select id="remarkclassid" name="remarkclassid" class="form-control"><option></option>';
        while($info=mysqli_fetch_array($result)){
            echo '<option value="'.$info["classid"].'">'.$info["classname"].'</option>';
        }
        echo '</select><br />';
    }

    if(isset($_POST['remarkoptionsectionbtn'])){
        $sql = "SELECT sectionid,sectionname FROM `section` where `ClassId`='{$_POST['remarkclassid']}'";
        $result=mysqli_query($con,$sql);
        echo 'Select the Section: <br /><select id="remarksectionid" name="remarksectionid" class="form-control"><option></option>';
        while($info=mysqli_fetch_array($result)){
            echo '<option value="'.$info["sectionid"].'">'.$info["sectionname"].'</option>';
        }
        echo '</select></div>';
    }
    
    if(isset($_POST['remarkoptionview'])){
        $i=1;
        $date=date("Y");
        $sql = "SELECT studentid,studentname FROM `studentprofile` where `StudentId` IN ( select studentid from `academicdetails` where classid='{$_POST['remarkclassid']}' and sectionid='{$_POST['remarksectionid']}' and instituteid='{$userid}' and academicyear='{$date}')";
        $result=mysqli_query($con,$sql);
        echo 'Select the Students: <br />
        <div class="checkbox checkbox-info checkbox-circle"><ul class="list-group" id="remarkstudentid" name="remarkstudentid">';
        while($info=mysqli_fetch_array($result)){
            echo '<li class="list-group-item"><input id="check'.$i.'" class="styled" type="checkbox" name="'.$info['studentid'].'"><label for="check'.$i.'">'.$info['studentname'].'</label></li>';
                  $i++;
        }
        echo '</ul></div><div class="row"><div class="col-lg-2"><br /><input type="button" id="remarkclasssectionsubmit" class="btn btn-success" value="Check"></div></div>';
    }
    
    if(isset($_POST['remarkclasssectionsubmit'])){
        /*
        Array ( [remarktext] => [remarkclassid] => 572abc101 [remarksectionid] => 527abc501 [5748115ad43ab] => on [Stu103] => on [Stu106] => on [remarkclasssectionsubmit] => true )
        */
        $date=date("Y-m-d");
        $uid=uniqid();
        $sql="INSERT INTO `remarks` VALUES ('{$userid}', '{$uid}', '{$_POST['remarktext']}', '{$_COOKIE['userid']}', '{$date}');";
        $res=mysqli_query($con,$sql);
        
        if($res){
            $keys=array_keys($_POST);
            for($i=0;$i<sizeof($keys);$i++){
                if($keys[$i]=='remarktext') continue;
                if($keys[$i]=='remarkclassid') continue;
                if($keys[$i]=='remarksectionid') continue;
                if($keys[$i]=='remarkclasssectionsubmit') continue;
                
                $sql="INSERT INTO `remarkssenderlist` VALUES ('{$uid}','{$keys[$i]}');";
                $resset[$i]=mysqli_query($con,$sql);
            }
            if($resset){
                echo '<p class="well">remark created successfully</p>';
            }
            else
                echo '<p class="well">remark failed</p>';
        }
    }
    
    

    
    mysqli_close($con);
?>