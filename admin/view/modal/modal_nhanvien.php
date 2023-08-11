<!-- Add Product Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Thêm nhân viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="http://localhost/DOANPHPMYSQL_2023/admin/core/xulyadd_nhanvien.php" method="POST"
                    enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="ten_khachhang" class="form-label">Tên nhân viên:</label>
                        <input type="text" class="form-control" id="ten_khachhang" name="ten_khachhang">
                    </div>
                    <div class="mb-3">
                        <label for="dia_chi" class="form-label">Địa chỉ:</label>
                        <input type="text" class="form-control" id="dia_chi" name="dia_chi">
                    </div>
                    <div class="mb-3">
                        <label for="so_dt" class="form-label">Số điện thoại:</label>
                        <input type="text" class="form-control" id="so_dt" name="so_dt">
                    </div>
                    <div class="mb-3">
                        <label for="Email" class="form-label">Email:</label>
                        <input type="text" class="form-control" id="Email" name="Email">
                    </div>
                    <div class="mb-3">
                        <label for="ten_dangnhap" class="form-label">Tên đăng nhập:</label>
                        <input type="text" class="form-control" id="ten_dangnhap" name="ten_dangnhap">
                    </div>
                    <div class="mb-3">
                        <label for="mat_khau" class="form-label">Mật khẩu:</label>
                        <input type="password" class="form-control" id="mat_khau" name="mat_khau">
                    </div>
                    <div class="mb-3">
                        <label for="anh_nhanvien" class="form-label">Ảnh nhân viên:</label>
                        <input type="file" class="form-control" id="anh_nhanvien" name="anh_nhanvien">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <input type="submit" class="btn btn-primary" name="submit" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editModal<?php echo $row['MaNhanVien']; ?>" tabindex="-1"
    aria-labelledby="editModalLabel<?php echo $row['MaNhanVien']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel<?php echo $row['MaNhanVien']; ?>">
                    Chỉnh sửa thông tin khách hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="http://localhost/DO_AN_PHP_MYSQL_2023/admin/uploads/xulyedit_khachhang.php" method="POST">
                    <input type="hidden" name="MaNhanVien" id="MaNhanVien" value="<?php echo $row['MaNhanVien']; ?>">
                    <div class="mb-3">
                        <label for="ten_nhasx_<?php echo $row['MaNhanVien']; ?>" class="form-label">Tên khách
                            hàng:</label>
                        <input type="text" class="form-control" id="ten_nhasx_<?php echo $row['TenNhanVien']; ?>"
                            name="ten_nhasx_<?php echo $row['MaNhanVien']; ?>"
                            value="<?php echo $row['TenNhanVien']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="dia_chi<?php echo $row['MaNhanVien']; ?>" class="form-label">Địa chỉ:</label>
                        <input type="text" class="form-control" id="dia_chi<?php echo $row['MaNhanVien']; ?>"
                            name="dia_chi<?php echo $row['MaNhanVien']; ?>" value="<?php echo $row['DiaChi']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="so_đt<?php echo $row['MaNhanVien']; ?>" class="form-label">Số điện thoại:</label>
                        <input type="text" class="form-control" id="so_đt<?php echo $row['MaNhanVien']; ?>"
                            name="so_đt<?php echo $row['MaNhanVien']; ?>" value="<?php echo $row['SoDienThoai']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email<?php echo $row['MaNhanVien']; ?>" class="form-label">Email:</label>
                        <input type="text" class="form-control" id="email<?php echo $row['MaNhanVien']; ?>"
                            name="email<?php echo $row['MaNhanVien']; ?>" value="<?php echo $row['Email']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="anh_sp_<?php echo $row['MaNhanVien']; ?>" class="form-label">Ảnh nhân viên:</label>
                        <!-- Hiển thị ảnh hiện tại -->
                        <img width="30%" src="data:images/jpeg;base64,<?php echo base64_encode($row['anh']); ?>" alt="Ảnh sản phẩm">

                        <!-- Trường đầu vào file để cập nhật ảnh -->
                        <input  type="file" class="form-control" id="anh_sp_<?php echo $row['MaNhanVien']; ?>"
                            name="anh_sp_<?php echo $row['MaNhanVien']; ?>" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="ten_dangnhap<?php echo $row['MaNhanVien']; ?>" class="form-label">Tên đăng
                            nhập:</label>
                        <input type="text" class="form-control" id="ten_dangnhap<?php echo $row['MaNhanVien']; ?>"
                            name="ten_dangnhap<?php echo $row['MaNhanVien']; ?>"
                            value="<?php echo $row['TenDangNhap']; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>