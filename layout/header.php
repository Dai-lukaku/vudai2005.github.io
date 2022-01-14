<?php include 'meta.php'; ?>
<body class="top-navigation">
    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom white-bg">
        <nav class="navbar navbar-expand-lg navbar-static-top" role="navigation">

                <a href="/" class="navbar-brand">Dịch Vụ Facebook</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-reorder"></i>
                </button>

            <div class="navbar-collapse collapse" id="navbar">
                <ul class="nav navbar-nav mr-auto">
                    <li class="active">
                        <a aria-expanded="false" role="button" href="/"> <i class="fa fa-home"></i><b>Trang Chủ</b></a></li>
                        <li><a href="/dich-vu/ho-tro.html"> <i class="fa fa-inbox"></i><b>Liên Hệ</b></a></li>
                    </li>
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-money"></i><b>Nạp Tiền</b></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="/dich-vu/nap-tien.html"><b>Nạp Chuyển Khoản</b></a></li>
                            <li><a href="/napthe.php"><b>Nạp Thẻ Cào</b></a></li>
                        </ul>
                    </li>    
                    <?php if(isset($_SESSION['username']) & $_SESSION['username'] === $config['username']){ ?> 
                        <li class="dropdown">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-gear"></i> Quản trị viên</a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="#" data-toggle="modal" data-target="#addVND">Cộng tiền thành viên</a></li>
                            <li><a href="/admin/dich-vu/all.html">Quản lý dịch vụ</a></li>
                            <li><a href="/admin/thanh-vien.html">Danh sách thành viên</a></li>
                        </ul>
                    </li>    
                    <?php } ?>
                </ul>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="/dang-xuat.html">
                            <i class="glyphicon glyphicon-off"></i> Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        </div>
        <div class="wrapper wrapper-content">
            <div class="container">
            <div class="row m-b-lg m-t-lg">
                <div class="col-md-6">

                    <div class="profile-image">
                    <a href="/">
                        <img src="https://thuviendohoa.vn/upload/images/items/vector-icon-logo-facebook-4375.jpg" alt="Bản Quyền cấm copy" class="rounded-circle circle-border m-b-md"></a>
                    </div>
                    <div class="profile-info">
                        <div class="">
                            <div>
                                <a href="/" class="no-margins" style="text-transform: uppercase;">
                                <h2><?= $_SESSION['username']; ?></h2>
                                </a>
                                <h4>Số Dư : <b class="text-danger"><?= number_format($account['vnd']); ?></b> VNĐ</h4>
                                <small>
                                   Chúc bạn sử dụng dịch vụ vui vẻ.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           