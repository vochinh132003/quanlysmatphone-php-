<?php
// Kết nối CSDL
include "../connect/config_oop.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $makh = $_POST['makh'];
    $dia_chi = $_POST['DiaChi'];
    $SoDienThoai = $_POST['SoDienThoai'];
    $email = $_POST['Email'];
    $productTotal = $_POST['cart_total_input'];
}

// Tạo hóa đơn mới
$date = date('Y-m-d H:i:s');
$sql = "INSERT INTO hoadon (NgayBan,MaKhachHang,TongGiaTri,TrangThai) VALUES ('$date','$makh',' $productTotal','Đang giao hàng')";
if ($conn->query($sql) === false) {
    // echo "Lỗi: " . $conn->error;
}
$hoadon = "SELECT MaHoaDon FROM hoadon ORDER BY MaHoaDon DESC LIMIT 1";
$resulthd = mysqli_query($conn, $hoadon);
if (mysqli_num_rows($resulthd) > 0) {
    if ($rowhd = mysqli_fetch_assoc($resulthd)) {
        $MaHoaDon = $rowhd['MaHoaDon'];
    }
}

// Lấy giỏ hàng từ Cookie
$cart = json_decode($_COOKIE['cart'], true);


// Thêm các sản phẩm vào chi tiết hóa đơn
foreach ($cart as $product) {
    $productName = $product['name'];
    $productPrice = $product['price'];
    $productQuantity = $product['quantity'];
    $producttotal = $productQuantity * $productPrice;
    $sqll = "select MaSanPham from sanpham where TenSanPham = '$productName'";
    $result = mysqli_query($conn, $sqll);
    if (mysqli_num_rows($result) > 0) {
        if ($rows = mysqli_fetch_assoc($result)) {
            $MaSanPham = $rows['MaSanPham'];
            $sqlct = "INSERT INTO chitiethoadon (MaSanPham, MaHoaDon, SoLuongBan, GiaBan,Thanhtien) VALUES ('$MaSanPham', '$MaHoaDon','$productQuantity','$productPrice', '$producttotal ')";
            if ($conn->query($sqlct) === false) {
                // echo "Lỗi: " . $conn->error;
            }
        }
    }
}

// Xóa dữ liệu trong cookie khi nhấn vào nút thanh toán
unset($_COOKIE['cart']);
setcookie('cart', null, -1, '/');
$sqlcp = "UPDATE khachhang SET  DiaChi='$dia_chi',SoDienThoai='$SoDienThoai',Email='$email' WHERE MaKhachHang='$MaKhachHang'";
$resultcp = mysqli_query($conn, $sqlcp);
// Execute the query
if ($resultcp) {
    // Product added successfully
} else {
    // Error occurred while adding the product
    echo "Error adding product: " . mysqli_error($conn);
}
// Đóng kết nối CSDL
$conn->close();
?>