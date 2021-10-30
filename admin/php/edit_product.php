<?php
    include_once "./config.php"; //import file php config.php vào file hiện tại
    
    if (isset($_POST['MSHH'])){
        $id_HH = $_POST['MSHH'];
        $ten_HH = $_POST['TenHH'];
        $quy_cach = $_POST['QuyCach'];
        $gia = $_POST['Gia'];
        $so_luong_hang = $_POST['SoLuongHang'];
        $ma_loai_hang = $_POST['MaLoaiHang'];

        
        /* Query cập nhật thông tin hàng hóa*/
        $query = mysqli_query($conn, "UPDATE HangHoa 
                            SET TenHH='$ten_HH', QuyCach='$quy_cach', Gia='$gia', SoLuongHang='$so_luong_hang', MaLoaiHang='$ma_loai_hang' 
                            WHERE MSHH='$id_HH'
                    ");
        if ($query){
            echo 'success';
        }
    }
?>