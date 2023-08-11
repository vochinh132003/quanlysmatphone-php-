<?php
// Assuming you have established a MySQL database connection
include "../connect/config_oop.php";

// Retrieve form data
$maSanPham = $_POST['maSanPham'];
$tenkhachhang = $_POST['tenkhachhang'];
$noiDung = $_POST['noiDung'];
$link = $_POST['link'];
$date = date('Y-m-d H:i:s');


$khachhang = "select MaKhachHang from khachhang where TenKhachHang = '$tenkhachhang'";
$resulthd = mysqli_query($conn, $khachhang);
if (mysqli_num_rows($resulthd) > 0) {
    if ($rowhd = mysqli_fetch_assoc($resulthd)) {
        $maKhachHang = $rowhd['MaKhachHang'];
    }
}

// Prepare the SQL statement
$sql = "INSERT INTO BinhLuan (MaSanPham, MaKhachHang, NoiDung, NgayBinhLuan,link)
        VALUES ('$maSanPham', '$maKhachHang', '$noiDung', '$date','$link')";

// Execute the SQL statement
if (mysqli_query($conn, $sql)) {
    // Comment inserted successfully
    header("Location: http://localhost/DOANPHPMYSQL_2023/admin/category/chitietsanpham.php?productId=$maSanPham");
} else {
    // Error occurred while inserting comment
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


// Close the database connection
mysqli_close($conn);
?>