<?php $tinXN = $t->TinXemNhieu(6); ?>
<ul class="middlebar_nav wow">
<?php while($rowXN = $tinXN->fetch_assoc() ) { ?>
    <li> <a href="news/<?php echo $rowXN['TieuDe_KhongDau'];?>.html/" class="mbar_thubnail">
	<img alt="" src="<?=$rowXN['urlHinh']?>" onerror="this.src='/tintuc/defaultImg.jpg'"></a> 
	<a href="news/<?php echo $rowXN['TieuDe_KhongDau'];?>.html/" class="mbar_title"><?=$rowXN['TieuDe']?></a> 
	</li>               
<?php }?>
</ul>
	
