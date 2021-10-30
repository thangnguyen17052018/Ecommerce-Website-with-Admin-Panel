<?php
    include_once "config.php"; //import file php config.php vào file hiện tại
    
    $sql1 = "SELECT *
             FROM DatHang";
    $query = mysqli_query($conn, $sql1);
    $total_all_rows = mysqli_num_rows($query);
    $output= array();


    if(isset($_POST['search']['value']))
    {
        $search_value = $_POST['search']['value'];
        $sql1 .= " WHERE SoDonDH like '%".$search_value."%'";
        $sql1 .= " OR MSKH like '%".$search_value."%'";
        $sql1 .= " OR MSNV like '%".$search_value."%'";
        $sql1 .= " OR NgayDH like '%".$search_value."%'";
        $sql1 .= " OR NgayGH like '%".$search_value."%'";
        $sql1 .= " OR TrangThaiDH like '%".$search_value."%'";
    }

    if(isset($_POST['order']))
    {
        $column_name = $_POST['order'][0]['column'];
        $order = $_POST['order'][0]['dir'];
        if (strcmp($column_name, "1") == 0){
            $column_name = "CAST(SUBSTRING(SoDonDH, 3, LENGTH(SoDonDH)) AS INT)";
        }
        if (strcmp($column_name, "2") == 0){
            $column_name = "CAST(SUBSTRING(MSKH, 3, LENGTH(MSKH)) AS INT)";
        }
        if (strcmp($column_name, "3") == 0){
            $column_name = "CAST(SUBSTRING(MSNV, 3, LENGTH(MSNV)) AS INT)";
        }
            $sql1 .= " ORDER BY ".$column_name." ".$order."";
    }
    else
    {
        $sql1 .= " ORDER BY CAST(SUBSTRING(SoDonDH, 3, LENGTH(SoDonDH)) AS INT) ASC";
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
    $change_status = "";
     while($row1 = mysqli_fetch_assoc($query1)){
        $sub_array = array();
        $sub_array[] = substr($row1['SoDonDH'], 2, strlen($row1['SoDonDH']));
        $sub_array[] = $row1['SoDonDH'];
        $sub_array[] = $row1['MSKH'];
        $sub_array[] = $row1['MSNV'];
        $sub_array[] = $row1['NgayDH'];
        $sub_array[] = $row1['NgayGH'];
        $status =  '<span class="badge bg-danger">'.$row1['TrangThaiDH'].'</span>';
        if (strcmp($row1['TrangThaiDH'], "Chưa duyệt") == 0){
            $status =  '<span class="badge bg-warning">'.$row1['TrangThaiDH'].'</span>';
            $change_status = '<li><a class="dropdown-item" id=" approve" href="#">Duyệt</a></li>
                              <li><hr class="dropdown-divider"></li>
                              <li><a class="dropdown-item" id="cancel" href="#">Hủy đơn</a></li>
                              </ul>
                        </div>';
        }
        else if (strcmp($row1['TrangThaiDH'], "Đang vận chuyển") == 0){
            $status =  '<span class="badge bg-info">'.$row1['TrangThaiDH'].'</span>';
            $change_status = '<li><a class="dropdown-item" id="confirm" href="#">Xác nhận hoàn thành</a></li>
                              <li><hr class="dropdown-divider"></li>
                              <li><a class="dropdown-item" id="cancel" href="#">Hủy đơn</a></li>
                              </ul>
                        </div>';
        } else if (strcmp($row1['TrangThaiDH'], "Đã hoàn thành") == 0){
                $status =  '<span class="badge bg-success">'.$row1['TrangThaiDH'].'</span>';
                $change_status = "";
            }
                    
        $sub_array[] = $status;
        $sub_array[] = '<button type="button" class="btn badge rounded-pill btn-primary add-alt-img-btn" data-bs-toggle="modal" data-bs-target="#detail-modal" data-role="detail-show" data-id="'.$row1['SoDonDH'].'" style="width:80px; height:36px; font-size:16px">Xem</button>';
        $sub_array[] = '<div class="dropdown" id="'.substr($row1['SoDonDH'], 2, strlen($row1['SoDonDH'])).'">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Thực hiện
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">'.$change_status;

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