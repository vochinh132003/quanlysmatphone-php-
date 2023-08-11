<?php
include "../connect/config_oop.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Mật khẩu cũ
    $oldPassword = md5($_POST["old_password"]);
    // Mật khẩu mới
    $newPassword = md5($_POST["new_password"]);
    // Xác nhận mật khẩu mới
    $confirmPassword = md5($_POST["confirm_password"]);
    // Tên khách hàng (User ID)
    $userId = $_POST["ten_khachhang"];

    // Kiểm tra mật khẩu cũ

    $sql = "SELECT MaKhachHang, matkhau FROM khachhang WHERE TenKhachHang = '$userId'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $maKhachHang = $row['MaKhachHang'];
            $hashedPassword = $row["matkhau"];

            // Check xem mật khẩu cũ có giống mật khẩu trong database hay không
            if ($oldPassword == $hashedPassword) {
                // Update the password in the database
                $updateSql = "UPDATE KhachHang SET matkhau = '$newPassword' WHERE MaKhachHang = '$maKhachHang'";

                if (mysqli_query($conn, $updateSql)) {
                    echo "Password changed successfully.";
                } else {
                    echo "Error updating password: " . mysqli_error($conn);
                }
            } else {
                echo "Incorrect old password.";
            }
        } else {
            echo "User not found.";
        }
    } else {
        echo "Error fetching user data: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
