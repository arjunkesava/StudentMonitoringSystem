<html>
    <head>
        <title>Forgot Password</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-3"><img src="smslogo.png" alt="" width="100%" height="25%"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-head">Forgot Password</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p class="well">Don`t Worry. We are here to Serve you. Tell your mail address to us. We will send password to your mail.</p>
                </div>
            </div>
            <form action="forget.php" method="get">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">Enter Mail Address: </span>
                            <input type="mail" class="form-control" placeholder="Enter your Mail Address" name="mail" id="mail" required="required">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <input type="submit" class="btn btn-success" name="mailcheck" id="mailcheck">
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-lg-12"><p><?php
                            if(isset($_GET['mailcheck']))
                            {
                                $data=$_GET['mail'];
                                if(preg_match("/^\S+@\S+\.\S+$/","$data"))
                                {
                                    $con=mysqli_connect("localhost","smssystem","tiger","sms_system");
                                    // Check connection
                                    if (mysqli_connect_errno())
                                    {
                                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                    }

                                    $sql="select parentname from parentstudentdata where mail='{$_GET['mail']}'";

                                    if ($result=mysqli_query($con,$sql))
                                    {
                                        // Fetch one and one row
                                        while ($row=mysqli_fetch_row($result))
                                        {
                                            $newpass=rand(100000,9999999);
                                            $pass=md5($newpass);
                                            $usql="UPDATE ``.`parentstudentdata` SET `password` = '{$pass}' where mail = '{$_GET['mail']}'";

                                            if($upres=mysqli_query($con,$usql))
                                            {
                                                $to = $_GET['mail'];
                                                $subject = "Forget Password on Student Monitoring System";

                                                $message = "
                                                <html>
                                                <head>
                                                <title>Forgot Password</title>
                                                </head>
                                                <body>
                                                <p>Hai '{$row[0]}'.</p>
                                                <div class='container'>
                                                <div class='row'>
                                                <div class='col-lg-8'>                 
                                                     Mail Address: <span style='color: red'> '{$to}' </span>
                                                </div>
                                                </div>
                                                <div class='row'>
                                                <div class='col-lg-8'>
                                                     New Password: <span style='color: red'> '{$newpass}' </span>
                                                </div>
                                                </div>
                                                
                                                <div class='row'>
                                                <div class='col-lg-8'>
                                                     <p>SMS System. All rights reserved</p>
                                                </div>
                                                </div>
                                                
                                                </div>
                                                </body>
                                                </html>
                                                ";

                                                // Always set content-type when sending HTML email
                                                $headers = "MIME-Version: 1.0" . "\r\n";
                                                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                                                // More headers
                                                $headers .= 'From: <admin@studentmonitoringsystem.in>' . "\r\n";
                                                $headers .= 'Cc: admin@studentmonitoringsystem.in' . "\r\n";

                                                $status=mail($to,$subject,$message,$headers);

                                                if($status)
                                                echo "We had Changed your password Mr. '{$row[0]}'  Please check your mail: '{$_GET['mail']}'";
                                            }
                                            else
                                            {
                                                echo'<script>alert("We are sorry to say this. The mail address wont match any of the records. Try Again")</script>'; 
                                            }
                                        }
                                        // Free result set
                                        mysqli_free_result($result);
                                    }
                                    mysqli_close($con);
                                }
                                else    
                                    echo'<script>alert("Please enter a Valid Mail Address")</script>'; 
                            }

                        ?>
                    </p></div>
            </div>
        </div>
    </body>
</html>
