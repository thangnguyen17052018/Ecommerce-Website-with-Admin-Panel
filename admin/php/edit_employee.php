<?php
    include_once "./config.php"; //import file php config.php vào file hiện tại
    
    if (isset($_POST['MSNV'])){
        $id = $_POST['MSNV'];
        $ho_ten = $_POST['HoTenNV'];
        $chuc_vu = $_POST['ChucVu'];
        $dia_chi = $_POST['DiaChi'];
        $sdt = $_POST['SoDienThoai'];
        
        /* Query cập nhật thông tin nhân viên*/
        $query = mysqli_query($conn, "UPDATE NhanVien 
                            SET HoTenNV='$ho_ten', ChucVu='$chuc_vu', DiaChi='$dia_chi', SoDienThoai='$sdt' 
                            WHERE MSNV='$id'
                    ");
        if ($query){
            echo 'data updated';
        }
    }
?>