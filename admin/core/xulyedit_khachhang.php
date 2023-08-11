<?php
// Establish a connection to the database
include "../connect/config_oop.php";


// Retrieve the form data
$MaKhachHang = mysqli_real_escape_string($conn, $_POST['MaKhachHang']);
$ten_nhasx = mysqli_real_escape_string($conn, $_POST['ten_nhasx_' . $MaKhachHang]);
$dia_chi = mysqli_real_escape_string($conn, $_POST['dia_chi' . $MaKhachHang]);
$so_dt = mysqli_real_escape_string($conn, $_POST['so_đt' . $MaKhachHang]);
$email = mysqli_real_escape_string($conn, $_POST['email' . $MaKhachHang]);

// Construct the SQL query
$sql = "UPDATE khachhang SET TenKhachHang='$ten_nhasx', DiaChi='$dia_chi', SoDienThoai='$so_dt', Email='$email' WHERE MaKhachHang='$MaKhachHang'";
$result = mysqli_query($conn, $sql);
// Execute the query
if ($result) {
    // Product added successfully
    header("Location: http://localhost/DOANPHPMYSQL_2023/admin/view/category/dashboard_khachhang.php");
} else {
    // Error occurred while adding the product
    echo "Error adding product: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>