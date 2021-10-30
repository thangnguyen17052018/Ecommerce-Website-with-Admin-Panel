<?php
    $conn = mysqli_connect("localhost", "root", "", "quanlydathang");
    mysqli_set_charset($conn, "utf8mb4");
    if (!$conn) {
        die ("Không thể kết nối đến cơ sở dữ liệu" . mysqli_connect_error());
    } 
?>