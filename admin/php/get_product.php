<?php
    include_once "config.php"; //import file php config.php vào file hiện tại
    
    $sql1 = "SELECT *
             FROM HangHoa
             LEFT JOIN LoaiHangHoa ON HangHoa.MaLoaiHang=LoaiHangHoa.MaLoaiHang";
    $query = mysqli_query($conn, $sql1);
    $total_all_rows = mysqli_num_rows($query);
    $output= array();


    if(isset($_POST['search']['value']))
    {
        $search_value = $_POST['search']['value'];
        $sql1 .= " WHERE HangHoa.MSHH like '%".$search_value."%'";
        $sql1 .= " OR HangHoa.TenHH like '%".$search_value."%'";
        $sql1 .= " OR HangHoa.QuyCach like '%".$search_value."%'";
        $sql1 .= " OR HangHoa.Gia like '%".$search_value."%'";
        $sql1 .= " OR HangHoa.SoLuongHang like '%".$search_value."%'";
    }

    if(isset($_POST['order']))
    {
        $column_name = $_POST['order'][0]['column'];
        $order = $_POST['order'][0]['dir'];
        if (strcmp($column_name, "1") == 0){
            $column_name = "CAST(SUBSTRING(HangHoa.MSHH, 3, LENGTH(HangHoa.MSHH)) AS INT)";
        }
        if (strcmp($column_name, "3") == 0){
            $column_name = "8";
        }
        if (strcmp($column_name, "4") == 0){
            $column_name = "2";
        }
        if (strcmp($column_name, "5") == 0){
            $column_name = "3";
        }
        if (strcmp($column_name, "6") == 0){
            $column_name = "4";
        }
        if (strcmp($column_name, "7") == 0){
            $column_name = "5";
        }
            $sql1 .= " ORDER BY ".$column_name." ".$order."";
    }
    else
    {
        $sql1 .= " ORDER BY CAST(SUBSTRING(HangHoa.MSHH, 3, LENGTH(HangHoa.MSHH)) AS INT) ASC";
    }

    if($_POST['length'] != -1){
        $start = $_POST['start'];
        $length = $_POST['length'];
        $sql1 .= " LIMIT  ".$start.", ".$length;
    }	

    /* echo $sql1; */
    $query1 = mysqli_query($conn,$sql1);
    $count_rows = mysqli_num_rows($query1);
    $data = array();
     while($row1 = mysqli_fetch_assoc($query1)){
        $id = $row1['MSHH'];
        $sql2 = "SELECT *
                 FROM hinhhanghoa
                 where MSHH='$id' LIMIT 1";
        $query2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($query2);
        $sub_array = array();
        $sub_array[] = substr($row1['MSHH'], 2, strlen($row1['MSHH']));
        $sub_array[] = $row1['MSHH'];
        $sub_array[] = '<img src="./assets/images/'.$row2['TenHinh'].'" style="width:80px; heigth: 80px">';
        $sub_array[] = $row1['TenLoaiHang'];
        $sub_array[] = $row1['TenHH'];
        $sub_array[] = $row1['QuyCach'];
        $sub_array[] = $row1['Gia'];
        $sub_array[] = $row1['SoLuongHang'];
        $sub_array[] = '<button type="button" class="btn badge rounded-pill btn-success add-alt-img-btn" data-bs-toggle="modal" data-bs-target="#alt-image-modal" data-role="add-alt-image" data-id="'.substr($row1['MSHH'], 2, strlen($row1['MSHH'])).'" style="width:80px; height:36px; font-size:16px">Thêm</button>';
        $sub_array[] = '<button type="button" class="btn badge rounded-pill btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#edit-modal" data-role="edit" data-id="'.substr($row1['MSHH'], 2, strlen($row1['MSHH'])).'" style="width:80px; height:36px; font-size:16px">Sửa</button>
                    <button type="button" class="btn badge rounded-pill btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#delete-modal" data-role="delete" data-id="'.substr($row1['MSHH'], 2, strlen($row1['MSHH'])).'" style="width:80px; height:36px; font-size:16px">Xóa</button>';
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