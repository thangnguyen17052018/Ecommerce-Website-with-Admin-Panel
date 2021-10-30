<?php
    include_once "config.php"; //import file php config.php vào file hiện tại
    
    $sql1 = "SELECT * FROM NhanVien";
    $query = mysqli_query($conn, $sql1);
    $total_all_rows = mysqli_num_rows($query);
    $output= array();
    if(isset($_POST['search']['value']))
    {
        $search_value = $_POST['search']['value'];
        $sql1 .= " WHERE MSNV like '%".$search_value."%'";
        $sql1 .= " OR HoTenNV like '%".$search_value."%'";
        $sql1 .= " OR ChucVu like '%".$search_value."%'";
        $sql1 .= " OR DiaChi like '%".$search_value."%'";
        $sql1 .= " OR SoDienThoai like '%".$search_value."%'";
    }

    if(isset($_POST['order']))
    {
        $column_name = $_POST['order'][0]['column'];
        $order = $_POST['order'][0]['dir'];
        if (strcmp($column_name, "1") == 0){
            $column_name = "CAST(SUBSTRING(MSNV, 3, LENGTH(MSNV)) AS INT)";
        }
            $sql1 .= " ORDER BY ".$column_name." ".$order."";
    }
    else
    {
        $sql1 .= " ORDER BY CAST(SUBSTRING(MSNV, 3, LENGTH(MSNV)) AS INT) ASC";
    }
    
    if($_POST['length'] != -1){
        $start = $_POST['start'];
        $length = $_POST['length'];
        $sql1 .= " LIMIT  ".$start.", ".$length;
    }	

    $query1 = mysqli_query($conn,$sql1);
    $count_rows = mysqli_num_rows($query1);
    $data = array();
    while($row1 = mysqli_fetch_assoc($query1)){
        $sub_array = array();
        $sub_array[] = substr($row1['MSNV'], 2, strlen($row1['MSNV']));
        $sub_array[] = $row1['MSNV'];
        $sub_array[] = $row1['HoTenNV'];
        $sub_array[] = $row1['ChucVu'];
        $sub_array[] = $row1['DiaChi'];
        $sub_array[] = $row1['SoDienThoai'];
        $sub_array[] = '<button type="button" class="btn badge rounded-pill btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#edit-modal" data-role="edit" data-id="'.substr($row1['MSNV'], 2, strlen($row1['MSNV'])).'" style="width:80px; height:36px; font-size:16px">Sửa</button>
                    <button type="button" class="btn badge rounded-pill btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#delete-modal" data-role="delete" data-id="'.substr($row1['MSNV'], 2, strlen($row1['MSNV'])).'" style="width:80px; height:36px; font-size:16px">Xóa</button>';
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