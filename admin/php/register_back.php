<?php
    session_start();
    include_once "config.php"; //import file php config.php vào file hiện tại
    $mskh = mysqli_real_escape_string($conn, $_POST['MSKH']);
    $hoTenKH = mysqli_real_escape_string($conn, $_POST['HoTenKH']);
    $tenCongTy = mysqli_real_escape_string($conn, $_POST['TenCongTy']);
    $soDienThoai = mysqli_real_escape_string($conn, $_POST['SoDienThoai']); //Hàm xử lí kí tự đặc biệt để tránh làm cho câu query bị lỗi cú pháp
    $soFax = mysqli_real_escape_string($conn, $_POST['SoFax']);
    $password = mysqli_real_escape_string($conn, $_POST['Password']);

    if (!empty($mskh) && !empty($hoTenKH) && !empty($tenCongTy) && !empty($soDienThoai) && !empty($soFax) && !empty($password)){   
        //Kiểm tra xem MSKH có tồn tại trong database chưa
        $sql = mysqli_query($conn, "SELECT MSKH FROM KhachHang WHERE MSKH = '{$mskh}'");
        if (mysqli_num_rows($sql) > 0){//Nếu mskh đã tồn tại
            echo "$mskh - MSKH đã tồn tại";
        } else {
            //Insert tất cả dữ liệu user vào bảng
            $sql2 =  mysqli_query($conn, "INSERT INTO khachhang (MSKH, HoTenKH, TenCongTy, SoDienThoai, SoFax, Password) 
                                    VALUES ('{$mskh}', '{$hoTenKH}', '{$tenCongTy}', '{$soDienThoai}', '{$soFax}', '{$password}')");
            if ($sql2){//Nếu dữ liệu đã được insert
                $sql3 = mysqli_query($conn, "SELECT * FROM khachhang WHERE MSKH='{$mskh}'");
                if (mysqli_num_rows($sql3) > 0){
                    $row = mysqli_fetch_assoc($sql3);//Tìm và trả về câu truy vấn dưới dạng mảng thích hợp
                    $_SESSION['id'] = $row['MSKH']; //Sử dụng session chúng ta sử dụng ở các file php khác
                    echo "success";
                } else {
                    echo "MSKH không tồn tại";
                }
            } else {
                echo "Có gì đó sai! Đăng kí không thành công";
            }
        }        
    } else {
            echo "Tất cả các trường đều không được để trống";
        }
?> 