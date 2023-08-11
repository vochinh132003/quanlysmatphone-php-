<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <?php
    include "http://localhost/DOANPHPMYSQL_2023/admin/category/navbarr.php";
    ?>
    <div style="padding: 60px 140px;" class="container-fluid">
        <div id="wrapper">
            <form action="http://localhost/DOanphpMYSQL_2023/admin/account/xulysignup.php" id="form-login" method="POST"
                enctype="multipart/form-data">
                <h1 class="form-heading">Form đăng ký</h1>
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-input" name="ten_khach_hang" placeholder="Tên khách hàng" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="text" class="form-input" name="dia_chi" placeholder="Địa chỉ">
                </div>
                <div class="form-group">
                    <i class="fas fa-phone"></i>
                    <input type="text" class="form-input" name="so_dien_thoai" placeholder="Số điện thoại">
                </div>
                <div class="form-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" class="form-input" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-input" name="ten_dang_nhap" placeholder="Tên đăng nhập" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-input" name="mat_khau" placeholder="Mật khẩu" required>
                    <div id="eye">
                        <i class="far fa-eye"></i>
                    </div>
                </div>
                <div class="form-group">
                    <i class="fas fa-check-circle"></i>
                    <input type="password" class="form-input" name="xac_nhan_mat_khau" placeholder="Xác nhận mật khẩu"
                        required>
                    <div id="eyee">
                        <i class="far fa-eye"></i>
                    </div>
                </div>
                <input type="file" class="form-control" id="anh_khachhang" name="anh_khachhang">
                <input type="submit" name="submit" value="Đăng ký" class="form-submit">
                <br>
                <br>
                <div class="singnup-link">
                    Bạn đã có tài khoản ? <a style="color: blue;"
                        href="http://localhost/DOANPHPMYSQL_2023/admin/category/home.php">Đăng nhập</a>
                </div>
            </form>
        </div>
    </div>

    <style>
        body {
            background: url('../img/bg.jpg');
            background-size: cover;
            background-position-y: -80px;
            font-size: 16px;
        }

        #wrapper {
            min-height: 60vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #form-login {
            max-width: 400px;
            background: rgba(0, 0, 0, 0.8);
            flex-grow: 1;
            padding: 30px 30px 40px;
            box-shadow: 0px 0px 17px 2px rgba(255, 255, 255, 0.8);
        }

        .form-heading {
            font-size: 25px;
            color: #f5f5f5;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            border-bottom: 1px solid #fff;
            margin-top: 15px;
            margin-bottom: 40px;
            display: flex;
        }

        .form-group i {
            color: #fff;
            font-size: 14px;
            padding-top: 5px;
            padding-right: 10px;
        }

        .form-input {
            background: transparent;
            border: 0;
            outline: 0;
            color: #f5f5f5;
            flex-grow: 1;
        }

        .form-input::placeholder {
            color: #f5f5f5;
        }

        #eye i {
            padding-right: 0;
            cursor: pointer;
        }

        #eyee i {
            padding-right: 0;
            cursor: pointer;
        }

        .form-submit {
            background: transparent;
            border: 1px solid #f5f5f5;
            color: #fff;
            width: 100%;
            text-transform: uppercase;
            padding: 6px 10px;
            transition: 0.25s ease-in-out;
            /* margin-top: 30px; */
        }

        .form-submit:hover {
            border: 1px solid #54a0ff;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

    <script>
        $(document).ready(function () {
            $('#eye').click(function () {
                $(this).toggleClass('open');
                $(this).children('i').toggleClass('fa-eye-slash fa-eye');
                if ($(this).hasClass('open')) {
                    $(this).prev().attr('type', 'text');
                } else {
                    $(this).prev().attr('type', 'password');
                }
            });
        });
        $(document).ready(function () {
            $('#eyee').click(function () {
                $(this).toggleClass('open');
                $(this).children('i').toggleClass('fa-eye-slash fa-eye');
                if ($(this).hasClass('open')) {
                    $(this).prev().attr('type', 'text');
                } else {
                    $(this).prev().attr('type', 'password');
                }
            });
        });
    </script>
</body>

</html>