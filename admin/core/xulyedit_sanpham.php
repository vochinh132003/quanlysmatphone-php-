<?php
include "../connect/config_oop.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the form data
    $ma_san_pham = $_POST['MaSanPham'];
    $tenSanPham = $_POST['ten_sanpham_' . $ma_san_pham];
    $giaBan = $_POST['gia_ban_' . $ma_san_pham];
    $soLuongTrongKho = $_POST['so_luong_trong_kho_' . $ma_san_pham];
    $moTaSanPham = $_POST['mo_ta_sp_' . $ma_san_pham];
    $maNhaSanXuat = $_POST['ma_nhasanxuat_' . $ma_san_pham];
    $kichThuoc = $_POST['kichthuoc_' . $ma_san_pham];
    $trongLuongSanPham = $_POST['trongluongsanpham_' . $ma_san_pham];
    $dienTichManHinh = $_POST['dientichmanhinh_' . $ma_san_pham];
    $ram = $_POST['ram_' . $ma_san_pham];
    $dungLuongPin = $_POST['dungluongpin_' . $ma_san_pham];
    $thoiGianBaoHanh = $_POST['thoigianbaohang_' . $ma_san_pham];

    if (isset($_POST['submit'])) {
        if (getimagesize($_FILES['anh_sp_' . $ma_san_pham]['tmp_name']) == false) {
            echo "<br />Please select an image.";
        } else {
            // Prepare image data for insertion
            $image = addslashes(file_get_contents($_FILES['anh_sp_' . $ma_san_pham]['tmp_name']));

            // Prepare and execute the SQL query to update the product in the database
            $updateQuery = "UPDATE SanPham SET TenSanPham = '$tenSanPham', GiaBan = $giaBan, SoLuongTrongKho = $soLuongTrongKho, MoTaSanPham = '$moTaSanPham', AnhSanPham = '$image', Kichthuoc = '$kichThuoc', Trongluongsanpham = '$trongLuongSanPham', Dientichmanhinh = '$dienTichManHinh', Ram = '$ram', Dungluongpin = '$dungLuongPin', Thoigianbaohang = '$thoiGianBaoHanh', MaNhaSanXuat = $maNhaSanXuat WHERE MaSanPham = $ma_san_pham";

            if ($conn->query($updateQuery) === TRUE) {
                header("Location: http://localhost/DOANPHPMYSQL_2023/admin/view/category/dashboard_sanpham.php");
                exit;
            } else {
                echo "Error updating product: " . mysqli_error($conn);
            }
        }
    }
}
?>
