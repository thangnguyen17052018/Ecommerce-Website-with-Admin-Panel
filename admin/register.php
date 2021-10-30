<?php
    // session_start();
    // if (isset($_SESSION['id_unique'])){//Nếu người dùng đã đăng nhập rồi
    //     header("location: users.php");
    // }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register Page</title>
        <link rel="stylesheet" href="./assets/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>
<body>
    <div class="wrapper register">
        <section class="form register">
            <header>Bu's Store</header>
            <form action="#" enctype="multipart/form-data" autocomplete="off"> <!-- Không được quên thêm thuộc tính enctype (multipart/form-data biểu mẫu khi người dùng muốn tải lên tệp) khi sử dụng thẻ input file -->
                <div class="error-text"></div>
                <div class="field input">
                    <label>Mã số khách hàng</label>
                    <input type="text" name="MSKH" placeholder="" required>
                </div>
                <div class="name-details">
                    <div class="field input">
                        <label>Họ tên</label>
                        <input type="text" name="HoTenKH" placeholder="" required>
                    </div>
                    <div class="field input">
                        <label>Tên công ty</label>
                        <input type="text" name="TenCongTy" placeholder="" required>
                    </div>
                </div>
                <div class="number-details">
                    <div class="field input">
                        <label>Số điện thoại</label>
                        <input type="text" name="SoDienThoai" placeholder="" required>
                    </div>
                    <div class="field input">
                        <label>Số fax</label>
                        <input type="text" name="SoFax" placeholder="" required>
                    </div>
                </div>
                <div class="field input">
                    <label>Mật khẩu</label>
                    <input type="password" name="Password" placeholder="" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field btn">
                    <input type="submit" name="submit" value="Đăng kí">
                </div>
            </form>
            <div class="link">Bạn đã có tài khoản? <a href="login.php"> Đăng nhập ngay</a></div>
        </section>
    </div>
    <script src="./js/pass-show-hide.js"></script>
    <script src="./js/register.js"></script>       
</body>
</html>