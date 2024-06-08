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
        $pid=$_POST["pid"];
        $areason=$_POST["areason"];
        $date=$_POST["date"];
        $time=$_POST["time"];


        $sql="insert into appointment (pid,appodate,appotime, areason) values ($pid,'$date','$time','$areason');";
        $result= $database->query($sql);
        header("location: appointment.php?action=session-added&title=$title");
        
    }


?>