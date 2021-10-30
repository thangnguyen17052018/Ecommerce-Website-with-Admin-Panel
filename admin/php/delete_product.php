<?php
    include_once "./config.php"; //import file php config.php vào file hiện tại
    
    if (isset($_POST['MSHH'])){
        $id = $_POST['MSHH'];
        /* Query xóa hình hàng hóa trước*/
        $query1 = mysqli_query($conn, "DELETE FROM HinhHangHoa
                                       WHERE MSHH='$id';
                            ");
        $query2 = mysqli_query($conn, "DELETE FROM HangHoa
                                       WHERE MSHH='$id';
                            ");               


        if ($query1 && $query2){
            echo 'success';
        }
    }
?>