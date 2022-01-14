<?php
include '../../core/config.php';
if(!isset($_SESSION['username'])){
    header("location: /"); exit;
}else{   
$title = "Nạp tiền vào tài khoản";
include '../../layout/header.php';
?>
<div class="row">
    <div class="col-lg-12">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>Nạp tiền chuyển khoản</h5>
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
	      <table class="table table-bordered col-md-8 mr-auto ml-auto">
          <thead>
												<tr class="active">
													<th>
														<center>Ngân hàng</center>
													</th>
													<th>
														<center>
                                                        Thông tin chuyển khoản
														</center>
													</th>
												</tr>
        </thead>
        <tbody>

												<tr>
													<td>
														<center><b>AGRIBANK</b><br><img src="http://tthtsv.ueh.edu.vn/wp-content/uploads/2019/05/agribank-logo-300x197.png" width="200" height="65"></center>
													</td>
													<td><b>
															<center>- Số tài khoản: <font color="red">3902205174446</font>
														</b><br>
														- Tên : <b>
															<font color="red"><?= $config['admin']; ?></font>
														</b><br>
														- Nội dung chuyển khoản: <font color="red"><b><?= $username; ?></font> PDH.S</b>
													</td>
                                                </tr>
                                                <tr>
													<td>
														<center><b>우리은행</b></b><br><img src="https://www.ekoreanews.co.kr/news/photo/202002/42114_52054_4050.jpg" width="200" height="65"></center>
													</td>
													<td><b>
															<center>- Số tài khoản: <font color="red">1002259081772</font>
														</b><br>
														- Tên : <b>
															<font color="red"><?= $config['admin2']; ?></font>
														</b><br>
														<center><b>1.000Won=15.000VNĐ</b>
														</center>
														<b><font color="red">Lưu Ý: Chuyển Khoản Xong Vui Lòng Gửi Bill</font>
														<div class="form-group">
                                                        <a href="https://facebook.com/phandinhhung.store">
                                                        <b>Tại Đây</b>
                                                        </a>
                                                        <font color="red">Để Cộng Tiền</b></font>
													</td>
													</div>
                                                </tr>
                                                <tr>
													<td>
														<center><b>MOMO</b><br><img src="https://static.mservice.io/blogscontents/momo-upload-api-push-momo-avatar-190131152912.png" width="200" height="65"></center>
													</td>
													<td><b>
															<center>- Số tài khoản: <font color="red">0949527012</font>
														</b><br>
														- Tên : <b>
															<font color="red"><?= $config['admin']; ?></font>
														</b><br>
														- Nội dung chuyển khoản: <font color="red"><b><?= $username; ?></font> PDH.S</b>
													</td>
                                                </tr>
        </tbody>
          </table>
        </div>

        </div>
    </div>
</div>
</div>
<?php
include '../../layout/footer.php';
}
?>