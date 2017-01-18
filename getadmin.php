<?php
    include('head.inc');
    
    if(isset($_POST['viewteachingstaffbtn'])){
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

        $sql="SELECT `StaffName`, `Designation`, `Qualification`, `StaffPhotoPath`, `CurriculumVitaePath`, `Gender`, `PhoneNum`, `MailId`, `StaffExperience`, `Dob`, `Doj`,`OtherDetails` FROM `staffprofile` WHERE instituteid='{$userid}' and StaffType='Teaching'";
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
    if(isset($_POST['viewnonteachingstaffbtn'])){
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

        $sql="SELECT `StaffName`, `Designation`, `Qualification`, `StaffPhotoPath`, `CurriculumVitaePath`, `Gender`, `PhoneNum`, `MailId`, `StaffExperience`, `Dob`, `Doj`,`OtherDetails` FROM `staffprofile` WHERE instituteid='{$userid}' and StaffType='Non-Teaching'";
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
    if(isset($_POST['viewnoticeboardbtn'])){
        echo '
        <div class="page-header"><h1><small>Notification & Circulars Zone</small></h1></div>
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

        $year=date("Y");
        $sno=1;
        $sql="select `Text`,`CircularFilePath`,`Date`,`StaffId` from circular where instituteid='{$userid}' and `CircularId` IN (select `CircularId` from circularsenderlist where userid IN (select distinct sectionid from academicdetails where academicyear='{$year}' and instituteid='{$userid}'))";
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
    if(isset($_POST['viewboyshostelbtn'])){
        echo '
        <div class="page-header"><h1><small>Hostel Billings Zone</small></h1></div>
        <div class="col-lg-8">
        <div class="panel panel-primary">
        <div class="panel-heading">View all the Bills paid by Boys of The Hostel</div>
        <table class="table">
        <thead>
        <tr><th>Sno</th>
        <th>Challan No</th>
        <th>Date</th>
        <th>Original Amount</th>
        <th>Amount Paid</th>
        <th>Due Amount</th>
        <th>Paid By</th>
        </tr>
        </thead><tbody>
        ';
        $sno=1;
        $sql="select `StudentId`,`BillId`, `Date`, `AmountPaid`, `OriginalAmount`, `OriginalAmount`-`AmountPaid` as `DueAmount` from billings where instituteid='{$userid}' and billtype='Hostel Bill'";
        $res=mysqli_query($con,$sql);
        while($info=mysqli_fetch_array($res)){
            $sql="Select studentname,studentrollnum from studentprofile where studentid='{$info['StudentId']}' and gender=0";
            $resset=mysqli_query($con,$sql);
            $studentset=mysqli_fetch_array($resset);
            if($studentset){
                echo '<tr><td>'.$sno.'</td><td>'.$info['BillId'].'</td><td>'.$info['Date'].'</td><td>'.$info['OriginalAmount'].'</td><td>'.$info['AmountPaid'].'</td><td>'.$info['DueAmount'].'</td><td title="Student roll number is: '.$studentset['studentrollnum'].'">'.ucfirst($studentset['studentname']).'</td></tr>';
            }
            $sno++;
        }
        echo '
        </tbody>
        </table>
        </div>   
        </div>   
        ';
    }    
    if(isset($_POST['viewgirlshostelbtn'])){
        echo '
        <div class="page-header"><h1><small>Hostel Billings Zone</small></h1></div>
        <div class="col-lg-8">
        <div class="panel panel-primary">
        <div class="panel-heading">View all the Bills paid by Girls of The Hostel</div>
        <table class="table">
        <thead>
        <tr><th>Sno</th>
        <th>Challan No</th>
        <th>Date</th>
        <th>Original Amount</th>
        <th>Amount Paid</th>
        <th>Due Amount</th>
        <th>Paid By</th>
        </tr>
        </thead><tbody>
        ';
        $sno=1;
        $sql="select `StudentId`,`BillId`, `Date`, `AmountPaid`, `OriginalAmount`, `OriginalAmount`-`AmountPaid` as `DueAmount` from billings where instituteid='{$userid}' and billtype='Hostel Bill'";
        $res=mysqli_query($con,$sql);
        while($info=mysqli_fetch_array($res)){
            $sql="Select studentname,studentrollnum from studentprofile where studentid='{$info['StudentId']}' and gender=1";
            $resset=mysqli_query($con,$sql);
            $studentset=mysqli_fetch_array($resset);
            if($studentset){
                echo '<tr><td>'.$sno.'</td><td>'.$info['BillId'].'</td><td>'.$info['Date'].'</td><td>'.$info['OriginalAmount'].'</td><td>'.$info['AmountPaid'].'</td><td>'.$info['DueAmount'].'</td><td title="Student roll number is: '.$studentset['studentrollnum'].'">'.ucfirst($studentset['studentname']).'</td></tr>';
            }
            $sno++;
        }
        echo '
        </tbody>
        </table>
        </div>   
        </div>   
        ';
    }    

    if(isset($_POST['viewbillbtn'])){
        echo '
        <div class="page-header"><h1><small>Billings Zone</small></h1></div>
        <div class="col-lg-12">
        <div class="panel panel-primary">
        <div class="panel-heading">View all the Academic Bills paid by the Students</div>
        <table class="table">
        <thead>
        <tr><th>Sno</th>
        <th>Challan No</th>
        <th>Bill Type</th>
        <th>Date</th>
        <th>Original Amount</th>
        <th>Amount Paid</th>
        <th>Due Amount</th>
        <th>Paid By</th>
        </tr>
        </thead><tbody>
        ';
        $sno=1;
        $sql="select `StudentId`,`BillId`,`BillType`, `Date`, `AmountPaid`, `OriginalAmount`, `OriginalAmount`-`AmountPaid` as `DueAmount` from billings where instituteid='{$userid}' and billtype!='Hostel Bill'";
        $res=mysqli_query($con,$sql);
        while($info=mysqli_fetch_array($res)){
            $sql="Select studentname,studentrollnum from studentprofile where studentid='{$info['StudentId']}'";
            $resset=mysqli_query($con,$sql);
            $studentset=mysqli_fetch_array($resset);
            if($studentset){
                echo '<tr><td>'.$sno.'</td><td>'.$info['BillId'].'</td><td>'.$info['BillType'].'</td><td>'.$info['Date'].'</td><td>'.$info['OriginalAmount'].'</td><td>'.$info['AmountPaid'].'</td><td>'.$info['DueAmount'].'</td><td title="Student roll number is: '.$studentset['studentrollnum'].'">'.ucfirst($studentset['studentname']).'</td></tr>';
            }
            $sno++;
        }
        echo '
        </tbody>
        </table>
        </div>   
        </div>   
        ';
    }    

    if(isset($_POST['viewhome'])){
        $sql="select count(`studentid`) as total from studentprofile where instituteid='{$userid}';";
        $res=mysqli_query($con,$sql);
        $studentcount=mysqli_fetch_array($res);
        echo '
        <div class="row">
        <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
        <div class="panel-heading">
        <div class="row">
        <div class="col-xs-3"></div>
        <div class="col-xs-9 text-right">
        <div class="huge">'.$studentcount['total'].'</div>
        <div>Total Students</div>
        </div>
        </div>
        </div>
        </div>
        </div>';
        $curdate=date("Y-m-d");
        $sql="select count(`studentid`) as total from attendance where date='{$curdate}' and academicid in (select academicid from academicdetails where instituteid='{$userid}');";
        $res=mysqli_query($con,$sql);
        $studentcount=mysqli_fetch_array($res);
        $totattended=$studentcount['total'];
        echo'
        <div class="col-lg-3 col-md-6">
        <div class="panel panel-warning">
        <div class="panel-heading">
        <div class="row">
        <div class="col-xs-3"></div>
        <div class="col-xs-9 text-right">
        <div class="huge">'.$studentcount['total'].'</div>
        <div>Students Attended</div>
        </div>
        </div>
        </div>
        </div>
        </div>';
        $curdate=date("Y-m-d");
        $sql="select count(`studentid`) as total from attendance where date='{$curdate}' and status=1 and academicid in (select academicid from academicdetails where instituteid='{$userid}');";
        $res=mysqli_query($con,$sql);
        $studentcount=mysqli_fetch_array($res);
        $totpresent=$studentcount['total'];
        echo '
        <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
        <div class="panel-heading">
        <div class="row">
        <div class="col-xs-3">
        </div>
        <div class="col-xs-9 text-right">
        <div class="huge">'.$studentcount['total'].'</div>
        <div>Students Present</div>
        </div>
        </div>
        </div>
        </div>
        </div>';
        $totabsent=$totattended-$totpresent;
        echo '
        <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
        <div class="panel-heading">
        <div class="row">
        <div class="col-xs-3">
        </div>
        <div class="col-xs-9 text-right">
        <div class="huge">'.$totabsent.'</div>
        <div>Students Absent</div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <div class="row">
        <div class="col-lg-10">
        <div class="panel panel-primary">
        <div class="panel-heading">
        Attendance Calender
        <div class="pull-right">
        <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm">Previous</button>
        <button type="button" class="btn btn-default btn-sm">Next</button>
        </div>
        </div>
        </div>
        <div class="panel-body">
        <table class="table table-bordered table-striped" cellspacing="500px" cellpadding="1000px">
        <thead>
        <tr>
        <th colspan="7">
        <span class="btn-group">
        <p style="margin-left: 48px;">February 2012</p>
        </span>
        </th>
        </tr>
        <tr>
        <th>Su</th>
        <th>Mo</th>
        <th>Tu</th>
        <th>We</th>
        <th>Th</th>
        <th>Fr</th>
        <th>Sa</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td class="disabled">29</td>
        <td class="disabled">30</td>
        <td class="muted">31</td>
        <td>1</td>
        <td>2</td>
        <td>3</td>
        <td class="btn-warning"><strong>4</strong></td>
        </tr>
        <tr>
        <td class="btn-danger"><strong>5</strong></td>
        <td>6</td>
        <td>7</td>
        <td class="btn-success"><strong>8</strong></td>
        <td>9</td>
        <td>10</td>
        <td class="btn-warning"><strong>11</strong></td>
        </tr>
        <tr>
        <td class="btn-danger"><strong>12</strong></td>
        <td>13</td>
        <td>14</td>
        <td>15</td>
        <td>16</td>
        <td>17</td>
        <td class="btn-warning"><strong>18</strong></td>
        </tr>
        <tr>
        <td class="btn-danger"><strong>12</strong></td>
        <td class="btn-success"><strong>20</strong></td>
        <td>21</td>
        <td>22</td>
        <td>23</td>
        <td>24</td>
        <td class="btn-warning"><strong>25</strong></td>
        </tr>                                                   
        <tr>
        <td class="btn-danger"><strong>26</strong></td>
        <td>27</td>
        <td>28</td>
        <td>29</td>
        <td class="muted">1</td>
        <td class="muted">2</td>
        <td class="muted"><strong>3</strong></td>
        </tr>
        </tbody>
        </table>
        </div> 
        </div>
        </div>';

        /*   echo '
        <div class="col-lg-2 col-md-6">
        <div class="panel panel-info">
        <div class="panel-heading">
        <div class="row">
        <div class="col-xs-3">
        </div>
        <div class="col-xs-9 text-right">
        <div class="huge">1400</div>
        <div>Total List of Students</div>
        </div>
        </div>
        </div>
        </div>
        <div class="panel panel-green">
        <div class="panel-heading">
        <div class="row">
        <div class="col-xs-3">
        </div>
        <div class="col-xs-9 text-right">
        <div class="huge">114</div>
        <div>Students Absent Today</div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>';    */

        echo '
        <div class="row">
        <div class="col-lg-10">
        <div class="panel panel-default">
        <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> Area Chart Example
        <div class="pull-right">
        <div class="btn-group">
        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
        Actions
        <span class="caret"></span>
        </button>
        <ul class="dropdown-menu pull-right" role="menu">
        <li><a href="#">Action</a>
        </li>
        <li><a href="#">Another action</a>
        </li>
        <li><a href="#">Something else here</a>
        </li>
        <li class="divider"></li>
        <li><a href="#">Separated link</a>
        </li>
        </ul>
        </div>
        </div>
        </div>

        <div class="panel-body">
        <div id="morris-area-chart"></div>
        </div>

        </div>


        </div>



        </div>
        ';
    }    

?>