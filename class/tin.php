<?php 
require_once "class/goc.php";
class tin extends goc{
	function TinMoi($sotin){
		$sql="SELECT idTin,TieuDe,Ngay,TomTat, urlHinh, loaitin.Ten as TenLT , TieuDe_KhongDau
		 FROM tin, loaitin
		  WHERE tin.idLT = loaitin.idLT AND tin.AnHien=1 and tin.lang='vi' 
		 ORDER BY idTin DESC LIMIT 0, $sotin";
		$kq = $this->db->query($sql);
		if(!$kq) die( $this-> db->error);
		return $kq;
	}//TinMoi
	function TinNoiBat($sotin){
		$sql="SELECT idTin,TieuDe,Ngay,TomTat, urlHinh, loaitin.Ten as TenLT, TieuDe_KhongDau
		 FROM tin, loaitin  WHERE tin.idLT = loaitin.idLT 
		 AND tin.AnHien=1 and tin.lang='vi' AND TinNoiBat=1
		 ORDER BY idTin DESC LIMIT 0, $sotin";
		$kq = $this->db->query($sql);
		if(!$kq) die( $this-> db->error);
		return $kq;
	}//TinNoiBat
	function TinXemNhieu($sotin){
		$sql="SELECT idTin,TieuDe,Ngay,TomTat, urlHinh, loaitin.Ten as TenLT, TieuDe_KhongDau
		 FROM tin, loaitin
		  WHERE tin.idLT = loaitin.idLT AND tin.AnHien=1 and tin.lang='vi' 
		 ORDER BY SoLanXem DESC LIMIT 0, $sotin";
		$kq = $this->db->query($sql);
		if(!$kq) die( $this-> db->error);
		return $kq;
	}//TinXemNhieu
	function TinNgauNhien($sotin){
		$sql="SELECT idTin,TieuDe,Ngay,TomTat, urlHinh, loaitin.Ten as TenLT, TieuDe_KhongDau
		 FROM tin, loaitin
		  WHERE tin.idLT = loaitin.idLT AND tin.AnHien=1 and tin.lang='vi' 
		 ORDER BY RAND() LIMIT 0, $sotin";
		$kq = $this->db->query($sql);
		if(!$kq) die( $this-> db->error);
		return $kq;
	}//TinNgauNhien
	function ListTheLoai(){
		$sql="SELECT idTL, TenTL  FROM theloai
		  WHERE AnHien=1 and lang='vi' ORDER BY ThuTu ";
		$kq = $this->db->query($sql);
		if(!$kq) die( $this-> db->error);
		return $kq;
	}//ListTheLoai
	function ListLoaiTinTrong1TheLoai ($idTL){
		$sql="SELECT idLT, Ten, Ten_KhongDau  FROM loaitin
		  WHERE AnHien=1 and idTL=$idTL ORDER BY ThuTu ";
		$kq = $this->db->query($sql);
		if(!$kq) die( $this-> db->error);
		return $kq;
	}//ListLoaiTinTrong1TheLoai
	function ChiTietTin($idTin)  {
		settype($idTin, "int");
		$sql="SELECT idTin, TieuDe, TomTat, Ngay, urlHinh, Content, SoLanXem, 
		tin.idLT, Ten, tin.idTL, TenTL
		FROM  tin, loaitin, theloai
		WHERE tin.idLT=loaitin.idLT  AND loaitin.idTL=theloai.idTL AND idTin=$idTin";
		$kq = $this->db-> query($sql);
	if(!$kq) die( $this-> db->error);
		return $kq; 
	}//ChiTietTin
	function CapNhatSolanXemTin($idTin){
		settype($idTin,"int");
		$sql = "UPDATE tin SET SolanXem = SoLanXem+1 WHERE idTin = $idTin";
		$this->db->query($sql);    
	}//CapNhatSolanXemTin
	function TinCuCungLoai($idTin, $sotin = 5){		
		$sql="SELECT idTin, TieuDe, TomTat, urlHinh, Ngay, SoLanXem, TieuDe_KhongDau  FROM  tin 
		WHERE AnHien = 1 AND idTin<$idTin AND  lang ='vi' 
		AND idLT = (SELECT idLT FROM tin WHERE idTin = $idTin)
		ORDER BY idTin DESC  LIMIT 0, $sotin";		
		$kq = $this->db-> query($sql);
		if(!$kq) die( $this-> db->error);
		return $kq;	
	}//TinCuCungLoai
	function TinTrongLoai($idLT ,$pageNum, $pageSize,&$totalRows ){
	   $startRow = ($pageNum-1)*$pageSize;
	   $sql="SELECT idTin, TieuDe, TomTat, urlHinh, Ngay, SoLanXem, TieuDe_KhongDau
	   FROM  tin  WHERE AnHien = 1 AND idLT=$idLT 
	   ORDER BY idTin DESC LIMIT $startRow , $pageSize ";// chỉ lấy vài record
	   $kq = $this->db-> query($sql);
	   if(!$kq) die( $this-> db->error);	
		
	   //đếm số record, 2 câu lệnh sql phải giống nhau phần From & Where
	   $sql = "SELECT count(*) FROM  tin WHERE AnHien = 1 AND idLT=$idLT";	
	   $rs = $this->db->query($sql) ;	
	   $row_rs = $rs->fetch_row();
	   $totalRows = $row_rs[0];
	   if(!$kq) die( $this-> db->error);	
	   return $kq;		
	}//TinTrongLoai
	function ChiTietLoaiTin($idLT) {
		settype($idLT, "int");
		$sql="SELECT idLT, Ten, loaitin.idTL, TenTL FROM loaitin, theloai
			WHERE loaitin.idTL = theloai.idTL AND idLT = $idLT";		
		$kq = $this->db-> query($sql);
	   if(!$kq) die( $this-> db->error);
		return $kq;		
	}//ChiTietLoaiTin
	function pagesList($baseURL,$totalRows,$pageNum=1,$pageSize=5,$offset=3){
		if ($totalRows<=0) return "";
		$totalPages = ceil($totalRows/$pageSize);
		if ($totalPages<=1) return "";
		$from = $pageNum - $offset;	
		$to = $pageNum + $offset;
		if ($from <=0) { $from = 1;   $to = $offset*2; }
		if ($to > $totalPages) { $to = $totalPages; }
		$links = "<ul class='newstuff_pagnav'>";
		for($j = $from; $j <= $to; $j++) {
		if ($j==$pageNum) 
	   $links= $links."<li><a href='$baseURL&pageNum=$j' class=active_page> $j</a></li>";
	   else
		$links= $links."<li><a href = '$baseURL&pageNum=$j'>$j</a></li>"; 
		} //for
	   $links= $links."</ul>";
		return $links;
	} // function pagesList
	function TimKiem($tukhoa, &$totalRows, $pageNum=1, $pageSize=5){
	   $startRow = ($pageNum-1)*$pageSize;
		$tukhoa = $this->db-> escape_string( trim(strip_tags($tukhoa)) );
		$sql = "SELECT idTin, TieuDe, TomTat, urlHinh, Ngay, SoLanXem, Ten, TenTL, TieuDe_KhongDau
		FROM tin, loaitin, theloai
		WHERE tin.AnHien = 1 AND tin.idLT = loaitin.idLT AND tin.idTL = theloai.idTL 
		AND (TieuDe RegExp '$tukhoa' or TomTat RegExp '$tukhoa') 
		ORDER BY idTin DESC LIMIT $startRow , $pageSize ";		
		$kq = $this->db->query($sql);
	   if(!$kq) die( $this-> db->error);
	
		$sql = "SELECT count(*) 
		FROM tin, loaitin, theloai
		WHERE tin.AnHien = 1 AND tin.idLT = loaitin.idLT AND tin.idTL = theloai.idTL 
		AND (TieuDe RegExp '$tukhoa' or TomTat RegExp '$tukhoa') ";		
	
		$rs = $this->db->query($sql);
	   if(!$kq) die( $this-> db->error);
	   $row_rs = $rs->fetch_row();
	   $totalRows = $row_rs[0];
		return $kq;
	}//TimKiem
	function getTitle($p=''){
	   if ($p=='') return "Tin tức online";
	   elseif ($p=='search') return "Tìm kiếm thông tin";
	   elseif ($p=='register') return "Đăng ký thành viên";
	   elseif ($p=="detail"){
		  $TieuDe_KhongDau = trim(strip_tags($_GET['TieuDe_KhongDau']));
		  $TieuDe_KhongDau = $this->db->escape_string($TieuDe_KhongDau);
		  $kq = $this->db->query("select TieuDe from tin where TieuDe_KhongDau='$TieuDe_KhongDau'");
		  if(!$kq) die( $this-> db->error);
		  if ($kq->num_rows<=0) return "Tin tức tổng hợp";
		  $row_kq = $kq->fetch_row();
		  return $row_kq[0];
	   }
	   elseif ($p=="cat"){
		  $Ten_KhongDau = trim(strip_tags($_GET['Ten_KhongDau']));
		  $Ten_KhongDau = $this->db->escape_string($Ten_KhongDau);
		  $kq = $this->db->query("select Ten from loaitin where Ten_KhongDau= '$Ten_KhongDau'");
		  if(!$kq) die( $this-> db->error);
		  if ($kq->num_rows<=0) return "Tin tức tổng hợp";
		  $row_kq = $kq->fetch_row();
		  return $row_kq[0];
	   }
	} //function getTitle
	function LayidTin($TieuDe_KhongDau){
		$TieuDe_KhongDau = trim(strip_tags($_GET['TieuDe_KhongDau']));
		$TieuDe_KhongDau = $this->db->escape_string($TieuDe_KhongDau);
		$sql = "SELECT idTin FROM tin WHERE TieuDe_KhongDau='$TieuDe_KhongDau'";
		$kq = $this->db->query($sql);
		$row_kq = $kq->fetch_assoc();
		return $row_kq['idTin'];
	}

