<content>
    <div class="text-center">
        <img src="images/flashsale.gif" width="1223px" style="margin-left: -22px">
    </div>

    <div class="text-center">
        <h2 style="color: red;padding-top: 50px;">SẢN PHẨM MỚI</h2>
        <hr width="30%">
        <!-- <img src="images/banner-welcome.gif" width="1223px" style="margin-left: -22px"> -->
    </div>
    <div class="container row sanpham">
        <div class="row row-cols-1 row-cols-md-5 g-4">
            <?php
            include "../connect/config_oop.php";
            // Xử lý tìm kiếm nếu có dữ liệu được gửi từ biểu mẫu
            if (isset($_POST['search'])) {
                $searchTerm = $_POST['searchTerm'];
                // Thực hiện truy vấn tìm kiếm
                $sqls = "SELECT * FROM sanpham WHERE MaSanPham < 6 AND TenSanPham LIKE '%$searchTerm%'";
            } else {
                $sqls = "SELECT * FROM sanpham WHERE MaSanPham < 6";
            }

            $results = mysqli_query($conn, $sqls);
            if (mysqli_num_rows($results) > 0) {
                while ($row = mysqli_fetch_assoc($results)) {
                    $anhsp = $row["AnhSanPham"];
                    $productId = $row["MaSanPham"];
                    $productName = $row["TenSanPham"];
                    $productPrice = $row["GiaBan"];
                    $productQuantity = 1;
                    ?>
                    <div class="col">
                        <div class="card">
                            <img class="card-img-top" src="data:image/jpeg;base64,<?php echo base64_encode($anhsp); ?>">
                            <div class="card-body">
                                <a href="detail.html">
                                    <h5 class="card-title">
                                        <?php echo $productName ?>
                                    </h5>
                                </a>
                                <p class="card-text">
                                    <?php echo $formattedPrice = number_format($productPrice, 0, ',', '.'); ?><sup>₫</sup>
                                </p>
                                <input type="hidden" name="quantity" value="<?php echo $productQuantity ?>"
                                    class="form-control" />
                                <input type="hidden" name="hidden_image" value="<?php echo base64_encode($anhsp); ?>">
                                <input type="hidden" name="hidden_name" value="<?php echo $productName; ?>" />
                                <input type="hidden" name="hidden_price" value="<?php echo $productPrice; ?>" />
                                <input type="hidden" name="hidden_id" value="<?php echo $productId; ?>" />
                                <button type="button" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal<?php echo $row['MaSanPham']; ?>">Xem
                                    ngay</button>
                                <div class="modal fade" id="exampleModal<?php echo $row['MaSanPham']; ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel<?php echo $row['MaSanPham']; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel">THÔNG TIN SẢN PHẨM</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">

                                                        <div class="mt-2 home-product ">
                                                            <div id="nxt" class="carousel slide" data-bs-ride="true">
                                                                <div id="thumbnail" class="carousel-indicators ">
                                                                    <button type="button" data-bs-target="#nxt"
                                                                        data-bs-slide-to="0" class="col-3 active tren"
                                                                        aria-current="true" aria-label="Slide 1">
                                                                        <img class="d-block  w-100"
                                                                            src="data:image/jpeg;base64,<?php echo base64_encode($anhsp); ?>">
                                                                    </button>
                                                                </div>
                                                                <div class="carousel-inner">
                                                                    <div class="carousel-item active">
                                                                        <div class="overflow-hidden">
                                                                            <img class="d-block  w-100"
                                                                                src="data:image/jpeg;base64,<?php echo base64_encode($anhsp); ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="carousel-item">
                                                                        <div class="overflow-hidden">
                                                                            <img src="images/size.png" class="d-block w-100"
                                                                                alt="...">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button class="carousel-control-prev" type="button"
                                                                    data-bs-target="#nxt" data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon"
                                                                        aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Previous</span>
                                                                </button>
                                                                <button class="carousel-control-next" type="button"
                                                                    data-bs-target="#nxt" data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon"
                                                                        aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Next</span>
                                                                </button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row text-start ">
                                                            <p class="fs-4 tit_modal_p_3" style="padding-top: 30px;">
                                                                <strong>
                                                                    <?php echo $productName ?>
                                                                </strong>
                                                            </p>
                                                            <p class="fs-4" style="color: red;">
                                                                <?php echo $formattedPrice = number_format($productPrice, 0, ',', '.'); ?><sup>₫</sup>
                                                                <?php
                                                                $soluongbantheosanpham = "SELECT sp.TenSanPham, SUM(cthd.SoLuongBan) AS SoLuongDaBan
                                                                FROM ChiTietHoaDon cthd
                                                                JOIN SanPham sp ON cthd.MaSanPham = sp.MaSanPham
                                                                WHERE sp.TenSanPham = '$productName'
                                                                GROUP BY sp.TenSanPham;
                                                                ";
                                                                $ban = mysqli_query($conn, $soluongbantheosanpham);
                                                                if (mysqli_num_rows($ban) > 0) {
                                                                    while ($slban = mysqli_fetch_assoc($ban)) { ?>
                                                                        <span class="text-muted " style="font-size: 15px">| Đã bán:
                                                                            <?php echo $slban['SoLuongDaBan'] ?>
                                                                        </span>
                                                                        <?php
                                                                    }
                                                                }

                                                                ?>
                                                            </p>
                                                        </div>
                                                        <div class="row text-start " style="color: red;">
                                                            <p class="fs-4 fw-bold icon_modal_p_3"><i class="fas fa-star"></i><i
                                                                    class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                                    class="fas fa-star"></i><i class="fas fa-star"></i> <span
                                                                    class="text-muted" style=" font-size: 15px "> | <span
                                                                        style="text-decoration-line: underline;">78</span>
                                                                    Đánh giá</span></p>
                                                        </div>
                                                        <div class="row text-start ">
                                                            <p>
                                                                <?php echo $row['MoTaSanPham']; ?>
                                                            </p>
                                                        </div>
                                                        <div class="row text-start mssp">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <p>Kích thước:</p>
                                                                </div>
                                                                <div class="col-sm-6 size">
                                                                    <div class="btn-group" role="group"
                                                                        aria-label="Third group">
                                                                        <button type="button" class="btn btn-danger">
                                                                            <?php echo $row['Kichthuoc']; ?>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div><br>
                                                            <div class="row" style="padding-top: 7px;margin-left: -12px;">
                                                                <div class="col-sm-4">
                                                                    <p>Số lượng:</p>
                                                                </div>
                                                                <div class="col-sm-3" style="margin-top: -5px;">
                                                                    <input type="number" class="form-control" id="inputnumber"
                                                                        value="<?php echo $productQuantity ?>"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row text-start submit1">

                                                            <div class="col-md-9">
                                                                <div class="row">
                                                                    <div class="col-7">
                                                                        <div onclick="displayInvoice(<?php echo $productId; ?>)"
                                                                            class="table">
                                                                            <button type="submit" name="btn-submit"
                                                                                class="btn-danger btn-submit">Xem
                                                                                chi tiết</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-5">
                                                                        <input type="submit" name="add_to_cart"
                                                                            style="margin-top:5px;" class="btn btn-success"
                                                                            value="Thêm vào giỏ hàng" id="add-to-cart-form"
                                                                            onclick="return addProductToCart(<?php echo $productId; ?>);" />
                                                                    </div>
                                                                </div>

                                                                <div class="offcanvas offcanvas-end" tabindex="-1"
                                                                    id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                                                                    <div class="offcanvas-header ">
                                                                        <img src="images/logo.png" width="399" height="200"
                                                                            class="offcanvas-title text-center"
                                                                            id="offcanvasRightLabel">
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="offcanvas"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="offcanvas-body">
                                                                        <div class="row text-center">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>


        <div class="row justify-content-center">
            <button class="btn" id="xemthem" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
                aria-expanded="false" aria-controls="collapseExample"
                style="width: 100px;margin-top: 20px; background-color: lightgray;color: red;">
                Xem thêm</button>
            <div class="collapse " id="collapseExample" style="padding-top: 20px">
                <div class="row row-cols-3 row-cols-md-5 g-4">
                    <?php
                    include "../connect/config_oop.php";
                    // Xử lý tìm kiếm nếu có dữ liệu được gửi từ biểu mẫu
                    if (isset($_POST['search'])) {
                        $searchTerm = $_POST['searchTerm'];
                        // Thực hiện truy vấn tìm kiếm
                        $sqls = "SELECT * FROM sanpham WHERE MaSanPham > 6 AND TenSanPham LIKE '%$searchTerm%'";
                    } else {
                        $sqls = "SELECT * FROM sanpham WHERE MaSanPham > 6";
                    }

                    $results = mysqli_query($conn, $sqls);
                    if (mysqli_num_rows($results) > 0) {
                        while ($row = mysqli_fetch_assoc($results)) {
                            $anhsp = $row["AnhSanPham"];
                            $productId = $row["MaSanPham"];
                            $productName = $row["TenSanPham"];
                            $productPrice = $row["GiaBan"];
                            $productQuantity = 1;
                            ?>
                            <div class="col">
                                <div class="card">
                                    <img class="card-img-top" src="data:image/jpeg;base64,<?php echo base64_encode($anhsp); ?>">
                                    <div class="card-body">
                                        <a href="detail.html">
                                            <h5 class="card-title">
                                                <?php echo $productName ?>
                                            </h5>
                                        </a>
                                        <p class="card-text">
                                            <?php echo $formattedPrice = number_format($productPrice, 0, ',', '.'); ?><sup>₫</sup>
                                        </p>
                                        <input type="hidden" name="quantity" value="<?php echo $productQuantity ?>"
                                            class="form-control" />
                                        <input type="hidden" name="hidden_image" value="<?php echo base64_encode($anhsp); ?>">
                                        <input type="hidden" name="hidden_name" value="<?php echo $productName; ?>" />
                                        <input type="hidden" name="hidden_price" value="<?php echo $productPrice; ?>" />
                                        <input type="hidden" name="hidden_id" value="<?php echo $productId; ?>" />
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal<?php echo $row['MaSanPham']; ?>">Xem
                                            ngay</button>
                                        <div class="modal fade" id="exampleModal<?php echo $row['MaSanPham']; ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel<?php echo $row['MaSanPham']; ?>"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="exampleModalLabel">THÔNG TIN SẢN PHẨM
                                                        </h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">

                                                                <div class="mt-2 home-product ">
                                                                    <div id="nxt" class="carousel slide" data-bs-ride="true">
                                                                        <div id="thumbnail" class="carousel-indicators ">
                                                                            <button type="button" data-bs-target="#nxt"
                                                                                data-bs-slide-to="0" class="col-3 active tren"
                                                                                aria-current="true" aria-label="Slide 1">
                                                                                <img class="d-block  w-100"
                                                                                    src="data:image/jpeg;base64,<?php echo base64_encode($anhsp); ?>">
                                                                            </button>
                                                                        </div>
                                                                        <div class="carousel-inner">
                                                                            <div class="carousel-item active">
                                                                                <div class="overflow-hidden">
                                                                                    <img class="d-block  w-100"
                                                                                        src="data:image/jpeg;base64,<?php echo base64_encode($anhsp); ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="carousel-item">
                                                                                <div class="overflow-hidden">
                                                                                    <img src="images/size.png"
                                                                                        class="d-block w-100" alt="...">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <button class="carousel-control-prev" type="button"
                                                                            data-bs-target="#nxt" data-bs-slide="prev">
                                                                            <span class="carousel-control-prev-icon"
                                                                                aria-hidden="true"></span>
                                                                            <span class="visually-hidden">Previous</span>
                                                                        </button>
                                                                        <button class="carousel-control-next" type="button"
                                                                            data-bs-target="#nxt" data-bs-slide="next">
                                                                            <span class="carousel-control-next-icon"
                                                                                aria-hidden="true"></span>
                                                                            <span class="visually-hidden">Next</span>
                                                                        </button>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row text-start ">
                                                                    <p class="fs-4 tit_modal_p_3" style="padding-top: 30px;">
                                                                        <strong>
                                                                            <?php echo $productName ?>
                                                                        </strong>
                                                                    </p>
                                                                    <p class="fs-4" style="color: red;">
                                                                        <?php echo $formattedPrice = number_format($productPrice, 0, ',', '.'); ?><sup>₫</sup>
                                                                        <?php
                                                                        $soluongbantheosanphamm = "SELECT sp.TenSanPham, SUM(cthd.SoLuongBan) AS SoLuongDaBann
                                                                        FROM ChiTietHoaDon cthd
                                                                        JOIN SanPham sp ON cthd.MaSanPham = sp.MaSanPham
                                                                        WHERE sp.TenSanPham = '$productName'
                                                                        GROUP BY sp.TenSanPham;
                                                                        ";
                                                                        $bann = mysqli_query($conn, $soluongbantheosanphamm);
                                                                        if (mysqli_num_rows($bann) > 0) {
                                                                            while ($slbann = mysqli_fetch_assoc($bann)) { ?>
                                                                                <span class="text-muted " style="font-size: 15px">| Đã
                                                                                    bán:
                                                                                    <?php echo $slbann['SoLuongDaBann'] ?>
                                                                                </span>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </p>
                                                                </div>
                                                                <div class="row text-start " style="color: red;">
                                                                    <p class="fs-4 fw-bold icon_modal_p_3"><i
                                                                            class="fas fa-star"></i><i
                                                                            class="fas fa-star"></i><i
                                                                            class="fas fa-star"></i><i
                                                                            class="fas fa-star"></i><i class="fas fa-star"></i>
                                                                        <span class="text-muted" style=" font-size: 15px "> |
                                                                            <span
                                                                                style="text-decoration-line: underline;">78</span>
                                                                            Đánh giá</span>
                                                                    </p>
                                                                </div>
                                                                <div class="row text-start ">
                                                                    <p>
                                                                        <?php echo $row['MoTaSanPham']; ?>
                                                                    </p>
                                                                </div>
                                                                <div class="row text-start mssp">
                                                                    <div class="row">
                                                                        <div class="col-sm-4">
                                                                            <p>Kích thước:</p>
                                                                        </div>
                                                                        <div class="col-sm-6 size">
                                                                            <div class="btn-group" role="group"
                                                                                aria-label="Third group">
                                                                                <button type="button" class="btn btn-danger">
                                                                                    <?php echo $row['Kichthuoc']; ?>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div><br>
                                                                    <div class="row"
                                                                        style="padding-top: 7px;margin-left: -12px;">
                                                                        <div class="col-sm-4">
                                                                            <p>Số lượng:</p>
                                                                        </div>
                                                                        <div class="col-sm-3" style="margin-top: -5px;">
                                                                            <input type="number" class="form-control"
                                                                                id="inputnumber"
                                                                                value="<?php echo $productQuantity ?>"></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row text-start submit1">
                                                                    <div class="col-md-9">
                                                                        <div class="row">
                                                                            <div class="col-7">
                                                                                <div onclick="displayInvoice(<?php echo $productId; ?>)"
                                                                                    class="table">
                                                                                    <button type="submit" name="btn-submit"
                                                                                        class="btn-danger btn-submit">Xem
                                                                                        chi tiết</button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-5">
                                                                                <input type="submit" name="add_to_cart"
                                                                                    style="margin-top:5px;"
                                                                                    class="btn btn-success" value="Thêm vào giỏ hàng"
                                                                                    id="add-to-cart-form"
                                                                                    onclick="return addProductToCart(<?php echo $productId; ?>);" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="offcanvas offcanvas-end" tabindex="-1"
                                                                            id="offcanvasRight"
                                                                            aria-labelledby="offcanvasRightLabel">
                                                                            <div class="offcanvas-header ">
                                                                                <img src="images/logo.png" width="399"
                                                                                    height="200"
                                                                                    class="offcanvas-title text-center"
                                                                                    id="offcanvasRightLabel">
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="offcanvas"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="offcanvas-body">
                                                                                <div class="row text-center">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <h2 style="color: red;padding-top: 50px;">SẢN PHẨM BÁN CHẠY NHẤT</h2>
        <hr width="30%">
        <!-- <img src="images/banner-welcome.gif" width="1223px" style="margin-left: -22px"> -->
    </div>
    <div class="container row sanpham">
        <div class="row row-cols-1 row-cols-md-5 g-4">
            <?php
            include "../connect/config_oop.php";
            $sql = "SELECT SanPham.MaSanPham, SanPham.TenSanPham,SanPham.Kichthuoc, SanPham.GiaBan, SanPham.AnhSanPham, SUM(ChiTietHoaDon.SoLuongBan) AS TongSoLuongBan
                                            FROM SanPham
                                            JOIN ChiTietHoaDon ON SanPham.MaSanPham = ChiTietHoaDon.MaSanPham
                                            GROUP BY SanPham.MaSanPham, SanPham.TenSanPham, SanPham.GiaBan, SanPham.AnhSanPham
                                            ORDER BY TongSoLuongBan DESC
                                            LIMIT 5;";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $productId = $row["MaSanPham"];
                    $TenSanPham = $row["TenSanPham"];
                    $GiaBan = $row["GiaBan"];
                    $AnhSanPham = $row["AnhSanPham"];
                    ?>
                    <div class="col">
                        <div class="card">
                            <img class="card-img-top" src="data:image/jpeg;base64,<?php echo base64_encode($AnhSanPham); ?>">
                            <div class="card-body">
                                <a href="detail.html">
                                    <h5 class="card-title">
                                        <?php echo $TenSanPham ?>
                                    </h5>
                                </a>
                                <p class="card-text">
                                    <?php echo $formattedPrice = number_format($GiaBan, 0, ',', '.'); ?><sup>₫</sup>
                                </p>
                                <input type="hidden" name="quantity" value="<?php echo $productQuantity ?>"
                                    class="form-control" />
                                <input type="hidden" name="hidden_image" value="<?php echo base64_encode($AnhSanPham); ?>">
                                <input type="hidden" name="hidden_name" value="<?php echo $TenSanPham; ?>" />
                                <input type="hidden" name="hidden_price" value="<?php echo $GiaBan; ?>" />
                                <input type="hidden" name="hidden_id" value="<?php echo $productId; ?>" />
                                <button type="button" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal<?php echo $row['MaSanPham']; ?>">Xem
                                    ngay</button>
                                <div class="modal fade" id="exampleModal<?php echo $row['MaSanPham']; ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel<?php echo $row['MaSanPham']; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel">THÔNG TIN SẢN PHẨM
                                                </h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">

                                                        <div class="mt-2 home-product ">
                                                            <div id="nxt" class="carousel slide" data-bs-ride="true">
                                                                <div id="thumbnail" class="carousel-indicators ">
                                                                    <button type="button" data-bs-target="#nxt"
                                                                        data-bs-slide-to="0" class="col-3 active tren"
                                                                        aria-current="true" aria-label="Slide 1">
                                                                        <img class="d-block  w-100"
                                                                            src="data:image/jpeg;base64,<?php echo base64_encode($AnhSanPham); ?>">
                                                                    </button>
                                                                </div>
                                                                <div class="carousel-inner">
                                                                    <div class="carousel-item active">
                                                                        <div class="overflow-hidden">
                                                                            <img class="d-block  w-100"
                                                                                src="data:image/jpeg;base64,<?php echo base64_encode($AnhSanPham); ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="carousel-item">
                                                                        <div class="overflow-hidden">
                                                                            <img src="images/size.png" class="d-block w-100"
                                                                                alt="...">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button class="carousel-control-prev" type="button"
                                                                    data-bs-target="#nxt" data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon"
                                                                        aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Previous</span>
                                                                </button>
                                                                <button class="carousel-control-next" type="button"
                                                                    data-bs-target="#nxt" data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon"
                                                                        aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Next</span>
                                                                </button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row text-start ">
                                                            <p class="fs-4 tit_modal_p_3" style="padding-top: 30px;">
                                                                <strong>
                                                                    <?php echo $TenSanPham ?>
                                                                </strong>
                                                            </p>
                                                            <p class="fs-4" style="color: red;">
                                                                <?php echo $GiaBan ?><sup>₫</sup> <span class="text-muted "
                                                                    style="font-size: 15px">| Đã
                                                                    bán:
                                                                    125 sản phẩm</span>
                                                            </p>
                                                        </div>
                                                        <div class="row text-start " style="color: red;">
                                                            <p class="fs-4 fw-bold icon_modal_p_3"><i class="fas fa-star"></i><i
                                                                    class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                                    class="fas fa-star"></i><i class="fas fa-star"></i>
                                                                <span class="text-muted" style=" font-size: 15px "> |
                                                                    <span style="text-decoration-line: underline;">78</span>
                                                                    Đánh giá</span>
                                                            </p>
                                                        </div>
                                                        <div class="row text-start ">
                                                            <p>
                                                                <?php echo $row['MoTaSanPham']; ?>
                                                            </p>
                                                        </div>
                                                        <div class="row text-start mssp">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <p>Kích thước:</p>
                                                                </div>
                                                                <div class="col-sm-6 size">
                                                                    <div class="btn-group" role="group"
                                                                        aria-label="Third group">
                                                                        <button type="button" class="btn btn-danger">
                                                                            <?php echo $row['Kichthuoc']; ?>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div><br>
                                                            <div class="row" style="padding-top: 7px;margin-left: -12px;">
                                                                <div class="col-sm-4">
                                                                    <p>Số lượng:</p>
                                                                </div>
                                                                <div class="col-sm-3" style="margin-top: -5px;">
                                                                    <input type="number" class="form-control" id="inputnumber"
                                                                        value="<?php echo $productQuantity ?>"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row text-start submit1">
                                                            <div class="col-md-9">
                                                                <div class="row">
                                                                    <div class="col-7">
                                                                        <div onclick="displayInvoice(<?php echo $productId; ?>)"
                                                                            class="table">
                                                                            <button type="submit" name="btn-submit"
                                                                                class="btn-danger btn-submit">Xem
                                                                                chi tiết</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-5">
                                                                        <input type="submit" name="add_to_cart"
                                                                            style="margin-top:5px;" class="btn btn-success"
                                                                            value="Thêm vào giỏ hàng" id="add-to-cart-form"
                                                                            onclick="return addProductToCart(<?php echo $productId; ?>);" />
                                                                    </div>
                                                                </div>
                                                                <div class="offcanvas offcanvas-end" tabindex="-1"
                                                                    id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                                                                    <div class="offcanvas-header ">
                                                                        <img src="images/logo.png" width="399" height="200"
                                                                            class="offcanvas-title text-center"
                                                                            id="offcanvasRightLabel">
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="offcanvas"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="offcanvas-body">
                                                                        <div class="row text-center">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>
    </div>
</content>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="http://localhost/DOANPHPMYSQL_2023/admin/assets/js/cart.js"></script>
<script language="Javascript">
    function displayInvoice(productId) {
        // Chuyển hướng người dùng đến trang hiển thị hoá đơn với tableId
        window.location.href = 'chitietsanpham.php?productId=' + productId;
    }
</script>