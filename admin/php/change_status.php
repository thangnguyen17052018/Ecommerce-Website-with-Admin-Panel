<?php
    include_once "./config.php"; //import file php config.php vào file hiện tại
    
    if (isset($_POST['SoDonDH'])){
    
        $status = $_POST['TrangThaiDH'];
        $id = $_POST['SoDonDH'];
    }
        /* Query cập nhật thông tin đặt hàng*/
        $query = mysqli_query($conn, "UPDATE DatHang 
                                     SET TrangThaiDH = '$status'
                                     WHERE SoDonDH='$id';
                    ");
        if ($query){
            echo 'success';
        }
    
?>