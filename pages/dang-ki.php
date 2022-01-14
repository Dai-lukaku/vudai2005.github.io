<?php 
include '../core/config.php';
if(isset($_SESSION['username'])){
    header("location: /"); exit;
}else{
$title = "Đăng kí tài khoản";
include '../layout/meta.php';
if(isset($_POST['submit'])){
  $username = addslashes($_POST['username']);
  $password = addslashes($_POST['password']);
  $password1 = addslashes($_POST['password1']);
  $acc = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `users` WHERE `username`='".$username."'"));
  if($password != $password1){
      echo '<script>alert("2 mật khẩu không khớp");</script>';
  }else if($acc){
      echo '<script>alert("Tên đăng nhập đã tồn tại");</script>';
  }else{
      $_SESSION['username'] = $username;
      mysqli_query($conn,"INSERT INTO `users`(`id`, `username`, `password`, `vnd`) VALUES (NULL, '$username', '$password', 0)");
      echo '<script>alert("Đăng kí thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/"},2000);</script>';
  }
}
?>
<body class="gray-bg">
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <h3>Tạo tài khoản mới</h3>
        <form class="m-t needs-validation" novalidate role="form" action="#" method="POST">
            <div class="form-group">
                <input type="text" value="<?= $_POST['username']; ?>" name="username" class="form-control" placeholder="Tên đăng nhập" required="">
            </div>
            <div class="form-group">
                <input type="password" value="<?= $_POST['password']; ?>" name="password" class="form-control" placeholder="Mật khẩu" required="">
            </div>
            <div class="form-group">
                <input type="password" value="<?= $_POST['password1']; ?>" name="password1" class="form-control" placeholder="Nhập lại mật khẩu" required="">
            </div>
            <div class="form-group">
                    <div class="checkbox i-checks"><label> <input type="checkbox" checked><i></i> Tôi đồng ý các điều khoản ! </label></div>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b" name="submit">Đăng kí</button>

            <p class="text-muted text-center"><small>Bạn đã có tài khoản ?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="/">Đăng nhập tài khoản</a>
        </form>
    </div>
</div>
<?php include '../layout/footer.php'; } ?>