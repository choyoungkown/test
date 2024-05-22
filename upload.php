<?php

$img_file = (isset($_FILES['img_file']) && $_FILES['img_file'] != '') ?$_FILES['img_file']: '';
//print_r($img_file) ;
// 업로드한 파일 php에서 보여주기
$upload_dir = "./upload/";
$cnt = count($_FILES['img_file']['name']);
for ( $i = 0; $i < $cnt; $i++) {
    $target=$upload_dir.basename($_FILES['img_file']['name'][$i]);
    $ext =pathinfo($upload_dir, PATHINFO_EXTENSION);
    $filename=basename($target,"$ext");


}
echo $filename;