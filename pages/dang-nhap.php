<?php 
$title = "Đăng nhập hệ thống";
include './layout/meta.php';
if(isset($_POST['submit'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $acc = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `users` WHERE `username`='".$username."'"));
  if(!$acc){
    echo '<script>alert("Tên đăng nhập không tồn tại");</script>';
  }else if($acc['id'] && $password != $acc['password']){
    echo '<script>alert("Sai mật khẩu , vui lòng thử lại");</script>';
  }else{
    $_SESSION['username'] = $username;
    echo '<script>alert("Đăng nhập thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/"});</script>';
  }
}
?>
<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">Welcome to <?= $config['domain']; ?></h2>

                <p>
                <?= $config['domain']; ?> SẼ GIÚP GÌ BẠN?
Chúng tôi cung cấp cho  quý khách những giải pháp chuyên nghiệp phục vụ cho công việc tìm kiếm khách hàng, kinh doanh buôn bán hiệu quả trên internet. Chúng tôi luôn là đối tác lớn mạnh của cá nhân, công ty, ca sĩ, doanh nghiệp…
                </p>

                <p>
                Chi phí hợp lý hiệu quả cao !

Chúng tôi luôn đưa ra nhiều giải pháp phù hợp với nhu cầu sử dụng, đa dạng nhiều gói dịch vụ giúp khách hàng thoải mái lựa chọn.             </p>

                <p>
              
Tốc độ làm việc và hoàn thành cực nhanh, chỉ cần gửi chúng tôi link công việc sau đó bạn chỉ cần đếm 3,2,1 là hoàn thành.                </p>

                <p>
               
Chất lượng, giá rẻ, bảo trì đầy đủ nhưng vẫn đảm bảo thời gian nhanh chóng để bàn giao.                </p>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <h3>Thông tin đăng nhập</h3>
                    <form class="m-t needs-validation" novalidate role="form" action="#" method="POST">
                        <div class="form-group">
                            <input type="text" value="<?= $_POST['username']; ?>" name="username" class="form-control" placeholder="Tên đăng nhập" required="">
                        </div>
                        <div class="form-group">
                            <input type="password" value="<?= $_POST['password']; ?>" name="password" class="form-control" placeholder="Mật khẩu" required="">
                        </div>
                        <div class="form-group">
                        <a href="https://zalo.me/0949527012">
                            <b>Quên Mật Khẩu ?</b>
                        </a>
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b" name="submit">Đăng nhập</button>
                        <a class="btn btn-sm btn-white btn-block" href="/dang-ki.html">Đăng kí tài khoản</a>
                    </form>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                <b>Copyright © 2020</b> <?= $config['admin']; ?>
            </div>
            <div class="col-md-6 text-right">
              <b>Vận hành bởi</b> <?= $config['admin']; ?>
            </div>
        </div>
    </div>
<?php include './layout/footer.php'; ?>