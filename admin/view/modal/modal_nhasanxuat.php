<!-- Add Product Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Thêm nhà sản xuất</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="http://localhost/DOANPHPMYSQL_2023/admin/core/xulyadd_nhasanxuat.php" method="POST">
                    <div class="mb-3">
                        <label for="ten_nhasx" class="form-label">Tên nhà sản xuất:</label>
                        <input type="text" class="form-control" id="ten_nhasx" name="ten_nhasx">
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
                        <textarea class="form-control" id="Email" name="Email"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editModal<?php echo $row['MaNhaSanXuat']; ?>" tabindex="-1"
    aria-labelledby="editModalLabel<?php echo $row['MaNhaSanXuat']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel<?php echo $row['MaNhaSanXuat']; ?>">
                    Chỉnh sửa thông tin nhà sản xuất</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="http://localhost/DOANPHPMYSQL_2023/admin/core/xulyedit_nhasanxuat.php" method="POST">
                    <input type="hidden" name="MaNhaSanXuat" id="MaNhaSanXuat"
                        value="<?php echo $row['MaNhaSanXuat']; ?>">
                    <div class="mb-3">
                        <label for="ten_nhasx_<?php echo $row['MaNhaSanXuat']; ?>" class="form-label">Tên nhà sản xuất:</label>
                        <input type="text" class="form-control" id="ten_nhasx_<?php echo $row['MaNhaSanXuat']; ?>"
                            name="ten_nhasx_<?php echo $row['MaNhaSanXuat']; ?>"
                            value="<?php echo $row['TenNhaSanXuat']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="dia_chi<?php echo $row['MaNhaSanXuat']; ?>" class="form-label">Địa chỉ:</label>
                        <input type="text" class="form-control" id="dia_chi<?php echo $row['MaNhaSanXuat']; ?>"
                            name="dia_chi<?php echo $row['MaNhaSanXuat']; ?>"
                            value="<?php echo $row['DiaChi']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="so_đt<?php echo $row['MaNhaSanXuat']; ?>" class="form-label">Số điện thoại:</label>
                        <input type="text" class="form-control" id="so_đt<?php echo $row['MaNhaSanXuat']; ?>"
                            name="so_đt<?php echo $row['MaNhaSanXuat']; ?>"
                            value="<?php echo $row['SoDienThoai']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email<?php echo $row['MaNhaSanXuat']; ?>" class="form-label">Email:</label>
                        <input type="text" class="form-control" id="email<?php echo $row['MaNhaSanXuat']; ?>"
                            name="email<?php echo $row['MaNhaSanXuat']; ?>"
                            value="<?php echo $row['Email']; ?>">
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