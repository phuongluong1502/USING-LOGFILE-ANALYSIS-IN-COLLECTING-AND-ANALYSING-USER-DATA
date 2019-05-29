<div class="row clearfix">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-pink hover-expand-effect">
            <div class="icon">
                <i class="material-icons">playlist_add_check</i>
            </div>
            <div class="content">
                <div class="text">Số Lượt PageView Mới</div>
                <div class="number count-to" data-from="0" data-to=<?=$respvnew[0]?> data-speed="15" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">help</i>
            </div>
            <div class="content">
                <div class="text">Số Người Dùng Mới Truy Cập</div>
                <div class="number count-to" data-from="0" data-to=<?php echo $rescntipnew?> data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-light-green hover-expand-effect">
            <div class="icon">
                <i class="material-icons">forum</i>
            </div>
            <div class="content">
                <div class="text">Tổng Page View</div>
                <div class="number count-to" data-from="0" data-to=<?php echo $respv[0]?> data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
                <i class="material-icons">person_add</i>
            </div>
            <div class="content">
                <div class="text">Tổng User Truy Cập</div>
                <div class="number count-to" data-from="0" data-to=<?php echo $rescntip ?> data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
</div>