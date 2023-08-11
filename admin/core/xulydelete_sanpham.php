<?php
include "../connect/config_oop.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $productId = $_POST['id_sanpham'];

    // Thực hiện truy vấn xóa sản phẩm trong CSDL
    $deleteQuery = "DELETE FROM SanPham WHERE MaSanPham = '$productId'";
    $result = mysqli_query($conn, $deleteQuery);

    if ($result) {
        // Trả về phản hồi cho AJAX request
        echo "Sản phẩm đã được xóa thành công.";
    } else {
        echo "Lỗi xóa sản phẩm: " . mysqli_error($conn);
    }
}
?>
