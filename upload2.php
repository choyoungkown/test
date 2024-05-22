<?php
$img_file = (isset($_FILES['img_file']) && $_FILES['img_file'] != '') ?$_FILES['img_file']: '';
//print_r($img_file) ;
// 업로드한 파일 php에서 보여주기
$upload_dir = "./upload/";

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
                
                echo "<script>alert('사진업로드준비완료!');</script>";
        }
        }
    }
echo  $imglist;
$imglis =  $imglist."";