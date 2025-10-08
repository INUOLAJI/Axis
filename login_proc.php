<?php
require_once 'db_conn/conn.php';

if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['login'])){
    $email=Sanitize($_POST['email']);
    $verify_password=Sanitize(md5($_POST['pword']));

    $sel_info="SELECT `uniqid` FROM `signup_biz` WHERE `password`='$verify_password' AND `email`='$email'";
    $result=$conn->query($sel_info);
    if($result->num_rows>0){
        $row=$result->fetch_assoc();
        $_SESSION['uid']=$row['uniqid'];
        header('location:navbar.php');
    }else{
        echo "<script>
        alert('Incorrect Password or Email');
        window.location='navbar.php?showlogin=1';
        </script>";
    }
}
?>