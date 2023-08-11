<!-- Add Product Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Thêm khách hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="http://localhost/DOANPHPMYSQL_2023/admin/core/xulyadd_khachhang.php" method="POST"
                    enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="ten_khachhang" class="form-label">Tên khách hàng:</label>
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
                        <label for="anh_khachhang" class="form-label">Ảnh khách hàng:</label>
                        <input type="file" class="form-control" id="anh_khachhang" name="anh_khachhang">
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
<div class="modal fade" id="editModal<?php echo $row['MaKhachHang']; ?>" tabindex="-1"
    aria-labelledby="editModalLabel<?php echo $row['MaKhachHang']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel<?php echo $row['MaKhachHang']; ?>">
                    Chỉnh sửa thông tin khách hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="http://localhost/DOANPHPMYSQL_2023/admin/core/xulyedit_khachhang.php" method="POST">
                    <input type="hidden" name="MaKhachHang" id="MaKhachHang" value="<?php echo $row['MaKhachHang']; ?>">
                    <div class="mb-3">
                        <label for="ten_nhasx_<?php echo $row['MaKhachHang']; ?>" class="form-label">Tên khách
                            hàng:</label>
                        <input type="text" class="form-control" id="ten_nhasx_<?php echo $row['TenKhachHang']; ?>"
                            name="ten_nhasx_<?php echo $row['MaKhachHang']; ?>"
                            value="<?php echo $row['TenKhachHang']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="dia_chi<?php echo $row['MaKhachHang']; ?>" class="form-label">Địa chỉ:</label>
                        <input type="text" class="form-control" id="dia_chi<?php echo $row['MaKhachHang']; ?>"
                            name="dia_chi<?php echo $row['MaKhachHang']; ?>" value="<?php echo $row['DiaChi']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="so_đt<?php echo $row['MaKhachHang']; ?>" class="form-label">Số điện thoại:</label>
                        <input type="text" class="form-control" id="so_đt<?php echo $row['MaKhachHang']; ?>"
                            name="so_đt<?php echo $row['MaKhachHang']; ?>" value="<?php echo $row['SoDienThoai']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email<?php echo $row['MaKhachHang']; ?>" class="form-label">Email:</label>
                        <input type="text" class="form-control" id="email<?php echo $row['MaKhachHang']; ?>"
                            name="email<?php echo $row['MaKhachHang']; ?>" value="<?php echo $row['Email']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="ten_dangnhap<?php echo $row['MaKhachHang']; ?>" class="form-label">Tên đăng
                            nhập:</label>
                        <input type="text" class="form-control" id="ten_dangnhap<?php echo $row['MaKhachHang']; ?>"
                            name="ten_dangnhap<?php echo $row['MaKhachHang']; ?>"
                            value="<?php echo $row['tendangnhap']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="mat_khau<?php echo $row['MaKhachHang']; ?>" class="form-label">Mật khẩu:</label>
                        <input type="password" class="form-control" id="mat_khau<?php echo $row['MaKhachHang']; ?>"
                            name="mat_khau<?php echo $row['MaKhachHang']; ?>" value="<?php echo $row['matkhau']; ?>">
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