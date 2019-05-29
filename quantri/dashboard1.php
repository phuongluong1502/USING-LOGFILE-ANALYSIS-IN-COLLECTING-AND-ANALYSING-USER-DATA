<?php
	include 'connectdatabase.php';	
	$str=file("/xampp/apache/logs/access.log");
	//dem log
	$cnt=count($str);
	//dem sql
	$sql="SELECT count(1) from file_log_raw";
	$kq = $db->query($sql);
	$res=$kq->fetch_row();
	$cntSql=$res[0];
	//so sanh count(filelog) vs table log_file nếu như trong table < thi chay dong for
	for($i=$cntSql;$i<$cnt;$i++){
		$x=explode('!',$str[$i]);
		$aa=join('\',\'', $x);
	//thêm dữ liệu vào trong database table log_file
	$sql="INSERT INTO `file_log_raw`(`IP`, `date:time`, `request`, `domain`, `useragent`, `cookies`) VALUES ('$aa')";
	$kq = $db->query($sql);
		}
		//thêm dữ liệu từ table file_log_raw vào table file_log
		$sql="INSERT INTO `file_log`(`IP`, `date:time`, `request`, `domain`, `useragent`, `cookies`, ID) SELECT * FROM file_log_raw WHERE domain NOT IN (SELECT domain FROM file_log_raw WHERE domain like '%phpmyadmin%') AND request NOT in (SELECT request FROM file_log_raw where request like '%.css%' OR request like '%.jpg%' OR request like '%.js%' OR request like '%.svg%' OR request like '%.png%' OR request like '%phpmyadmin%' OR request like '%.ico%' OR request like '%/captcha.php%' OR request LIKE '%/assets%' OR request LIKE '%/quantri/%') AND ID> '$cntSql'";
		$kq=$db->query($sql);
		//đếm số lượng browser truy cập vào trang web
			$sql="SELECT useragent FROM file_log";
			$kqbr=$db->query($sql);
				$chrome=0;
		$chromium=0; $opera=0; $edge=0; $IE=0; $firefox=0; $safari=0; $android=0; $ios=0; $windows=0; $windowsphone=0; $mac=0; $linux=0; $other=0;
			while($row_usrag=$kqbr->fetch_assoc()){
				if(strpos($row_usrag['useragent'],"Chromium")) $chromium++;
				else if(strpos($row_usrag['useragent'],"Opera") or strpos($row_usrag['useragent'],"OPR")) $opera++ ;
				else if(strpos($row_usrag['useragent'],"Edge")) $edge++;
				else if(strpos($row_usrag['useragent'],"MSIE") or strpos($row_usrag['useragent'],"Trident") or strpos($row_usrag['useragent'],"IE")) $IE++;
				else if(strpos($row_usrag['useragent'],"Firefox")) $firefox++;
				else if(strpos($row_usrag['useragent'],"Chrome")) $chrome++;
				else if(strpos($row_usrag['useragent'],"Safari")) $safari++;
				//if else for OS
				if(strpos($row_usrag['useragent'],"Android")) $android++;
				else if(strpos($row_usrag['useragent'],"iPhone") or strpos($row_usrag['useragent'],"iPad") or strpos($row_usrag['useragent'],"iPod")) $ios++;
				else if(strpos($row_usrag['useragent'],"Windows")) $windows++;
				else if(strpos($row_usrag['useragent'],"Windows Phone")) $windowsphone++;
				else if(strpos($row_usrag['useragent'],"Mac")) $mac++;
				else if(strpos($row_usrag['useragent'],"Linux") or strpos($row_usrag['useragent'],"X11")) $linux++;
				else $other++;
				}
		//Đếm số lượng người truy cập mới
		$sql="SELECT count(DISTINCT(SessionID)) FROM file_log Where ID > '$cntSql'";
		$kqcntipnew= $db->query($sql);
		$cntipnew= $kqcntipnew->fetch_row();
		$rescntipnew=$cntipnew[0];
		//Đếm số lượng page View mới
		$sql="SELECT count(1) as PageView FROM file_log Where ID > '$cntSql'";
		$kqpvnew=$db->query($sql);
		$respvnew=$kqpvnew->fetch_row();
		//Đếm tổng page view
		$sql="SELECT count(1) as PageView FROM file_log";
		$kqpv=$db->query($sql);
		$respv=$kqpv->fetch_row();
		//update session ID PHPSESSID
		$sql="SELECT cookies FROM file_log GROUP BY cookies ";
		$kq=$db->query($sql);
		while($row_sess=$kq->fetch_assoc()){
		$a =strpos($row_sess['cookies'],'PHPSESSID')+10;
		$b=substr($row_sess['cookies'],$a, 26);
		$sql1="UPDATE `file_log` SET `SessionID` = '$b' WHERE `file_log`.`cookies` LIKE '%PHPSESSID=$b%';";
		$kq1=$db->query($sql1);
		$a=0;
		}
		//đếm số lượng user đã truy cập vào trang web bằng IP
		$sql="SELECT count(DISTINCT(SessionID)) FROM file_log";
		$kqcntip= $db->query($sql);
		$cntip= $kqcntip->fetch_row();
		$rescntip=$cntip[0];
