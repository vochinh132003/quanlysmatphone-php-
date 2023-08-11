<?php
// Establish a connection to the database
include "../connect/config_oop.php";


// Retrieve the form data
$ma_nhasx = mysqli_real_escape_string($conn, $_POST['MaNhaSanXuat']);
$ten_nhasx = mysqli_real_escape_string($conn, $_POST['ten_nhasx_' . $ma_nhasx]);
$dia_chi = mysqli_real_escape_string($conn, $_POST['dia_chi' . $ma_nhasx]);
$so_dt = mysqli_real_escape_string($conn, $_POST['so_đt' . $ma_nhasx]);
$email = mysqli_real_escape_string($conn, $_POST['email' . $ma_nhasx]);

// Construct the SQL query
$sql = "UPDATE NhaSanXuat SET TenNhaSanXuat='$ten_nhasx', DiaChi='$dia_chi', SoDienThoai='$so_dt', Email='$email' WHERE MaNhaSanXuat='$ma_nhasx'";
$result = mysqli_query($conn, $sql);
// Execute the query
if ($result) {
    // Product added successfully
    header("Location: http://localhost/DO_AN_PHP_MYSQL_2023/admin/dashboardd/dashboardd_nhasanxuat.php");
} else {
    // Error occurred while adding the product
    echo "Error adding product: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>