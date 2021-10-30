<?php
    include_once "./config.php"; //import file php config.php vào file hiện tại
    
    $id_HH = mysqli_real_escape_string($conn, $_POST['id_HH']);
    $ten_HH = mysqli_real_escape_string($conn, $_POST['ten_HH']);
    $quy_cach = mysqli_real_escape_string($conn, $_POST['quy_cach']);
    $gia = mysqli_real_escape_string($conn, $_POST['gia']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $type = $_POST['type'];

/*     echo $id_HH." ";
    echo $ten_HH." ";
    echo $quy_cach." ";
    echo $gia." ";
    echo $quantity." ";
    echo $type." ";
    echo $_FILES['product_img']['size']." ";
    echo $_FILES['product_img']['tmp_name']." "; */


    if (!empty($id_HH) && !empty($ten_HH) && !empty($quy_cach) && !empty($gia) && !empty($quantity) && !empty($type)){
        //Kiểm tra nếu ảnh đã được gửi
        if (isset($_FILES['product_img'])){

            //lấy dữ liệu hình ảnh và lưu trữ
            $product_img_name = $_FILES['product_img']['name'];//Lấy tên ảnh hàng hóa đã upload 
            $product_img_size = $_FILES['product_img']['size'];//Lấy kiểu ảnh hàng hóa
            $product_img_tmp = $_FILES['product_img']['tmp_name'];//Tên tạm thời được sử dụng để lưu/di chuyển file trong thư mục của chúng ta
            //explode image (chuyển tên file img thành các phần tử trong mảng) và lấy phần mở rộng của file ảnh (png, jpeg, jpg)
            $img_explode = explode('.', $product_img_name);//Chuyển tên file thành mảng mỗi phần tử được xác định qua dấu . ở đây là tên file và phần mở rộng
            $img_extension = end($img_explode); //Lấy phần tử của của mảng img_explode (phần mở rộng) 
            
            $extensions = ['png', 'jpeg', 'jpg'];

            if (in_array($img_extension, $extensions) == true){ //Nếu phần mở rộng của ảnh mà người dùng up lên match với phần tử trong mảng extensions
                $time = time();//Trả về thời gian hiện tại..
                //Chúng ta cần thời gian này bởi vì khi mình up file ảnh vào trong folder thì chúng ta đặt tên file với current time (unique)
                //Vì thế tất cả các file ảnh sẽ unique (không thể bị trùngs)
                //Chuyển file đã upload vào 1 thư mục cụ thể 
                //Chúng ta không lưu file ở database mà chỉ save URL. File thực tế sẽ lưu trữ ở 1 thư mục cụ thể trong project              
                $new_img_name = $time.$product_img_name; //current time (concat with) tên file ảnh để đề phòng trường hợp người dùng tải cả 2 ảnh khác nhau cùng tên
                if (move_uploaded_file($product_img_tmp, "../assets/images/".$new_img_name)){ //nếu ảnh người dùng upload di chuyển vào thư mục thành công
                    //Insert tất cả dữ liệu user vào bảng
                    $sql2 = mysqli_query($conn, "INSERT INTO HangHoa (MSHH, TenHH, QuyCach, Gia, SoLuongHang, MaLoaiHang) 
                                          VALUES ('{$id_HH}', '{$ten_HH}', '{$quy_cach}', '{$gia}', '{$quantity}', {$type})");
                    //Lấy mã hình lớn nhất để add mã hình mới
                    $query_img = mysqli_query($conn, "SELECT * 
                                                      FROM HinhHangHoa 
                                                      ORDER BY CAST(SUBSTRING(MaHinh, 2, LENGTH(MaHinh)) AS INT) 
                                                      DESC LIMIT 1
                                            ");
                    $row_img = mysqli_fetch_assoc($query_img);
                    $lastID_img = $row_img['MaHinh'];
                    if ($lastID_img == ""){
                        $imgID = "H1";
                    } else {
                        $imgID = substr($lastID_img, 1);
                        $imgID = intval($imgID);
                        $imgID = "H".($imgID + 1);
                    }
                    
                    $sql3 = mysqli_query($conn, "INSERT INTO HinhHangHoa(MaHinh, TenHinh, MSHH)
                                          VALUES ('{$imgID}','{$new_img_name}','{$id_HH}')");
                    if (($sql2 > 0) && ($sql3 > 0))
                        echo "success";
                    else
                        echo "Có gì đó sai sai!!!";
                }
            } else {
                echo "Vui lòng chọn file ảnh - png, jpg, jpeg !!!";        
            }
        } else {
            echo "Vui lòng chọn file ảnh !";
        }
    } else {
        echo "Tất cả các trường dữ liệu không được trống";
    }

    








    /* if (isset($_POST['MSNV'])){
        $id = $_POST['MSNV'];
        $ho_ten = $_POST['HoTenNV'];
        $chuc_vu = $_POST['ChucVu'];
        $dia_chi = $_POST['DiaChi'];
        $sdt = $_POST['SoDienThoai'];
        $pwd = $_POST['Password'];
        //Query cập nhật thông tin nhân viên
        $query = mysqli_query($conn, "INSERT INTO NhanVien 
                                    values ('$id', '$ho_ten', '$chuc_vu', '$dia_chi', '$sdt', '$pwd');
                    ");
        if ($query){
            echo 'success';
        }
    } */
    
?>