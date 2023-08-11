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
    <div class="div" style="padding: 20px 40px;">
        <div class="row"> <a href="">Đổi mật khẩu</a>
            <form action="http://localhost/DOANPHPMYSQL_2023/admin/account/logout.php" method="POST">
                <span><input type="submit" value="Thoát"></span>
            </form>
        </div>
        <style>
            .row a {
                text-decoration: none;
                color: #000;
            }
        </style>
        <h1 style="color:red;">THÔNG TIN TÀI KHOẢN</h1>
        <?php
        if (isset($_SESSION['username'], $_SESSION['user_id'], $_SESSION['DiaChi'], $_SESSION['Email'])) {
            $user_id = $_SESSION['user_id'];
            $dia_chi = $_SESSION['DiaChi'];
            $username = $_SESSION['username'];
            $email = $_SESSION['Email'];
            ?>
            <div class="mb-3 form-group row">
                <label for="ten_nhanvien" class="col-sm-2 col-form-label">Tên nhân viên:</label>
                <div class="col-sm-10">
                    <input type="text" value="<?php echo $user_id; ?>" class="form-control" id="ten_khachhang"
                        name="ten_khachhang">
                </div>
            </div>
            <div class="mb-3 form-group row">
                <label for="ten_dangnhap" class="col-sm-2 col-form-label">Tên đăng nhập:</label>
                <div class="col-sm-10">
                    <input type="text" value="<?php echo $username; ?>" class="form-control" id="ten_dangnhap"
                        name="ten_dangnhap">
                </div>
            </div>
            <div class="mb-3 form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="text" value="<?php echo $email; ?>" class="form-control" id="Email" name="Email">
                </div>
            </div>
            <div class="mb-3 form-group row">
                <label for="diachi" class="col-sm-2 col-form-label">Địa chỉ:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="DiaChi" name="DiaChi"><?php echo $dia_chi; ?></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button> -->
                <input type="submit" class="btn btn-primary" name="submit" value="Chỉnh sửa thông tin">
            </div>
            <?php
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>