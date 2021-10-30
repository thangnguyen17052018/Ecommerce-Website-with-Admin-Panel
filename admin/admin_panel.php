<?php
    session_start();
    if (!isset($_SESSION['id'])){
        header("location: login.php");
    }
    include_once "./php/config.php"; //import file php config.php vào file hiện tại
    $id_NV = $_SESSION['id'];
    $sql = mysqli_query($conn, "SELECT * FROM NhanVien WHERE MSNV='{$id_NV}'");
    if (mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
    }
    include "sidebar.php";
?>

<script>
    $(document).ready(() => {
        $('#admin_page').addClass('active');
    }); 
</script>


            <!-- width 100% tại tất cả các breakpoints -->
            <div class="container-fluid px-4">
                <!-- g-3 == chiều rộng gutter (rãnh) ngang -->
                <div class="row g-3 my-2">
                    <div class="col-md-3">
                        <!-- shadow-sm == small shadow -->
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">720</h3>
                                <p class="fs-5">Sản phẩm</p>
                            </div>
                            <i class="primary-text rounded-full secondary-bg p-3"><span class="material-icons md-36">inventory_2</span></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <!-- shadow-sm == small shadow -->
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">4920</h3>
                                <p class="fs-5">Doanh số</p>
                            </div>
                            <i class="primary-text rounded-full secondary-bg p-3"><span class="material-icons md-36">receipt</span></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <!-- shadow-sm == small shadow -->
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">3899</h3>
                                <p class="fs-5">Vận chuyển</p>
                            </div>
                            <i class="primary-text rounded-full secondary-bg p-3"><span class="material-icons md-36">local_shipping</span></i>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <!-- shadow-sm == small shadow -->
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">%25</h3>
                                <p class="fs-5">Tăng trưởng</p>
                            </div>
                            <i class="primary-text rounded-full secondary-bg p-3"><span class="material-icons md-36">trending_up</span></i>
                        </div>
                    </div>
                </div>

                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Đơn hàng gần đây</h3>
                    <div class="col">
                        <table class="table bg-white rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">#</th>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Khách hàng</th>
                                    <th scope="col">Nhân viên</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Áo Degrey</td>
                                    <td>Lê Thị Diễm Kỳ</td>
                                    <td>Bành Thị Búp Bu</td>
                                    <td>4</td>
                                    <td>200.000 VNĐ</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Quần thun Dirty Coin</td>
                                    <td>Võ Lê Hậu</td>
                                    <td>Nguyễn Minh Thắng</td>
                                    <td>10</td>
                                    <td>1.200.000 VNĐ</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Dây chuyền Hades</td>
                                    <td>Huỳnh Hữu Nghị</td>
                                    <td>Bành Thị Lu</td>
                                    <td>22</td>
                                    <td>3.400.000 VNĐ</td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>Giày Nike Air Force 1</td>
                                    <td>Phan Phú Cường</td>
                                    <td>Bành Thị Lu</td>
                                    <td>1</td>
                                    <td>8.100.000 VNĐ</td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>Áo Degrey</td>
                                    <td>Bành Thị Búp Bu</td>
                                    <td>Nguyễn Minh Thắng</td>
                                    <td>4</td>
                                    <td>200.000 VNĐ</td>
                                </tr>
                                <tr>
                                    <th scope="row">6</th>
                                    <td>Áo Degrey</td>
                                    <td>Bành Thị Búp Bu</td>
                                    <td>Nguyễn Minh Thắng</td>
                                    <td>4</td>
                                    <td>200.000 VNĐ</td>
                                </tr>
                                <tr>
                                    <th scope="row">7</th>
                                    <td>Áo Degrey</td>
                                    <td>Bành Thị Búp Bu</td>
                                    <td>Nguyễn Minh Thắng</td>
                                    <td>4</td>
                                    <td>200.000 VNĐ</td>
                                </tr>
                                <tr>
                                    <th scope="row">8</th>
                                    <td>Áo Degrey</td>
                                    <td>Bành Thị Búp Bu</td>
                                    <td>Nguyễn Minh Thắng</td>
                                    <td>4</td>
                                    <td>200.000 VNĐ</td>
                                </tr>
                                <tr>
                                    <th scope="row">9</th>
                                    <td>Áo Degrey</td>
                                    <td>Bành Thị Búp Bu</td>
                                    <td>Nguyễn Minh Thắng</td>
                                    <td>4</td>
                                    <td>200.000 VNĐ</td>
                                </tr>
                                <tr>
                                    <th scope="row">10</th>
                                    <td>Áo Degrey</td>
                                    <td>Bành Thị Búp Bu</td>
                                    <td>Nguyễn Minh Thắng</td>
                                    <td>4</td>
                                    <td>200.000 VNĐ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    <!-- Content END !!! -->

    </div>



<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>    
<script src="./js/toggle-sidebar.js"></script>
</body>

</html>
        