<script type="text/javascript">
	function selectFileWithCKFinder( elementId ) {
	   CKFinder.popup( {
			chooseFiles: true, width: 800, height: 600,
			onInit: function( finder ) {
				finder.on( 'files:choose', function( evt ) {
					var file = evt.data.files.first();
					var output = document.getElementById( elementId );
					output.value = file.getUrl();
				});
			finder.on( 'file:choose:resizedImage', function( evt ) {
				 var output = document.getElementById( elementId );
				 output.value = evt.data.resizedUrl;
			});
			}
	   });
	}
	</script>
<script>
$(document).ready(function(e) {
    $("#form_validation").submit(function(){
         if ($("#idTL").val()==0) {
            alert("Bạn ơi! Chưa chọn thể loại mà");return false;
         }
    });
    $("#form_validation").submit(function(){
            if ($("#idLT").val()==0) {
               alert("Bạn ơi! Chưa chọn loại tin mà"); return false;
            }
    }); 
});
</script>

<?php
if (isset($_POST['TieuDe'])){ 
   $TieuDe = $_POST['TieuDe'];
   $TieuDe_KD = $_POST['TieuDe_KhongDau'];
   $TomTat = $_POST['TomTat'];
   $Ngay = $_POST['Ngay']; //hiện đang là d/m/Y
   $Ng = DateTime::createFromFormat('d/m/Y', $Ngay); //tạo obj dạng ngày
   $Ngay = $Ng->format('Y-m-d'); //đổi thành dạng Y-m-d
   $AnHien = $_POST['AnHien'];
   $TinNoiBat = $_POST['TinNoiBat'];
   $idTL = $_POST['idTL'];
   $idLT = $_POST['idLT'];
   $urlHinh = $_POST['urlHinh'];
   $NoiDung = $_POST['NoiDungTin'];
   $qt->Tin_Them($TieuDe, $TieuDe_KD, $TomTat,$Ngay, $AnHien,$TinNoiBat, $urlHinh, $NoiDung, $idTL, $idLT);
   echo "<script>document.location='index.php?p=tin_ds';</script>";
   exit();
}
?>
		
            <div class="row clearfix">
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" style="margin:auto; float:none">
                    <div class="card">
                        <div class="header">
                            <h2>THÊM TIN</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="TieuDe" required maxlength="100" minlength="10" > 
                                        <label class="form-label">Tiêu đề tin</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="TieuDe_KhongDau">
                                        <label class="form-label">Tiêu đê KD</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-group form-float"> 
                                    <div class="form-line">
                                    <input type="text" name="urlHinh" id="urlHinh" class="form-control">
                                    <input type="button" onclick="selectFileWithCKFinder('urlHinh')" value="…"/>
                                    <label class="form-label">url Hình</label>
                                    </div> 
                                    </div>
                                    <div class="form-line">
                                        <textarea name="TomTat" cols="30" rows="5" class="form-control no-resize" ></textarea>
                                        <label class="form-label">Tóm tắt</label>
                                    </div>
                                </div>
                                <div class="row cleafix">
                                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-6">
                                       <div class="form-group form-float">
                                       <input type="radio" name="AnHien" id="AnHien_0" value="0">
                                       <label for="AnHien_0">Ẩn</label>
                                       <input type="radio" name="AnHien" id="AnHien_1" value="1" checked>
                                       <label for="AnHien_1" class="m-l-20">Hiện</label>
                                       </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-6">
                                       <div class="form-group form-float">
                                       <input type="radio" name="TinNoiBat" id="TinNoiBat_0" value="0">
                                       <label for="TinNoiBat_0">Tin thường</label>
                                       <input type="radio" name="TinNoiBat" id="TinNoiBat_1" value="1"  checked>
                                       <label for="TinNoiBat_1" class="m-l-20">Tin nổi bật</label>
                                       </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                       <div class="form-group form-float">
                                       <div class="form-line">
                                       <input type="text" class="datepicker form-control" name="Ngay">
                                       <label class="form-label">Ngày đăng</label>
                                       </div>
                                       </div>
                                    </div>
                                </div>
                                <div class="row cleafix">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> <div class="form-line">
                                <?php $listTL= $qt->ListTheLoai();?>
                                <select class="form-control show-tick" name="idTL" id="idTL">
                                   <option value="0">-- Chọn Thể loại --</option>
                                   <?php while ($r = $listTL->fetch_assoc()) { ?>
                                   <option value="<?=$r['idTL']?>  "><?=$r['TenTL']?></option>
                                   <?php } ?>
                                </select>
                                </div> </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> <div class="form-line">
                                <select class="form-control show-tick" name="idLT" id="idLT">
                                   <option value="0">-- Chọn loại tin--</option>
                                   <option value="cc">dd</option>
                                </select>
                                </div> </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="NoiDungTin" cols="30" rows="10" class="form-control" required></textarea>
                                    </div>
                                </div>                               
                                <button class="btn btn-primary waves-effect" type="submit">THÊM TIN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
<link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<script src="plugins/ckeditor/ckeditor.js"></script>
<script>
$(document).ready(function(e) {        
    CKEDITOR.replace('NoiDungTin',
		{language:'vi', skin:'kama',
		filebrowserImageBrowseUrl : '/tintuc/quantri/plugins/ckfinder/ckfinder.html?Type=Images',
		filebrowserImageUploadUrl : '/tintuc/quantri/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    });
    CKEDITOR.config.height = 300;   
});
</script>
<link href="plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
<script src="plugins/autosize/autosize.js"></script>
<script src="plugins/momentjs/moment.js"></script>
<script src="plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script>
$(document).ready(function(e) {   
    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'DD/MM/Y', clearButton: true, 
        weekStart: 1, time: false
    });	
});
</script>
<script>
$(document).ready(function(e) {   
	$("#idTL").change(function(){
		var idTL=$(this).val();
         var url="tintuc_layloaitin.php?idTL="+ idTL;
         $("#idLT").load(url,"", lamtuoi);
	});
});
function lamtuoi(){  $("#idLT").selectpicker('refresh');}
</script>
<script type="text/javascript" src="plugins/ckfinder/config.js"></script>