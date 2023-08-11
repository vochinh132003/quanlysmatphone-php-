<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Thêm sản phẩm mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="http://localhost/DOANPHPMYSQL_2023/admin/core/xulyadd_sanpham.php" method="POST"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="ten_sanpham" class="form-label">Tên sản phẩm:</label>
                                <input type="text" class="form-control" id="ten_sanpham" name="ten_sanpham">
                            </div>
                            <div class="mb-3">
                                <label for="gia" class="form-label">Đơn giá:</label>
                                <input type="number" class="form-control" id="gia" name="gia">
                            </div>
                            <div class="mb-3">
                                <label for="so_luong" class="form-label">Số lượng trong kho:</label>
                                <input type="number" class="form-control" id="so_luong" name="so_luong">
                            </div>
                            <div class="mb-3">
                                <label for="mo_ta" class="form-label">Mô tả:</label>
                                <textarea class="form-control" id="mo_ta" name="mo_ta"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="anh_sanpham" class="form-label">Ảnh sản phẩm:</label>
                                <input type="file" class="form-control" id="anh_sanpham" name="anh_sanpham">
                            </div>
                            <div class="mb-3">
                                <label for="kich_thuoc" class="form-label">Kích thước:</label>
                                <input type="text" class="form-control" id="kich_thuoc" name="kich_thuoc">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="trong_luong_san_pham" class="form-label">Trọng lượng sản phẩm:</label>
                                <input type="text" class="form-control" id="trong_luong_san_pham"
                                    name="trong_luong_san_pham">
                            </div>
                            <div class="mb-3">
                                <label for="dien_tich_man_hinh" class="form-label">Diện tích màn hình:</label>
                                <input type="text" class="form-control" id="dien_tich_man_hinh"
                                    name="dien_tich_man_hinh">
                            </div>
                            <div class="mb-3">
                                <label for="ram" class="form-label">RAM:</label>
                                <input type="text" class="form-control" id="ram" name="ram">
                            </div>
                            <div class="mb-3">
                                <label for="dung_luong_pin" class="form-label">Dung lượng pin:</label>
                                <input type="text" class="form-control" id="dung_luong_pin" name="dung_luong_pin">
                            </div>
                            <div class="mb-3">
                                <label for="thoi_gian_bao_hanh" class="form-label">Thời gian bảo hành:</label>
                                <input type="text" class="form-control" id="thoi_gian_bao_hanh"
                                    name="thoi_gian_bao_hanh">
                            </div>
                            <div class="mb-3">
                                <label for="ma_nha_sx_" class="form-label">Mã nhà sản xuất:</label>
                                <select class="form-select" id="ma_nha_sx_" name="ma_nha_sx_">
                                    <option selected disabled>Chọn nhà sản xuất</option>
                                    <?php
                                    include "../../connect/config_oop.php";
                                    $querya = "SELECT * FROM NhaSanXuat";
                                    $mysqli_result = mysqli_query($conn, $querya);
                                    while ($rows = mysqli_fetch_array($mysqli_result)) {
                                        echo "<option value='" . $rows['MaNhaSanXuat'] . "'>" . $rows['MaNhaSanXuat'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <input type="submit" class="btn btn-primary" name="submit" value="Thêm">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="editModal<?php echo $row['MaSanPham']; ?>" tabindex="-1"
    aria-labelledby="editModalLabel<?php echo $row['MaSanPham']; ?>" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel<?php echo $row['MaSanPham']; ?>">
                    Chỉnh sửa thông tin sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="http://localhost/DOANPHPMYSQL_2023/admin/core/xulyedit_sanpham.php" method="POST"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <input type="hidden" name="MaSanPham" id="MaSanPham"
                                value="<?php echo $row['MaSanPham']; ?>">
                            <div class="mb-3">
                                <label for="ten_sanpham_<?php echo $row['MaSanPham']; ?>" class="form-label">Tên sản
                                    phẩm:</label>
                                <input type="text" class="form-control"
                                    id="ten_sanpham_<?php echo $row['MaSanPham']; ?>"
                                    name="ten_sanpham_<?php echo $row['MaSanPham']; ?>"
                                    value="<?php echo $row['TenSanPham']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="gia_ban_<?php echo $row['MaSanPham']; ?>" class="form-label">Giá
                                    bán:</label>
                                <input type="text" class="form-control" id="gia_ban_<?php echo $row['MaSanPham']; ?>"
                                    name="gia_ban_<?php echo $row['MaSanPham']; ?>"
                                    value="<?php echo $row['GiaBan']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="so_luong_trong_kho_<?php echo $row['MaSanPham']; ?>" class="form-label">Số
                                    lượng
                                    trong kho:</label>
                                <input type="text" class="form-control"
                                    id="so_luong_trong_kho_<?php echo $row['MaSanPham']; ?>"
                                    name="so_luong_trong_kho_<?php echo $row['MaSanPham']; ?>"
                                    value="<?php echo $row['SoLuongTrongKho']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="mo_ta_sp_<?php echo $row['MaSanPham']; ?>" class="form-label">Mô tả sản
                                    phẩm:</label>
                                <textarea class="form-control" id="mo_ta_sp_<?php echo $row['MaSanPham']; ?>"
                                    name="mo_ta_sp_<?php echo $row['MaSanPham']; ?>"><?php echo $row['MoTaSanPham']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="anh_sp_<?php echo $row['MaSanPham']; ?>" class="form-label">Ảnh sản
                                    phẩm:</label>
                                <!-- Hiển thị ảnh hiện tại -->
                                <img width="30%" src="data:images/jpeg;base64,<?php echo base64_encode($row['AnhSanPham']); ?>"
                                    alt="Ảnh sản phẩm">

                                <!-- Trường đầu vào file để cập nhật ảnh -->
                                <input type="file" class="form-control" id="anh_sp_<?php echo $row['MaSanPham']; ?>"
                                    name="anh_sp_<?php echo $row['MaSanPham']; ?>" accept="image/*">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="kichthuoc_<?php echo $row['MaSanPham']; ?>" class="form-label">Kích
                                    thước:</label>
                                <input type="text" class="form-control" id="kichthuoc_<?php echo $row['MaSanPham']; ?>"
                                    name="kichthuoc_<?php echo $row['MaSanPham']; ?>"
                                    value="<?php echo $row['Kichthuoc']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="trongluongsanpham_<?php echo $row['MaSanPham']; ?>" class="form-label">Trọng
                                    lượng
                                    sản phẩm:</label>
                                <input type="text" class="form-control"
                                    id="trongluongsanpham_<?php echo $row['MaSanPham']; ?>"
                                    name="trongluongsanpham_<?php echo $row['MaSanPham']; ?>"
                                    value="<?php echo $row['Trongluongsanpham']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="dientichmanhinh_<?php echo $row['MaSanPham']; ?>" class="form-label">Diện
                                    tích màn
                                    hình:</label>
                                <input type="text" class="form-control"
                                    id="dientichmanhinh_<?php echo $row['MaSanPham']; ?>"
                                    name="dientichmanhinh_<?php echo $row['MaSanPham']; ?>"
                                    value="<?php echo $row['Dientichmanhinh']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="ram_<?php echo $row['MaSanPham']; ?>" class="form-label">RAM:</label>
                                <input type="text" class="form-control" id="ram_<?php echo $row['MaSanPham']; ?>"
                                    name="ram_<?php echo $row['MaSanPham']; ?>" value="<?php echo $row['Ram']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="dungluongpin_<?php echo $row['MaSanPham']; ?>" class="form-label">Dung lượng
                                    pin:</label>
                                <input type="text" class="form-control"
                                    id="dungluongpin_<?php echo $row['MaSanPham']; ?>"
                                    name="dungluongpin_<?php echo $row['MaSanPham']; ?>"
                                    value="<?php echo $row['Dungluongpin']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="thoigianbaohang_<?php echo $row['MaSanPham']; ?>" class="form-label">Thời
                                    gian bảo
                                    hành:</label>
                                <input type="text" class="form-control"
                                    id="thoigianbaohang_<?php echo $row['MaSanPham']; ?>"
                                    name="thoigianbaohang_<?php echo $row['MaSanPham']; ?>"
                                    value="<?php echo $row['Thoigianbaohang']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="ma_nhasanxuat_<?php echo $row['MaSanPham']; ?>" class="form-label">Mã nhà
                                    sản xuất:</label>
                                <select class="form-select" id="ma_nhasanxuat_<?php echo $row['MaSanPham']; ?>"
                                    name="ma_nhasanxuat_<?php echo $row['MaSanPham']; ?>">
                                    <?php
                                    $query_nsx = "SELECT * FROM NhaSanXuat";
                                    $result_nsx = mysqli_query($conn, $query_nsx);
                                    while ($row_nsx = mysqli_fetch_array($result_nsx)) {
                                        if ($row_nsx['MaNhaSanXuat'] == $row['MaNhaSanXuat']) {
                                            echo "<option value='" . $row_nsx['MaNhaSanXuat'] . "' selected>" . $row_nsx['TenNhaSanXuat'] . "</option>";
                                        } else {
                                            echo "<option value='" . $row_nsx['MaNhaSanXuat'] . "'>" . $row_nsx['TenNhaSanXuat'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <input type="submit" class="btn btn-primary" name="submit" value="Lưu">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>