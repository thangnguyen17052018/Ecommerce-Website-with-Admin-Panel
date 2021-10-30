<?php
    include_once "./config.php"; //import file php config.php vào file hiện tại
    
    if (isset($_POST['MaHinh'])){
        $id = $_POST['MaHinh'];
        /* Query xóa hình hàng hóa trước*/
        $query1 = mysqli_query($conn, "DELETE FROM HinhHangHoa
                                       WHERE MaHinh='$id';
                            ");

        if ($query1){
            echo 'success';
        } 
    }
?>