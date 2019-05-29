<?php require_once "class/tin.php"; $t = new tin;
      $sorecord = $t->DanhDauKichHoatUser($_GET['id'], $_GET['rd']);
?>
<!doctype html><html><head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<title>Kích hoạt tài khoản</title>
</head><body>
<div class="panel panel-default text-center text-uppercase" style="width:60%; margin:50px auto">
  <div class="panel-heading"><b>Kích hoạt tài khoản</b></div>
  <div class="panel-body">
     <?php if ($sorecord>0) { ?>
       <div class="alert alert-success">
         Đã kích hoạt xong tài khoản.<br/>
         Mời bạn <a href=login.php> nhắp vào đây</a> để đăng nhập
       </div>
     <?php } else { ?>
       <div class="alert alert-info">
         Bạn đã kích hoạt tài khoản rồi<br/>Không cần kích hoạt nữa<br/><br/>
         <a href="index.php">Về trang chủ</a>
         </div>
     <?php } ?>
   </div>
</div>
</body></html>
