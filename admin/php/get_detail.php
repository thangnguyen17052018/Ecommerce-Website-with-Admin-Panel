<?php
    include_once "config.php"; //import file php config.php vào file hiện tại
    $msDH = $_POST['SoDonDH'];
    $sql1 = mysqli_query($conn, "SELECT * FROM chitietdathang
                                 LEFT JOIN hanghoa ON chitietdathang.MSHH = hanghoa.MSHH                    
                                 WHERE chitietdathang.SoDonDH = '$msDH'");
    $index = 1;
    $output = "";
    $total = 0;

    $output .= '<thead>
        <tr>
            <th scope="col" width="50px">#</th>
            <th scope="col">Mã hàng hóa</th>
            <th scope="col">Tên hàng hóa</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Giá đặt hàng</th>
            <th scope="col">Giảm giá</th>
        </tr>
    </thead>
    <tbody>';
    while($row1 = mysqli_fetch_assoc($sql1)){
        $output .= '<tr id="'.$row1['SoDonDH'].'">';
        $output .= '<th scope="row">'.$index.'</th>';
        $output .= '<td data-target="MaHH">'.$row1['MSHH'].'</td>';
        $output .= '<td data-target="TenHangHoa">'.$row1['TenHH'].'</td>';
        $output .= '<td data-target="SoLuong">'.$row1['SoLuong'].'</td>';
        $output .= '<td data-target="GiaDatHang">'.$row1['GiaDatHang'].'</td>';
        $output .= '<td data-target="GiamGia">'.$row1['GiamGia'].'</td>';
        $output .= '</tr>';
        $total += $row1['GiaDatHang'] - $row1['GiamGia'];
        $index++;
    }
    $output .= '</tbody>
                <tfoot>
                    <tr class="table-primary">
                        <th scope="col">Tổng:</th>
                        <td colspan=5" style="text-align: right; padding-right: 36px; color: #c90f2e; font-weight: 600; font-size: 20px;" id="total" active>'.$total.' VNĐ</td>
                    </tr>
                </tfoot>
                ';

    

    echo $output;
    
?>