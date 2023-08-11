<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../assets/css/detail.css">
    <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () { scrollFunction() };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("myBtn").style.display = "block";
            } else {
                document.getElementById("myBtn").style.display = "none";
            }
        }
        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <script>
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })

    </script>

</head>

<body>
    <?php
    include "navbarr.php";
    ?>
    <content>
        <?php
        $productId = $_GET['productId']; // Lấy tableId từ tham số truy vấn trong URL
        include "../connect/config_oop.php";
        $sql = "SELECT * FROM sanpham where MaSanPham = '$productId'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $TenSanPham = $row["TenSanPham"];
                $AnhSanPham = $row["AnhSanPham"];
                $GiaBan = $row["GiaBan"];
                $MoTaSanPham = $row["MoTaSanPham"];
                $productQuantity = 1;
                ?>
                <div class="row sanpham" style="margin-left:100px;margin-right: 100px;padding-top:30px;padding-bottom:30px ;">
                    <div class="col-sm-6 border-end">
                        <div class="mt-2 home-product ">
                            <div id="nxt" class="carousel slide" data-bs-ride="true">
                                <div id="thumbnail" class="carousel-indicators ">
                                    <button type="button" data-bs-target="#nxt" data-bs-slide-to="0" class="col-3 active tren"
                                        aria-current="true" aria-label="Slide 1">
                                        <img class="d-block  w-75"
                                            src="data:image/jpeg;base64,<?php echo base64_encode($AnhSanPham); ?>"> </button>
                                    <button type="button" data-bs-target="#nxt" data-bs-slide-to="1" aria-label="Slide 2"
                                        class="col-3 tren">
                                        <!-- <img class="d-block w-75 " src="images/size.png" class="img-fluid" /> -->
                                    </button>

                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="">
                                            <!-- <img src="images/aocamtho.png " class="d-block  " alt="..."> -->
                                            <img class="d-block  w-100"
                                                src="data:image/jpeg;base64,<?php echo base64_encode($AnhSanPham); ?>">
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="">
                                            <!-- <img src="images/size.png" class="d-block " alt="..."> -->
                                        </div>
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#nxt" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#nxt" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 ttsp " style="padding-left:30px">
                        <h2 style="color: rgba(255, 99, 71, 1); ">
                            <?php echo $row["TenSanPham"] ?>
                        </h2>
                        <p style="color: red; font-size: 30px;">
                            <?php echo $formattedPrice = number_format($row["GiaBan"], 0, ',', '.'); ?><sup>₫</sup>
                        </p>
                        <div class="row">
                            <div class="col-sm-3">
                                <p>Kích thước:</p>
                            </div>

                            <div class="col-sm-6 size" style="color: red;">
                                <div class="btn-group" role="group" aria-label="Third group">
                                    <button type="button" class="btn btn-danger">
                                        <?php echo $row['Kichthuoc']; ?>
                                    </button>
                                </div>
                            </div>
                        </div><br>
                        <div class="row" style="padding-top: 7px;margin-left: -12px;">
                            <div class="col-sm-3">
                                <p>Số lượng:</p>
                            </div>
                            <div class="col-sm-3" style="margin-top: -5px;">
                                <input type="number" class="form-control" id="inputnumber"
                                    value="<?php echo $productQuantity ?>"></p>
                                <input type="hidden" name="quantity" value="<?php echo $productQuantity ?>"
                                    class="form-control" />
                                <input type="hidden" name="hidden_image" value="<?php echo base64_encode($anhsp); ?>">
                                <input type="hidden" name="hidden_name" value="<?php echo $TenSanPham; ?>" />
                                <input type="hidden" name="hidden_price" value="<?php echo $GiaBan; ?>" />
                                <input type="hidden" name="hidden_id" value="<?php echo $productId; ?>" />
                            </div>
                        </div><br>
                        <p class="text-muted">
                            <?php echo $row['MoTaSanPham']; ?>
                        </p> <br>
                        <div class="row text-start submit1">
                            <div class="col-md-9" style="text-color:white;">
                                <a href=""><button type="submit" name="btn-submit" class="btn-danger btn-submit"
                                        style="text-color:white;"><i class="fas fa-shopping-cart"></i> Thêm vào giỏ</button></a>
                                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                                    aria-labelledby="offcanvasRightLabel">
                                    <div class="offcanvas-header ">
                                        <img src="images/logo.png" width="399" height="200" class="offcanvas-title text-center"
                                            id="offcanvasRightLabel">
                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <div class="row text-center">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                </div>

            <?php }
        } ?>

        <hr width="80%" style="margin-left:150px">
        <div class="row" style="margin-left:100px;margin-right: 100px;padding-top:30px;padding-bottom:30px ;">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                        <p style="font-size:20px">Mô tả</p>
                    </button>
                    <!-- <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                        <p style="font-size:20px">Chính sách</p>
                    </button> -->
                </div>
            </nav>

            <?php
            $productId = $_GET['productId']; // Lấy tableId từ tham số truy vấn trong URL
            include "../connect/config_oop.php";
            $sql = "SELECT * FROM sanpham where MaSanPham = '$productId'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $TenSanPham = $row["TenSanPham"];
                    $AnhSanPham = $row["AnhSanPham"];
                    $GiaBan = $row["GiaBan"];
                    $MoTaSanPham = $row["MoTaSanPham"];
                    $productQuantity = 1;
                    ?>
                    <div class="tab-content border-end border-start border-bottom" style="margin-left: 12px;border-right: 12px;"
                        id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                            tabindex="0">
                            <h1 style="padding-top:30px; text-align: center;color: rgba(255, 99, 71, 1);padding-bottom: 30px;">
                                <?php echo $row["TenSanPham"] ?>
                            </h1>
                            <div class="row">
                                <div class="col-sm-8">
                                    <h2> Đặc điểm nổi bật</h2>
                                    <p>
                                        <?php echo $row["MoTaSanPham"]; ?>
                                    </p>
                                    Thông tin sản phẩm:<br>
                                    - Tên sản phẩm:
                                    <?php echo $row["TenSanPham"] ?><br>
                                    - Trọng lượng sản phẩm:
                                    <?php echo $row["Trongluongsanpham"] ?><br>
                                    - Kích thước:
                                    <?php echo $row["Kichthuoc"] ?><br>
                                    - Diện tích màn hình:
                                    <?php echo $row["Dientichmanhinh"] ?><br>
                                    - Ram:
                                    <?php echo $row["Ram"] ?><br>
                                    - Dung lượng pin:
                                    <?php echo $row["Dungluongpin"] ?><br>
                                    - Thời gian bảo hành:
                                    <?php echo $row["Thoigianbaohang"] ?><br>
                                </div>
                                <div class="col-sm-4">
                                    <img width="95%" src="data:image/jpeg;base64,<?php echo base64_encode($AnhSanPham); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                            tabindex="0">
                            <p style="padding-top:30px"><span style="font-weight: bolder;font-size: 20px;">PETSHOP BAOO
                                    NGOC</span> không chấp nhận trường hợp trả hàng lấy lại tiền.<br>
                                - Quý khách có thể đổi qua sản phẩm có giá trị tương đương. <br>
                                - SHOP chỉ nhận đổi các mặt hàng như: QUẦN ÁO - NÓN - GIÀY - YẾM ĐỊU CÚN - GIỎ XÁCH - NHÀ NỆM.
                                <br>
                                - Còn lại các sản phẩm khác SHOP tuyệt đối không nhận đổi trả. <br>
                                - SHOP chỉ chấp nhận đổi trả trong trường hợp sản phẩm bị lỗi, không vừa với size đã mua trước
                                đó. <br>
                                - Không nhận đổi hàng vì lý do sở thích của khách Trong bất kỳ trường hợp nào.<br>
                                - SHOP chỉ chấp nhận trường hợp đổi hàng còn mới, chưa qua sử dụng trong vòng 2 ngày kể từ ngày
                                mua hàng Hàng đổi phải còn mới và giữ nguyên tình trạng ban đầu, còn nguyên bao bì, nguyên tem,
                                chưa qua sử dụng.<br>
                                - Các sản phẩm phải được làm sạch và lấy bớt lông ra, sản phẩm đổi không được có mùi lạ, mùi
                                hôi.<br>
                                - Hàng chỉ được đổi 1 lần Giá trị đổi hàng tính theo giá bán thực tế tại thời điểm mua hàng,
                                nhưng phải bằng hoặc cao hơn sản phẩm muốn đổi.<br>
                                - Đối với khách mua hàng Online: Khách hàng liên hệ với bộ phận bán hàng online để xác nhận đơn
                                hàng muốn đổi và được hướng dẫn đổi hàng (không quá 2 ngày kể từ ngày nhận được sản phẩm).<br>
                                - Inbox trực tiếp cho SHOP hoặc gọi số điện thoại (0913710333).<br>
                                - Hàng chỉ đổi lại khi lỗi do nhà sản xuất, sai cỡ như khách hàng yêu cầu.<br>
                                - Quý khách vui lòng chịu phí vận chuyển nếu quý khách yêu cầu chúng tôi đem hàng đến đổi tận
                                nhà <br>
                                - Đối với khách đến mua hàng trực tiếp: Quý khách vui lòng xuất trình hóa đơn mua hàng khi có
                                yêu cầu đổi hàng.<br>
                                - SHOP chỉ hỗ trợ đổi size, lỗi thuộc về nhà sản xuất. Hàng đã mua tại SHOP khách vui lòng kiểm
                                tra kĩ trước khi thanh toán.<br>
                                - Với mỗi đơn hàng chỉ được đổi tối đa 01 lần. Xin cảm ơn !
                            </p>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>
        <?php
        include "content.php";
        ?>
        <?php
        include "comment.php";
        ?>
    </content>

    <?php
    include "footer.php";
    ?>
</body>

</html>