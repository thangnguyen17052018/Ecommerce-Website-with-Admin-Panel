<?php
    session_start();
    if (isset($_SESSION['id'])){//Nếu người dùng đã đăng nhập rồi
        header("location: admin_panel.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
        <link rel="stylesheet" href="./assets/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>
<body>
    <div class="wrapper login">
        <section class="form login">
            <header>Bu's Store</header>
            <form action="#" autocomplete="off">
                <div class="error-text"></div>
                <div class="field input">
                    <label>Mã số</label>
                    <input type="text" name="id" placeholder="" required>
                </div>
                <div class="field input">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" placeholder="" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field btn">
                    <input type="submit" name="submit" value="Đăng nhập">
                </div>
            </form>
            <div class="link">Bạn là khách hàng chưa có tài khoản? <a href="register.php"> Đăng ký ngay</a></div>
        </section>
    </div>
    <script src="./js/pass-show-hide.js"></script>
    <script src="./js/login.js"></script>
</body>
</html>