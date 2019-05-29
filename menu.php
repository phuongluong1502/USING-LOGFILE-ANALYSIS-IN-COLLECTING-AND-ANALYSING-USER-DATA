<?php $theloai = $t->ListTheLoai(); ?>
<ul class="nav navbar-nav custom_nav" >
	<li class=""><a href="index.php">Trang chủ</a></li>
	<?php while($rowTL = $theloai->fetch_assoc() ) { ?>
	<li class="dropdown"> 
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <?=$rowTL['TenTL']?></a>
	 <ul class="dropdown-menu" role="menu">
		<?php $loaitin = $t->ListLoaiTinTrong1TheLoai($rowTL['idTL']); ?>
		<?php while($rowLT = $loaitin->fetch_assoc() ) { ?>
		<li><a href="cat/<?php echo $rowLT['Ten_KhongDau']?>/"><?=$rowLT['Ten']?></a></li>
		<?php } ?>
	 </ul>
	</li>	
	<?php }?>
</ul>
