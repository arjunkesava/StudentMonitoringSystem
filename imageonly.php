<?php

    include('head.inc');

    if(isset($_POST['createnonstaffbtn'])){
        /*
        print_r($_FILES);
        
        Array ( 
        [staffname] => efgthbgf 
        [designation] => sdfgb 
        [qualification] => sdfgb 
        [gender] => Male 
        [phonenum] => 12345 
        [mailid] => wdefg 
        [staffexperience] => efg 
        [dob] => 2016-06-02 
        [doj] => 2016-06-02 
        [otherdetails] => sdefvd 
        [addstaff] => Done 
        [createstaffbtn] => true )

        Array ( 
        [staffphoto] => Array ( [name] => female.jpg [type] => image/jpeg [tmp_name] => C:\Users\What the\AppData\Local\Temp\php7D69.tmp [error] => 0 [size] => 14048 ) 
        [curriculum] => Array ( [name] => sms testing pailot data.txt [type] => text/plain [tmp_name] => C:\Users\What the\AppData\Local\Temp\php7D6A.tmp [error] => 0 [size] => 1352 ) )

        */

        $staffphoto=$_FILES['staffphoto'];
        $curriculum=$_FILES['curriculum'];

        $uid=uniqid();
        $pass=md5('Non-Teacher');
        //  InstituteId UserId Ascending MailId Cell Password Type
        $sql="insert into mainlogin values('{$userid}','{$uid}','{$_POST['mailid']}','{$_POST['phonenum']}','{$pass}','Non-Teaching');";
        $res=mysqli_query($con,$sql);
        if($res){
            $staffphotoupload=false;
            $curriculumupload=false;

            if($staffphoto["type"]=='image/jpeg')
                $type='.jpg';
            elseif($staffphoto["type"]=='image/png')
                $type='.png';
            elseif($staffphoto["type"]=='image/gif')
                $type='.gif';

            $imgid=uniqid();
            $target_file ='staffdetails/'.$userid.'/staffphotopath/'.$imgid.$type;
            if (move_uploaded_file($staffphoto["tmp_name"], $target_file)) {
                $staffphotoupload=true;
                $staffphotopath=$target_file;
            }
            

            //jpg,.docx,.pdf,.doc,.txt,.rtf
            //Array ( application/vnd.openxmlformats-officedocument.wordprocessingml.document , application/msword

            if($curriculum["type"]=='image/jpeg')
                $type='.jpg';
            elseif($curriculum["type"]=='application/pdf')
                $type='.pdf';
            elseif($curriculum["type"]=='text/plain')
                $type='.txt';
            elseif($curriculum["type"]=='text/rtf')
                $type='.rtf';
            elseif($curriculum["type"]=='application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                $type='.docx';
            elseif($curriculum["type"]=='application/msword')
                $type='.doc';

            $imgid=uniqid();
            $target_file ='staffdetails/'.$userid.'/curriculumpath/'.$imgid.$type;
            if (move_uploaded_file($curriculum["tmp_name"], $target_file)) {
                $curriculumupload=true;
                $curriculumfilepath=$target_file;
            }
            //  StaffId InstituteId StaffName Designation Qualification StaffPhotoPath CurriculumVitaePath Gender PhoneNum MailId StaffExperience Dob Doj StaffType OtherDetail
            if(($curriculumupload)&&($staffphotoupload)){
                if($_POST['gender']=='Male')    $gender=1;  else    $gender=0;
                $sql="insert into staffprofile values('{$uid}','{$userid}','{$_POST['staffname']}','{$_POST['designation']}','{$_POST['qualification']}','{$staffphotopath}','{$curriculumfilepath}','{$gender}','{$_POST['phonenum']}','{$_POST['mailid']}','{$_POST['staffexperience']}','{$_POST['dob']}','{$_POST['doj']}','Non-Teaching','{$_POST['otherdetails']}');";
                $res=mysqli_query($con,$sql);
                if($res){
                    echo '<p class="well">Congratulations...! The Teacher has been added and an Account has been created with username as <strong>'.$_POST['mailid'].'</strong> and password as <strong>Non-Teacher</strong></p>';
                }else
                    mysqli_query($con,"DELETE from mainlogin where `userid`='{$uid}';");
            }                                    
            else
            {
                mysqli_query($con,"DELETE from mainlogin where `userid`='{$uid}';");
                echo 'staff='.$staffphotoupload.' & cum ='.$curriculumupload;
                echo '<p class="well">Something wrong with the Data. Please refresh the page and try again.</p>';    
            }
        }




    }
    elseif(isset($_POST['createstaffbtn'])){
        /*
        print_r($_FILES);
        
        Array ( 
        [staffname] => efgthbgf 
        [designation] => sdfgb 
        [qualification] => sdfgb 
        [gender] => Male 
        [phonenum] => 12345 
        [mailid] => wdefg 
        [staffexperience] => efg 
        [dob] => 2016-06-02 
        [doj] => 2016-06-02 
        [otherdetails] => sdefvd 
        [addstaff] => Done 
        [createstaffbtn] => true )

        Array ( 
        [staffphoto] => Array ( [name] => female.jpg [type] => image/jpeg [tmp_name] => C:\Users\What the\AppData\Local\Temp\php7D69.tmp [error] => 0 [size] => 14048 ) 
        [curriculum] => Array ( [name] => sms testing pailot data.txt [type] => text/plain [tmp_name] => C:\Users\What the\AppData\Local\Temp\php7D6A.tmp [error] => 0 [size] => 1352 ) )

        */

        $staffphoto=$_FILES['staffphoto'];
        $curriculum=$_FILES['curriculum'];

        $uid=uniqid();
        $pass=md5('Teacher');
        //  InstituteId UserId Ascending MailId Cell Password Type
        $sql="insert into mainlogin values('{$userid}','{$uid}','{$_POST['mailid']}','{$_POST['phonenum']}','{$pass}','Teaching');";
        $res=mysqli_query($con,$sql);
        if($res){
            $staffphotoupload=false;
            $curriculumupload=false;

            if($staffphoto["type"]=='image/jpeg')
                $type='.jpg';
            elseif($staffphoto["type"]=='image/png')
                $type='.png';
            elseif($staffphoto["type"]=='image/gif')
                $type='.gif';

            $imgid=uniqid();
            $target_file ='staffdetails/'.$userid.'/staffphotopath/'.$imgid.$type;
            if (move_uploaded_file($staffphoto["tmp_name"], $target_file)) {
                $staffphotoupload=true;
                $staffphotopath=$target_file;
            }
            

            //jpg,.docx,.pdf,.doc,.txt,.rtf
            //Array ( application/vnd.openxmlformats-officedocument.wordprocessingml.document , application/msword

            if($curriculum["type"]=='image/jpeg')
                $type='.jpg';
            elseif($curriculum["type"]=='application/pdf')
                $type='.pdf';
            elseif($curriculum["type"]=='text/plain')
                $type='.txt';
            elseif($curriculum["type"]=='text/rtf')
                $type='.rtf';
            elseif($curriculum["type"]=='application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                $type='.docx';
            elseif($curriculum["type"]=='application/msword')
                $type='.doc';

            $imgid=uniqid();
            $target_file ='staffdetails/'.$userid.'/curriculumpath/'.$imgid.$type;
            if (move_uploaded_file($curriculum["tmp_name"], $target_file)) {
                $curriculumupload=true;
                $curriculumfilepath=$target_file;
            }
            //  StaffId InstituteId StaffName Designation Qualification StaffPhotoPath CurriculumVitaePath Gender PhoneNum MailId StaffExperience Dob Doj StaffType OtherDetail
            if(($curriculumupload)&&($staffphotoupload)){
                if($_POST['gender']=='Male')    $gender=1;  else    $gender=0;
                $sql="insert into staffprofile values('{$uid}','{$userid}','{$_POST['staffname']}','{$_POST['designation']}','{$_POST['qualification']}','{$staffphotopath}','{$curriculumfilepath}','{$gender}','{$_POST['phonenum']}','{$_POST['mailid']}','{$_POST['staffexperience']}','{$_POST['dob']}','{$_POST['doj']}','Teaching','{$_POST['otherdetails']}');";
                $res=mysqli_query($con,$sql);
                if($res){
                    echo '<p class="well">Congratulations...! The Teacher has been added and an Account has been created with username as <strong>'.$_POST['mailid'].'</strong> and password as <strong>Teacher</strong></p>';
                }else
                    mysqli_query($con,"DELETE from mainlogin where `userid`='{$uid}';");
            }                                    
            else
            {
                mysqli_query($con,"DELETE from mainlogin where `userid`='{$uid}';");
                echo 'staff='.$staffphotoupload.' & cum ='.$curriculumupload;
                echo '<p class="well">Something wrong with the Data. Please refresh the page and try again.</p>';    
            }
        }




    }
    elseif(isset($_POST['createnoticecontentbtn'])){
        $circularfile=$_FILES['circularfile'];
        /*
        print_r($circularfile);
        echo '<br /><br />';
        print_r($_POST);

        echo '<br /><br /><br />';

        print_r($keys);
        */
        $keys=array_keys($_POST);
        $uid=uniqid();


        $circularfileupload=false;
        $type=null;
        if($circularfile["type"]=="image/jpeg")
            $type='.jpg';
        elseif($circularfile["type"]=="application/pdf")
            $type='.pdf';

        $imgid=uniqid();
        $target_file ='circular/'.$userid.'/'.$imgid.$type;
        if (move_uploaded_file($circularfile["tmp_name"], $target_file)) {
            $circularfileupload=true;
        }

        if($circularfileupload){
            $date=date("Y-m-d");
            $sql="INSERT INTO `circular` VALUES ('{$userid}', '{$uid}', '{$_POST['notice']}','{$target_file}', '{$date}', '{$_POST['priority']}', '{$_COOKIE['userid']}');";
            $res=mysqli_query($con,$sql);
            if($res!=FALSE){

                for($i=2;$i<sizeof($keys);$i++)
                {
                    if($keys[$i]=='createnoticesubmitbtn')  continue;
                    if($keys[$i]=='createnoticecontentbtn') continue;

                    if(($keys[$i]=='teaching')||($keys[$i]=='nonteaching')){
                        $sql="select staffid from staffprofile where instituteid='{$userid}';";
                        $res=mysqli_query($con,$sql);
                        while($info=mysqli_fetch_array($res)){
                            $row[$i]=mysqli_query($con,"insert into circularsenderlist values('{$uid}','{$info['staffid']}');");
                        }
                    }                                                         
                    $row[$i]=mysqli_query($con,"insert into circularsenderlist values('{$uid}','{$keys[$i]}');");
                }

                if($row!=FALSE){
                    echo '<div class="row"><div class="col-lg-6"><p class="well">Notice Created Sucessfully</p></div></div>';
                }
                else
                    echo '<div class="row"><div class="col-lg-6"><p class="well">Notice Failed</p></div></div>';

            }
        }

    }
    else
    {

        $studentimg = $_FILES['studentphoto'];
        $photoupload=false;

        /*
        Array ( 
        [name] => Array ( [0] => female.jpg ) 
        [type] => Array ( [0] => image/jpeg ) 
        [tmp_name] => Array ( [0] => C:\wamp\tmp\phpD8FA.tmp ) 
        [error] => Array ( [0] => 0 ) 
        [size] => Array ( [0] => 14048 ) 
        )

        Array ( 
        [studentphoto] => Array ( 
        [name] => Array ( [0] => female.jpg ) 
        [type] => Array ( [0] => image/jpeg ) 
        [tmp_name] => Array ( [0] => C:\wamp\tmp\php288E.tmp ) 
        [error] => Array ( [0] => 0 ) 
        [size] => Array ( [0] => 14048 ) ) )

        Array ( 
        [name] => Array ( [0] => female.jpg ) 
        [type] => Array ( [0] => image/jpeg ) 
        [tmp_name] => Array ( [0] => C:\wamp\tmp\phpA2E7.tmp ) 
        [error] => Array ( [0] => 0 ) 
        [size] => Array ( [0] => 14048 ) ) 
        */
        $classid=trim($_POST['classid']);
        $sectionid=trim($_POST['sectionid']);


        if($classid!=null)
        {
            if($sectionid!=null)
            {

                if($_FILES["studentphoto"]["type"][0]=="image/jpeg")
                    $type='.jpg';
                elseif($_FILES["studentphoto"]["type"][0]=="image/png")
                    $type='.png';

                $uid=uniqid();
                $target_file ='studentphoto/'.$userid.'/'.$uid.$type;
                if (move_uploaded_file($_FILES["studentphoto"]["tmp_name"][0], $target_file)) {
                    $photoupload=true;
                }

                if($photoupload==true){
                    $year=date("Y");
                    if($_POST['gender']=='Male')    $gender=0;
                    else    $gender=1;
                    echo '<script>alert("uid= '.$uid.' & userid= '.$userid.'  & userid= '.$_POST['studentrollno'].'  & userid= '.$_POST['name'].'  & userid= '.$target_file.'  & userid= '.$gender.' & userid= '.$_POST['cell'].' & mail= '.$_POST['mail'].'& dob= '.$_POST['dob'].' & doa= '.$_POST['doa'].'  & doa= '.$_POST['otherdetails'].' & doa= '.$year.' ")</script>';
                    $sql="INSERT INTO `studentprofile` VALUES ('{$uid}','{$userid}', '{$_POST['studentrollno']}',  '{$_POST['name']}',  '{$target_file}',  '{$gender}', '{$_POST['cell']}', '{$_POST['mail']}', '{$_POST['dob']}', '{$_POST['doa']}', '{$_POST['otherdetails']}', '{$year}');";
                    $res=mysqli_query($con,$sql);
                    if($res){
                        $newuid=uniqid();
                        $sql="INSERT INTO `academicdetails` VALUES ('{$newuid}', '{$year}', '{$userid}','{$classid}', '{$sectionid}', '{$uid}');";
                        $subres=mysqli_query($con,$sql);
                        if($subres){
                            echo '
                            <h3> New Student Profile </h3><br />
                            <tr><td><img src="'.$target_file.'" cols="100%" rows="100%" alt="i will pink you"></td></tr>
                            <tr><td></td></tr>
                            <tr><td>Name: <strong>'.ucfirst($_POST['name']).'</strong><br /></td></tr>

                            <tr><td>roll No: <strong>'.$_POST['studentrollno'].'</strong><br /></td></tr>

                            <tr><td>Date Of Birth: <strong>'.$_POST['dob'].'</strong><br /></td></tr>
                            <tr><td>Gender: <strong>'.$gender.'</strong><br /></td></tr>
                            <tr><td>Phone Number: <strong>'.$_POST['cell'].'</strong><br /></td></tr>
                            <tr><td>Mail ID: <strong>'.$_POST['mail'].'</strong><br /></td></tr>
                            <tr><td>Date Of Admission: <strong>'.$_POST['doa'].'</strong><br /></td></tr>
                            <tr><td>Other Details: <strong>'.$_POST['otherdetails'].'</strong><br /></td></tr>
                            <tr><td>Year: <strong>'.$year.'</strong><br /></td></tr>';
                        }
                        else
                        {
                            echo "We Think that Student was Entered. Check Once Again";
                            $sql="delete from studentprofile where studentid='{$uid}'";
                            $res=mysqli_query($con,$sql);
                        }
                    }
                    else{
                        echo "Wrong With the Data you Entered. Try Again";
                    }
                }
                else{
                    echo "Sorry Something Went Wrong";
                }
            }
        }
        else
            echo "Go Back and Select the Class and Section First";

    }        
    /*
    Array ( [studentrollno] => ffd [name] => sdwdf [cell] => -2 [mail] => arjun.kesava@gmail.com [dob] => 2016-05-27 [gender] => Male [studentsubmit] => Add Student )
    */
?>
