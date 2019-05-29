<?php
require "../class/goc.php";
class quantritin extends goc {
	function thongtinuser($u, $p){
	$u = $this->db->escape_string($u);
	$p = $this->db->escape_string($p);
	$p = md5($p);
	echo $sql="SELECT * FROM users WHERE username='$u' AND password='$p'";
	$kq = $this->db->query($sql);
	if ($kq->num_rows==0) return FALSE;
	else return $kq->fetch_assoc();
}
function checkLogin() {
    session_start();
    if (isset($_SESSION['login_id'])== false){
          $_SESSION['error'] = 'Bạn chưa đăng nhập';
          $_SESSION['back'] = $_SERVER['REQUEST_URI'];
           header('location:login.php'); 
           exit();
     }elseif ($_SESSION['login_level']!=1){
          $_SESSION['error'] = 'Bạn không có quyền xem trang này';
          $_SESSION['back'] = $_SERVER['REQUEST_URI'];
          header('location:login.php');
          exit();
     }
}//function

function ListTheLoai(){
   $sql="SELECT idTL,TenTL,ThuTu,AnHien,TenTL_KhongDau FROM theloai ORDER BY ThuTu";
   $kq = $this->db->query($sql) ;
   if(!$kq) die( $this-> db->error);
   return $kq; 
}//function TheLoai
function TheLoai_Them($TenTL, $TenTL_KD, $ThuTu,$AnHien){
    $TenTL= $this->db->escape_string(trim(strip_tags($TenTL)));
    $TenTL_KD= $this->db->escape_string(trim(strip_tags($TenTL_KD)));
    if ($TenTL_KD=="")  $TenTL_KD = $this->changeTitle($TenTL);
    settype($ThuTu,"int");
    settype($AnHien,"int");
    $sql="INSERT INTO theloai SET TenTL='$TenTL', TenTL_KhongDau= '$TenTL_KD', ThuTu=$ThuTu, AnHien=$AnHien";
    $kq= $this->db->query($sql) ;
    if(!$kq) die( $this-> db->error);
}
function changeTitle($str){
    $str = $this->stripUnicode($str);
    $str = $this->stripSpecial($str);
    $str = mb_convert_case($str , MB_CASE_LOWER , 'utf-8');
    return $str;
}
function stripSpecial($str){
   $arr = array(",","$","!","?","&","'",'"',"+");
    $str = str_replace($arr,"",$str);
    $str = trim($str);
   while (strpos($str,"  ")>0) $str = str_replace("  "," ",$str);
    $str = str_replace(" ","-",$str);
    return $str;
}
function stripUnicode($str){
    if(!$str) return false;
    $unicode = array(
     'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
     'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
     'd'=>'đ','D'=>'Đ',
     'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ', 'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
     'i'=>'í|ì|ỉ|ĩ|ị', 'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
     'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
     'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
     'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự', 'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
     'y'=>'ý|ỳ|ỷ|ỹ|ỵ', 'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
    );
    foreach($unicode as $khongdau=>$codau) {
      $arr = explode("|",$codau);
      $str = str_replace($arr,$khongdau,$str);
    }
    return $str;
}//function TheLoai_Them
function TheLoai_ChiTiet($idTL){
   $sql="SELECT idTL, TenTL, ThuTu, AnHien, TenTL_KhongDau FROM theloai 
       WHERE idTL=$idTL";
   $kq = $this->db->query($sql) ;
   if(!$kq) die( $this-> db->error);
   return $kq; 
}//function THeLoai_ChiTIet
function TheLoai_Sua($idTL, $TenTL, $TenTL_KD, $ThuTu,$AnHien){
	settype($idTL,"int");
	$TenTL= $this->db->escape_string(trim(strip_tags($TenTL)));
	$TenTL_KD= $this->db->escape_string(trim(strip_tags($TenTL_KD)));
	if ($TenTL_KD=="")  $TenTL_KD = $this->changeTitle($TenTL);
	settype($ThuTu,"int");
	settype($AnHien,"int");
	echo $sql="UPDATE theloai SET TenTL='$TenTL', TenTL_KhongDau= '$TenTL_KD' , ThuTu=$ThuTu, AnHien=$AnHien WHERE idTL=$idTL";
	$kq= $this->db->query($sql) ;
	if(!$kq) die( $this-> db->error);
}//TheLoai_Sua
function TheLoai_Xoa($idTL){
    settype($idTL,"int");
    $sql="DELETE FROM theloai WHERE idTL=$idTL";
	 $kq= $this->db->query($sql) ;
	 if(!$kq) die( $this-> db->error);		
}//THELOAI_XOA
function ListLoaiTIn(){
   $sql="SELECT idLT,Ten,loaitin.ThuTu,loaitin.AnHien,Ten_KhongDau, TenTL FROM loaitin, theloai 
   WHERE loaitin.idTL=theloai.idTL
   ORDER BY loaitin.ThuTu";
   $kq = $this->db->query($sql) ;
   if(!$kq) die( $this-> db->error);
   return $kq; 
}//ListLoaiTin
function LoaiTin_Them($Ten, $Ten_KD, $ThuTu,$AnHien,$idTL){
	$Ten = $this->db->escape_string(trim(strip_tags($Ten)));
	$Ten_KD= $this->db->escape_string(trim(strip_tags($Ten_KD)));
	if ($Ten_KD=="")  $Ten_KD = $this->changeTitle($Ten);
	settype($ThuTu,"int");
	settype($AnHien,"int");
	settype($idTL,"int");
	$sql="INSERT INTO loaitin SET Ten='$Ten', Ten_KhongDau='$Ten_KD', 
    ThuTu=$ThuTu, AnHien=$AnHien, idTL=$idTL";
	$kq= $this->db->query($sql) ;
	if(!$kq) die( $this-> db->error);
}//LoaiTin_Them
function LoaiTin_ChiTiet($idLT){
   $sql="SELECT idLT,Ten,ThuTu,AnHien,Ten_KhongDau,idTL FROM loaiTin 
       WHERE idLT=$idLT";
   $kq = $this->db->query($sql) ;
   if(!$kq) die( $this-> db->error);
   return $kq; 
}//LoaiTin_ChiTiet 
function LoaiTin_Sua($Ten, $Ten_KD, $ThuTu,$AnHien,$idTL,$idLT){
	$Ten = $this->db->escape_string(trim(strip_tags($Ten)));
	$Ten_KD= $this->db->escape_string(trim(strip_tags($Ten_KD)));
	if ($Ten_KD=="") $Ten_KD = $this->changeTitle($Ten);
	settype($ThuTu,"int");
	settype($AnHien,"int");
	settype($idTL,"int");
	settype($idLT,"int");
	$sql="UPDATE loaitin SET Ten='$Ten', Ten_KhongDau='$Ten_KD', 
         ThuTu=$ThuTu, AnHien=$AnHien, idTL=$idTL WHERE idLT=$idLT";
	$kq= $this->db->query($sql) ;
	if(!$kq) die( $this-> db->error);
}//LoaiTin_Sua
function LoaiTin_Xoa($idLT){
    settype($idLT,"int");
    $sql="DELETE FROM loaitin WHERE idLT=$idLT";
	 $kq= $this->db->query($sql) ;
	 if(!$kq) die( $this-> db->error);		
}//LoaiTin_Xoa
function ListTin(){
   $sql="SELECT idTin,TieuDe,TomTat,tin.AnHien,TinNoiBat,Ngay, SoLanXem,
      TenTL,Ten FROM tin, loaitin, theloai 
      WHERE tin.idLT=loaitin.idLT AND tin.idTL=theloai.idTL
      ORDER BY idTin Desc";
   $kq = $this->db->query($sql) ;
   if(!$kq) die( $this-> db->error);
   return $kq; 
}//ListTin
function Tin_Them($TieuDe, $TieuDe_KD, $TomTat, $Ngay, $AnHien, $TinNoiBat, $urlHinh, $NoiDung, $idTL, $idLT){
	$TieuDe = $this->db->escape_string(trim(strip_tags($TieuDe)));
	$TieuDe_KD= $this->db->escape_string(trim(strip_tags($TieuDe_KD)));
	if ($TieuDe_KD=="")  $TieuDe_KD = $this->changeTitle($TieuDe);
	settype($AnHien,"int");
	settype($TinNoiBat,"int");
	settype($idTL,"int");
  settype($idLT,"int");
	$sql="INSERT INTO tin SET TieuDe='$TieuDe',TomTat='$TomTat' , 
     TieuDe_KhongDau='$TieuDe_KD', Ngay='$Ngay', AnHien=$AnHien, 
     TinNoiBat=$TinNoiBat, urlHinh='$urlHinh', Content='$NoiDung', 
     idTL=$idTL,idLT=$idLT";

	$kq= $this->db->query($sql) ;
	if(!$kq) die( $this-> db->error);
}//Tin_Them
function LoaiTinTrongTheLoai($idTL){
 $sql="SELECT idLT,Ten FROM loaitin WHERE idTL=$idTL ORDER BY ThuTu";
 $kq = $this->db->query($sql) ;
 if(!$kq) die( $this-> db->error);
 return $kq; 
}//LoaiTinTrongTheLoai
function Tin_ChiTiet($idTin){
   $sql="SELECT * FROM tin WHERE idTin=$idTin";
   $kq = $this->db->query($sql) ;
   if(!$kq) die( $this-> db->error);
   return $kq; 
}//Tin_ChiTiet
function Tin_Sua($TieuDe, $TieuDe_KD, $TomTat, $Ngay, $AnHien, $TinNoiBat, $urlHinh, $NoiDung, $idTL, $idLT, $idTin){
	$TieuDe = $this->db->escape_string(trim(strip_tags($TieuDe)));
	$TieuDe_KD= $this->db->escape_string(trim(strip_tags($TieuDe_KD)));
	if ($TieuDe_KD=="")  $TieuDe_KD = $this->changeTitle($TieuDe);
	settype($AnHien,"int");
	settype($TinNoiBat,"int");
	settype($idTL,"int");
   settype($idLT,"int");
	$sql="UPDATE tin SET TieuDe='$TieuDe',TomTat='$TomTat' , 
     TieuDe_KhongDau='$TieuDe_KD', Ngay='$Ngay', AnHien=$AnHien, 
     TinNoiBat=$TinNoiBat, urlHinh='$urlHinh', Content='$NoiDung',idTL=$idTL,idLT=$idLT WHERE idTin=$idTin";
	$kq= $this->db->query($sql) ;
	if(!$kq) die( $this-> db->error);
}//Tin_Sua
function Tin_Xoa($idTin){
    settype($idTin,"int");
    $sql="DELETE FROM tin WHERE idTin=$idTin";
	 $kq= $this->db->query($sql) ;
	 if(!$kq) die( $this-> db->error);		
}//Tin_Xoa
//Các Function dành cho file log
	function Demsql(){
		$sql="SELECT count(1) from file_log_raw";
		$kq=$this->db->query($sql);
		if(!$kq) die($this->db->error);
		return $kq;
	}//Demsql
	function TDLfile_log_raw($aa){
		$sql="INSERT INTO `file_log_raw`(`IP`, `date:time`, `request`, `domain`, `useragent`, `cookies`) VALUES ('$aa')";
		$kq=$this->db->query($sql);
	}//thêm dữ liệu vào trong database table log_file
	function Locfile_log(){
		$sql="INSERT INTO `file_log`(`IP`, `date:time`, `request`, `domain`, `useragent`, `cookies`, ID) SELECT * FROM file_log_raw WHERE domain NOT IN (SELECT domain FROM log_file WHERE domain like '%phpmyadmin%') AND request NOT in (SELECT request FROM file_log_raw where request like '%.css%' OR request like '%.jpg%' OR request like '%.js%' OR request like '%.svg%' OR request like '%.png%' OR request like '%phpmyadmin%' OR request like '%.ico%' OR request like '%/captcha.php%' OR request LIKE '%/assets/css/img%' OR request LIKE '%/quantri/%') AND ID > '$cntSql'";
		$kq=$this->db->query($sql);
	}//thêm dữ liệu từ table file_log_raw vào table file_log
	function countIP(){
		$sql="SELECT count(DISTINCT(IP)) from file_log";
		$kq=$this->db->query($sql);
		if(!$kq) die($this->db->error);
		return $kq;
	}//đếm số lượng user đã truy cập vào trang web bằng IP
	function Browser(){
		$sql="SELECT useragent FROM file_log";
		$kq=$this->db->query($sql);
		if(!$kq) die($this->db->error);
		return $kq;
	}//đếm số lượng browser truy cập vào trang web
	function countIPnew($cntSql){
		$sql="SELECT count(DISTINCT(IP)) from file_log Where ID > '$cntSql'";
		$kq=$this->db->query($sql);
		if(!$kq) die($this->db->error);
		return $kq;
	}//Đếm số lượng người truy cập mới
	function pageViewnew($cntSql){
		$sql="SELECT count(1) as PageView FROM file_log Where ID > '$cntSql'";
		$kq=$this->db->query($sql);
		if(!$kq) die($this->db->error);
		return $kq;
	}//Đếm số lượng page View mới
	function pageView(){
		$sql="SELECT count(1) as PageView FROM file_log";
		$kq=$this->db->query($sql);
		if(!$kq) die($this->db->error);
		return $kq;
	}//Đếm tổng page view
}//class quantritin
?>