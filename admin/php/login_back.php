<?php
    session_start();
    include_once "config.php"; //import file php config.php vào file hiện tại
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); //Hàm xử lí kí tự đặc biệt để tránh làm cho câu query bị lỗi cú pháp
    
    if (!empty($id) && !empty($password)){
        //Kiểm tra email và password xem có match với database chưa
        $sqlKH = mysqli_query($conn, "SELECT * FROM KhachHang WHERE MSKH='{$id}' AND password='{$password}'");
        if (mysqli_num_rows($sqlKH) > 0){//Nếu matched
            $row = mysqli_fetch_assoc($sqlKH);
            //Cập nhật status thành active nếu user login thành công
                $_SESSION['id'] = $row['MSKH']; //Sử dụng session chúng ta sử dụng ở các file php khác
                echo "success client";
        } else {//Xét trường hợp là nhân viên
            $sqlNV = mysqli_query($conn, "SELECT * FROM NhanVien WHERE MSNV='{$id}' AND password='{$password}'");
            if (mysqli_num_rows($sqlNV) > 0){//Nếu matched
                $row = mysqli_fetch_assoc($sqlNV);
                //Cập nhật status thành active nếu user login thành công
                    $_SESSION['id'] = $row['MSNV']; //Sử dụng session chúng ta sử dụng ở các file php khác
                    echo "success admin";
            } else {
                echo "Mã số hoặc mật khẩu không đúng !!!";
            }
        }

    } else {
        echo "Tất cả trường không được để trống !!!";
    }
?>