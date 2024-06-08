<!-- admin dashboard -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="icon" type="shortcut-icon" href="../img/favicon/dashboard.png">
        
    <title>Dashboard</title>
    <style>
        .dashbord-tables{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
    
    
</head>

<body>
    <?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }
    }else{
        header("location: ../login.php");
    }
    

    //import database
    include("../connection.php");
    $userrow = $database->query("select * from admintbl where aemail='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["a_id"];
    $username=$userfetch["aname"];

    ?>


    <div class="container">
        <!-- sidebar -->
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/adminicon.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                <p class="profile-title"><?php echo substr($username,0,13)  ?>..</p>
                                <p class="profile-subtitle"><?php echo substr($useremail,0,22)  ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active" >
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active">
                            <div><p class="menu-text">Dashboard</p></a></div>
                        </a>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-schedule">
                        <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">Schedule</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">Appointment</p></a></div>
                    </td>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor ">
                        <a href="doctors.php" class="non-style-link-menu "><div><p class="menu-text">Doctors</p></a></div>
                    </td>
                </tr>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="patient.php" class="non-style-link-menu"><div><p class="menu-text">Patients</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings">
                        <a href="admin.php" class="non-style-link-menu"><div><p class="menu-text">Admin</p></a></div>
                    </td>
                </tr>
            </table>
        </div>
        <!-- end of sidebar -->

        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
                <tr >
                        <td colspan="2" class="nav-bar" >
                            </td>
                            <td width="15%">
                                <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                                    Today's Date
                                </p>
                             <p class="heading-sub12" style="padding: 0;margin: 0;">
                                <?php 
                                    date_default_timezone_set('Asia/Manila');
            
                                    $today = date('Y-m-d');
                                    echo $today;


                                    $patientrow = $database->query("select  * from  patient;");
                                    $doctorrow = $database->query("select  * from  doctor;");
                                    $appointmentrow = $database->query("select  * from  appointment;");
                                    $schedulerow = $database->query("select  * from  schedule;");

                                ?>
                            </p>
                            </td>
                            <td width="10%">
                                <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                        </td>        
                </tr>


                <tr>
                    <td colspan="4">
                        
                        <center>
                        <table class="filter-container" style="border: none;" border="0">
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 20px;font-weight:600;padding-left: 12px;">Status</p>
                                </td>
                            </tr>
                            <tr>

                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:30px;margin:auto;width:95%;display: flex;">
                                        <div>
                                                <div class="h1-dashboard">
                                                    <?php    echo $patientrow->num_rows  ?>
                                                </div><br>
                                                <div class="h3-dashboard">
                                                    Patients &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                        </div>
                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/patients-hover.svg');"></div>
                                    </div>
                                </td>

                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:30px;margin:auto;width:95%;display: flex">
                                        <div>
                                                <div class="h1-dashboard">
                                                    <?php    echo $schedulerow->num_rows  ?>
                                                </div><br>
                                                <div class="h3-dashboard">
                                                    Schedule &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                        </div>
                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/schedule-hover.svg');"></div>
                                    </div>
                                </td>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:30px;margin:auto;width:95%;display: flex; ">
                                        <div>
                                                <div class="h1-dashboard" >
                                                    <?php    echo $appointmentrow ->num_rows  ?>
                                                </div><br>
                                                <div class="h3-dashboard" >
                                                    Appointment &nbsp;&nbsp;&nbsp;
                                                </div>
                                        </div>
                                                <div class="btn-icon-back dashboard-icons" style="margin-left: 0px;background-image: url('../img/icons/book-hover.svg');"></div>
                                    </div>
                            </tr>
                        </table>
                    </center>
                    </td>
                </tr>

                <?php
                    if($_POST){
                        //print_r($_POST);
                        $sqlpt1="";
                        if(!empty($_POST["sheduledate"])){
                            $sheduledate=$_POST["sheduledate"];
                            $sqlpt1=" schedule.scheduledate='$sheduledate' ";
                        }


                        $sqlpt2="";
                        if(!empty($_POST["pid"])){
                            $pid=$_POST["pid"];
                            $sqlpt2=" patient.pid=$pid ";
                        }
                        //echo $sqlpt2;
                        //echo $sqlpt1;
                        $sqlmain= "select appointment.appoid,patient.pname,appointment.apponum,appointment.appodate,appointment.appotime,appointment.areason from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid";
                        $sqllist=array($sqlpt1,$sqlpt2);
                        $sqlkeywords=array(" where "," and ");
                        $key2=0;
                        foreach($sqllist as $key){

                            if(!empty($key)){
                                $sqlmain.=$sqlkeywords[$key2].$key;
                                $key2++;
                            };
                        };
                        //echo $sqlmain;

                        
                        
                        //
                    }else{
                        $sqlmain = "SELECT appointment.appoid, patient.pname, appointment.apponum, appointment.appodate, appointment.appotime, appointment.areason FROM appointment INNER JOIN patient ON patient.pid = appointment.pid";

                    }



                ?>
                <!-- appointment table -->
                <tr>
                    <td colspan="4">
                        <table width="100%" border="0" class="dashbord-tables">

                            <tr>
                                <td width="50%">
                                    <center>
                                        <div class="abc scroll" style="height: 200px;">
                                        <table width="93%" class="sub-table scrolldown" border="0">
                                        <thead>
                                        <tr>
                                            <th class="table-headin">Appointment ID</th>
                                            <th class="table-headin">Patient Name</th>
                                            <th class="table-headin">Date</th> 
                                            <th class="table-headin">Time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                            $nextweek=date("Y-m-d",strtotime("+1 week"));
                                            $sqlmain = "SELECT appointment.appoid, patient.pname, appointment.apponum, appointment.appodate, appointment.appotime, appointment.areason FROM appointment INNER JOIN patient ON patient.pid = appointment.pid";
                                                $result= $database->query($sqlmain);
                
                                                if($result->num_rows==0){
                                                    echo '<tr>
                                                    <td colspan="3">
                                                    <br><br><br><br>
                                                    <center>
                                                    <img src="../img/notfound.svg" width="25%">
                                                    
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                                    <a class="non-style-link" href="appointment.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Appointments &nbsp;</font></button>
                                                    </a>
                                                    </center>
                                                    <br><br><br><br>
                                                    </td>
                                                    </tr>';
                                                    
                                                }
                                                else{
                                                    for ( $x=0; $x<$result->num_rows;$x++){
                                                        $row=$result->fetch_assoc();
                                                        $appoid=$row["appoid"];
                                                        $pname=$row["pname"];
                                                        $apponum=$row["apponum"];
                                                        $appodate=$row["appodate"];
                                                        $appotime=$row["appotime"];
                                                        $formattedTime = date("h:i A", strtotime($appotime));
                                                    echo '<tr>


                                                        <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);padding:20px;">
                                                            '.$appoid.'
                                                            
                                                        </td>

                                                        <td style="text-align:center;font-weight:600;"> &nbsp; 
                                                        '.substr($pname,0,25).'
                                                        </td >
 
                                                        <td style="text-align:center;font-weight:600;"> &nbsp;'.
                                                        
                                                        substr($appodate,0,25)
                                                        .'</td >
                                                        <td style="text-align:center;font-weight:600;"> &nbsp;
                                                        '.$formattedTime.'
                                                        </td >
                        

                                                    </tr>';
                                                    
                                                }
                                            }
                                        
                                            ?>
                                            </tbody>
                
                                        </table>
                                        </div>
                                        </center>
                                </td>
                                <!-- end of appointment table -->



                        <!-- schedule table -->
                        <td width="50%" style="padding: 0;">
                        <center>
                        <div class="abc scroll" style="height: 200px;padding: 0;margin: 0;">
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0">
                        <thead>
                        <tr>
                            <th class="table-headin">Schedule Title</th>
                            <th class="table-headin">Date</th>
                            <th class="table-headin">Start Time</th> 
                            <th class="table-headin">End Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                            <?php

                    if($_POST){
                        //print_r($_POST);
                        $sqlpt1="";
                        if(!empty($_POST["sheduledate"])){
                            $sheduledate=$_POST["sheduledate"];
                            $sqlpt1=" schedule.scheduledate='$sheduledate' ";
                        }


                        $sqlmain= "select schedule.scheduleid,schedule.title,schedule.scheduledate,schedule.scheduletime, schedule.endtime";
                        $sqllist=array($sqlpt1,$sqlpt2);
                        $sqlkeywords=array(" where "," and ");
                        $key2=0;
                        foreach($sqllist as $key){

                            if(!empty($key)){
                                $sqlmain.=$sqlkeywords[$key2].$key;
                                $key2++;
                            };
                        };
                        //echo $sqlmain;

    
    
                            //
                     }else{
                        $sqlmain= "select * from schedule order by scheduleid desc";

                        }
                                                        
                                $result= $database->query($sqlmain);

                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Sessions &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{
                                for ( $x=0; $x<$result->num_rows;$x++){
                                    $row=$result->fetch_assoc();
                                    $scheduleid=$row["scheduleid"];
                                    $title=$row["title"];
                                    $scheduledate=$row["scheduledate"];
                                    $scheduletime=$row["scheduletime"];
                                    $endtime=$row["endtime"];
                                    $formattedSTime = date("h:i A", strtotime($scheduletime));
                                    $formattedETime = date("h:i A", strtotime($endtime));
                        

                             echo '<tr>
                                        <td style="text-align:center;font-size:18px;font-weight:500; color: var(--btnnicetext);padding:20px;">
                                        '.substr($title,0,30).'
                                        </td>
                                        <td style="text-align:center;font-weight:600;"> &nbsp; 
                                            '.substr($scheduledate,0,10).'
                                        </td>
                                        <td style="text-align:center;font-weight:600;"> &nbsp; 
                                            '.$formattedSTime.'
                                        </td>
                                        <td style="text-align:center;font-weight:600;"> &nbsp; 
                                            '.$formattedETime.'
                                        </td>

                                    </tr>';
                                    
                                }
                            }

                                ?>
        
                                </tbody>
                
                                </table>
                                </div>
                                </center>
                                </td>
                            </tr>
                            <!-- end of schedule table -->

                    <tr>
                        <td>
                            <center>
                                <a href="appointment.php" class="non-style-link"><button class="btn-primary btn" style="width:85%">Show all Appointments</button></a>
                            </center>
                        </td>
                        <td>
                            <center>
                                <a href="schedule.php" class="non-style-link"><button class="btn-primary btn" style="width:85%">Show all Sessions</button></a>
                            </center>
                        </td>
                    </tr>
                </table>
            </td>

            </tr>
                    </table>
                    </center>
                    </td>
                </tr>
            </table>
        </div>
    </div>


</body>
</html>