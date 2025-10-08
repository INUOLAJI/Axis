<?php
session_start();

$servername="localhost";
$username="root";
$password="";
$db_name="my_project";


$conn= new mysqli($servername,$username,$password,$db_name);

function Sanitize($santize){
    $santize=trim($santize);
    $santize=htmlspecialchars($santize);
    $santize=stripslashes($santize);

    return $santize;
}


function u_info($uid,$info){
    $cont=$GLOBALS['conn'];
    $get="SELECT `$info` FROM `signup_biz` WHERE `unique_id`='$uid'";
    $res=$cont->query($get);
    $row=$res->fetch_assoc();
    return $row[$info];
}

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}else{
    
}
?>