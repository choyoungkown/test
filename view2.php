<html lang="en">

<head>
   
  <meta charset="UTF-8">

  <div class="container">
    <div class="mb-2 mt-4">
      <h2>글수정 화면</h2>
    </div>
    
    <script
  src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
  integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8="
  crossorigin="anonymous"></script>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
      integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
      crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    
</head>
<?php include "dbconfig.php";
      $idx = (isset($_POST['idx']) && $_POST['idx'] != '' && is_numeric($_POST['idx'])) ?$_POST['idx']: '';
 //if ($idx == '') {
    //exit('비정상적인 접근');  }
       
    $sql= "SELECT * FROM mboard WHERE idx=idx" ;
    $result = mysqli_query($conn, $sql); 
    $row = mysqli_fetch_assoc($result);
    //print_r($row) ;
    //$stmt = $conn->prepare($sql) ;
    //$stmt->bind_param(":idx", $idx) ;
    //$stmt->execute() ;
    //$stmt->setFetchMode(PDO::FETCH_ASSOC);  
    //$row= $stmt->fetch() ;
?>

<script>const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})</script>

<body>


  <form action="write.php" method="post">
  <div class="mb-2">

    <div class="mb-2"><input type="text" name="name" id="id_name" value="<?php echo $row['name'];?>">
      <input type="password" name="password" id="id_password" placeholder="비밀번호" value="<?php echo $row['password'];?>" autocomplete="off">
    </div>
    <div class="mb-2">
      <input type="text" class="form-control" id="id_subject" value="<?php echo $row['subject'];?>">

      <div id="summernote"></div>

    </form>

    <?php echo "아래에 이미지가 출력됩니다.<br/>"; echo "<img src='240507091433_0.jpg'/>";?> 

    
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

         
      var markupStr ='<?php echo $row['content']; echo $row['imglist']; ?>'
     $('#summernote').summernote('code', markupStr);
    </script>

      <div class="mt-2  d-flex justify-content-end ">
        <button type="button" class="btn btn-primary mr-3" id="btn_submit">수정</button>
             
        <button type="button" class="btn btn-danger" id="btn_delete">삭제</button>


 <!-- 비밀번호 확인에 활용
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Open modal for @getbootstrap</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div> -->


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