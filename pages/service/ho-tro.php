<?php
include '../../core/config.php';
if(!isset($_SESSION['username'])){
    header("location: /"); exit;
}else{   
$title = "Hỗ Trợ Web";
include '../../layout/header.php';
?>
<div class="row">
    <div class="col-lg-12">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>Thông Tin Liên Hệ</h5>
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
														<center>Ứng Dụng</center>
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
														<center><b>FACEBOOK</b><br><img src="https://sites.google.com/site/banfanpagefb/_/rsrc/1489113741131/tin-tuc/tai-sao-doanh-nghiep-can-co-fanpage-facebook/TAI-SAO-DOANH-NGHIEP-CAN-CO-FANPAGE.png" width="200" height="65"></center>
													</td>
													<td><b>
															<center><big><b>LINK: <font color="red">https://facebook.com/phandinhhung.store</b></big></font></center>
															<center><big><b>CÓ THỂ CHUYỂN ĐẾN PAGE</b></big></center>
															<div class="form-group">
                                                            <a href="https://facebook.com/phandinhhung.store">
                                                            <center><big><b><font color="red">Tại Đây</font></b></big></center>
                                                            </a>
                                                            </div>
														</b>
													</td>
                                                </tr>
                                                <tr>
													<td>
														<center><b>ZALO</b></b><br><img src="https://www.monkube.com/wp-content/uploads/2020/06/zalo.jpg" width="200" height="65"></center>
													</td>
													<td><b>
															<center><big><b>Số Điện Thoại: <font color="red">0949527012</b></big></font></center>
															<center><big><b>CÓ THỂ CHUYỂN ĐẾN ZALO</b></big></center>
															<div class="form-group">
                                                            <a href="https://zalo.me/0949527012">
                                                            <center><big><b><font color="red">Tại Đây</font></b></big></center>
														</b><br>
														
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