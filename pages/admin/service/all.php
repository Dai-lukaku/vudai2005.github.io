<?php
include '../../../core/config.php';
if(!isset($_SESSION['username'])){
    header("location: /"); exit;
}else{   
if($_SESSION['username'] === $config['username']){
$title = "Quản lý dịch vụ";
include '../../../layout/header.php';
?>
<div class="row">
         <div class="col-md-4">
    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Report Facebook</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content text-center">
                            <div>
                                <p>Tổng : <b class="text-danger"><?= mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `report`")); ?></b> ID</p>
                            </div>
                        <div class="m-t text-righ">
                                    <a href="/admin/dich-vu/report-facebook.html" class="btn btn-outline btn-primary">Xem <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                        </div>
                    </div>
    </div>
<div class="col-md-4">
    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Vip like</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content text-center">
                            <div>
                                <p>Tổng : <b class="text-danger"><?= mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `viplike`")); ?></b> ID</p>
                            </div>
                        <div class="m-t text-righ">
                                    <a href="/admin/dich-vu/vip-like.html" class="btn btn-outline btn-primary">Xem <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                        </div>
                    </div>
    </div>
    <div class="col-md-4">
    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Buff like</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content text-center">
                            <div>
                                <p>Tổng : <b class="text-danger"><?= mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `bufflike`")); ?></b> ID</p>
                            </div>
                        <div class="m-t text-righ">
                                    <a href="/admin/dich-vu/buff-like.html" class="btn btn-outline btn-primary">Xem <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                        </div>
                    </div>
    </div>
     <div class="col-md-4">
    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Buff comment</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content text-center">
                            <div>
                                <p>Tổng : <b class="text-danger"><?= mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `buffcomment`")); ?></b> ID</p>
                            </div>
                        <div class="m-t text-righ">
                                    <a href="/admin/dich-vu/buff-comment.html" class="btn btn-outline btn-primary">Xem <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                        </div>
                    </div>
    </div>
     <div class="col-md-4">
    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Buff share</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content text-center">
                            <div>
                                <p>Tổng : <b class="text-danger"><?= mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `buffshare`")); ?></b> ID</p>
                            </div>
                        <div class="m-t text-righ">
                                    <a href="/admin/dich-vu/buff-share.html" class="btn btn-outline btn-primary">Xem <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                        </div>
                    </div>
    </div>
     <div class="col-md-4">
    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Buff sub profile</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content text-center">
                            <div>
                                <p>Tổng : <b class="text-danger"><?= mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `buffsub`")); ?></b> ID</p>
                            </div>
                        <div class="m-t text-righ">
                                    <a href="/admin/dich-vu/buff-sub.html" class="btn btn-outline btn-primary">Xem <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                        </div>
                    </div>
    </div>
<div class="col-md-4">
    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Buff like page</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content text-center">
                            <div>
                                <p>Tổng : <b class="text-danger"><?= mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `bufflikepage`")); ?></b> ID</p>
                            </div>
                        <div class="m-t text-righ">
                                    <a href="/admin/dich-vu/buff-like-page.html" class="btn btn-outline btn-primary">Xem <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                        </div>
                    </div>
    </div>
<div class="col-md-4">
    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Buff Love TikTok</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content text-center">
                            <div>
                                <p>Tổng : <b class="text-danger"><?= mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `bufftiktok`")); ?></b> ID</p>
                            </div>
                        <div class="m-t text-righ">
                                    <a href="/admin/dich-vu/buff-tiktok.html" class="btn btn-outline btn-primary">Xem <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                        </div>
                    </div>
    </div>
<div class="col-md-4">
    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Buff Sub TikTok</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content text-center">
                            <div>
                                <p>Tổng : <b class="text-danger"><?= mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `buffsubtiktok`")); ?></b> ID</p>
                            </div>
                        <div class="m-t text-righ">
                                    <a href="/admin/dich-vu/buff-subtiktok.html" class="btn btn-outline btn-primary">Xem <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                        </div>
                    </div>
    </div>
</div>
<?php
include '../../../layout/footer.php';
}else{
    die(HACKER);
}
}
?>