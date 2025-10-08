<?php
require_once 'db_conn/conn.php';
if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['signup'])){
    $fname=Sanitize($_POST['fname']);
    $email=Sanitize($_POST['email']);
    $pword=Sanitize(md5($_POST['pword']));
    $cword=Sanitize(md5($_POST['cword']));
    $uid=uniqid();
    if($pword!==$cword){
        echo "<script>
        alert('Password doesn't match Confirm Password');
        window.location='navbar.php?showsignup=1';
        </script>";
    }else{
        $check1="SELECT `id` FROM `signup_biz` WHERE `fname`='$fname'";
        $cc1=$conn->query($check1);
        $check2="SELECT `id` FROM `signup_biz` WHERE `email`='$email'";
        $cc2=$conn->query($check2);

        if($cc1->num_rows>0){
            echo "<script>
            alert('User with $fname already exist');
            window.location='navbar.php';
            </script>";
        }else if($cc2->num_rows>0){
            echo "<script>
            alert('User with $email already exist');
            window.location='navbar.php';
            </script>";
        }else{
            $ins="INSERT INTO `signup_biz`(`uniqid`,`fname`, `email`, `password`) VALUES ('$uid','$fname','$email','$pword')";
            if($conn->query($ins)){
                echo "<script>
                alert('Account Created Successfully go back to login page to sign in');
                window.location='navbar.php?showlogin=1';
                </script>";
            }
        }

    }
}


?>