	function LayidLT($Ten_KhongDau){
	   $Ten_KhongDau = trim(strip_tags($_GET['Ten_KhongDau']));
	   $Ten_KhongDau = $this->db->escape_string($Ten_KhongDau);
	   $sql="select idLT from loaitin where Ten_KhongDau='$Ten_KhongDau'";
	   $kq = $this->db->query($sql);
	   if(!$kq) die( $this-> db->error);
	   $row_kq = $kq->fetch_assoc();
	   $idLT= $row_kq['idLT'];
	   return $idLT;
	}
	function pagesList1($baseURL,$totalRows,$pageNum=1,$pageSize=5,$offset=3){
		if ($totalRows<=0) return "";
		$totalPages = ceil($totalRows/$pageSize);
		if ($totalPages<=1) return "";
		$from = $pageNum - $offset;	
		$to = $pageNum + $offset;
		if ($from <=0) { $from = 1;   $to = $offset*2; }
		if ($to > $totalPages) { $to = $totalPages; }
		$links = "<ul class='newstuff_pagnav'>";
		for($j = $from; $j <= $to; $j++) {
		if ($j==$pageNum) 
	   $links=$links."<li><a href='$baseURL/$j/' class=active_page>$j</a> </li>";
	   else
		$links= $links."<li><a href = '$baseURL/$j/'>$j</a></li>"; 
		} //for
	   $links= $links."</ul>";
		return $links;
	} // function pagesList
	function DangKyThanhVien(&$loi){			
	 $thanhcong = true;
	 $username=$this->db->escape_string(trim(strip_tags($_POST['username'])));
	 $pass=$this->db->escape_string(trim(strip_tags($_POST['pass'])));
	 $repass= $this->db->escape_string(trim(strip_tags($_POST['repass'])));
	 $email = $this->db->escape_string(trim(strip_tags($_POST['email'])));
	 $hoten = $this->db->escape_string(trim(strip_tags($_POST['hoten'])));	
	 $phai = $_POST['phai']; settype($phai,"int");
	 
	 //kiễm tra dữ liệu
	 if ($username == NULL){ 
		$thanhcong = false; 
		$loi['username']= "Bạn chưa nhập username"; 
	 }elseif (strlen($username)<3 ){
		$thanhcong = false; 
		$loi['username']="Username quá ngắn, phải >=3 ký tự";
	 }elseif ($this->CheckUsername($username)==false) { 
		$thanhcong = false;  
		$loi['username'] = "Username bạn nhập đã có người dùng";
	 }
	 //kiêm tra mật khẩu và gõ lại mật khẩu
	if ($pass == NULL) {
		$thanhcong = false; 
		$loi['pass'] = "Bạn chưa nhập mật khẩu";
	}elseif (strlen($pass)<6 ) {
		$thanhcong = false; 
		$loi['pass'] = "Mật khẩu của bạn phải >=6 ký tự";
	} 
	if ($repass == NULL) {
		$thanhcong=false; 
		$loi['repass'] = "Nhập lại mật khẩu đi";
	}elseif ($pass != $repass ) { 
		$thanhcong = false; 
		$loi['repass'] = "Mật khẩu 2 lần không giống";
	}
	//kiêm tra hoten
	if ($hoten == NULL){
		$thanhcong = false; 
		$loi['hoten']= "Chưa nhập họ tên";
	}
	//kiêm tra email
	if ($email == NULL){
		 $thanhcong = false;
		 $loi['email'] = "Bân chưa nhập email"; }
	elseif (filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE) { 
		 $thanhcong = false; 
		 $loi['email']="Bạn nhập email không đúng";
	}elseif ($this->CheckEmail($email)==false) { 
		 $thanhcong = false; 
		 $loi['email'] = "Email này đã có người dùng";
	}
	
	 // chèn dữ liệu
	 if ($thanhcong==true) {
		$mahoa = md5($pass);
		$rd = md5(rand(1,99999));
		 $sql = "INSERT INTO  users  SET username='$username', password= '$mahoa',
		 email='$email', hoten='$hoten', gioitinh=$phai, active='0', randomkey='$rd', ngaydangky=NOW()";
		 $kq = $this->db->query($sql) ;
		 $iduser = $this->db->insert_id;
		 $tieudethu = "Kích hoạt tài khoản";
		 $noidungthu = file_get_contents("dangky_thukichhoat.html");			
		 $link="http://".$_SERVER['SERVER_NAME']."/tintuc/kh.php?id=$iduser&rd=$rd";
		 $noidungthu = str_replace(	array("{username}","{matkhau}","{hoten}","{link}"), 					array($username,$pass,$hoten,$link),$noidungthu);
		 $from = "phuongtestwordpress@gmail.com"; //dùng mail test, đừng dùng mail chính thức
		 $p = "wnrhydbhdddbnqzu"; 
		 $this->GuiMail($email, $from, $tennguoigui="BQT", $tieudethu, $noidungthu, $from, $p, $error);
		 if ($error!="") $loi['guimail']=$error;
	
	}
	 return $thanhcong;
	}//DangKyThanhVien
	function CheckUsername($username){
		$sql="select idUser from users where username='$username'";
		$kq = $this->db->query($sql);
		if ($kq->num_rows>0) return false; 
		else return true;
	}//CheckUsername
	function CheckEmail($email){
		$sql="select idUser from users where email ='{$email}'";
		$kq = $this->db->query($sql);
		if ($kq->num_rows>0) return false;	
	   else return true;
	}//CheckEmail
	function DanhDauKichHoatUser($id,$rd){
		$sql="UPDATE users SET active=1 WHERE idUser=$id AND randomkey='$rd' AND active=0";
		$sd=$this->db->query($sql);
		return $sd;
	}
	function GuiMail($to, $from, $from_name, $subject, $body, $username, $password, &$error){ 
	   $error="";
	   require_once "class/class.phpmailer.php";      
	   require_once "class/class.smtp.php";      
	   try {
		  $mail = new PHPMailer();  
		  $mail->IsSMTP(); 
		  $mail->SMTPDebug = 0;  //  1=errors and messages, 2=messages only
		  $mail->SMTPAuth = true;  
		  $mail->SMTPSecure = 'ssl'; 
		  $mail->Host = 'smtp.gmail.com';
		  $mail->Port = 465; 
		  $mail->Username = $username;  
		  $mail->Password = $password;           
		  $mail->SetFrom($from, $from_name);
		  $mail->Subject = $subject;
		  $mail->MsgHTML($body);// noi dung chinh cua mail
		  $mail->AddAddress($to);
		  $mail->CharSet="utf-8";
		  $mail->IsHTML(true);   
		  if(!$mail->Send()) {$error='Loi:'.$mail->ErrorInfo; return false;}
		  else { $error = ''; return true; }
	   } 
	   catch (phpmailerException $e) { echo "<pre>".$e->errorMessage(); }    
	}//GuiMail
	function login($u, $p, &$loi){
		$loi=array();
		$u = $this->db->escape_string(trim(strip_tags($u)));
		$p = $this->db->escape_string(trim(strip_tags($p)));	
		$p_mahoa = md5($p);
	
		$sql="SELECT * FROM users WHERE username='$u'";
		$kq = $this->db->query($sql);
		if ($kq->num_rows==0) { 
		  $loi['username']="<span class='label label-warning'>UN kô có</span>";
		  return FALSE;
		}
	
		$sql="SELECT * FROM users WHERE username='$u' AND password ='$p_mahoa'";
		$kq = $this->db->query($sql);
		if ($kq->num_rows==0) { 
		   $loi['pass']="<span class='label label-info'>Mật khẩu kô đúng</span>";
		   return FALSE;
		 } 
		$row = $kq->fetch_assoc();
		$_SESSION['login_id']   = $row['idUser'];
		$_SESSION['login_user'] = $row['Username'];    
		$_SESSION['login_hoten'] = $row['HoTen'];
		$_SESSION['login_email'] = $row['Email'];
		return true;
	}
	function checkLogin() {
	if (isset($_SESSION['login_id'])== false){
		$_SESSION['error'] = 'Bạn chưa đăng nhập';
		$_SESSION['back'] = $_SERVER['REQUEST_URI'];
		header('location:login.php'); 
		exit();
	}
	}//function
	function DoiMatKhau($passold, $pass, $repass, &$loi){
	$thanhcong = true;
	  
	$passold = $this->db->escape_string(trim(strip_tags($passold)));
	$pass = $this->db->escape_string(trim(strip_tags($pass)));
	$repass = $this->db->escape_string(trim(strip_tags($repass))); 
	$iduser = $_SESSION['login_id'];	
	
	// kiểm tra dữ liệu nhập
	$pass_min = 3;	
	if ($passold==NULL){$thanhcong=false; $loi[]="Chưa nhập mật khẩu cũ"; }
	else {
	  $sql="select * from users where idUser=$iduser and password=md5('$passold')";
	  $rs = $this->db->query($sql);
	  if ($rs->num_rows==0) {$thanhcong=false; $loi[]="Mật khẩu cũ không đúng";}	
	}
	
	if ($pass==NULL){$thanhcong=false;$loi[]="Chưa nhập pass mới";}
	elseif (strlen($pass)<$pass_min) { 
	   $thanhcong = false; 
	   $loi[] = "Mật khẩu mới quá ngắn.>= $pass_min ký tự";
	}
	elseif ($pass!=$repass) {
	   $thanhcong = false; 
	   $loi[] = "Mật khẩu mới nhập 2 lần không giống nhau";
	}		
	
	if ($thanhcong ==true) { // cập nhật pass mới
	   $sql="UPDATE users SET password=md5('$pass') where iduser=$iduser";
	   $this->db->query($sql);
	}	
	return $thanhcong;
	} //function DoiPass

}//tin
?>