?>
<?php include 'chart.php' ?>
<div class="container-fluid">
    <div class="block-header">
        <h2>Dữ Liệu Người Dùng</h2>
    </div>           
    <!-- Widgets -->
    <?php include 'widgets.php' ?>
    <!-- #END# Widgets -->
    <!-- Browser Usage -->
    <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">                        
                <h2>BROWSER USAGE</h2>
                </div>
                <div class="body">
                    <div id="donutchart" style="height:400px;"></div>
                </div>
            </div>
        </div>
        <!-- #END# Browser Usage -->
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">                        
                <h2>OS	</h2>
                </div>
                <div class="body">
                    <div id="chart_div" style="height:400px;">
                </div>
            </div>
        </div>
</div>
</div>
	<div class="row clearfix">
    	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">                        
                <h2>Top 5 Area Access Website</h2>
                </div>
                <div class="body">
                	<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                    <tr>  <th>Số Lần</th> <th>Khu Vực</th></tr>
                    </thead>
                    <tbody>
                    	<?php 
							//chon ra cac IP
							$sql="SELECT DISTINCT(IP) as IP FROM file_log where ID > '$cntSql'";
							$kq=$db->query($sql);
							while($row_usrag=$kq->fetch_assoc()){
							$ip=$row_usrag['IP'];
							$service_url = "https://ipinfo.io/$ip/json";
							$curl = curl_init($service_url);
							curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
							$curl_response = curl_exec($curl);
							if ($curl_response === false) {
							$info = curl_getinfo($curl);
							curl_close($curl);
								die('error occured during curl exec. Additioanl info: ' . var_export($info));
							}
							curl_close($curl);
							$decoded = json_decode($curl_response);
							if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
							die('error occured: ' . $decoded->response->errormessage);
							}
							//them location phu hop voi ip
							$sql2="UPDATE `file_log` SET `Location` = '$decoded->city' WHERE IP = '$ip'";
							$kq2=$db->query($sql);
							}
							//Đổ dữ liệu location ra 
							$sql3="SELECT Location, COUNT(Location) as Solan from file_log GROUP BY Location ORDER BY Solan DESC LIMIT 0,5";
							$kq3=$db->query($sql3);
							while($row_location=$kq3->fetch_assoc()){?>                    
                        <tr> <td><?php echo $row_location['Solan']; ?></td> <td><?php echo $row_location['Location']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">                        
                <h2>Top 5 Tin Tức Được Xem Nhiều Nhất</h2>
                </div>
                <div class="body">
                	<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                    <tr>  <th>Tin</th> <th>Số Lần Xem</th></tr>
                    </thead>
                    <tbody>
                    <?php 
						$sql="SELECT TieuDe, SoLanXem FROM tin WHERE AnHien=1 AND lang='vi'ORDER BY SoLanXem DESC LIMIT 0,5";
						$kq=$db->query($sql);
						while($row_XNN=$kq->fetch_assoc()){
					?>
                        <tr> <td><?php echo $row_XNN['TieuDe']; ?></td> <td><?php echo $row_XNN['SoLanXem']; ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>
</div>