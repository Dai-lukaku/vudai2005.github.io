<?php
include '../../core/config.php';
if(isset($_SESSION['username']) & $_SESSION['username'] === $config['username']){
    if($_POST['type'] === 'admin_vnd'){
        $un = addslashes($_POST['un']);
        $vnd = addslashes($_POST['vnd']);
        mysqli_query($conn,"UPDATE `users` SET `vnd`=`vnd`+ '$vnd' WHERE `username`='$un'");
        echo '<script>alert("Cộng thành công");</script>';
     exit;
    }
}else{
    die(HACKER); exit;
}
?>