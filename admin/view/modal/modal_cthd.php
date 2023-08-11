<!-- Replace $row['MaChiTietHoaDon'] with the actual value of the order detail ID -->
<div class="modal fade" id="viewModal<?php echo $row['MaHoaDon']; ?>" tabindex="-1"
    aria-labelledby="viewModalLabel<?php echo $row['MaHoaDon']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel<?php echo $row['MaHoaDon']; ?>">Chi tiết đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng bán</th>
                            <th>Giá bán</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Fetch and display the specific order detail data from the database -->
                        <?php
                        $orderDetailId = $row['MaHoaDon'];
                        $sql = "select sanpham.TenSanPham, SoLuongBan, sanpham.GiaBan, chitiethoadon.GiaBan ,chitiethoadon.thanhtien from chitiethoadon left join sanpham on chitiethoadon.MaSanPham = sanpham.MaSanPham where MaHoaDon  = $orderDetailId";
                        $result = mysqli_query($conn, $sql);
                        $ii = 1;
                        while ($detailRow = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $ii++; ?>
                                </td>
                                <td>
                                    <?php echo $detailRow['TenSanPham']; ?>
                                </td>
                                <td>
                                    <?php echo $detailRow['SoLuongBan']; ?>
                                </td>
                                <td>
                                    <?php echo $formattedPrice = number_format($detailRow['GiaBan'], 0, ',', '.'); ?><sup>₫</sup>
                                </td>
                                <td>
                                    <?php echo $formattedPrice = number_format($detailRow['thanhtien'], 0, ',', '.'); ?><sup>₫</sup>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
            $orderDetailId = $row['MaHoaDon'];
            $sqltong = "select sum(TongGiaTri) as tong from hoadon where MaHoaDon = '$orderDetailId'";
            $results = mysqli_query($conn, $sqltong);
            while ($detailRows = mysqli_fetch_assoc($results)) {
                ?>
                <h3>Tổng tiền:
                    <?php echo $formattedPrice = number_format($detailRows['tong'], 0, ',', '.'); ?><sup>₫</sup>
                </h3>
                <?php
            }
            ?>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>