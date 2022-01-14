<?php
include '../../core/config.php';
if(!isset($_SESSION['username'])){
    header("location: /"); exit;
}else{   
function tinhtien($soluong,$camxuc,$goiBuffLike){
  if($soluong < $goiBuffLike['minLike']){
      $error = "Min ".number($goiBuffLike['minLike'])." Like";
      $tongthanhtoan = 0;
  }else if($soluong > $goiBuffLike['maxLike']){
      $error = "Max ".number($goiBuffLike['maxLike'])." Like";
      $tongthanhtoan = 0;
  }else{
      $tongthanhtoan = $goiBuffLike['rate'][$camxuc] * $soluong;
  }
  $tinhtien = array('tongthanhtoan' => $tongthanhtoan ,'fmtongthanhtoan' => number_format($tongthanhtoan) , 'error' => $error);
  return $tinhtien;
}
if($_GET['type'] === 'tinhtien' && is_numeric($_GET['soluong']) && is_numeric($_GET['camxuc'])){
echo json_encode(tinhtien(addslashes($_GET['soluong']),addslashes($_GET['camxuc']),$goiBuffLike));
exit;
}
if($_POST['type'] === 'thanhtoan' && ($_POST['idpost']) && is_numeric($_POST['soluong']) && $_POST['soluong'] > 0 && is_numeric($_POST['camxuc'])){
    $idpost = addslashes($_POST['idpost']);
    $soluong = addslashes($_POST['soluong']);
    $camxuc = addslashes($_POST['camxuc']);
    $tinhtien = tinhtien($soluong,$camxuc,$goiBuffLike);
    $tongthanhtoan = $tinhtien['tongthanhtoan'];
      if($tinhtien['error']){
        echo '<script>alert("'.$tinhtien['error'].'");</script>';
      }else if(!$tongthanhtoan){
        echo '<script>alert("Thông tin thanh toán không hợp lệ");</script>';
      }else if($tongthanhtoan > $account['vnd']){
        echo '<script>alert("Bạn không đủ tiền để thanh toán");</script>';
      }else{
        mysqli_query($conn,"UPDATE `users` SET `vnd`=`vnd`-'$tongthanhtoan' WHERE `username`='$username'");
        mysqli_query($conn,"INSERT INTO `bufflike`(`id`, `idpost`, `soluong`, `camxuc`, `tongthanhtoan`, `ghichu`, `status`, `time`, `username`) VALUES (NULL,'$idpost','$soluong','$camxuc','$tongthanhtoan',NULL,0,'$time','$username')");
        echo '<script>alert("Thanh toán thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/dich-vu/buff-like.html"},2000);</script>';
      }
exit; 
}
$title = "Buff like";
include '../../layout/header.php';
?>
<div class="row">
    <div class="col-md-6">
    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Thêm ID <?= $title; ?></h5>
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
         <div class="row">
          <div class="col-md-6">
          <div class="form-group">
        <input type="text" class="form-control" id="idpost" placeholder="ID bài viết" onkeyup="tinhtien();">
      </div>
          </div>
          <div class="col-md-6">
          <div class="form-group">
        <input type="number" class="form-control" id="soluong" placeholder="Số lượng(min 10)" onkeyup="tinhtien();">
      </div>
          </div>
      </div>
                                <div class="form-group">
                                    <label for="package-vip" class="control-label">Lựa Chọn Cảm Xúc</label>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-10 text-center mr-auto ml-auto">
                                        <input name="camxuc" checked type="radio" class="filled-in" id="like" value="1" onclick='tinhtien()' />
                                    <label for="like" ><img src="/asset/img/camxuc/like.png" style="width:24px" data-toggle="tooltip" title="" data-original-title="Thích"></label>
                                    <label for="like" style="margin-right: 20px; color:green"><span class="label label-success"><?= $goiBuffLike['rate'][1] ?> VNĐ</label>

                                    <input name="camxuc" type="radio" class="filled-in" id="love" value="2" onclick='tinhtien()' />
                                    <label for="love"><img src="/asset/img/camxuc/love.png" style="width:24px" data-toggle="tooltip" title="" data-original-title="Yêu Thích"></label>
                                    <label for="love" style="margin-right: 20px; color:green"><span class="label label-success"><?= $goiBuffLike['rate'][2] ?> VNĐ</label>

                                    <input name="camxuc" type="radio" class="filled-in" id="haha" value="3" onclick='tinhtien()' />
                                    <label for="haha"><img src="/asset/img/camxuc/haha.png" style="width:24px" data-toggle="tooltip" title="" data-original-title="Cười Lớn"></label>
                                    <label for="haha" style="margin-right: 20px; color:green"><span class="label label-success"><?= $goiBuffLike['rate'][3] ?> VNĐ</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10 text-center mr-auto ml-auto">
                                    <input name="camxuc" type="radio" class="filled-in" id="wow" value="4"  onclick='tinhtien()'/>
                                    <label for="wow"><img src="/asset/img/camxuc/wow.png" style="width:24px" data-toggle="tooltip" title="" data-original-title="Ngạc Nhiên"></label>
                                    <label for="wow" style="margin-right: 20px; color:green"><span class="label label-success"><?= $goiBuffLike['rate'][4] ?> VNĐ</label>

                                    <input name="camxuc" type="radio" class="filled-in" id="sad" value="5" onclick='tinhtien()' />
                                    <label for="sad"><img src="/asset/img/camxuc/sad.png" style="width:24px" data-toggle="tooltip" title="" data-original-title="Buồn"></label>
                                    <label for="sad" style="margin-right: 20px; color:green"><span class="label label-success"><?= $goiBuffLike['rate'][5] ?> VNĐ</label>

                                    <input name="camxuc" type="radio" class="filled-in" id="angry" value="6" onclick='tinhtien()'/>
                                    <label for="angry"><img src="/asset/img/camxuc/angry.png" style="width:24px" data-toggle="tooltip" title="" data-original-title="Phẫn Nộ"></label>
                                    <label for="angry" style="margin-right: 20px; color:green"><span class="label label-success"><?= $goiBuffLike['rate'][6] ?> VNĐ</label>
                                        </div>
                                    </div>
                                </div>
      <div class="form-group">
             <label class="active">Tổng Thanh Toán: <font color="red"><b id="tongthanhtoan">0</b></font> VNĐ</label>
           </div>
      <div class="form-group text-center">
          <button type="button" class="btn btn-primary" id="thanhtoan" onclick="thanhtoan();"><i class="fa fa-shopping-cart"></i> Thanh toán</button>
      </div>
                        </div>
                    </div>
    </div>
    <div class="col-md-6">
    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Chú ý</h5>
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
              <div>
                  <p>
                      <b class="text-danger">* BUFF LIKE POST :</b>
                      <div><strong>+ không nhập id album, id comment, id trang cá nhân, id page,...</strong></div>
                      <div><strong>+ like việt người dùng hoạt động</strong></div>
                      <div><strong>+ tùy lượng đơn mỗi ngày hệ thống có lúc nhanh - chậm </strong></div>
                      <div><strong>+ hiện tại tốc đang nhanh</strong></div>
                      <div><strong>Đối với buff like avatar : click hẳn vào ảnh rồi lấy ,nhiều bạn hay lấy sai ID  </strong></div>
                      <div><strong>Đối với buff like avatar : 1 số bạn không biết gì chưa mở công khai thì mở lên ,setting => bài viết công khai => thông tin cá nhân công khai chọn công khai</strong></div>
                  </p>
              </div>
                        </div>
                    </div>
    </div>
</div>
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
            <th>Trang thái</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
            <?php 
            $query = mysqli_query($conn,"SELECT * FROM `bufflike` WHERE `username`='$username' ORDER BY id DESC");
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
            <td>
            <button type="button" class="btn btn-primary">
            <?php
            if($row['status'] == 0) echo "Đang chạy";
            if($row['status'] == 1) echo "Đã hoàn thành";
            if($row['status'] == 2) echo "Huỷ đơn";
            ?>
            </button>
            </td>
            <td>
            <a href="?type=xoa&id=<?= $row['id']; ?>" class="btn btn-danger">Xoá</a>
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
    function tinhtien() {
        var soluong = $('#soluong').val();
        var camxuc = $("input[name=camxuc]:checked").val();
        $.get('#',{type:'tinhtien',soluong,camxuc},function (response) {
         if(response.error){
          alert(response.error);
          $('#tongthanhtoan').html(0);
          return;
         }else{
            if(parseInt(response.tongthanhtoan)){
             $('#tongthanhtoan').html(response.fmtongthanhtoan);                   
            }
         }
        },"json");
    }
    function thanhtoan(){
        var idpost = $('#idpost').val();
        var soluong = $('#soluong').val();
        var camxuc = $("input[name=camxuc]:checked").val();
        if(!idpost){
         alert('Vui lòng nhập ID bài viết');
         return;
        }else if(!soluong){
         alert('Vui lòng nhập số lượng');
         return;
        }else{
            tinhtien();
            wait('#thanhtoan',false);
            $.ajax({
                type: "POST",
                url: "#",
                data: {type:'thanhtoan',idpost,soluong,camxuc},
                dataType: "text",
                success: function (response) {
                    $('#ketqua').html(response);
                    wait('#thanhtoan',true,'<i class=\"fa fa-shopping-cart\"></i> Thanh toán');
                }
            });
        }
    }
</script>
<?php
if($_GET['type'] === 'xoa' && $_GET['id']){
  $id = addslashes($_GET['id']);
  $check = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `bufflike` WHERE `id`='$id' AND`username`='$username'")); 
  if($check){
    mysqli_query($conn,"DELETE FROM `bufflike` WHERE `id`='$id' AND `username`='$username'");
    echo '<script>alert("Xoá thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/dich-vu/buff-like.html"},2000);</script>';
  }else{
    echo '<script>alert("Không thể xoá ID này");</script>';
  }
}
include '../../layout/footer.php';
}
?>