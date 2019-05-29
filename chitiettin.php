<?php 
$TieuDe_KhongDau= $_GET['TieuDe_KhongDau'];
$idTin = $t->LayidTin($TieuDe_KhongDau);
$tin = $t->ChiTietTin($idTin);
$row_tin=$tin->fetch_assoc();
$t->CapNhatSolanXemTin($idTin);
?>

<div class="singlepost_area">
              <div class="singlepost_content"> <a href="#" class="stuff_category"><?=$row_tin['Ten']?></a> <span class="stuff_date"><?=date( 'M', strtotime($row_tin['Ngay'])  )?><strong><?=date( 'd', strtotime($row_tin['Ngay'])  )?></strong></span>
                <h2><a href="#"><?=$row_tin['TieuDe']?></a></h2>
                <img class="img-center" src="<?=$row_tin['urlHinh']?>" alt="">
                <p><?=$row_tin['TomTat']?>/p>
				<div id="noidung"><?=$row_tin['Content']?></div>                
                
                <div class="social_area wow fadeInLeft">
                  <ul>
                    <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                    <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                    <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                    <li><a href="#"><span class="fa fa-linkedin"></span></a></li>
                    <li><a href="#"><span class="fa fa-pinterest"></span></a></li>
                  </ul>
                </div>
                
                <div id="tincuhon">  
				   <?php $tincuhon = $t->TinCuCungLoai($idTin,6);?>
                   <h3 class="caption"> Tin tiếp theo</h3>
                   <?php while ($row_kq = $tincuhon->fetch_assoc()) {?>
                      <h4><a href="news/<?php echo $row_kq['TieuDe_KhongDau'];?>.html/"> <?=$row_kq['TieuDe'];?> </a></h4>
                   <?php } ?>
                </div>

              </div>
</div>