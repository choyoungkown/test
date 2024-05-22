<?php

//include 'upload.php';
include 'dbconfig.php';

 
$writer = (isset($_POST['writer']) && $_POST['writer'] != '') ?$_POST['writer']: '';
$password = (isset($_POST['password']) && $_POST['password'] != '') ?$_POST['password']: '';
$subject = (isset($_POST['subject']) && $_POST['subject'] != '') ?$_POST['subject']: '';
$content = (isset($_POST['content']) && $_POST['content'] != '') ?$_POST['content']: '';
$img_file = (isset($_FILES['img_file']) && $_FILES['img_file'] != '') ?$_FILES['img_file']: '';
//print_r ($img_file) ;
// 업로드한 파일 php에서 보여주기
$upload_dir = "./upload/";
$cnt = count($_FILES['img_file']['name']);
echo $cnt;

// 업로드 폴더(directory)이 없으면
if ( !is_dir($upload_dir) ) {
    mkdir($upload_dir);
}

if ( isset($_FILES['img_file']['name'])) {
    $cnt = count($_FILES['img_file']['name']);

    for ( $i = 0; $i < $cnt; $i++) {
        if ( isset($_FILES['img_file']['name'][$i])
        && $_FILES['img_file']['size'][$i] > 0 ) {
            $filename = $_FILES['img_file']['name'][$i];
            $img_array[] = $filename;
            $target = $upload_dir.$filename;
            $file = $_FILES['img_file']['tmp_name'][$i];}
         if ( !move_uploaded_file($file, $target) ) {
                echo "실패";
                break;
            } else {
                 $imglist = implode(', ', $img_array);  
                 //echo  $imglist;
                //
        }
        }
    }
echo  $imglist;
//$imglis =  $imglist."";

//print_r($img_file) ;
$pwd_hash = password_hash($password, PASSWORD_BCRYPT);
//echo $pwd_hash;

$sql = "INSERT INTO mboard (writer, password, subject, rdate, content)
VALUES ('$writer', '$password', '$subject', NOW(),'$content')";
$result = mysqli_query($conn, $sql); 
 
 
//**인덱스 조회 후 그 인덱스를 찾아 imglist만 추가**
$sql_id= "SELECT * FROM mboard ORDER BY idx DESC limit 1 ";
$result = mysqli_query($conn, $sql_id);
$row= mysqli_fetch_object($result);
$idx= "$row->idx";

 $sql5= "UPDATE mboard SET imglist='$imglist' WHERE idx=$idx";
 $result = mysqli_query($conn, $sql5);

 echo "<script>alert('파일전송과 게시글입력이 정상처리되었습니다!');</script>";
 //mysqli_close($conn);
 
