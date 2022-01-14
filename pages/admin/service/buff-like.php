<?php
include '../../../core/config.php';
if(!isset($_SESSION['username'])){
    header("location: /"); exit;
}else{   
if($_SESSION['username'] === $config['username']){
$title = "Quản lý Buff like";
include '../../../layout/header.php';
if($_GET['type'] === 'note' && $_GET['id'] && $_GET['user']){
    $id = addslashes($_GET['id']);
    $user = addslashes($_GET['user']);
    $check = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `bufflike` WHERE `id`='$id' AND`username`='$user'")); 
    if(!$check){
        header("location: /admin/dich-vu/buff-like.html"); exit;
    }else{
        if(isset($_POST['submit'])){
            $ghichu = addslashes($_POST['ghichu']);
            mysqli_query($conn,"UPDATE `bufflike` SET `ghichu`= '$ghichu' WHERE  `id`= '$id' AND  `username`= '$user'");
            echo '<script>alert("Ghi chú thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/admin/dich-vu/buff-like.html"},2000);</script>';
          }
        ?>
        <div class="row">
        <div class="col-md-6 mr-auto ml-auto">
    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Sủa ghi chú</h5>
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
           <form class="m-t needs-validation" novalidate role="form" action="#" method="POST">
            <div class="form-group">
              <textarea class="form-control" name="ghichu" rows="3" required><?=  $check['ghichu']; ?></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="submit">Lưu</button>
            </div>
          </form>
                        </div>
                    </div>
    </div>
        </div>
        <?php
    }
}else{
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
            <th>ID post</th>
            <th>Số lượng</th>
            <th>Cảm xúc</th>
            <th>Ghi chú</th>
            <th>Trang thái</th>
            <th>Username</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
            <?php 
            $query = mysqli_query($conn,"SELECT * FROM `bufflike` WHERE `status`= 0 ORDER BY id DESC");
            $stt = 0;
            while($row = mysqli_fetch_array($query)){ 
                ++$stt;
            ?>
           <tr>
            <td><?= $stt; ?></td>
            <td><?= date('d/m/Y - H:i:s',$row['time']); ?></td>
            <td><?= $row['idpost']; ?></td>
            <td><?= $row['soluong']; ?></td>
            <td><?= $listCx[$row['camxuc']]; ?></td>
            <td><textarea class="form-control" rows="3"><?= $row['ghichu']; ?></textarea></td>
            <td>
            <button type="button" class="btn btn-primary">
            <?php
            if($row['status'] == 0) echo "Đang chạy";
            if($row['status'] == 1) echo "Đã hoàn thành";
            if($row['status'] == 2) echo "Huỷ đơn";
            ?>
            </button>
            </td>
            <td><?= $row['username']; ?></td>
            <td>
            <a href="?type=xoa&id=<?= $row['id']; ?>&user=<?= $row['username']; ?>" class="btn btn-danger">Xoá</a>
            <a href="?type=note&id=<?= $row['id']; ?>&user=<?= $row['username']; ?>" class="btn btn-info">Sửa ghi chú</a>
            <a href="?type=done&id=<?= $row['id']; ?>&user=<?= $row['username']; ?>" class="btn btn-success">Done</a>
            <a href="?type=error&id=<?= $row['id']; ?>&user=<?= $row['username']; ?>" class="btn btn-warning">Hoàn trả</a>
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
    $check = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `bufflike` WHERE `id`='$id' AND`username`='$user'")); 
    if($check){
      mysqli_query($conn,"DELETE FROM `bufflike` WHERE `id`='$id' AND `username`='$user'");
      echo '<script>alert("Xoá thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/admin/dich-vu/buff-like.html"},2000);</script>';
    }else{
      echo '<script>alert("Không thể xoá ID này");</script>';
    }
  }
  if($_GET['type'] === 'done' && $_GET['id'] && $_GET['user']){
    $id = addslashes($_GET['id']);
    $user = addslashes($_GET['user']);
    $check = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `bufflike` WHERE `id`='$id' AND`username`='$user'")); 
    if($check){
        mysqli_query($conn,"UPDATE `bufflike` SET `status`= 1 WHERE  `id`= '$id' AND  `username`= '$user'");
    }
    echo '<script>alert("Done thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/admin/dich-vu/buff-like.html"},2000);</script>';
  }
  if($_GET['type'] === 'error' && $_GET['id'] && $_GET['user']){
    $id = addslashes($_GET['id']);
    $user = addslashes($_GET['user']);
    $check = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `bufflike` WHERE `id`='$id' AND`username`='$user'")); 
    if($check){
        mysqli_query($conn,"UPDATE `users` SET `vnd`=`vnd`+'".$check["tongthanhtoan"]."' WHERE `username`='$user'");
        mysqli_query($conn,"UPDATE `bufflike` SET `status`= 2 WHERE `id`= '$id' AND  `username`= '$user'");
    }
    echo '<script>alert("Hoàn trả thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/admin/dich-vu/buff-like.html"},2000);</script>';
  }
}
include '../../../layout/footer.php';
}else{
    die(HACKER);
}
}
?>