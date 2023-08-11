<?php
// Kết nối cơ sở dữ liệu
include "../connect/config_oop.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $idnv = $_POST["idnv"];
    $maBinhLuan = $_POST["maBinhLuan"];
    $noiDungTraLoi = $_POST["noiDungTraLoi"];
    $date = date('Y-m-d H:i:s');

    $sqll = "select MaNhanVien from nhanvien where TenNhanVien = '$idnv'";
    $result = mysqli_query($conn, $sqll);
    if (mysqli_num_rows($result) > 0) {
        if ($rows = mysqli_fetch_assoc($result)) {
            $MaNhanVien = $rows['MaNhanVien'];
            $sqlInsertTraLoi = "INSERT INTO traloi (MaBinhLuan,  MaNhanVien ,NoiDung,NgayTraLoi) VALUES ('$maBinhLuan','$MaNhanVien', '$noiDungTraLoi', '$date')";
            if ($conn->query($sqlInsertTraLoi) === false) {
                // echo "Lỗi: " . $conn->error;
            }
        }
    }

    // Sau khi lưu trả lời, bạn có thể chuyển hướng người dùng về trang chi tiết sản phẩm hoặc trang hiển thị bình luận
    header("Location: http://localhost/DOANPHPMYSQL_2023/admin/view/category/dashboard_phanhoi.php");
    exit();
}

mysqli_close($conn);
?>