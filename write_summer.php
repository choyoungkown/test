<?php

include 'dbconfig.php';

print_r($_POST);

$name = (isset($_POST['name']) && $_POST['name'] != '') ?$_POST['name']: '';
$password = (isset($_POST['password']) && $_POST['password'] != '') ?$_POST['password']: '';
$subject = (isset($_POST['subject']) && $_POST['subject'] != '') ?$_POST['subject']: '';
$content = (isset($_POST['content']) && $_POST['content'] != '') ?$_POST['content']: '';
//$name = $_POST['name'];
//$password =$_POST['password'];
//$subject = $_POST['subject'];
//$content = $_POST['content'];

//$content = str_replace('</P>','',$content);

$pwd_hash = password_hash($password, PASSWORD_BCRYPT);
//echo $pwd_hash;


$sql = "INSERT INTO mboard (name, password, subject, rdate, content)
VALUES ('$name', '$password', '$subject', NOW(),'$content')";
$result = mysqli_query($conn, $sql); 


$sql2 ="UPDATE mboard SET content = REPLACE(content,'<p>','' )";
$sql3 ="UPDATE mboard SET content = REPLACE(content,'</p>','' )";
  $result = mysqli_query($conn, $sql2); 
  $result = mysqli_query($conn, $sql3); 
 

preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $content, $matches);
 
foreach($matches[1] AS $key => $val) {
   
    list ($type, $data) = explode(';', $val);
    list (,$ext)= explode('/', $type);
    $ext = ($ext == 'jpeg') ? 'jpg': $ext;
    date_default_timezone_set('Asia/Seoul');
    $filename = date('ymdHis').'_'.$key.'.'.$ext;
    //echo $filename;
    list (,$base64_decode_data) = explode(',', $data);
 
    $rs_code = base64_decode($base64_decode_data);
    //echo $rs_code;
    file_put_contents($filename, $rs_code);

    $img_array[] = $filename;
    
}
if (empty($img_array)) {
    //echo 'No Image';
} else {
    $imglist = implode(', ', $img_array);

    //**인덱스 조회 후 그 인덱스를 찾아 imglist만 추가**
   $sql_id= "SELECT * FROM mboard ORDER BY idx DESC limit 1 ";
   $result = mysqli_query($conn, $sql_id);
   $row= mysqli_fetch_object($result);
   $idx= "$row->idx";
  
$sql_cut1= "SELECT SUBSTRING_INDEX(content, '<img', -1) FROM mboard WHERE idx=$idx";
$result2 = mysqli_query($conn, $sql_cut1);
$row2 = mysqli_fetch_array($result2);


$sql_cut2 ="UPDATE mboard SET content = REPLACE(content,'$row2[0]', '' ) WHERE idx=$idx";
 $result = mysqli_query($conn, $sql_cut2); 
 $sql4 ="UPDATE mboard SET content = REPLACE(content,'<img','' ) WHERE idx=$idx";
 $result = mysqli_query($conn, $sql4); 

 $sql2 ="UPDATE mboard SET content = REPLACE(content,'<p>','' )";
 $sql3 ="UPDATE mboard SET content = REPLACE(content,'</p>','' )";

  $result = mysqli_query($conn, $sql2); 
  $result = mysqli_query($conn, $sql3); 


 $sql5= "UPDATE mboard SET imglist='$imglist' WHERE idx=$idx";
 $result = mysqli_query($conn, $sql5);

 //mysqli_close($conn);
 
}

    
   
    
   