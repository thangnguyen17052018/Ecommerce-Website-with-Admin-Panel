<?php
    session_start();
    if (isset($_SESSION['id'])){//nếu người dùng đã đăng nhặp sau đó đến trang này thay vì đến trang login page
        include_once "config.php";
        $id_logout = mysqli_real_escape_string($conn, $_GET['id_logout']);
        if (isset($id_logout)){//Nếu id_logout đã được đặt
                session_unset();
                session_destroy();
                header("location: ../login.php");
        } else {
            header("location: ../admin_panel.php");    
        }
    } else {
        header("location: ../login.php");
    }
?>