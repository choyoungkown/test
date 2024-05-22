<?php

require 'dbconfig.php';

$mode = (isset($_POST['mode']) && $_POST['mode'] != '') ?$_POST['mode']: '';
$idx = (isset($_POST['idx']) && $_POST['idx'] != '' && is_numeric($_POST['idx'])) ?$_POST['idx']: '';
$password = (isset($_POST['password']) && $_POST['password'] != '') ?$_POST['password']: '';

 if ($mode == '') {
    $arr= ['result'=> 'empty_mode'];
    die(json_encode($arr)); }
 if ($idx == '') {
    $arr= ['result'=> 'empty_idx'];
    die(json_encode($arr)); }
 if ($password == '') {
    $arr= ['result'=> 'empty_password'];
    die(json_encode($arr)); }

    $sql="SELECT password from mboard WHERE idx=:idx";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
 
    if (password_verify($password, $row['password'])) {
     if ($mode=='delete') {
        $sql="DELETE from mboard WHERE idx=:idx";   
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result); 

        $arr=['result' =>'delete_success']; } 
        
    else if ($mode== "edit") {
       session_start();
       $_SESSION['edit_idx']='edit_success'; }
    else {
        $arr=['result' =>'wrong_password']; }
    die(json_encode($arr));
  }    



  
