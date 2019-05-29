<?php $tinNN = $t->TinNgauNhien(6); ?>
<ul class="featured_nav">
<?php while($rowNN = $tinNN->fetch_assoc() ) { ?>	
	<li> <a class="featured_img" href="news/<?php echo $rowNN['TieuDe_KhongDau'];?>.html/"><img src="<?=$rowNN['urlHinh']?>" onerror="this.src='/tintuc/defaultImg.jpg'" alt=""></a>
	  <div class="featured_title"> <a class="" href="news/<?php echo $rowNN['TieuDe_KhongDau'];?>.html/	"><?=$rowNN['TieuDe']?></a> </div>
	</li>
<?php }?>
</ul>
