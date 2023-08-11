<?php
include "../connect/config_oop.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the form data
    $tenSanPham = $_POST['ten_sanpham'];
    $giaBan = $_POST['gia'];
    $soLuongTrongKho = $_POST['so_luong'];
    $moTaSanPham = $_POST['mo_ta'];
    $maNhaSanXuat = $_POST['ma_nha_sx_'];
    $kichThuoc = $_POST['kich_thuoc'];
    $trongLuongSanPham = $_POST['trong_luong_san_pham'];
    $dienTichManHinh = $_POST['dien_tich_man_hinh'];
    $ram = $_POST['ram'];
    $dungLuongPin = $_POST['dung_luong_pin'];
    $thoiGianBaoHanh = $_POST['thoi_gian_bao_hanh'];

    if (isset($_POST['submit'])) {
        if (getimagesize($_FILES['anh_sanpham']['tmp_name']) == false) {
            echo "<br />Please select an image.";
        } else {
            // Prepare image data for insertion
            $image = addslashes(file_get_contents($_FILES['anh_sanpham']['tmp_name']));

            // Prepare and execute the SQL query to insert the product into the database
            $insertQuery = "INSERT INTO SanPham (TenSanPham, GiaBan, SoLuongTrongKho, MoTaSanPham, AnhSanPham, Kichthuoc, Trongluongsanpham, Dientichmanhinh, Ram, Dungluongpin, Thoigianbaohang, MaNhaSanXuat)
             VALUES ('$tenSanPham', $giaBan, $soLuongTrongKho, '$moTaSanPham', '$image', '$kichThuoc', '$trongLuongSanPham', '$dienTichManHinh', '$ram', '$dungLuongPin', '$thoiGianBaoHanh', $maNhaSanXuat)";

            if ($conn->query($insertQuery) === TRUE) {
                header("Location: http://localhost/DOANPHPMYSQL_2023/admin/view/category/dashboard_sanpham.php");
                exit;
            } else {
                echo "Error adding product: " . mysqli_error($conn);
            }
        }
    }
}
?>