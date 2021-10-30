<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1f10585980.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

    <!-- Material Icons Google -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
  
    <link rel="stylesheet" href="./assets/css/adminstyle.css">
</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar  -->
        <div class="bg-white" id="sidebar-wrapper">

            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <i class="me-2"><span class="material-icons md-36">polymer</span></i>Bu Store
            </div>
            <!-- list-group-flush để bỏ một số viền mà các góc tròn -->
             <div class="list-group list-group-flush my-3"> 
                <!-- list-group-item-action == hover (grey background color) -->
                <a href="admin_panel.php" id="admin_page" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="me-2"><span class="material-icons">dashboard</span></i>Tổng quan
                </a>
                <a href="employee.php" id="emp_page" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="me-2"><span class="material-icons">assignment_ind</span></i>Quản lí nhân viên
                </a>
                <a href="customer.php" id="customer_page" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="me-2"><span class="material-icons">groups</span></i>Khách hàng
                </a>
                <a href="product.php" id="product_page" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-tshirt me-2"></i>Quản lí hàng hóa
                </a>
                <a href="order.php" id="order_page" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="me-2"><span class="material-icons">receipt_long</span></i>Quản lí đơn hàng
                </a>
                <a href="#" id="category_page" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="me-2"><span class="material-icons">category</span></i>Quản lí loại hàng hóa
                </a>

                
                <a href="php/logout.php?id_logout=<?php echo $row['MSNV']?>" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold">
                    <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                </a>

            </div>

        </div>
        <!-- Sidebar END !!! -->
      
        <!-- Content -->

        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 title-head">Tổng quan</h2>
                </div> 

                <!-- Ẩn hiện nội dung nhờ lớp collapse, target là #navbarSupportedContent -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navBarSupportedContent" 
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-2">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle second-text fw-bold" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="me-2"><span class="material-icons">account_circle</span></i><?php echo $row['HoTenNV']?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a href="#" class="dropdown-item">Thông tin cá nhân</a></li>        
                                <li><a href="php/logout.php?id_logout=<?php echo $row['MSNV']?>" class="dropdown-item">Đăng xuất</a></li>         
                            </ul>
                        </li>
                    </ul>
                </div>

            </nav>

