<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body>
    <?php
    if (!isset($_SESSION['username'])) {
        // Redirect to the login page
        header("Location: http://localhost/DOANPHPMYSQL_2023/admin/category/home.php");
        exit;
    }
    ?>
    <style>
        .edit-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }

        .delete-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }

        .edit-btn i,
        .delete-btn i {
            margin-right: 5px;
        }
    </style>

    <?php
    include "../../connect/config_oop.php";
    $sql = "select * from khachhang";
    $query = mysqli_query($conn, $sql);
    ?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2>Danh sách khách hàng</h2>
            </div>
            <div class="card-footer text-muted">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Thêm mới</button>
                <?php include '../../view/modal/modal_khachhang.php' ?>
            </div>
            <div class="card-body">
                <table id="productTable" class="table">
                    <thead class="thead-dark">
                        <tr style="font-size: 15px;">
                            <th>ID</th>
                            <th>TÊN KHÁCH HÀNG</th>
                            <th>ĐỊA CHỈ</th>
                            <th>SỐ ĐIỆN THOẠI</th>
                            <th>EMAIL</th>
                            <th>Tên đăng nhập</th>
                            <th>MẬT KHẨU</th>
                            <th>ẢNH</th>
                            <th>Setting</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($query)) {
                            $anh = $row["anh"];
                            $TenKhachHang = $row["TenKhachHang"];
                            ?>
                            <tr style="font-size: 13px;">
                                <td>
                                    <?php echo $i++; ?>
                                </td>
                                <td>
                                    <?php echo $row['TenKhachHang']; ?>
                                </td>
                                <td>
                                    <?php echo $row['DiaChi']; ?>
                                </td>
                                <td>
                                    <?php echo $row['SoDienThoai']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Email']; ?>
                                </td>
                                <td>
                                    <?php echo $row['tendangnhap']; ?>
                                </td>
                                <td>
                                    <?php echo md5($row['matkhau']); ?>
                                </td>
                                <td>
                                    <img style="width: 100px;height: 100px;"
                                        src="data:image/jpeg;base64,<?php echo base64_encode($anh); ?>"
                                        alt="<?php echo $TenKhachHang; ?>">
                                </td>
                                <td>
                                    <button class="edit-btn" data-bs-toggle="modal"
                                        data-bs-target="#editModal<?php echo $row['MaKhachHang']; ?>">
                                        <i class="fas fa-cogs"></i>
                                    </button>
                                    <?php include '../modal/modal_khachhang.php' ?>
                                    <button class="delete-btn" data-id="<?php echo $row['MaKhachHang']; ?>"
                                        onclick="deleteProduct(<?php echo $row['MaKhachHang']; ?>)"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <style>
        th {
            border-top: 1px solid #ccc;
            border-left: 1px solid #ccc;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }

        th:last-child {
            border-right: none;
        }

        td {
            border-left: 1px solid #ccc;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#productTable').DataTable();
        });
    </script>
    <script>
        function deleteProduct(MaKhachHang) {
            if (confirm("Bạn có chắc chắn muốn xóa khách hàng này?")) {
                // Gửi yêu cầu xóa sản phẩm bằng AJAX
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "http://localhost/DOANPHPMYSQL_2023/admin/core/xulydelete_khachhang.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Xử lý phản hồi từ máy chủ sau khi xóa thành công
                        alert(xhr.responseText);
                        // Refresh trang để cập nhật danh sách sản phẩm
                        location.reload();
                    }
                };
                xhr.send("MaKhach_Hang=" + MaKhachHang);
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>