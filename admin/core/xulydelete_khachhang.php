<?php
include "../connect/config_oop.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $MaKhachHang = $_POST['MaKhach_Hang'];

    // Thực hiện truy vấn xóa sản phẩm trong CSDL
    $deleteQuery = "DELETE FROM KhachHang WHERE MaKhachHang = '$MaKhachHang'";
    $result = mysqli_query($conn, $deleteQuery);

    if ($result) {
        // Trả về phản hồi cho AJAX request
        echo "Khách hàng đã được xóa thành công.";
    } else {
        echo "Lỗi xóa sản phẩm: " . mysqli_error($conn);
    }
}
?>