<?php
$loi = array(); 
$loi_str="";
if (isset($_POST['username'])){	
if ($_POST['cap']!=$_SESSION['captcha_code']){
  $loi['captcha'] = "<span class='label label-danger'>Ban nhập sai ma so trong hinh</span>";
}else {
  $thanhcong = $t->DangKyThanhVien($loi);
  if ($thanhcong==true) {
  echo "<script>document.location='index.php?p=dangkytc';</script>";
  exit();
  }else foreach($loi as $s) $loi_str = $loi_str . $s . "<br/>";
}
}

?>
<div class="panel panel-default" >
<div class="panel-heading">ĐĂNG KÝ THÀNH VIÊN</div>
<div class="panel-body">
<?php if ($loi_str!="") {?>
<div class="alert alert-danger">  <?=$loi_str?> </div>
<?php }?>
<form class="form-horizontal"  method="POST" action="">
<div class="form-group">
  <label class="control-label col-sm-3" for="username">Tên đăng nhập:</label>
  <div class="col-sm-9">
  <input type="text" class="form-control" id="username" name="username" required placeholder="Tên đăng nhập" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" >
  <span id="kiemtraUN"></span>
  </div>
</div>
<div class="form-group">
   <label class="control-label col-sm-3" for="pass">Mật khẩu:</label>
   <div class="col-sm-9"> 
   <input type="password" class="form-control" id="pass" name="pass" required placeholder="Mật khẩu" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>">
   </div>
</div>
<div class="form-group">
   <label class="control-label col-sm-3" for="repass">Gõ lại Mật khẩu:</label>
   <div class="col-sm-9"> 
   <input type="password" class="form-control" id="repass" name="repass" required placeholder="Mật khẩu" value="<?php if (isset($_POST['repass'])) echo $_POST['repass']; ?>">
   </div>
</div>
<div class="form-group">
   <label class="control-label col-sm-3" for="hoten">Họ tên:</label>
   <div class="col-sm-9">
   <input type="text" class="form-control" id="hoten" name="hoten" required placeholder="Họ tên" value="<?php if (isset($_POST['hoten'])) echo $_POST['hoten']; ?>">
   </div>
</div>
<div class="form-group">
   <label class="control-label col-sm-3" for="email">Email:</label>
   <div class="col-sm-9">
   <input type="email" class="form-control" id="email" name="email" required placeholder="Địa chỉ mail" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
   </div>
</div> 
<div class="form-group">
   <label class="control-label col-sm-3" >Phái:</label>
   <div class="col-sm-9">
   <input type="radio" id="phainam"  value="1" checked name="phai"> Nam &nbsp;
   <input type="radio" id="phainu"  value="0" name="phai"> Nữ
   </div>
</div> 
<div class="form-group">
   <label class="control-label col-sm-3" ></label>
   <div class="col-sm-9">
      <img src="captcha.php" vspace="5"/> <br /> 
      <input name="cap" class="form-control" >
      <?php if (isset($loi['captcha'])) echo $loi['captcha'];?>
   </div>
</div>
<div class="form-group">
   <label class="control-label col-sm-3" ></label>
   <div class="col-sm-9">
   <button type="reset" class="btn btn-default">Xóa</button>
   <button type="submit" class="btn btn-default">Đăng ký</button>
   </div>
</div> 
</form>   
</div>
<div class="panel-footer">Mời bạn nhập đúng các thông tin của mình </div>
</div>
<script>
$(document).ready(function(){ 
	$('#username').blur(function() { 
		$.get(
             'checkun.php' , 
              "username=" + $('#username').val()  , 
		     function (d){  $('#kiemtraUN').html(d); }
		);//$.get
	});
});
</script>


