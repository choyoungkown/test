
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<!-- jquery cdn -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>   
<!-- datatable cdn -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.bootstrap5.min.css">  


</head>

<body>
    
      <div class="container">
    <div  class="mb-4 mt-4">
      <h1 style="text-align: center" class="black-han-sans-regular" >게시글 목록</h1>
      <link href="https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Noto+Sans+KR:wght@100..900&display=swap" rel="stylesheet">
    </div>

     <div class="container mt-6">
    
       <table style="table-layout:fixed" class="table table-bordered table-hover table-striped">         
          <thead class= "text-big-primary text-center table-info">
             <tr>
                <th style="width: 8% ">번호</th>
                <th style="width: 22%">제  목</th>
                <th style="width: 30%">작성한 글</th>
                <th style="width: 10%">작성자</th>
                <th style="width: 12%">등록일</th>
                <th style="width: 10%">이미지</th>
                <th style="width: 8%">조회</th>
            </tr>  
    
<?php
 include "dbconfig.php";
 include "lib.php";

 $limit= 5;
 $page_limit= 5;
 $page=(isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ?$_GET['page'] : 1;
 //$page=$_GET['page'];
 $start=($page-1)*$limit;

 $sql= "SELECT COUNT(*) cnt FROM mboard";
 $result = mysqli_query($conn, $sql); 
 $row = mysqli_fetch_array($result);
 $total=$row['cnt'];
 //echo $total;

  $sql = "SELECT * from mboard ORDER BY idx DESC LIMIT $start, $limit";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_array($result))
  { //print_r($row) ;
    ; ?>
 <tbody table-success> 
  <tr class="view_detail" data-idx="<?=$row['idx'];?>">
    <td style="text-align:center; overflow:hidden;white-space:nowrap;text-overflow:ellipsis; font-size:small"></a><?php echo $row['idx'];?></td>
    <td style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis; font-size:small"><?php echo $row['subject'];?></td>
    <td style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis; font-size:small;"><?php echo $row['content'];?></td>
    <td style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis; font-size:small"><?php echo $row['name'];?></td>
    <td style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis; font-size:small";><?php echo $row['rdate'];?></td>
    <td style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis; font-size:small"><?php echo $row['imglist'];?></td>
    <td style="text-align: center"><?php echo $row['hit'];?></td>
  </tr>  </tbody>  
       
          <?php } ?>
        </table>
 <div>
<?php 
$rs_str= my_pagination($total, $limit, $page_limit, $page);
echo  $rs_str;
?>
 
 <button class="btn btn-primary" id ="btn_write">글쓰기</button>
 </div>
 <script> 
     const btn_write= document.querySelector("#btn_write")
      btn_write.addEventListener("click", ()=> {
        self.location.href='./write.html'
      })

     const view_detail = document.querySelectorAll(".view_detail")
     view_detail.forEach((box) => {
       box.addEventListener("click", ()=> {
       self.location.href='view.php?idx=' + box.dataset.idx
     })
     })

 </script>
    </div>
    </body>
<!-- datatable cdn -->
<!-- <script src="https://cdn.datatables.net/2.0.6/js/dataTables.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/2.0.6/js/dataTables.bootstrap5.min.js"></script> -->
 
<!-- <script>    new DataTable('#example', {    order: [[3, 'desc']]});</script> -->



</html>