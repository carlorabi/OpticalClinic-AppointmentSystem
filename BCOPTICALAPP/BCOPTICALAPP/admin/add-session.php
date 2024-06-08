<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    
    if($_POST){
        //import database
        include("../connection.php");
        $title=$_POST["title"];
        $date=$_POST["date"];
        $time=$_POST["time"];
        $endtime=$_POST["endtime"];


        $sql="insert into schedule (title,scheduledate,scheduletime,endtime) values ('$title','$date','$time','$endtime')";
        $result= $database->query($sql);
        header("location: schedule.php?action=session-added&title=$title");
        
    }


?>