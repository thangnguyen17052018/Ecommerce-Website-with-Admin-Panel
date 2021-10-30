<?php
    include_once "config.php"; //import file php config.php vào file hiện tại
    $msKH = $_POST['MSKH'];
    $sql1 = mysqli_query($conn, "SELECT * FROM DiaChiKH WHERE MSKH='$msKH' ORDER BY MacDinh DESC");
    $index = 1;
    $output = "";
    while($row1 = mysqli_fetch_assoc($sql1)){
        $output .= '<tr id="'.$row1['MaDC'].'">';
        $output .= '<th scope="row">'.$index.'</th>';
        $output .= '<td data-target="MaDC">'.$row1['MaDC'].'</td>';
        $output .= '<td data-target="DiaChi">'.$row1['DiaChi'].'</td>';
        if ($row1['MacDinh'] == 1)
            $default = '<span class="badge bg-secondary">Mặc định</span>';
        else 
            $default = "";
        $output .= '<td data-target="Mặc định">'.$default.'</td>';
        $output .= '</tr>';
        $index++;
    }
    echo $output;
    
?>