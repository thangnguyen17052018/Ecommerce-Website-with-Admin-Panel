<?php
    include_once "config.php"; //import file php config.php vào file hiện tại
    $sql1 = mysqli_query($conn, "SELECT * FROM NhanVien");
    $index = 1;
    $output = "";
    while($row1 = mysqli_fetch_assoc($sql1)){
        $output .= '<tr id="'.$index.'">';
        $output .= '<th scope="row">'.$index.'</th>';
        $output .= '<td data-target="MSNV">'.$row1['MSNV'].'</td>';
        $output .= '<td data-target="HoTenNV">'.$row1['HoTenNV'].'</td>';
        $output .= '<td data-target="ChucVu">'.$row1['ChucVu'].'</td>';
        $output .= '<td data-target="DiaChi">'.$row1['DiaChi'].'</td>';
        $output .= '<td data-target="SoDienThoai">'.$row1['SoDienThoai'].'</td>';
        $output .= '<td>
        <button type="button" class="btn badge rounded-pill btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#edit-modal" data-role="edit" data-id="'.$index.'" style="width:80px; height:36px; font-size:16px">Sửa</button>
        <button type="button" class="btn badge rounded-pill btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#delete-modal" data-role="delete" data-id="'.$index.'" style="width:80px; height:36px; font-size:16px">Xóa</button>
    </td>';
        $output .= '</tr>';
        $index++;
    }
    echo $output;
    
?>