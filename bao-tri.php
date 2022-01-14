<?php 
$title = "BẢO TRÌ";
include './layout/meta.php';
include './core/config.php';
?>
<body class="gray-bg">                   
    <div class="loginColumns animated fadeInDown">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox-content product-box">
                  <div class="ibox-content">
        <center><h2>BẢO TRÌ HỆ THỐNG</h2></center>
                        <div class="form-group">
                      <b>Nội Dung Bảo Trì :</b>
<br>_<?= $config['baotri1']; ?><br>_<?= $config['baotri2']; ?>
                        </div>
          <a href="https://zalo.me/0949527012">
                        <button type="submit" class="btn btn-primary block full-width m-b" name="submit">LIÊN HỆ</button> 
         </a>
                        <a class="btn btn-sm btn-white btn-block" href="#">BẢO TRÌ SAU 5h00</a>
                </div>
            </div>
</div>
    </div>
    </hr>
<?php include './layout/footer.php'; ?>