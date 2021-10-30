<?php
    include_once "config.php"; //import file php config.php vào file hiện tại
    
    $sql1 = "SELECT * FROM KhachHang LEFT JOIN DiaChiKH ON KhachHang.MSKH = DiaChiKH.MSKH WHERE DiaChiKH.MacDinh = 1";
    $query = mysqli_query($conn, $sql1);
    $total_all_rows = mysqli_num_rows($query);
    $output= array();
    if(isset($_POST['search']['value']))
    {
        $search_value = $_POST['search']['value'];
        $sql1 .= " AND ( KhachHang.MSKH like '%".$search_value."%'";
        $sql1 .= " OR KhachHang.HoTenKH like '%".$search_value."%'";
        $sql1 .= " OR KhachHang.TenCongTy like '%".$search_value."%'";
        $sql1 .= " OR KhachHang.SoDienThoai like '%".$search_value."%'";
        $sql1 .= " OR KhachHang.SoFax like '%".$search_value."%')";
       /*  $sql1 .= " OR DiaChiKH.DiaChi like '%".$search_value."%'"; */
    }

    if(isset($_POST['order']))
    {
        $column_name = $_POST['order'][0]['column'];
        $order = $_POST['order'][0]['dir'];
        if (strcmp($column_name, "MSKH")){
            $column_name = "CAST(SUBSTRING(KhachHang.MSKH, 3, LENGTH(KhachHang.MSKH)) AS INT)";
        }
            $sql1 .= " ORDER BY ".$column_name." ".$order."";

    }
    else
    {
        $sql1 .= " ORDER BY CAST(SUBSTRING(KhachHang.MSKH, 3, LENGTH(KhachHang.MSKH)) AS INT) ASC";
    }

    if($_POST['length'] != -1){
        $start = $_POST['start'];
        $length = $_POST['length'];
        $sql1 .= " LIMIT  ".$start.", ".$length;
    }	
   /*  echo $sql1; */

    $query1 = mysqli_query($conn,$sql1);
    $count_rows = mysqli_num_rows($query1);
    $data = array();
    while($row1 = mysqli_fetch_assoc($query1)){
        $sub_array = array();
        $sub_array[] = substr($row1['MSKH'], 2, strlen($row1['MSKH']));
        $sub_array[] = $row1['MSKH'];
        $sub_array[] = $row1['HoTenKH'];
        $sub_array[] = $row1['TenCongTy'];
        $sub_array[] = $row1['SoDienThoai'];
        $sub_array[] = $row1['SoFax'];
        $sub_array[] = $row1['DiaChi'];
        $sub_array[] = '<button type="button" class="btn badge rounded-pill btn-primary add-alt-img-btn" data-bs-toggle="modal" data-bs-target="#address-modal" data-role="address-show" data-id="'.$row1['MSKH'].'" style="width:80px; height:36px; font-size:16px">Xem</button>';
        $data[] = $sub_array;
    }

    $output = array(
        'draw'=> intval($_POST['draw']),
        'recordsTotal' => $count_rows,
        'recordsFiltered'=> $total_all_rows,
        'data'=> $data,
    );
    echo json_encode($output);
    
?>