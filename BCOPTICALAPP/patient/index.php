<!-- patient index -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/patient.css"> 
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="icon" type="shortcut-icon" href="../img/favicon/home.png">
    <title>Home</title>

    
</head>
<body>
    <?php


    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    

    // database connection
    include("../connection.php");

    // user information to sidebar
    $userrow = $database->query("select * from patient where pemail='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];


    
    ?>
    <!-- sidebar area -->
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username,0,30) ?></p>
                                    <p class="profile-subtitle"><?php echo substr($useremail,0,22) ?></p>
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
                    <td class="menu-btn menu-icon-home menu-active menu-icon-home-active" >
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Home</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor">
                        <a href="doctors.php" class="non-style-link-menu"><div><p class="menu-text">Doctor</p></a></div>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-session">
                        <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">Available Schedule</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">My Appointment</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings">
                        <a href="settings.php" class="non-style-link-menu"><div><p class="menu-text">Settings</p></a></div>
                    </td>
                </tr>
            </table>
        </div>
        <!-- end of sidebar -->

        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
                        
                        <tr >
                            
                            <td colspan="1" class="nav-bar" >
                            <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;">Dashboard</p>
                          
                            </td>
                            <td width="25%">

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



                                $appointmentrow = $database->query("select appointment.appoid,patient.pname,appointment.apponum,appointment.appodate,appointment.appotime, appointment.areason from appointment inner join patient on patient.pid=appointment.pid  where  patient.pid=$userid ");
                                $schedulerow = $database->query("select  * from  schedule where scheduledate;");


                                ?>
                                </p>
                            </td>
                            <td width="10%">
                                <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                            </td>
        
        
                        </tr>
                <tr>
                    <td colspan="4" >
                        
                    <center>
                    <table class="filter-container doctor-header patient-header" style="border: none;width:95%" border="0" >
                    <tr>
                        <td >
                            <h3>Welcome!</h3>
                            <h1><?php echo $username  ?></h1>
                            <p>Haven't any idea about appointment? No problem, let's jump to 
                                <a href="appointment.php" class="non-style-link"><b>"Appointment"</b><br></a> or 
                                <a href="schedule.php" class="non-style-link"><b>"Schedule" section</b>.</a>
                                Track your past and future appointment history.<br>
                            </p>
                        </td>
                    </tr>
                    </table>
                    </center>
                    
                </td>
                </tr>



                
                <tr>
                    <!-- Status area -->
                    <td colspan="4">
                        <table border="0" width="100%"">
                            <tr>
                                <td width="50%">
                                    <center>
                                        <table class="filter-container" style="border: none; " border="0">
                                            <tr>
                                                <td colspan="4">
                                                    <p style="font-size: 20px;font-weight:600;padding:0;padding-left: 12px;">Status</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 25%;">
                                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex">
                                                        <div>
                                                                <div class="h1-dashboard">
                                                                    <?php    echo $appointmentrow->num_rows  ?>
                                                                </div><br>
                                                                <div class="h3-dashboard">
                                                                    Appointment &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                </div>
                                                        </div>
                                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/book-hover.svg');"></div>
                                                    </div>
                                                </td>
                                                <td style="width: 35%;">
                                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex;">
                                                        <div>
                                                                <div class="h1-dashboard">
                                                                    <?php    echo $schedulerow->num_rows  ?>
                                                                </div><br>
                                                                <div class="h3-dashboard">
                                                                    Schedule &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                </div>
                                                        </div>
                                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/session-iceblue.svg');"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </center>
                                </td>
                                <!-- end of status area -->

                                <!-- Your appointment table -->
                                <td>
                                    <p style="font-size: 20px;font-weight:600;padding-left: 40px;" class="anime">Your Appointment</p>
                                    <center>
                                        <div class="abc scroll" style="height: 250px;padding: 0;margin: 0;">
                                        <table width="85%" class="sub-table scrolldown" border="0" >
                                        <thead>
                                            
                                        <tr>
                                        <th class="table-headin">Appointment ID</th>
                                            <th class="table-headin">Date</th> 
                                            <th class="table-headin">Time</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                                // to retreive the appointment of the user
                                                $sqlmain= "select appointment.appoid,patient.pname,appointment.apponum,appointment.appodate,appointment.appotime, appointment.areason from appointment inner join patient on patient.pid=appointment.pid  where  patient.pid=$userid ";
                                            
                                                $result= $database->query($sqlmain);
                
                                                if($result->num_rows==0){
                                                    echo '<tr>
                                                    <td colspan="4">
                                                    <br><br><br><br>
                                                    <center>
                                                    <img src="../img/notfound.svg" width="25%">
                                                    
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Nothing to show here!</p>
                                                    <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Channel a Doctor &nbsp;</font></button>
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
                                                    $appodate=$row["appodate"];
                                                    $appotime=$row["appotime"];
                                                    $formattedTime = date("h:i A", strtotime($appotime));
                                                   
                                                    echo '<tr>
                                                    <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);padding:20px;">
                                                        '.$appoid.'
                                                        </td>
                                                        <td style="text-align:center;">
                                                        '.$appodate.'
                                                        </td>
                                                        <td style="text-align:center;">
                                                        '.$formattedTime.'
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
                            <!-- end of your appointment table -->
                            </tr>
                        </table>
                    </td>
                <tr>
            </table>
        </div>
    </div>


</body>
</html>