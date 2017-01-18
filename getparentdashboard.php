<?php
    include("head.inc");

    $displaydate=date("d-m-Y");
    $year=date("Y");

    if(isset($_POST['studentclick'])){
        /*
        StudentId  InstituteId  StudentRollNum  StudentName  StudentPhotoPath Gender PhoneNum  MailId Dob Doa OtherDetails CurrentYear
        */
        $sql="select StudentId,InstituteId,StudentRollNum,StudentName,StudentPhotoPath,Gender,PhoneNum,MailId,Dob,Doa,OtherDetails,CurrentYear from studentprofile where studentid='{$_COOKIE['studentid']}' and instituteid='{$userid}'";
        $res=mysqli_query($con,$sql);
        $info=mysqli_fetch_array($res);
        if($info){
            if($info['Gender']=='0')    $gender="Male";
            else    $gender="Female";
            echo'
            <div class="page-header"><h1><small>Student Profile Zone</small></h1></div>
            <div class="col-lg-9">
            Student Full Name:
            <input type="text" class="form-control" readonly="readonly" value="'.ucfirst($info['StudentName']).'">
            <br />
            <div class="row">
            <div class="col-lg-3">
            Student Roll Num:
            <input type="text" class="form-control" readonly="readonly" value="'.$info['StudentRollNum'].'">
            </div>
            <div class="col-lg-3">
            Gender:
            <input type="text" class="form-control" readonly="readonly" value="'.$gender.'">
            </div>
            <div class="col-lg-3">
            Student Phone Num:
            <input type="text" class="form-control" readonly="readonly" value="'.$info['PhoneNum'].'">
            </div>
            </div>
            <div class="row">
            <div class="col-lg-4"><br />
            Current Year:
            <input type="text" class="form-control" readonly="readonly" value="'.$info['CurrentYear'].'">
            </div>
            <div class="col-lg-4"><br />
            Mail Id:
            <input type="text" class="form-control" readonly="readonly" value="'.$info['MailId'].'">
            </div><br />
            </div>
            <div class="row">
            <div class="col-lg-4"><br />
            Date of Birth:
            <input type="text" class="form-control" readonly="readonly" value="'.$info['Dob'].'">
            </div>
            <div class="col-lg-4"><br />
            Date of Admission:
            <input type="text" class="form-control" readonly="readonly" value="'.$info['Doa'].'">
            </div><br />
            </div>
            <div class="row">
            <div class="col-lg-6"><br />
            Other Details:
            <input type="text" class="form-control" readonly="readonly" value="'.$info['OtherDetails'].'">
            </div>
            </div>
            </div>
            <div class="row">
            <div class="col-lg-3">
            <img src="'.$info['StudentPhotoPath'].'" alt="Check the Path">
            </div>
            </div>

            ';

        }
        else
            echo "No Student Was There to Show. relogin and show it.";
    }

    if(isset($_POST['attendanceclick'])){

        // Only Today Attendance is here.
        echo '
        <div class="page-header"><h1><small>Attendance Zone</small></h1></div>
        Today Date: <strong>'.$displaydate.'</strong><br />';
        $sql="select status from attendance where date='{$displaydate}' and studentid='{$_COOKIE['studentid']}';";
        $res=mysqli_query($con,$sql);
        if($res){
            $info=mysqli_fetch_row($res);
            if($info[0]=='1')
                $inf="<strong>Present</strong>";
            else
                $inf="<strong>Absent</strong>";

        }
        else
            $inf="Attendance for Today Was Not Yet Taken.";
        echo'
        <div class="col-lg-6">
        <div class="panel panel-primary">
        <div class="panel-heading">Today`s Attendance</div>
        <table class="table">
        <tr><td>'.$inf.'</td></tr>
        </table>
        </div>   
        </div>   
        '; 
        /*--------------------------------------- Old Attendance ------------------------*/
        echo'
        <div class="col-lg-8">
        <div class="panel panel-default">
        <div class="panel-heading">Previous Attendance</div>
        <table class="table">
        <thead>
        <tr>
        <th>Sno</th>
        <th>Date</th>
        <th>Status</th>
        </tr>
        </thead><tbody>
        ';

        $sql="select status,date from attendance where date!='{$displaydate}' and studentid='{$_COOKIE['studentid']}' ORDER BY `Date` DESC;";
        $res=mysqli_query($con,$sql);
        if($res){
            $sno=1;
            while($info=mysqli_fetch_array($res)){
                if($info['status']==1)
                    $inf="Present";
                else
                    $inf="Absent";

                echo '<tr><td>'.$sno.'</td><td>'.$info['date'].'</td><td>'.$inf.'</td></tr>';
                $sno++;
            }
        }
        echo'
        </tbody>
        </table>
        </div>   
        </div>
        ';
    }

    if(isset($_POST['notificationcircularclick'])){

        echo '
        <div class="page-header"><h1><small>Notification & Circulars Zone</small></h1></div>
        Today Date: <strong>'.$displaydate.'</strong><br />
        <div class="col-lg-6">
        <div class="panel panel-primary">
        <div class="panel-heading">All Notifications & Circulars for you</div>
        <table class="table">
        <thead>
        <tr><th>Sno</th>
        <th>Date</th>
        <th>Text</th>
        <th>Posted By</th>
        <th>Download</th></tr>
        </thead><tbody>
        ';

        $sno=1;
        $sql="select `Text`,`CircularFilePath`,`Date`,`StaffId` from circular where instituteid='{$userid}' and `CircularId` IN (select `CircularId` from circularsenderlist where userid IN (select distinct sectionid from academicdetails where academicyear='{$year}' and studentid='{$_COOKIE['studentid']}'))";
        $res=mysqli_query($con,$sql);
        while($info=mysqli_fetch_array($res)){
            $sql="select `StaffName` from staffprofile where instituteid='{$userid}' and `StaffId`='{$info['StaffId']}'";
            $secres=mysqli_query($con,$sql);
            $staffname=mysqli_fetch_row($secres);
            echo '<tr><td>'.$sno.'</td><td>'.$info['Date'].'</td><td>'.$info['Text'].'</td><td>'.$staffname[0].'</td><td><a href="'.$info['CircularFilePath'].'" target="blank">Link</a></td></tr>';
            $sno++;
        }
        echo '
        </tbody>
        </table>
        </div>   
        </div>   
        ';
    }

    if(isset($_POST['billclick'])){
        echo '
        <div class="page-header"><h1><small>Billings Zone</small></h1></div>
        <div class="col-lg-8">
        <div class="panel panel-primary">
        <div class="panel-heading">View all the Bills paid by you</div>
        <table class="table">
        <thead>
        <tr><th>Sno</th>
        <th>Challan No</th>
        <th>Date</th>
        <th>Bill Type</th>
        <th>Original Amount</th>
        <th>Amount Paid</th>
        <th>Due Amount</th>
        </tr>
        </thead><tbody>
        ';
        $sno=1;
        $sql="select `BillId`, `Date`, `AmountPaid`, `OriginalAmount`, `OriginalAmount`-`AmountPaid` as `DueAmount`, `BillType` from billings where studentid='{$_COOKIE['studentid']}' and instituteid='{$userid}'";
        $res=mysqli_query($con,$sql);
        while($info=mysqli_fetch_array($res)){
            echo '<tr><td>'.$sno.'</td><td>'.$info['BillId'].'</td><td>'.$info['Date'].'</td><td>'.$info['BillType'].'</td><td>'.$info['OriginalAmount'].'</td><td>'.$info['AmountPaid'].'</td><td>'.$info['DueAmount'].'</td></tr>';
            $sno++;
        }
        echo '
        </tbody>
        </table>
        </div>   
        </div>   
        ';
    }     

    if(isset($_POST['markclick'])){
        /*StudentId, StaffId, ClassId, SectionId, SubjectId, Marks, Date, ExamId, Result  */
        echo '
        <div class="page-header"><h1><small>Marks Zone</small></h1></div>
        <div class="col-lg-6">
        <div class="row">
        <div class="panel panel-primary">
        <div class="panel-heading">All the Examination Marks</div>';

        $sql="select examid,examname from examdetails where examid in (select examid from marks where studentid='{$_COOKIE['studentid']}')";
        $res=mysqli_query($con,$sql);
        while($info=mysqli_fetch_array($res)){

            echo '
            <table class="table table-bordered table-striped">
            <thead>
            <tr><th colspan="4">Exam name: '.$info['examname'].'</th></tr>
            <tr>
            <th>Sno</th>
            <th>Subject name</th>
            <th>Marks</th>
            <th>Status</th>
            </tr>
            </thead>
            <tbody>';
            $totmarks=0;
            $totmarksgained=0;
            $fail=false;
            $sno=1;

            $sql="select SubjectId,TotalMarks,PassMarks from examsubject where examid='{$info['examid']}' and instituteid='{$userid}'";
            $subres=mysqli_query($con,$sql);
            while($subinfo=mysqli_fetch_array($subres))
            {
                echo '<tr><td>'.$sno.'</td>';
                $sql="select subjectname from subject where subjectid='{$subinfo['SubjectId']}'";
                $subjectidres=mysqli_query($con,$sql);
                $resset=mysqli_fetch_row($subjectidres);
                echo '<td>'.$resset[0].'</td>';

                $sql="select marks from marks where examid='{$info['examid']}' and studentid='{$_COOKIE['studentid']}' and subjectid='{$subinfo['SubjectId']}'";
                $marksres=mysqli_query($con,$sql);
                $marks=mysqli_fetch_row($marksres);
                echo '<td>'.$marks[0].'</td>';

                if($marks[0]>$subinfo['PassMarks'])
                    echo '<td>Pass</td>';
                else{
                    echo '<td>Fail</td>';
                    $fail=true;
                }
                $totmarks+=intval($subinfo['TotalMarks']);                      
                $totmarksgained+=intval($marks[0]);

                echo '</tr>';
                $sno++;
            }

            if($fail)   $status='Not Promoted';
            else    $status='Promoted';                                                          
            $avg=number_format((float)($totmarksgained/$totmarks)*100, 2, '.', '');
            echo'
            </tbody>
            <tfoot>
            <tr><th colspan="3">Total Marks Gained: </th><th>'.$totmarksgained.'</th></tr>
            <tr><th colspan="3">Average: </th><th>'.$avg.'</th></tr>
            <tr><th colspan="3">Overall Status</th><th>'.$status.'</th></tr>
            </tfoot>
            </table>
            </div>
            </div>
            ';
        }
    } 

    if(isset($_POST['remarkclick'])){

        echo '
        <div class="page-header"><h1><small>Remark`s Zone</small></h1></div>
        <div class="col-lg-8">
        <div class="panel panel-primary">
        <div class="panel-heading">View all the Remark`s</div>
        <table class="table table-bordered table-striped">
        <thead>
        <tr>
        <th>Sno</th>
        <th>From</th>
        <th>Date</th>
        <th>Remark</th>
        </tr>
        </thead><tbody>
        ';
        $sno=1;
        $sql="select `Text`,`FromId`,`Date` from remarks where instituteid='{$userid}' and remarksid in (SELECT `remarksid` FROM `remarkssenderlist` where userid='{$_COOKIE['studentid']}')";
        $res=mysqli_query($con,$sql);
        while($info=mysqli_fetch_array($res)){
            echo '<tr><td>'.$sno.'</td>';
            $sql="select staffname from staffprofile where staffid='{$info['FromId']}'";
            $subres=mysqli_query($con,$sql);
            $sub=mysqli_fetch_array($subres);
            echo'<td>'.$sub[0].'</td><td>'.$info['Date'].'</td><td>'.$info['Text'].'</td></tr>';
            $sno++;
        }
        echo '
        </tbody>
        </table>
        </div>   
        </div>   
        ';



    }     

    /*

    */
?>            