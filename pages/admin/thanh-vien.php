<?php
include '../../core/config.php';
if(!isset($_SESSION['username'])){
    header("location: /"); exit;
}else{   
if($_SESSION['username'] === $config['username']){
$title = "Quản lý thành viên";
include '../../layout/header.php';
?>
<div class="row">
    <div class="col-lg-12">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>Danh sách thành viên</h5>
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
            <th>Tên đang nhập</th>
            <th>Số dư</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
            <?php 
            $query = mysqli_query($conn,"SELECT * FROM `users` ORDER BY id DESC");
            $stt = 0;
            while($row = mysqli_fetch_array($query)){ 
                ++$stt;
            ?>
           <tr>
            <td><?= $stt; ?></td>
            <td><?= $row['username']; ?></td>
            <td><?= number_format($row['vnd']); ?> VNĐ</td>
            <td>
            <a href="?type=xoa&id=<?= $row['id']; ?>&user=<?= $row['username']; ?>" class="btn btn-danger">Xoá</a>
            <button type="button" onclick="domVND('<?= $row['username']; ?>');" class="btn btn-primary" data-toggle="modal" data-target="#addVND">Cộng tiền</button>
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
<script>
    function domVND(username) { 
                $('#un').val(username); 
     }
</script>
<?php
if($_GET['type'] === 'xoa' && $_GET['id'] && $_GET['user']){
    $id = addslashes($_GET['id']);
    $user = addslashes($_GET['user']);
    $check = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `users` WHERE `id`='$id' AND`username`='$user'")); 
    if($check){
      mysqli_query($conn,"DELETE FROM `users` WHERE `id`='$id' AND `username`='$user'");
      echo '<script>alert("Xoá thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/admin/thanh-vien.html"},2000);</script>';
    }else{
      echo '<script>alert("Không thể xoá ID này");</script>';
    }
  }
include '../../layout/footer.php';
}else{
    die(HACKER);
}
}
?>