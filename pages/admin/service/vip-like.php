<?php
include '../../../core/config.php';
if(!isset($_SESSION['username'])){
    header("location: /"); exit;
}else{   
if($_SESSION['username'] === $config['username']){
$title = "Quản lý Vip like";
include '../../../layout/header.php';
?>
<div class="row">
    <div class="col-lg-12">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>Danh sách ID</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">

            <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataTables-example" >
        <thead>
        <tr>
            <th>#</th>
            <th>Thời gian</th>
            <th>ID Facebook</th>
            <th>Họ tên</th>
            <th>Hạn sử dụng</th>
            <th>Loại</th>
            <th>Ngày hết hạn</th>
            <th>Trang thái</th>
            <th>Username</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
            <?php 
            $query = mysqli_query($conn,"SELECT * FROM `viplike` WHERE `status`= 0 ORDER BY id DESC");
            $stt = 0;
            while($row = mysqli_fetch_array($query)){ 
                ++$stt;
            ?>
           <tr>
            <td><?= $stt; ?></td>
            <td><?= date('d/m/Y - H:i:s',$row['time']); ?></td>
            <td><?= $row['idvip']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['hsd']; ?> ngày</td>
            <td><?php
  if($row['loai'] == 1){
    echo $goiVipLike['nameVip'][1];
  }else if($row['loai'] == 2){
    echo $goiVipLike['loai'][2];
  }else if($row['loai'] == 3){
    echo $goiVipLike['nameVip'][3];
  }else if($row['loai'] == 4){
    echo $goiVipLike['nameVip'][4];
  }
  ?></td>
            <td><?= date('d/m/Y - H:i:s',$row['time_die']); ?></td>
            <td>
            <button type="button" class="btn btn-primary">
            <?php
            if($row['status'] == 0) echo "Đang chạy";
            if($row['status'] == 1) echo "Đã hoàn thành";
            ?>
            </button>
            </td>
            <td><?= $row['username']; ?></td>
            <td>
            <a href="?type=xoa&id=<?= $row['id']; ?>&user=<?= $row['username']; ?>" class="btn btn-danger">Xoá</a>
            </td>
           </tr>
            <?php } ?>
        </tbody>
        </table>
            </div>

        </div>
    </div>
</div>
</div>
<?php
if($_GET['type'] === 'xoa' && $_GET['id'] && $_GET['user']){
    $id = addslashes($_GET['id']);
    $user = addslashes($_GET['user']);
    $check = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `viplike` WHERE `id`='$id' AND`username`='$user'")); 
    if($check){
      mysqli_query($conn,"DELETE FROM `viplike` WHERE `id`='$id' AND `username`='$user'");
      echo '<script>alert("Xoá thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/admin/dich-vu/vip-like.html"},2000);</script>';
    }else{
      echo '<script>alert("Không thể xoá ID này");</script>';
    }
  }
include '../../../layout/footer.php';
}else{
    die(HACKER);
}
}
?>