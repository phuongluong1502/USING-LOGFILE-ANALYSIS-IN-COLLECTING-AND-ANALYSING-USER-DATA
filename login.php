<?php
$loi=array();
if (isset($_POST['username'])){	
	require_once('class/tin.php');  
	$t= new tin; 	 
	$thanhcong = $t->login($_POST['username'], $_POST['pass'], $loi);
	
	if ($thanhcong==true) {	
		echo "<script>document.location='index.php';</script>";
		exit();
	}	
}
?>
<!doctype html><html><head>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<title>Trang đăng nhập</title><meta charset="utf-8">
</head>
<body>
<div class="container" style="margin-top:100px" >
<div class="col-md-6 col-md-offset-3" >
<div class="panel panel-default" >
<div class="panel-heading"><b>THÀNH VIÊN ĐĂNG NHẬP</b></div>
<div class="panel-body">
<form class="form-horizontal" method="POST" action="" >

<div class="form-group">
<label class="control-label col-sm-3">Tên đăng nhập:</label>
<div class="col-sm-9">
<input type="text" class="form-control" id="username" name="username" placeholder="Tên đăng nhập" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>">	
<?php if (isset($loi['username'])) echo $loi['username']?> 
</div>
</div> 

<div class="form-group">
<label class="control-label col-sm-3">Mật khẩu:</label>
<div class="col-sm-9"> 
<input type="password" class="form-control" id="pass" name="pass"  required placeholder="Mật khẩu" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>">
<?php if (isset($loi['pass'])) echo $loi['pass']?>
</div>
</div>

<div class="form-group">
<label class="control-label col-sm-3" ></label>
<div class="col-sm-9">
<button type="submit" class="btn btn-default">Đăng nhập</button>
</div>
</div> 
</form>
</div>
</div></div></div>
</body></html>
