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
        $('#emp_page').addClass('active');
    }); 
</script>

            <!-- width 100% tại tất cả các breakpoints -->
            <div class="container-fluid px-4">
                <div class="row my-5">
                    <div class="d-flex justify-content-between">
                        <h3 class="fs-4 mb-3">Danh sách nhân viên</h3>
                        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#add-modal" data-role="add">
                            <i class="me-2"><span class="material-icons">person_add_alt</span></i> 
                        Thêm nhân viên</button>
                    </div>
                    <div class="col">
                        <table id="table_id" class="table table-striped bg-white rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">MSNV</th>
                                    <th scope="col">Họ tên</th>
                                    <th scope="col">Chức vụ</th>
                                    <th scope="col">Địa chỉ</th>
                                    <th scope="col">Số điện thoại</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    <!-- Content END !!! -->

    </div>

    <!-- Lấy mã số nhân viên cao nhất hiện tại -->
    
    <!-- ADD EMPLOYEE MODAL -->
    <div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModal">Thêm nhân viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate>
                    <div class="form-group">
                        <label>MSNV</label>
                        <input type="text" id="idNV_ADD" class="form-control" readonly value="">
                    </div>
                    <div class="form-group">
                        <label>Họ tên</label>
                        <input type="text" id="fullname_ADD" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Chức vụ</label>
                        <input type="text" id="position_ADD" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" id="address_ADD" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" id="phone_ADD" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="password_ADD" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" id="insert-btn" class="btn btn-primary">Thêm</button>
            </div>
            </div>
        </div>
    </div>
    <!-- ADD EMPLOYEE MODAL END -->


    <!-- EDIT MODAL -->
    <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal">Sửa thông tin nhân viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>MSNV</label>
                    <input type="text" id="idNV" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Họ tên</label>
                    <input type="text" id="fullname" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Chức vụ</label>
                    <input type="text" id="position" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" id="address" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" id="phone" class="form-control" required>
                </div>

                <input type="hidden" id="employeeIndex_edit" class="form-control" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" id="save-btn" class="btn btn-primary">Lưu thay đổi</button>
            </div>
            </div>
        </div>
    </div>
    <!-- EDIT MODAL END -->

    <!-- DELETE MODAL -->
    <div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModal">Xóa thông tin nhân viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Bạn có chắc chắn muốn xóa dòng dữ liệu này không?</h5>               
                <input type="hidden" id="employeeIndex_delete" class="form-control">
                <input type="hidden" id="employeeID_delete" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" id="delete-btn-modal" class="btn btn-primary">Có, tôi chắc chắn</button>
            </div>
            </div>
        </div>
    </div>
    <!-- DELETE MODAL END-->



    <script>
        const tilteHead = document.querySelector('.title-head');
        tilteHead.innerHTML = "Quản lí nhân viên";
    </script>
    <!-- Sửa thông tin nhân viên -->
    <script>
  
        $(document).ready(() => {
            //Khởi tạo DataTable và custom language
            $('#table_id').DataTable({
                'language':{
                    "decimal":        "",
                    "emptyTable":     "Không có dữ liệu nào trong bảng",
                    "info":           "Hiển thị _START_ đến _END_ trong số _TOTAL_ mục",
                    "infoEmpty":      "Hiển thị 0 đến 0 trong số 0 mục nhập",
                    "infoFiltered":   "(Được lọc từ tổng số _MAX_ mục)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Hiển thị _MENU_ mục",
                    "loadingRecords": "Đang tải...",
                    "processing":     "Đang xử lí...",
                    "search":         "Tìm:",
                    "zeroRecords":    "Không tìm thấy bản ghi nào",
                    "paginate": {
                        "first":      "Đầu",
                        "last":       "Cuối",
                        "next":       "Sau",
                        "previous":   "Trước"
                    },
                    "aria": {
                        "sortAscending":  ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    }
                },
                "fnCreatedRow": function( row, data, dataIndex ) {
                    $(row).attr('id', data[1].substring(2, data[1].length));
                },
                "pageLength": 5,
                'processing': true,
                'serverSide': true,
                'paging': true,
                'order': [],
                'ajax': {
                    'url': './php/get_employee.php',
                    'type': 'POST',
                },
                'columnDefs':[
                    { //Tắt tính năng sắp xếp ở cột thử nhất và cột cuối
                    'targets': [0, 6],
                    'orderable': false,
                    },
                    {
                        'width' : '5%',
                        'targets' : [0, 1]
                    },
                    {
                        'width' : '10%',
                        'targets' : [3, 5]
                    },
                    {
                        'width' : '20%',
                        'targets' : [2, 6]
                    },
                ]

                
            });


            /* Insert nhân viên */
            $('#insert-btn').on('click', () => {
                let id_NV = $('#idNV_ADD').val();
                let ho_ten = $('#fullname_ADD').val();
                let chuc_vu = $('#position_ADD').val();
                let dia_chi = $('#address_ADD').val();
                let sdt = $('#phone_ADD').val();
                let pwd = $('#password_ADD').val();
                $.ajax({
                    url: './php/add_employee.php',
                    method: 'POST',
                    data: {MSNV: id_NV, HoTenNV: ho_ten, ChucVu: chuc_vu, DiaChi: dia_chi, SoDienThoai: sdt, Password: pwd},
                    success: function(response){
                        $('#add-modal').modal('toggle');
                        if(response=='success') {
                            mytable =$('#table_id').DataTable();
                            mytable.draw();
                        }    
                    }
                });
            });

            /* Gán các giá trị hiện tại của các trường dữ liệu vào các input để chỉnh sửa */
            $(document).on('click', 'button[data-role=edit]', (e) => {
                let id  = e.target.getAttribute("data-id");
                console.log(id);
                let id_NV =  $('#'+id).children('td').eq(1).text();//Tìm child có tagName là td. (eq(1) để trả về child có index là 1)
                let ho_ten =  $('#'+id).children('td').eq(2).text();
                let chuc_vu =  $('#'+id).children('td').eq(3).text();
                let dia_chi =  $('#'+id).children('td').eq(4).text();
                let sdt =  $('#'+id).children('td').eq(5).text();
                $('#idNV').val(id_NV);
                $('#fullname').val(ho_ten);
                $('#position').val(chuc_vu);
                $('#address').val(dia_chi);
                $('#phone').val(sdt);
                $('#employeeIndex_edit').val(id);
            });

            /* Lấy dữ liệu từ input và thực hiện cập nhật lên cơ sở dữ liệu dùng Ajax*/
            $('#save-btn').on('click', (e) => {
                e.preventDefault();
                let id = $('#employeeIndex_edit').val();
                let id_NV = $('#idNV').val();
                let ho_ten = $('#fullname').val();
                let chuc_vu = $('#position').val();
                let dia_chi = $('#address').val();
                let sdt = $('#phone').val();

                $.ajax({
                    url: './php/edit_employee.php',
                    method: 'POST',
                    data: {MSNV: id_NV, HoTenNV: ho_ten, ChucVu: chuc_vu, DiaChi: dia_chi, SoDienThoai: sdt},
                    success: function(response){
                        /* Cập nhật bản ghi trên bảng thông tin nhân viên */
                        $('#'+id).children('td').eq(2).text(ho_ten);
                        $('#'+id).children('td').eq(3).text(chuc_vu);
                        $('#'+id).children('td').eq(4).text(dia_chi);
                        $('#'+id).children('td').eq(5).text(sdt);
                        $('#edit-modal').modal('toggle');
                    }
                });
            });

            /* Xử lí nút xóa */
            $(document).on('click', 'button[data-role=delete]', (e) => {
                var table = $('#table_id').DataTable();
                e.preventDefault();
                let id = e.target.getAttribute("data-id");
                let id_NV =  $('#'+id).children('td').eq(1).text();
                $('#employeeIndex_delete').val(id);
                $('#employeeID_delete').val(id_NV);
            });
            /* Lấy dữ liệu từ input userID và thực hiện xóa nhân viên có id lên cơ sở dữ liệu dùng Ajax*/
            $('#delete-btn-modal').on('click', () => {
                let id = $('#employeeIndex_delete').val();
                let id_NV = $('#employeeID_delete').val();
                $.ajax({
                    url: './php/delete_employee.php',
                    method: 'POST',
                    data: {MSNV: id_NV},
                    success: function(response){
                        /* Cập nhật bản ghi trên bảng thông tin nhân viên */
                        $('#delete-modal').modal('toggle');
                        $("#"+id).closest('tr').remove();
                    }
                });
            });

            /* Xử lí phần cập nhật giá trị lớn nhất của ID để làm ID auto increment 
                Và refresh các giá trị sau khi thêm
            */
            $('.btn-success').on('click', () => {
                $.ajax({
                    url: './php/largest_employee.php',
                    method: 'GET',
                    data: {},
                    success: function(response){
                        $('#idNV_ADD').val(response);
                        $('#fullname_ADD').val("");
                        $('#position_ADD').val("");
                        $('#address_ADD').val("");
                        $('#phone_ADD').val("");
                        $('#password_ADD').val("");
                    }
                });
            });
/* 
            $('.needs-validation').on('submit', (e) => {
                e.preventDefault();
                if ($('#fullname_ADD').val() == ""){
                    $('#fullname_ADD').addClass("is-invalid");
                }
                console.log("submit stop");
            }); */

        });
    </script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>    
    <script src="./js/toggle-sidebar.js"></script>
</body>

</html>
        