<?php
    include_once "./config.php"; //import file php config.php vào file hiện tại
    
    $id_HH = mysqli_real_escape_string($conn, $_POST['MSHH']);
/*     echo $id_HH." ";
    echo $ten_HH." ";
    echo $quy_cach." ";
    echo $gia." ";
    echo $quantity." ";
    echo $type." ";
    echo $_FILES['alt_img']['size']." ";
    echo $_FILES['alt_img']['tmp_name']." "; */


    if (!empty($id_HH)){
        //Kiểm tra nếu ảnh đã được gửi
        if (isset($_FILES['alt_img'])){

            //lấy dữ liệu hình ảnh và lưu trữ
            $alt_img_name = $_FILES['alt_img']['name'];//Lấy tên ảnh hàng hóa đã upload 
            $alt_img_size = $_FILES['alt_img']['size'];//Lấy kiểu ảnh hàng hóa
            $alt_img_tmp = $_FILES['alt_img']['tmp_name'];//Tên tạm thời được sử dụng để lưu/di chuyển file trong thư mục của chúng ta
            //explode image (chuyển tên file img thành các phần tử trong mảng) và lấy phần mở rộng của file ảnh (png, jpeg, jpg)
            $img_explode = explode('.', $alt_img_name);//Chuyển tên file thành mảng mỗi phần tử được xác định qua dấu . ở đây là tên file và phần mở rộng
            $img_extension = end($img_explode); //Lấy phần tử của của mảng img_explode (phần mở rộng) 
            
            $extensions = ['png', 'jpeg', 'jpg'];

            if (in_array($img_extension, $extensions) == true){ //Nếu phần mở rộng của ảnh mà người dùng up lên match với phần tử trong mảng extensions
                $time = time();//Trả về thời gian hiện tại..
                //Chúng ta cần thời gian này bởi vì khi mình up file ảnh vào trong folder thì chúng ta đặt tên file với current time (unique)
                //Vì thế tất cả các file ảnh sẽ unique (không thể bị trùngs)
                //Chuyển file đã upload vào 1 thư mục cụ thể 
                //Chúng ta không lưu file ở database mà chỉ save URL. File thực tế sẽ lưu trữ ở 1 thư mục cụ thể trong project              
                $new_img_name = $time.$alt_img_name; //current time (concat with) tên file ảnh để đề phòng trường hợp người dùng tải cả 2 ảnh khác nhau cùng tên
                if (move_uploaded_file($alt_img_tmp, "../assets/images/".$new_img_name)){ //nếu ảnh người dùng upload di chuyển vào thư mục thành công
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
                    if ($sql3 > 0)
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

?>