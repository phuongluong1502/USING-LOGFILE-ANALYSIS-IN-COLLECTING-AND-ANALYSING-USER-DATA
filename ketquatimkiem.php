<?php
$tukhoa = $_GET['tukhoa'];  
$pageSize = 5; //số tin sẽ hiện trong 1 trang 
if (isset($_GET['pageNum'])) $pageNum = $_GET['pageNum'];//trang user xem
settype($pageNum, "int"); 
if ($pageNum<=0) $pageNum=1;
$totalRows=0;
$tin = $t->TimKiem($tukhoa,$totalRows, $pageNum, $pageSize);
?>	

<div id="tintrongloai">
	<ol class="breadcrumb">
     <li class="breadcrumb-item"><a href="index.php">TRANG CHỦ</a></li>
      <li class="breadcrumb-item">Tìm Kiếm</li>
      <li class="breadcrumb-item"><?=$tukhoa;?></li>
    </ol>

<?php 
	while ($row_tin=$tin->fetch_assoc()) {?>
    <div class="stuff_article_inner"> <span class="stuff_date"> <?=date( 'M', strtotime($row_tin['Ngay'])  )?> <strong><?=date('d',strtotime($row_tin['Ngay']))?></strong></span>
	<img src="<?=$row_tin['urlHinh'];?>" align="left" onerror="this.src='/tintuc/defaultImg.jpg'">
    <h2><a href="news/<?php echo $row_tin['TieuDe_KhongDau'];?>.html/"><?=$row_tin['TieuDe']?></a></h2>
	<p><?=$row_tin['TomTat']?></p>
	 </div>
<?php } ?>
</div> <!--div tintrongloai -->
<div class="slideInLeft animated" style="float:left";>
<?=$t->pagesList1("search/$tukhoa",$totalRows,$pageNum,$pageSize,5)?>
</div>


