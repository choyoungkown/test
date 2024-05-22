
<script>const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})
</script>
<!DOCTYPE html>
<html lang="en">
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>


      <?php include "dbconfig.php";
      $idx = (isset($_POST['idx']) && $_POST['idx'] != '' && is_numeric($_POST['idx'])) ?$_POST['idx']: '';
 //if ($idx == '') {
    //exit('비정상적인 접근');  }
       
    $sql= "SELECT * FROM mboard WHERE idx=idx" ;
    $result = mysqli_query($conn, $sql); 
    $row = mysqli_fetch_assoc($result);
    print_r($row) ;
    //$stmt = $conn->prepare($sql) ;
    //$stmt->bind_param(":idx", $idx) ;
    //$stmt->execute() ;
    //$stmt->setFetchMode(PDO::FETCH_ASSOC);  
    //$row= $stmt->fetch() ;
?>


    <title>Document</title>
</head>
<body>
    
    <h1 class="h1">자유게시판</h1>
     <div class="container border border-1 w-50 vstack"></div>
    <div class="p-3">
        <span class="hw fw-bolder"><?php echo $row['subject'];?></span> 
        <span><?php echo $row['name'];?></span> 
        <span class="mt-5 me AUTO"><?php echo $row['hit'];?></span>
        <span><?php echo $row['rdate'];?></span>
    </div>
 
 
    <form action="write.php" method="post">
  <div class="mb-2">

    <div class="mb-2"><input type="text" name="name" id="id_name" placeholder="글쓴이">
      <input type="password" name="password" id="id_password" placeholder="비밀번호" autocomplete="off">
    </div>
    <div class="mb-2">
      <input type="text" class="form-control" id="id_subject" placeholder="제목을 입력하세요">

      <div id="summernote"></div>

    </form>

      <script>
      $('#summernote').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 300,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
    </script>

<div class="mt-2  d-flex justify-content-end ">
        <button type="button" class="btn btn-primary mr-3" id="btn_submit">확인</button>
        <button type="button" class="btn btn-danger" id="btn_delete">삭제</button>
      </div>
    
      <script>
        const btn_submit = document.querySelector('#btn_submit')
        btn_submit.addEventListener("click", () => {
          const id_name = document.querySelector('#id_name')
          const id_password = document.querySelector('#id_password')
          const id_subject = document.querySelector('#id_subject')
          if (id_name.value == '') {
            alert('이름을 입력하세요')
            id_name.focus()
            return false
          }
          if (id_password.value == '') {
            alert('비밀번호를 입력하세요')
            btn_password.focus()
            return false
          }
          if (id_subject.value == '') {
            alert('제목을 입력하세요')
            id_subject.focus()
            return false
          }

          const markupStr = $('#summernote').summernote('code');
          if (markupStr == '<p><br></p>') {
            alert('내용을 입력하세요')
            btn_name.focus()
            return false
          }

        const f1 = new FormData()
           f1.append('name', id_name.value)
           f1.append('password', id_password.value)
           f1.append('subject', id_subject.value)
           f1.append('content', markupStr)

        const xhr = new XMLHttpRequest()
           xhr.open("POST", "write.php", "true")
           xhr.send(f1)
           btn_submit.disabled = true
           xhr.onload = () => {
            if (xhr.status == 200) {
              alert ('글이 정상적으로 입력되었습니다.')
            }
            else {
              alert (xhr.status + ' 통신실패')

            }
           }



        })

      </script>
      
    </body>







</html>