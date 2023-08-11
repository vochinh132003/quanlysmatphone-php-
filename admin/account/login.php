<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div style="padding: 60px 140px;" class="container-fluid ">
        <div id="wrapper">
            <form action="http://localhost/DOANPHPMYSQL_2023/admin/account/xulylogin.php" method="post" id="form-login">
                <h1 class="form-heading">Form đăng nhập</h1>
                <div class="form-group">
                    <i class="far fa-user"></i>
                    <input type="text" Username="username" name="username" class="form-input"
                        placeholder="Tên đăng nhập">
                </div>
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" password="password" name="password" class="form-input"
                        placeholder="Mật khẩu">
                    <div id="eye">
                        <i class="far fa-eye"></i>
                    </div>
                </div>
                <input type="submit" value="Đăng nhập" class="form-submit">
                <br>
                <br>
                <div class="singnup-link">
                    Bạn chưa có tài khoản ? <a style="color: blue;"
                        href="http://localhost/DO_AN_PHP_MYSQL_2023/admin/view/nic/signup.php">Đăng ký</a>
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
    </script>
</body>

</html>