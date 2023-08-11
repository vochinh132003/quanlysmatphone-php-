<?php
session_start();

include "../connect/config_oop.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$employeeQuery = "SELECT * FROM NhanVien WHERE tendangnhap = '$username' AND matkhau = '$password'";
$employeeResult = mysqli_query($conn, $employeeQuery);

$customerQuery = "SELECT * FROM khachhang WHERE tendangnhap = '$username' AND matkhau = '$password'";
$customerResult = mysqli_query($conn, $customerQuery);

if (mysqli_num_rows($customerResult) == 1) {
    $rows = mysqli_fetch_assoc($customerResult);
    $_SESSION['user_id'] = $rows['TenKhachHang'];
    $_SESSION['DiaChi'] = $rows['DiaChi'];
    $_SESSION['SoDienThoai'] = $rows['SoDienThoai'];
    $_SESSION['Email'] = $rows['Email'];
    $_SESSION['anh_1'] = $rows['anh'];
    $_SESSION['username'] = $rows['tendangnhap'];
    $_SESSION['id'] = $rows['MaKhachHang'];
    $_SESSION['vaitro'] = $rows['VaiTro'];
    if ($_SESSION['vaitro'] === 'Khách Hàng') {
        header("Location: http://localhost/DOANPHPMYSQL_2023/admin/category/home.php");
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
} elseif (mysqli_num_rows($employeeResult) == 1) {
    $row = mysqli_fetch_assoc($employeeResult);
    $_SESSION['id'] = $row['MaNhanVien'];
    $_SESSION['user_id'] = $row['TenNhanVien'];
    $_SESSION['DiaChi'] = $row['DiaChi'];
    $_SESSION['SoDienThoai'] = $row['SoDienThoai'];
    $_SESSION['Email'] = $row['Email'];
    $_SESSION['anh_1'] = $row['anh'];
    $_SESSION['username'] = $row['TenDangNhap'];
    $_SESSION['vaitro'] = $row['VaiTro'];
    if ($_SESSION['vaitro'] === 'Quản Lý') {
        header("Location: http://localhost/DOANPHPMYSQL_2023/admin/view/category/dashboard.php");
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    echo "Tên đăng nhập hoặc mật khẩu không chính xác.";
}

mysqli_close($conn);
?>