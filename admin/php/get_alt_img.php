<?php
    include_once "config.php"; //import file php config.php vào file hiện tại
    $msHH = $_POST['MSHH'];
    $sql1 = mysqli_query($conn, "SELECT * FROM HinhHangHoa WHERE MSHH='$msHH' ORDER BY CAST(SUBSTRING(MaHinh, 2, LENGTH(MaHinh)) AS INT) ASC");
    $index = 1;
    $output = "";
    while($row1 = mysqli_fetch_assoc($sql1)){
        $output .= '<tr id="'.$row1['MaHinh'].'">';
        $output .= '<th scope="row">'.$index.'</th>';
        $output .= '<td data-target="MaHinh">'.$row1['MaHinh'].'</td>';
        $output .= '<td data-target="Preview">'.'<img src="./assets/images/'.$row1['TenHinh'].'" style="width:100px; heigth: 100px">'.'</td>';
        $output .= '<td>
                        <button type="button" class="btn badge rounded-pill btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#delete-img-modal" data-role="delete-img" data-id="'.$row1['MaHinh'].'" style="width:80px; height:36px; font-size:16px">Xóa</button>
                    </td>';
        $output .= '</tr>';
        $index++;
    }
    echo $output;
    
?>