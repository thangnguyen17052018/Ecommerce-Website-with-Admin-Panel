<?php
    include_once "./config.php"; //import file php config.php vào file hiện tại
    
    if (isset($_POST['MSNV'])){
        $id = $_POST['MSNV'];
        $ho_ten = $_POST['HoTenNV'];
        $chuc_vu = $_POST['ChucVu'];
        $dia_chi = $_POST['DiaChi'];
        $sdt = $_POST['SoDienThoai'];
        $pwd = $_POST['Password'];
        /* Query cập nhật thông tin nhân viên*/
        $query = mysqli_query($conn, "INSERT INTO NhanVien 
                                    values ('$id', '$ho_ten', '$chuc_vu', '$dia_chi', '$sdt', '$pwd');
                    ");
        if ($query){
            echo 'success';
        }
    }
?>