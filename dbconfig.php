 <?php

 $servername = "localhost";
 $username = "root";
 $passsword = "";
 $database = "test";


$conn = mysqli_connect($servername, $username, $passsword, $database);

if( empty( $conn ) == true ) {
        echo ( "</br> default DBMS 접속 호스트 정보가 정확하지 않습니다. </br>\n\n" );

        exit ( "#############################################################################" );
}
 else {

        //echo ( "</br> default DBMS 접속에 성공하였습니다. </br>\n\n" );

        
        //print_r ( $conn );

        //echo ( "</pre>" );

        


}
  

