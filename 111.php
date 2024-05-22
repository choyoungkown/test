<?php
print_r($_POST);


$stmt = $conn->prepare($sql);
     $stmt->bind_param(":name", $name);
     $stmt->bind_param(":password", $password);
     $stmt->bind_param(":subject", $subject);
     $stmt->bind_param(":content", $content);
     $stmt->bind_param(":imglist", $imglist);
     $stmt->bind_param(":rdate", $rdate);
     $stmt->execute();



    

      //list (,$base64_decode_data) = explode(',', $data);
 
    //$rs_code = base64_decode($base64_decode_data);
    //echo $rs_code;
    //file_put_contents("upload/".$filename, $rs_code);
    
    $img_array[] = "upload/".$filename;
    echo $content;
    $content = str_replace($val, "upload/".$filename, $content);
    echo $content;

    $imglist = implode('|', $img_array);
    echo $imglist;

   //**인덱스 조회 후 그 인덱스를 찾아 imglist만 추가**
   $sql_id= "SELECT * FROM mboard ORDER BY idx DESC limit 1 ";
   $result = mysqli_query($conn, $sql_id);
   $row= mysqli_fetch_object($result);
   $idx= "$row->idx";
   //echo "$idx";

//$sql4= "INSERT INTO mboard (content, imglist, subject) VALUES ('$content', '$imglist', '18') WHERE idx='$idx'";

//$result = mysqli_query($conn, $sql4);

