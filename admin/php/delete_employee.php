<?php
    include_once "./config.php"; //import file php config.php vào file hiện tại
    
    if (isset($_POST['MSNV'])){
        $id = $_POST['MSNV'];
        /* Query xóa nhân viên*/
        $query = mysqli_query($conn, "DELETE FROM NhanVien 
                            WHERE MSNV='$id';
                    ");
        if ($query){
            echo 'success';
        }
    }
?>