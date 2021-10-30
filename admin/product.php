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
        $('#product_page').addClass('active');
    }); 
</script>

            <!-- width 100% tại tất cả các breakpoints -->
            <div class="container-fluid px-4">
                <div class="row my-5">
                    <div class="d-flex justify-content-between">
                        <h3 class="fs-4 mb-3">Danh sách hàng hóa</h3>
                        <button type="button" id="btn-add-product" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#add-modal" data-role="add">
                            <i class="me-2"><span class="material-icons">add_box</span></i> 
                        Thêm hàng hóa</button>
                    </div>
                    <div class="col">
                        <table id="table_id" class="table table-striped bg-white rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">MSHH</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Loại hàng hóa</th>
                                    <th scope="col">Tên hàng hóa</th>
                                    <th scope="col">Quy cách</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số lượng hàng</th>
                                    <th scope="col">Ảnh thay thế</th>
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

    <!-- SELECT bảng loại hàng hóa để lấy giá trị vào combobox mã hàng hóa -->
    <?php 
        $sql_LHH = mysqli_query($conn, "SELECT * FROM LoaiHangHoa");
        $str_LHH = "";
        while($row_LHH = mysqli_fetch_assoc($sql_LHH)){
            $str_LHH .= '<option value="'.$row_LHH['MaLoaiHang'].'">'.$row_LHH['MaLoaiHang'].' - '.$row_LHH['TenLoaiHang'].'</option>';
        }
    ?>

    
    <!-- ADD PRODUCT MODAL -->
    <div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModal">Thêm hàng hóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="form" novalidate action="./php/upload_img.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>MSHH</label>
                            <input type="text" id="idHH_ADD" class="form-control" readonly value="">
                        </div>
                        <div class="form-group">
                            <label>Tên hàng hóa</label>
                            <input type="text" id="tenHH_ADD" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Quy cách</label>
                            <textarea rows="3" id="quyCach_ADD" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Giá</label>
                            <input type="text" id="gia_ADD" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Số lượng hàng</label>
                            <input type="text" id="quantity_ADD" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Mã loại hàng</label>
                            <select class="form-select" id="type_ADD" aria-label="Default select example">
                                <option value="0" selected>Mở để chọn loại hàng hóa</option>
                                <?php echo $str_LHH; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ảnh</label>
                            <input type="file" id="img_ADD" name="image" class="form-control" onchange="getImagePreview(event, 'preview')">
                        </div>
                        <div id="preview"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" id="insert-btn" class="btn btn-primary">Thêm</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ADD PRODUCT MODAL END -->
        
    <!-- Script preview ảnh hàng hóa trước khi upload -->
    <script>
        const getImagePreview = (e, id) => {
            /* Tạo đối tượng URL để tải tệp vào trang web */
            let preview_img = URL.createObjectURL(e.target.files[0]);
            let preview_div = document.querySelector("#"+id);
            let preview_img_element = document.createElement('img');
            preview_div.innerHTML = "";
            preview_img_element.src = preview_img;
            preview_img_element.style.width = "180px";
            preview_img_element.style.height = "180px";
            preview_img_element.style.marginBottom = "20px";

            preview_div.appendChild(preview_img_element);
        }
    </script>


    <!-- EDIT MODAL -->
    <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal">Sửa thông tin hàng hóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>MSHH</label>
                    <input type="text" id="idHH" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Tên hàng hóa</label>
                    <input type="text" id="tenHH" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Quy cách</label>
                    <textarea rows="3" id="quyCach" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label>Giá</label>
                    <input type="text" id="price" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Số lượng hàng</label>
                    <input type="text" id="quantity" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Mã loại hàng</label>
                    <select class="form-select" id="type_edit" aria-label="Default select example">
                        <option selected>Mở để chọn loại hàng hóa</option>
                        <?php echo $str_LHH; ?>
                    </select>
                </div>
                
                <input type="hidden" id="productIndex_edit" class="form-control" required>
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
                <h5 class="modal-title" id="deleteModal">Xóa thông tin hàng hóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Bạn có chắc chắn muốn xóa dòng dữ liệu này không?</h5>               
                <input type="hidden" id="productIndex_delete" class="form-control">
                <input type="hidden" id="productID_delete" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" id="delete-btn-modal" class="btn btn-primary">Có, tôi chắc chắn</button>
            </div>
            </div>
        </div>
    </div>
    <!-- DELETE MODAL END-->

    <!-- ADD ALT_IMAGES MODAL -->
    <div class="modal fade" id="alt-image-modal" tabindex="-1" aria-labelledby="altImgModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="altImgModal"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="productID_alt" class="form-control">
                    <div class="container-fluid px-4">
                        <div class="row my-5">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="fs-4 mb-3">Bộ sưu tập ảnh</h3>
                                <!-- <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#add-img-modal" data-role="add">
                                    <i class="me-2"><span class="material-icons">add_photo_alternate</span></i> 
                                Thêm ảnh cho sản phẩm</button> -->
                                <!-- <span class="btn btn-info btn-file" id="file-btn">
                                    Tải ảnh lên<input type="file" id="alt_img_btn" name="image" class="form-control">
                                    <button type="submit" id="alt-img-btn" class="btn btn-success" style="margin-top: 20px"><i class="me-2"><span class="material-icons">add_photo_alternate</span></i> Thêm vào bộ sưu tập</button>
                                </span> -->
                                <div id="img_preview"></div>
                                <form class="needs-validation" id="form_img" novalidate action="./php/add_alt_img.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Chọn ảnh để thêm vào</label>
                                        <input type="file" id="alt_img_btn" name="alt-image" class="form-control" onchange="getImagePreview(event, 'img_preview')">
                                        <button type="submit" id="add-btn-alt" class="btn btn-primary" style="margin-top: 20px; margin-bottom:16px"><i class="me-2"><span class="material-icons">add_photo_alternate</span></i> Thêm vào bộ sưu tập</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col">
                                <table id="img_table" class="table table-striped bg-white rounded shadow-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="50px">#</th>
                                            <th scope="col">Mã hình</th>
                                            <th scope="col">Preview</th>
                                            <th scope="col" width="150px">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
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
    <!-- ADD ALT_IMAGES MODAL END -->
    <!-- DELETE ALT_IMAGES MODAL -->
    <div class="modal fade" id="delete-img-modal" tabindex="-1" aria-labelledby="deleteImgModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteImgModal">Xóa ảnh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#alt-image-modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Bạn có chắc chắn muốn xóa ảnh không?</h5>               
                <input type="hidden" id="imgID_delete" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#alt-image-modal" data-bs-dismiss="modal">Hủy</button>
                <button type="button" id="delete-img-btn" class="btn btn-primary">Có, tôi chắc chắn</button>
            </div>
            </div>
        </div>
    </div>
    <!-- DELETE ALT_IMAGES MODAL END-->
  
    <script>
        const tilteHead = document.querySelector('.title-head');
        tilteHead.innerHTML = "Quản lí hàng hóa";

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
                    'url': './php/get_product.php',
                    'type': 'POST',
                },
                'columnDefs':[
                    {//Tắt tính năng sắp xếp
                    'targets': [0, 2, 8, 9],
                    'orderable': false,
                    },
                    { 
                    "width": "5%", 
                    "targets": [0, 1, 7, 6, 8] 
                    },
                    { 
                    "width": "15%", 
                    "targets": [4, 5]
                    },
                    { 
                    "width": "10%", 
                    "targets": [3, 2]
                    },
                    { 
                    "width": "35%", 
                    "targets": 9
                    }
                ]

                
            });

            /* Xử lí phần cập nhật giá trị lớn nhất của ID để làm dạng ID auto increment (bằng chuỗi như HH1) 
            Và refresh các giá trị sau khi thêm
            */
            $('#btn-add-product').on('click', () => {
                $.ajax({
                    url: './php/largest_product.php',
                    method: 'GET',
                    data: {},
                    success: function(response){
                        $('#idHH_ADD').val(response);
                        $('#tenHH_ADD').val("");
                        $('#quyCach_ADD').val("");
                        $('#gia_ADD').val("");
                        $('#quantity_ADD').val("");
                        $('#type_ADD').val("0").change();
                        $('#img_ADD').val("");
                        $('#preview').html("");
                    }
                });
            });


            /* Insert hàng hóa */
            $('#insert-btn').on('click', (e) => {
                e.preventDefault();
                let formData = new FormData();
                let product_img = $("#img_ADD")[0].files;
                if (product_img.length > 0){
                    formData.append('product_img', product_img[0]);
                    formData.append('id_HH', $('#idHH_ADD').val());
                    formData.append('ten_HH', $('#tenHH_ADD').val());
                    formData.append('quy_cach', $('#quyCach_ADD').val());
                    formData.append('gia', $('#gia_ADD').val());
                    formData.append('quantity', $('#quantity_ADD').val());
                    formData.append('type', $('#type_ADD').val());
                    $.ajax({
                        url: './php/add_product.php',
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response){
                            if(response=='success') {
                                mytable =$('#table_id').DataTable();
                                mytable.draw();
                                $('#add-modal').modal('toggle');
                            } else {
                                alert(response);
                            }   
                        }
                    });
                } else {
                    alert("Mời bạn chọn ảnh !!!");
                }

                
            });
            
            /* Gán các giá trị hiện tại của các trường dữ liệu vào các input để chỉnh sửa */
            $(document).on('click', 'button[data-role=edit]', (e) => {
                e.preventDefault();
                let id  = e.target.getAttribute("data-id");
                let id_HH =  $('#'+id).children('td').eq(1).text();//Tìm child có tagName là td. (eq(1) để trả về child có index là 1)
                $.ajax({
                    url: './php/get_type_product.php',
                    method: 'POST',
                    data: {ID: id_HH},
                    success: function(type_product){
                        let ten_HH =  $('#'+id).children('td').eq(4).text();
                        let quy_cach =  $('#'+id).children('td').eq(5).text();
                        let gia =  $('#'+id).children('td').eq(6).text();
                        let quantity =  $('#'+id).children('td').eq(7).text();

                        $('#idHH').val(id_HH);
                        $('#tenHH').val(ten_HH);
                        $('#quyCach').val(quy_cach);
                        $('#price').val(gia);
                        $('#quantity').val(quantity);
                        $('#type_edit').val(type_product).change();
                        $('#productIndex_edit').val(id);
                    }
                });
            });

            /* Lấy dữ liệu từ input và thực hiện cập nhật lên cơ sở dữ liệu dùng Ajax*/
            $('#save-btn').on('click', (e) => {
                e.preventDefault();
                let id = $('#productIndex_edit').val();
                let id_HH = $('#idHH').val();
                let ten_HH = $('#tenHH').val();
                let quy_cach = $('#quyCach').val();
                let gia = $('#price').val();
                let so_luong = $('#quantity').val();
                let loai_HH = $('#type_edit').val();
                /* console.log(id_HH);
                console.log(ten_HH);
                console.log(quy_cach);
                console.log(gia);
                console.log(so_luong);
                console.log(loai_HH); */
                $.ajax({
                    url: './php/edit_product.php',
                    method: 'POST',
                    data: {MSHH: id_HH, TenHH: ten_HH, QuyCach: quy_cach, Gia: gia, SoLuongHang: so_luong, MaLoaiHang:loai_HH},
                    success: function(response){
                        //Cập nhật bản ghi trên bảng thông tin hàng hóa
                        if(response=='success') {
                            mytable = $('#table_id').DataTable();
                            mytable.draw();
                            $('#edit-modal').modal('toggle');
                        } else {
                            alert(response);
                        }   
                    }
                });
            });

            /* Xử lí nút xóa */
            $(document).on('click', 'button[data-role=delete]', (e) => {
                var table = $('#table_id').DataTable();
/*                 e.preventDefault(); */
                let id = e.target.getAttribute("data-id");
                let id_HH =  $('#'+id).children('td').eq(1).text();
                $('#productIndex_delete').val(id);
                $('#productID_delete').val(id_HH);
            });

            /* Lấy dữ liệu từ input productID và thực hiện xóa hàng hoá có id lên cơ sở dữ liệu dùng Ajax*/
            $('#delete-btn-modal').on('click', () => {
                let id = $('#productIndex_delete').val();
                let id_HH = $('#productID_delete').val();
                
                $.ajax({
                    url: './php/delete_product.php',
                    method: 'POST',
                    data: {MSHH: id_HH},
                    success: function(response){
                        /* Cập nhật bản ghi trên bảng thông tin hàng hóa */
                        $('#delete-modal').modal('toggle');
                        $("#"+id).closest('tr').remove();
                    }
                });
            });

            $(document).on('click', 'button[data-role=add-alt-image]', (e) => {
                e.preventDefault();
                let id  = e.target.getAttribute("data-id");
                let id_HH =  $('#'+id).children('td').eq(1).text();//Tìm child có tagName là td. (eq(1) để trả về child có index là 1)
                let tilteAltModal = document.querySelector('#altImgModal');
                $('#productID_alt').val(id_HH);
                tilteAltModal.innerHTML = $('#'+id).children('td').eq(4).text() + ' - ' + id_HH;
                $.ajax({
                    url: './php/get_alt_img.php',
                    method: 'POST',
                    data: {MSHH: id_HH},
                    success: function(response){
                        $('#img_table > tbody').html(response);
                    }
                });
            });

            $('#add-btn-alt').on('click', (e) => {
                e.preventDefault();
                let idHH= $('#productID_alt').val();
                let formData1 = new FormData();
                let alt_img = $("#alt_img_btn")[0].files;
                if (alt_img.length > 0){
                    formData1.append('alt_img', alt_img[0]);
                    formData1.append('MSHH', idHH);
                    $.ajax({
                        url: './php/add_alt_img.php',
                        method: 'POST',
                        data: formData1,
                        contentType: false,
                        processData: false,
                        success: function(response){
                            if (response == 'success'){
                                $.ajax({
                                    url: './php/get_alt_img.php',
                                    method: 'POST',
                                    data: {MSHH: idHH},
                                    success: function(response1){
                                        $('#img_table > tbody').html(response1);
                                    }
                                });
                                $('#alt_img_btn').val("");
                                $('#img_preview').html("");
                            } else {
                                alert(response);
                            }
                        }
                    });
                } else {
                    alert("Mời bạn chọn ảnh !!!");
                }
            });

            /* Xử lí nút xóa ảnh */
            $(document).on('click', 'button[data-role=delete-img]', (e) => {
                let id = e.target.getAttribute("data-id");
                $('#imgID_delete').val(id);
            });

            $('#delete-img-btn').on('click', () => {
                let id_Hinh = $('#imgID_delete').val();
                console.log(id_Hinh);
                $.ajax({
                    url: './php/delete_alt_img.php',
                    method: 'POST',
                    data: {MaHinh: id_Hinh},
                    success: function(response){
                        //Cập nhật bản ghi trên bảng thông tin hàng hóa
                        $('#delete-img-modal').modal('toggle');
                        $("#"+id_Hinh).closest('tr').remove();
                        $('#alt-image-modal').modal('toggle');
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
        