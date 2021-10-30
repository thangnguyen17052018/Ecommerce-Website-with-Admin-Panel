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
        $('#order_page').addClass('active');
    }); 
</script>

            <!-- width 100% tại tất cả các breakpoints -->
            <div class="container-fluid px-4">
                <div class="row my-5">
                    <div class="d-flex justify-content-between">
                        <h3 class="fs-4 mb-3">Danh sách đặt hàng</h3>
                    </div>
                    <div class="col">
                        <table id="table_id" class="table table-striped bg-white rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Số đơn hàng</th>
                                    <th scope="col">MSKH</th>
                                    <th scope="col">MSNV</th>
                                    <th scope="col">Ngày đặt hàng</th>
                                    <th scope="col">Ngày giao hàng</th>
                                    <th scope="col">Trạng thái đặt hàng</th>
                                    <th scope="col">Chi tiết đặt hàng</th>
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

        <!-- ADDRESS MODAL -->
        <div class="modal fade" id="detail-modal" tabindex="-1" aria-labelledby="detailModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalTitle"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="orderID" class="form-control">
                        <div class="container-fluid px-4">
                            <div class="row my-5">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="fs-4 mb-3">Chi tiết đặt hàng</h3>
                                </div>
                                <div class="col">
                                    <table id="detail_table" class="table table-striped bg-white rounded shadow-sm table-hover">
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    
    <script>
        const tilteHead = document.querySelector('.title-head');
        tilteHead.innerHTML = "Quản lí đặt hàng";
    </script>

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
                    $(row).attr('id', data[1]);
                },
                "pageLength": 5,
                'processing': true,
                'serverSide': true,
                'paging': true,
                'order': [],
                'ajax': {
                    'url': './php/get_order.php',
                    'type': 'POST',
                },
                'columnDefs':[
                    { //Tắt tính năng sắp xếp ở cột thử nhất và cột cuối
                    'targets': [0, 7, 8],
                    'orderable': false,
                    },
                    { 
                    "width": "5%", 
                    "targets": [0, 1, 2, 3] 
                    },
                    { 
                    "width": "15%", 
                    "targets": [6, 4, 5]
                    },
                    { 
                    "width": "10%", 
                    "targets": [7]
                    }
                ]

                
            });
        

            $("body").on('click', '.dropdown-menu li a',(e) => {
                e.preventDefault();
                let target = e.target.getAttribute('id');
                let row_id = e.target.parentNode.parentNode.parentNode.getAttribute('id');
                let id = 'DH'+row_id;
                let status = "";
                if (target.toString().trim() === 'approve'){
                    /* $('#DH'+row_id).children('td').eq(6).text('Đang vận chuyển'); */
                    status = "Đang vận chuyển";
                } else if (target.toString().trim() === 'confirm'){
                    status = "Đã hoàn thành";
                } else if (target.toString().trim() === 'cancel'){
                    status = "Đã hủy";
                }
                $.ajax({
                    url: './php/change_status.php',
                    method: 'POST',
                    data: {SoDonDH: id, TrangThaiDH: status},
                    success: function(response){
                        if (response == 'success'){
                            mytable = $('#table_id').DataTable();
                            mytable.draw();
                        }
                    }
                });
            });

            $(document).on('click', 'button[data-role=detail-show]', (e) => {
                e.preventDefault();
                let id_DH  = e.target.getAttribute("data-id");
                let detailModalTitle = document.querySelector('#detailModalTitle');
                $('#orderID').val(id_DH);
                detailModalTitle.innerHTML = $('#'+id_DH).children('td').eq(2).text() + ' - ' + id_DH;
                $.ajax({
                    url: './php/get_detail.php',
                    method: 'POST',
                    data: {SoDonDH: id_DH},
                    success: function(response){
                        $('#detail_table').html(response);
                        
                    }
                });
            });

           
        });
    </script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>    
    <script src="./js/toggle-sidebar.js"></script>
</body>

</html>
        