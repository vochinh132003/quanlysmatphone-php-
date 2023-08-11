<?php
include "../connect/config_oop.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $productId = $_POST['id_donhang'];

    // Thực hiện truy vấn xóa sản phẩm trong CSDL
    $deleteQuery = "UPDATE hoadon SET TrangThai = 'Đang chờ duyệt' where MaHoaDon = '$productId' ";
    $result = mysqli_query($conn, $deleteQuery);

    if ($result) {
        // Trả về phản hồi cho AJAX request
        echo "Đã xác nhận thanh toán.";
    } else {
        echo "Lỗi xóa sản phẩm: " . mysqli_error($conn);
    }
}
?>
