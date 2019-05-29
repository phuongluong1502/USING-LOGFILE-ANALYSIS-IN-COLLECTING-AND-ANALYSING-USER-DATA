<?php
if (isset($_POST['TenTL'])){ 
    $TenTL = $_POST['TenTL'];
    $TenTL_KD = $_POST['TenTL_KhongDau'];
    $ThuTu = $_POST['ThuTu'];
    $AnHien = $_POST['AnHien'];
    $qt->TheLoai_Them($TenTL, $TenTL_KD, $ThuTu,$AnHien);
    echo "<script>document.location='index.php?p=theloai_ds';</script>";
    exit();
}
?>

<div class="row clearfix">
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 center-block" style="float:none">
                <div class="card">
                        <div class="header">
                            <h2>
                                THÊM THỂ LOẠI
                            </h2>
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
                            <form class="form-horizontal" method="post" action="">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="TenTL">Tên TL</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="TenTL" name="TenTL" class="form-control" placeholder="Nhập tên thể loại"  maxlength="20" minlength="3" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="TenTL_KhongDau"> TênTL không dấu</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="TenTL_KhongDau" class="form-control" placeholder="Nhap ten the loai khong dau" maxlength="20" minlength="3" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                   <label for="ThuTu">Thứ tự</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                   <div class="form-group">
                                      <div class="form-line">
                                         <input type="text" id="ThuTu" name="ThuTu" class="form-control" placeholder="Nhập thứ tự xuất hiện" required min="1" max="1000">
                                      </div>
                                   </div>
                                </div>
                                </div>
                                
                                <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                   <label>Ẩn hiện</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                   <div class="form-group">
                                      <div class="form-line">
                                         <input type="radio" id="AnHien_1" name="AnHien" checked value="1"> <label for="AnHien_1">Hiện</label>
                                         <input type="radio" id="AnHien_0" name="AnHien" value="0">
                                         <label for="AnHien_0">Ẩn</label></div>
                                      </div>
                                </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">THÊM THỂ LOẠI</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>