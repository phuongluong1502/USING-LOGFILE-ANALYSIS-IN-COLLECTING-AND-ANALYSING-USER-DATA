<?php $tinNB = $t->TinNoiBat(20); ?>
<ul class="middlebar_nav">
<?php while($rowNB = $tinNB->fetch_assoc() ) { ?>
	<li> <a class="mbar_thubnail" href="news/<?php echo $rowNB['TieuDe_KhongDau'];?>.html/">
	<img src="<?=$rowNB['urlHinh']?>" onerror="this.src='/tintuc/defaultImg.jpg'">
	</a> 
	<a class="mbar_title" href="news/<?php echo $rowNB['TieuDe_KhongDau'];?>.html/"><?=$rowNB['TieuDe']?></a> 
	</li>
<?php } ?>
</ul>
