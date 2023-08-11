<?php
include "../connect/config_oop.php";

// Retrieve the form data
$ten_nhasx = mysqli_real_escape_string($conn, $_POST['ten_nhasx']);
$dia_chi = mysqli_real_escape_string($conn, $_POST['dia_chi']);
$so_dt = mysqli_real_escape_string($conn, $_POST['so_dt']);
$email = mysqli_real_escape_string($conn, $_POST['Email']);

// Construct the SQL query
$sql = "INSERT INTO NhaSanXuat (TenNhaSanXuat, DiaChi, SoDienThoai, Email) VALUES ('$ten_nhasx', '$dia_chi', '$so_dt', '$email')";
$result = mysqli_query($conn, $sql);

// Check if the query executed successfully
if ($result) {
    // Product added successfully
    header("Location: http://localhost/DOANPHPMYSQL_2023/admin/view/category/dashboard_nhasanxuat.php");
} else {
    // Error occurred while adding the product
    echo "Error adding product: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>