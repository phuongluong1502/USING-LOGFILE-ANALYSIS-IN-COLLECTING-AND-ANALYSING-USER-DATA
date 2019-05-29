<?php $tinmoi = $t->TinMoi(5); ?>
<?php while($rowTM = $tinmoi->fetch_assoc() ) { ?>
<div class="single_stuff wow fadeInDown">
	  <div class="single_stuff_img"> <a href="news/<?php echo $rowTM['TieuDe_KhongDau'];?>.html/"><img src="<?=$rowTM['urlHinh']?>" onerror="this.src='/tintuc/defaultImg.jpg'" alt=""></a> </div>
	  <div class="single_stuff_article">
		<div class="single_sarticle_inner"> <a class="stuff_category" href="#"><?=$rowTM['TenLT']?></a>
		 <div class="stuff_article_inner"> <span class="stuff_date"><?=date( 'M', strtotime($rowTM['Ngay'])  )?>  <strong><?=date( 'd', strtotime($rowTM['Ngay'])  )?> </strong></span>
			<h2><a href="news/<?php echo $rowTM['TieuDe_KhongDau'];?>.html/"><?=$rowTM['TieuDe']?></a></h2>
			<p><?=$rowTM['TomTat']?></p>
		  </div>
		</div>
	  </div>
</div>
<?php }?>
