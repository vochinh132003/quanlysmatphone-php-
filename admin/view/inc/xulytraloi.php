<?php
// Kết nối cơ sở dữ liệu
include "../../../connect/config_oop.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $maBinhLuan = $_POST["maBinhLuan"];
    $noiDungTraLoi = $_POST["noiDungTraLoi"];
    $date = date('Y-m-d H:i:s');

    // Thực hiện lưu trả lời vào cơ sở dữ liệu
    $sqlInsertTraLoi = "INSERT INTO traloi (MaBinhLuan,  MaNhanVien ,NoiDung,NgayTraLoi) VALUES ('$maBinhLuan','1', '$noiDungTraLoi', '$date')";
    mysqli_query($conn, $sqlInsertTraLoi);

    // Sau khi lưu trả lời, bạn có thể chuyển hướng người dùng về trang chi tiết sản phẩm hoặc trang hiển thị bình luận
    // header("Location: chitietsanpham.php?productId=$productId");
    exit();
}

mysqli_close($conn);
?>