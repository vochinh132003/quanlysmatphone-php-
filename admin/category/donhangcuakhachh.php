<?php
include "navbarr.php";
?>
<br><br>
<?php
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: http://localhost/DOANPHPMYSQL_2023/admin/category/home.php");
    exit;
}
?>
<style>
    .edit-btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 3px;
        cursor: pointer;
    }

    .delete-btn {
        background-color: #dc3545;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 3px;
        cursor: pointer;
    }

    .edit-btn i,
    .delete-btn i {
        margin-right: 5px;
    }
</style>
<style>
    th {
        border-top: 1px solid #ccc;
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
    }

    th:last-child {
        border-right: none;
    }

    td {
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
    }
</style>
<?php
$sql = "SELECT HoaDon.MaHoaDon, SanPham.TenSanPham,SanPham.AnhSanPham, SanPham.GiaBan,  HoaDon.NgayBan,HoaDon.TongGiaTri,HoaDon.trangthai, ChiTietHoaDon.SoLuongBan, ChiTietHoaDon.GiaBan AS GiaBanSanPham, HoaDon.TrangThai
            FROM SanPham
            INNER JOIN ChiTietHoaDon ON SanPham.MaSanPham = ChiTietHoaDon.MaSanPham
            INNER JOIN HoaDon ON ChiTietHoaDon.MaHoaDon = HoaDon.MaHoaDon
            INNER JOIN KhachHang ON HoaDon.MaKhachHang = KhachHang.MaKhachHang
            WHERE KhachHang.TenKhachHang = '$user_id' AND HoaDon.TrangThai = 'Đang giao hàng'";
$query = mysqli_query($conn, $sql);
?>
<div class="container-fluid" style="padding: 20px 40px;">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h2>Danh sách đơn hàng của khách hàng:
                    <?php echo $user_id; ?>
                </h2>
            </div>
        </div>
        <div class="card-body">
            <table id="productTable" class="table">
                <thead class="thead-dark">
                    <tr style="font-size: 15px; text-align: center;">
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá bán</th>
                        <th>Số lượng mua</th>
                        <th>TỔNG TIỀN</th>
                        <th>NGÀY MUA</th>
                        <th>TRẠNG THÁI</th>
                        <th>XỬ LÝ ĐƠN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($query)) {
                        $anhsp = $row['AnhSanPham'];
                        ?>
                        <tr style="font-size: 13px; text-align: center;">
                            <td>
                                <?php echo $i++; ?>
                            </td>
                            <td>
                                <img style="width: 100px;height: 100px;"
                                    src="data:image/jpeg;base64,<?php echo base64_encode($anhsp); ?>"
                                    alt="<?php echo $TenSanPham; ?>">
                            </td>
                            <td>
                                <?php echo $row['TenSanPham']; ?>
                            </td>
                            <td>
                                <?php echo $formattedPrice = number_format($row['GiaBan'], 0, ',', '.'); ?><sup>₫</sup>
                            </td>
                            <td>
                                <?php echo $row['SoLuongBan']; ?>
                            </td>
                            <td>
                                <?php echo $formattedPrice = number_format($row['TongGiaTri'], 0, ',', '.'); ?><sup>₫</sup>
                            </td>
                            <td>
                                <?php echo $row['NgayBan']; ?>
                            </td>
                            <td>
                                <?php echo $row['trangthai']; ?>
                            </td>
                            <td>
                                <?php
                                $queryyhuy = mysqli_query($conn, $sql);
                                if ($row = mysqli_fetch_assoc($queryyhuy)) {
                                    $trangthai = $row['trangthai'];
                                    ?>
                                    <button class="delete-btn" data-id="<?php echo $row['MaHoaDon']; ?>"
                                        onclick="huydon(<?php echo $row['MaHoaDon']; ?>)">Huỷ đơn</button>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br><br>
<?php
include "footer.php";
?>
<script>
    function huydon(productId) {
        if (confirm("Xác nhận huỷ đơn ?")) {
            // Gửi yêu cầu xóa sản phẩm bằng AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "http://localhost/DOANPHPMYSQL_2023/admin/core/xulyedit_huydon.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Xử lý phản hồi từ máy chủ sau khi xóa thành công
                    alert(xhr.responseText);
                    // Refresh trang để cập nhật danh sách sản phẩm
                    location.reload();
                }
            };
            xhr.send("id_donhang=" + productId);
        }
    }
</script>