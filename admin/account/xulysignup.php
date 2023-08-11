<?php
include "../connect/config_oop.php";

// Retrieve the form data
$ten_khachhang = mysqli_real_escape_string($conn, $_POST['ten_khach_hang']);
$dia_chi = mysqli_real_escape_string($conn, $_POST['dia_chi']);
$so_dt = mysqli_real_escape_string($conn, $_POST['so_dien_thoai']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$ten_dangnhap = mysqli_real_escape_string($conn, $_POST['ten_dang_nhap']);
$mat_khau = mysqli_real_escape_string($conn, $_POST['mat_khau']);
// $hashedPassword = password_hash($mat_khau, PASSWORD_DEFAULT);
$hashedPassword = md5($mat_khau);


if (isset($_POST['submit'])) {
    if (getimagesize($_FILES['anh_khachhang']['tmp_name']) == false) {
        echo "<br />Please select an image.";
    } else {
        // Prepare image data for insertion
        $image = addslashes(file_get_contents($_FILES['anh_khachhang']['tmp_name']));

        // Prepare and execute the SQL query to insert the image into the database
        $insertQuery = "INSERT INTO khachhang (TenKhachHang, DiaChi, SoDienThoai, Email, VaiTro, tendangnhap,matkhau,anh) VALUES ('$ten_khachhang', '$dia_chi', '$so_dt', '$email','Khách Hàng','$ten_dangnhap','$hashedPassword', '$image')";
        if ($conn->query($insertQuery) === TRUE) {
            header("Location: http://localhost/DOANPHPMYSQL_2023/admin/category/home.php");
        } else {
            echo "Error adding product: " . mysqli_error($conn);

        }
    }
}


// Close the connection
mysqli_close($conn);
?>