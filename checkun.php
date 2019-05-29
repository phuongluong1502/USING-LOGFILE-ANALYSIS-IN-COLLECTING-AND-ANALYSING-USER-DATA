<?php 
require_once('class/tin.php');  
$t= new tin; 	 
$username = $_GET['username'];
if ($username == NULL) echo "<span class='label label-warning'>Chưa nhập username</span>"; 
elseif (strlen($username)<3 ) echo " <span class='label label-info'>Username phải >=3 ký tự</span>";
elseif ($t->CheckUsername($username)==false) echo "<span class='label label-danger'>Username đã có người dùng</span>";
else echo "<span class='label label-success'>Bạn có thể dùng tài khoản này</span>";
?>
