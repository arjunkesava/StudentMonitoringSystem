 <!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMS Login</title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="" />
        <!-- Bootstrap -->
        <script src="js/modernizr.custom.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/jquery.fancybox.css" rel="stylesheet">
        <link href="css/flickity.css" rel="stylesheet" >
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/queries.css" rel="stylesheet">
        <!-- Facebook and Twitter integration -->
        <meta property="og:title" content=""/>
        <meta property="og:image" content=""/>
        <meta property="og:url" content=""/>
        <meta property="og:site_name" content=""/>
        <meta property="og:description" content=""/>
        <meta name="twitter:title" content="" />
        <meta name="twitter:image" content="" />
        <meta name="twitter:url" content="" />
        <meta name="twitter:card" content="" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- open/close -->
        <header>
            <section class="hero2">
                <div class="container">
                    <div class="row" align="center">
                        <img src="smslogo.png" alt="" class="login-page">
                        <h2><p align="center">Welcome to <?php
                                    if(isset($_GET['admin'])){echo "Adminstrator`s"; $_GLOBALS['type']="admin";}
                                    elseif(isset($_GET['faculty'])){echo "Faculty`s"; $_GLOBALS['type']="faculty";}
                                    elseif(isset($_GET['parent'])){echo "Parent`s"; $_GLOBALS['type']="parent";}
                                ?> Login Form</p></h2>
                        <div class="form" id="login">
                            <form class="login-form" method="post">
                                <input type="text" hidden="hidden" name="rtype" value="<?php echo $_GLOBALS['type'];?>">
                                <input type="text" placeholder="Cell Number or Email" name="data"/>
                                <input type="password" placeholder="Password" name="password"/>
                                <input type="submit" class="submit" name="submit"value="login">
                                <p class="message">Forgot Password? <a href="forget.php">Click Here</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?if(isset($_GET['parent'])){?>New <strong><a href="pages/parentregister.php">Sign Up</a></strong></p><?}?> 
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </header>


        <script src="js/min/toucheffects-min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="js/flickity.pkgd.min.js"></script>
        <script src="js/jquery.fancybox.pack.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/retina.js"></script>
        <script src="js/waypoints.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/min/scripts-min.js"></script>
    </body>
</html>
<?php
    error_reporting(0);
    if(isset($_POST['submit'])){
        $con=mysqli_connect("localhost","smssystem","tiger","sms_testing_total");
        // Check connection
        if (mysqli_connect_errno())
            die("Failed to connect to MySQL: " . mysqli_connect_error());

        $md=md5($_POST['password']);
        $data=$_POST['data'];
        if(preg_match("/^\d{10}$/","$data"))            $utype="num";
        elseif(preg_match("/^\S+@\S+\.\S+$/","$data"))  $utype="mail";
        else                                            echo'<script>alert("Please enter a Valid Phone Number or Mail Address")</script>'; 

        //if($_POST['rtype']=="parent")

        if($utype=="num")
            $sql="select instituteid,userid,password,type from mainlogin where cell='{$data}'";
        if($utype=="mail")
            $sql="select instituteid,userid,password,type from mainlogin where mailid='{$data}'";

        if ($result=mysqli_query($con,$sql))
        {
            // Fetch one and one row
            if ($row=mysqli_fetch_row($result))
            {
                //if(($row[0]==null) and ($row[1]==null) and ($row[2]==null)) echo '<script>alert("Invalid Details. Try Again");</script>';
                if($row[2]==$md)    // checks pass word.
                {
                    setcookie("instituteid",$row[0],time()+(86400*30),"/");
                    setcookie("userid",$row[1],time()+(86400*30),"/");
                    setcookie("password",$row[2],time()+(86400*30),"/");
                    setcookie("type",$row[3],time()+(86400*30),"/");

                    if((strtoupper($row[3])=="STUDENT")||(strtoupper($row[3])=="PARENT"))
                    {
                        $sql="select studentid from parentprofile where parentid='{$_COOKIE['userid']}'";
                        $res=mysqli_query($con,$sql);
                        $info=mysqli_fetch_row($res);
                        $studentid=$info[0];

                        if(!$studentid){
                            echo'<script>window.location.assign("logout.php")</script>';
                        }
                        else
                            setcookie("studentid",$studentid,time()+(86400*30),"/");
                        echo'<script>window.location.assign("parentdashboard.php")</script>';
                    }

                    if(strtoupper($row[3])=="TEACHING")
                        echo'<script>window.location.assign("teachingstaff.php")</script>';
                    if(strtoupper($row[3])=="NON-TEACHING")
                        echo'<script>window.location.assign("nonteachingstaff.php")</script>';
                    if(strtoupper($row[3])=="PRINCIPAL")
                        echo'<script>window.location.assign("admin.php")</script>';


                    // alert("Welcome Mr. '.$row[1].' ur id= '.$row[0].'"); 
                }
                else
                    echo '<script>alert("Invalid Password. Try Again");</script>';

            }
            else
                echo '<script>alert("Invalid Mail Address. Try Again");</script>';
            // Free result set
            mysqli_free_result($result);
        }

        mysqli_close($con);
    }
?>