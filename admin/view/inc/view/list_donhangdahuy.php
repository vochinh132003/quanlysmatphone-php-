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
    <?php
    include "../../connect/config_oop.php";
    $sql = "SELECT MaHoaDon, TenKhachHang, SoDienThoai, hoadon.TongGiaTri, hoadon.NgayBan, hoadon.trangthai
    FROM hoadon
    LEFT JOIN khachhang ON hoadon.MaKhachHang = khachhang.MaKhachHang
    WHERE hoadon.trangthai = 'Đã huỷ'
    ORDER BY MaHoaDon DESC;
    ";
    $query = mysqli_query($conn, $sql);
    ?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h2>Danh sách đơn hàng đã huỷ</h2>
                    </div>
                    <div class="col-4"></div>
                </div>
            </div>
            <div class="card-body">
                <table id="productTablee" class="table">
                    <thead class="thead-dark">
                        <tr style="font-size: 15px; text-align: center;">
                            <th>ID</th>
                            <th>TÊN KHÁCH HÀNG</th>
                            <th>SỐ ĐIỆN THOẠI</th>
                            <th>TỔNG TIỀN</th>
                            <th>NGÀY BÁN</th>
                            <th>TRẠNG THÁI</th>
                            <th>Setting</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($query)) { ?>
                            <tr style="font-size: 13px; text-align: center;">
                                <td>
                                    <?php echo $i++; ?>
                                </td>
                                <td>
                                    <?php echo $row['TenKhachHang']; ?>
                                </td>
                                <td>
                                    <?php echo $row['SoDienThoai']; ?>
                                </td>
                                <td>
                                    <?php echo $formattedPrice = number_format($row['TongGiaTri'], 0, ',', '.'); ?><sup>₫</sup>
                                </td>
                                <td>
                                    <?php echo $row['NgayBan']; ?>
                                </td>
                                <td>
                                    <?php echo $row['trangthai']; ?>
                                </td>
                                <td>
                                    <?php include '../../view/modal/modal_cthd.php' ?>
                                    <button class="edit-btn" data-bs-toggle="modal"
                                        data-bs-target="#viewModal<?php echo $row['MaHoaDon']; ?>"
                                        onclick="viewOrder(<?php echo $row['MaHoaDon']; ?>)">
                                        Xem
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#productTablee').DataTable();
        });
    </script>
    <script>
        function eidtProduct(productId) {
            if (confirm("Xác nhận thanh toán ?")) {
                // Gửi yêu cầu xóa sản phẩm bằng AJAX
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "http://localhost/DOANPHPMYSQL_2023/admin/core/xulyedit_hoadon.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Xử lý phản hồi từ máy chủ sau khi xóa thành công
                        alert(xhr.responseText);
                        // Refresh trang để cập nhật danh sách sản phẩm
                        location.reload();
                    }
                };
                xhr.send("id_donhang=" + productId);
            }
        }
        function eidtduyetProduct(productId) {
            if (confirm("Xác nhận thanh toán ?")) {
                // Gửi yêu cầu xóa sản phẩm bằng AJAX
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "http://localhost/DOANPHPMYSQL_2023/admin/core/xulyedit_duyethoadon.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Xử lý phản hồi từ máy chủ sau khi xóa thành công
                        alert(xhr.responseText);
                        // Refresh trang để cập nhật danh sách sản phẩm
                        location.reload();
                    }
                };
                xhr.send("id_donhang=" + productId);
            }
        }
        function huydon(productId) {
            if (confirm("Xác nhận huỷ đơn ?")) {
                // Gửi yêu cầu xóa sản phẩm bằng AJAX
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "http://localhost/DOANPHPMYSQL_2023/admin/core/xulyedit_huydon.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Xử lý phản hồi từ máy chủ sau khi xóa thành công
                        alert(xhr.responseText);
                        // Refresh trang để cập nhật danh sách sản phẩm
                        location.reload();
                    }
                };
                xhr.send("id_donhang=" + productId);
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>
<style>
    .edit-btn {
        /* Your button styles */
        background-color: #f0f0f0;
        color: #333;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    /* Additional styles for specific button states */
    .edit-btn.success {
        background-color: #4caf50;
        color: white;
    }

    .edit-btn.successs {
        background-color: #0664f9;
        color: white;
    }

    .edit-btn.pending {
        background-color: #ff9800;
        color: white;
    }

    tr {
        font-size: 13px;
        text-align: center;
    }

    tr:hover {
        background-color: #f0f0f0;
    }

    tr td {
        padding: 10px;
    }

    tr .edit-btn {
        background-color: #f0f0f0;
        color: #333;
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    tr .edit-btn:hover {
        background-color: #ccc;
    }

    tr .delete-btn {
        background-color: #ff0000;
        color: #fff;
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    tr .delete-btn:hover {
        background-color: #ff3333;
    }
</style>

</html>