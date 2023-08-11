<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: http://localhost/DOANPHPMYSQL_2023/account/login.php");
    exit;
}
include "../../connect/config_oop.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
</head>

<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"><i class='bx bxl-android'></i></span>
                        <span class="title">Brand Name</span>
                    </a>
                </li>
                <li>
                    <a href="http://localhost/DOANPHPMYSQL_2023/admin/view/category/dashboard.php">
                        <span class="icon"><i class='bx bx-home'></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="http://localhost/DOANPHPMYSQL_2023/admin/view/category/dashboard_nhasanxuat.php">
                        <span class="icon"><i class='bx bxl-product-hunt'></i></span>
                        <span class="title">Nhà sản xuất</span>
                    </a>
                </li>
                <li>
                    <a href="http://localhost/DOANPHPMYSQL_2023/admin/view/category/dashboard_sanpham.php">
                        <span class="icon"><i class='bx bxl-product-hunt'></i></span>
                        <span class="title">Sản phẩm</span>
                    </a>
                </li>
                <li>
                    <a href="http://localhost/DOANPHPMYSQL_2023/admin/view/category/dashboard_khachhang.php">
                        <span class="icon"><i class='bx bxs-user-account'></i></span>
                        <span class="title">Khách hàng</span>
                    </a>
                </li>
                <li>
                    <a href="http://localhost/DOANPHPMYSQL_2023/admin/view/category/dashboard_nhanvien.php">
                        <span class="icon"><i class='bx bx-food-menu'></i></span>
                        <span class="title">Nhân viên</span>
                    </a>
                </li>
                <li>
                    <a href="http://localhost/DOANPHPMYSQL_2023/admin/view/category/dashboard_donhang.php">
                        <span class="icon"><i class='bx bx-captions'></i></span>
                        <span class="title">Đơn hàng</span>
                    </a>
                </li>
                <li>
                    <a href="http://localhost/DOANPHPMYSQL_2023/admin/view/category/dashboard_phanhoi.php">
                        <span class="icon"><i class='bx bx-message'></i></span>
                        <span class="title">Phản hồi</span>
                    </a>
                </li>
            </ul>
        </div>



        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <i class='bx bx-menu'></i>
                </div>
                <div class="search">
                    <label>
                        <input type="text" placeholder="Search...">
                        <i class='bx bx-search-alt-2'></i>
                    </label>
                </div>
                <div class="letters">
                    <a href="#"><i class='bx bx-envelope'></i><sup>9</sup></a>
                    <a href="#"><i class='bx bx-bell'></i><sup class="total-count" data-count='0'></sup></a>
                </div>
                <div class="user" onclick="settingsMenuToggle()">
                    <?php
                    if (isset($_SESSION['username'], $_SESSION['user_id'], $_SESSION['anh_1'])) {
                        $anh = $_SESSION['anh_1'];
                        ?>
                        <img style=" border-radius: 50px;" src="data:image/jpeg;base64,<?php echo base64_encode($anh); ?>"
                            alt="">
                    <?php }
                    ?>
                </div>

                <div class="settings-menu">
                    <div id="dark-btn">
                        <span></span>
                    </div>
                    <div class="settings-menu-inner">
                        <div class="user-profile">
                            <?php
                            if (isset($_SESSION['username'], $_SESSION['user_id'], $_SESSION['anh_1'])) {
                                $anh = $_SESSION['anh_1'];
                                $user_id = $_SESSION['user_id'];
                                ?>
                                <img style=" border-radius: 50px;"
                                    src="data:image/jpeg;base64,<?php echo base64_encode($anh); ?>" alt="">
                                <p>
                                    <?php echo $user_id ?>
                                </p>
                                <?php
                                // echo '<input type="text" value="' . $_SESSION['user_id'] . '">';
                            }
                            ?>
                        </div>
                        <!-- <div class="settings-links">
                            <form action="http://localhost/DOANPHPMYSQL_2023/admin/account/logout.php" method="POST">
                                <div class="fas fa-sign-out-alt"></div>
                                <span><input type="submit" value="Logout"></span>
                            </form>
                        </div> -->
                        <hr>
                        <div class="settings-links">
                            <a
                                href="http://localhost/DOANPHPMYSQL_2023/admin/view/category/dashboard_thongtintaikhoan.php">Xem
                                thông tin tài khoản<i class='bx bxs-chevron-right'></i></a>
                        </div>
                        <hr>
                        <div class="settings-links">
                            <i class='bx bx-log-in icon'></i>
                            <a href="http://localhost/DOANPHPMYSQL_2023/admin/account/logout.php">Logout<i
                                    class='bx bxs-chevron-right'></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card-container">
                <h1 class="main-title">Today's data</h1>
                <div class="card-wrapper">
                    <?php
                    include "../../connect/config_oop.php";
                    $sql = "select sum(TongGiaTri) as doanhthu  from hoadon;";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $tong_tien = $row["doanhthu"];
                            ?>
                            <div class="payment-card">
                                <div class="border"></div>
                                <div class="card-header">
                                    <div class="amount">
                                        <span class="titlee">
                                            Tổng doanh thu
                                        </span>
                                        <span class="amount-value">
                                            <!-- <?php echo $formattedPrice = number_format($tong_tien, 0, ',', '.'); ?><sup>₫</sup> -->
                                            <?php echo $tong_tien ?> VND
                                        </span>
                                    </div>
                                    <div class="bx bx-line-chart icons"></div>
                                </div>
                            </div>
                        <?php }
                    }
                    ?>
                    <?php
                    include "../../connect/config_oop.php";
                    $sql = "SELECT COUNT(*) AS total_count FROM SanPham;";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $tong_san_pham = $row["total_count"];
                            ?>
                            <div class="payment-card">
                                <div class="border " style=" background: rgb(246, 4, 190);"></div>
                                <div class="card-header">
                                    <div class="amount">
                                        <span class="titlee">
                                            Sản phẩm
                                        </span>
                                        <span class="amount-value">
                                            <?php echo $tong_san_pham ?>
                                        </span>
                                    </div>
                                    <div class=" bx bx-leaf iconnnn"></div>
                                </div>
                            </div>
                        <?php }
                    }
                    ?>
                    <?php
                    include "../../connect/config_oop.php";
                    $sql = "SELECT COUNT(*) AS total_customers FROM khachhang;";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $total_customers = $row["total_customers"];
                            ?>
                            <div class="payment-card">
                                <div class="border " style="background: rgb(255, 204, 0);"></div>
                                <div class="card-header">
                                    <div class="amount">
                                        <span class="titlee">
                                            Tổng khách hàng
                                        </span>
                                        <span class="amount-value">
                                            <?php echo $total_customers ?>
                                        </span>
                                    </div>
                                    <div class=" bx bxs-id-card iconn"></div>
                                </div>
                            </div>
                        <?php }
                    }
                    ?>
                    <?php
                    include "../../connect/config_oop.php";
                    $sql = "SELECT COUNT(*) AS tong_hoa_don FROM hoadon;";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $tong_hoa_don = $row["tong_hoa_don"];
                            ?>
                            <div class="payment-card">
                                <div class="border " style="  background: rgb(44, 246, 4);"></div>
                                <div class="card-header">
                                    <div class="amount">
                                        <span class="titlee">
                                            Tổng số hoá đơn
                                        </span>
                                        <span class="amount-value">
                                            <?php echo $tong_hoa_don ?>
                                        </span>
                                    </div>
                                    <div class="bx bx-clipboard iconnn"></div>
                                </div>
                            </div>
                        <?php }
                    }
                    ?>
                </div>
            </div>
            <br>

            <div class="details" style="margin-left: 40px;">
                <div class="text" style="text-align:center;">
                    <?php include '../category/linegraph.php' ?>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <?php include '../category/piechart.php' ?>
                    </div>
                    <div class="col-6">
                        <br><br><br>
                        <?php include '../category/columnchart.php' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="http://localhost/DOANPHPMYSQL_2023/admin/assets/js/admin.js"></script>
<script language="Javascript" src="js/giohang.js"></script>
<script>
    /// toggle///
    let toggle = document.querySelector('.toggle');
    let navigation = document.querySelector('.navigation');
    let main = document.querySelector('.main');

    toggle.onclick = function () {
        navigation.classList.toggle('active')
        main.classList.toggle('active')
    }
    /////
    let list = document.querySelectorAll('.navigation li');

    function activeLink() {
        list.forEach((item) =>
            item.classList.remove('hovered'));
        this.classList.add('hovered');
    }
    list.forEach((item) =>
        item.addEventListener('mouseover', activeLink));
</script>

</html>