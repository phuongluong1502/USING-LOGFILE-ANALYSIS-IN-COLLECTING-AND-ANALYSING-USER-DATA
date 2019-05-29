<?php session_start();
	  $p = isset($_GET['p']) ? $_GET['p'] : ''; 
	  $p;
      require_once "class/tin.php";
      $t = new tin;
      $lang='vi';
?>

<!DOCTYPE html>
<html>
<head>
<title><?=$t->getTitle($p); ?></title>
<base href="http://localhost/tintuc/"/>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/font.css">
<link rel="stylesheet" href="assets/css/animate.css">
<link rel="stylesheet" href="assets/css/structure.css">
<!--[if lt IE 9]>
<script src="assets/js/html5shiv.min.js"></script>
<script src="assets/js/respond.min.js"></script>
<![endif]-->
<style>
.single_stuff_img img { width:100%; height:300px;}
.mbar_thubnail > img {width:95px; height:55px}
.featured_img img { width: 100%;  height: 140px;}
#tintrongloai .stuff_article_inner {margin-bottom:15px; padding-right:20px; text-align:justify;}
#tintrongloai .stuff_article_inner img {width:180px; height:150px; margin:10px 15px 0 -70px; }
#tintrongloai .stuff_article_inner h2 {font-size:1.3em; font-weight:700; line-height:150%;  }
#tintrongloai .stuff_date {position:relative; z-Index:1; opacity:0.8}

</style>
<script src="assets/js/jquery.min.js"></script>
</head>
<body>
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<header id="header">
  <div class="container">
    <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          <a class="navbar-brand" href="index.php"><span>TIN TUC TONG HOP</span></a> </div>
        <div id="navbar" class="navbar-collapse collapse">
         <?php include "menu.php"?>
        </div>
      </div>
    </nav>
    <form id="searchForm" onsubmit="this.action='/tintuc/search/' + document.getElementsByName('tukhoa')[0].value +'/'" action="" method="post" >
   	<input type="hidden" name="p" value="search">
  	<input type="text" placeholder="Tìm kiếm" name="tukhoa">
   	<input type="submit" value="">
	</form>
    <div style="float:right; margin-top:10px;">
	<a href="http://localhost/tintuc/dang-ky/";><button type="button" class="btn btn-primary">Đăng nhập</button></a>
	<a href="http://localhost/tintuc/login.php";><button type="button" class="btn btn-success">Đăng ký</button></a>  
	</div>
  </div>
</header>
<section id="contentbody">
  <div class="container">
    <div class="row">
      <div class=" col-sm-12 col-md-6 col-lg-6">
        <div class="row">
          <div class="leftbar_content">
            <h2>Tin mới cập nhật</h2>
          <?php 
			switch ($p){
			   case "detail": include "chitiettin.php"; break;
			   case "cat": include "tintrongloai.php"; break;
			   case "search": include "ketquatimkiem.php"; break;
			   case "dangky": include "dangkytv.php"; break;
			   case "dangkytc": include "dangkytc.php"; break;
			   default: include "tinmoi.php"; 
			}//switch
		  ?>
               
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-2 col-lg-2">
        <div class="row">
          <div class="middlebar_content">
            <h2 class="yellow_bg">Tin nổi bật</h2>
            <div class="middlebar_content_inner wow fadeInUp">
              <?php include "tinnoibat.php"?>
            </div>
            
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-4">
        <div class="row">
          <div class="rightbar_content">
            <div class="single_blog_sidebar wow fadeInUp">
              <h2>Bạn xem chưa?</h2>
              <?php include "tinngaunhien.php"?>
            </div>
            <div class="single_blog_sidebar wow fadeInUp">
              <h2>Tin xem nhiều</h2>
              <?php include "tinxemnhieu.php"?>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<footer id="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="footer_inner">
          <p class="pull-left">Tin tức tổng hợp &copy;  2018</p>
          <p class="pull-right">Phát triển bởi Lương Văn Phương</p>
        </div>
      </div>
    </div>
  </div>
</footer> 
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/wow.min.js"></script> 
<script src="assets/js/custom.js"></script>
</body>
</html>