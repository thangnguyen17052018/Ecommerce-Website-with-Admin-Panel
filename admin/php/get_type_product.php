<?php 
    include_once "config.php"; //import file php config.php vào file hiện tại
    $sql_LHH = mysqli_query($conn, "SELECT *
                                    FROM HangHoa
                                    LEFT JOIN LoaiHangHoa ON HangHoa.MaLoaiHang=LoaiHangHoa.MaLoaiHang
                                    WHERE HangHoa.MSHH='{$_POST['ID']}'");
    $row_LHH = mysqli_fetch_assoc($sql_LHH);
    echo $row_LHH['MaLoaiHang'];
?>