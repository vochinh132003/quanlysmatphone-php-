<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điện thoại | Smartphone chính hãng, giá rẻ, trợ giá lên đời</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <div style="padding: 60px 140px;" class="container-fluid ">
        <div class="container">
            <?php
            $productId = $_GET['productId']; // Lấy tableId từ tham số truy vấn trong URL
            include "../connect/config_oop.php";
            $sql = "SELECT * FROM sanpham where MaSanPham = '$productId '";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $TenSanPham = $row["TenSanPham"];
                    $AnhSanPham = $row["AnhSanPham"];
                    $GiaBan = $row["GiaBan"];
                    $MoTaSanPham = $row["MoTaSanPham"];
                    ?>
                    <div class="comment" style="margin-top: 50px; background: #dfd9d9; width: 100%; height: 100%">
                        <div class="section" style="padding: 20px 40px;">
                            <h1 class="fs">
                                Hỏi & Đáp
                            </h1>
                            <div class="soid" style="margin-bottom: 30px; border-bottom: 1px solid #000;"></div>
                            <?php
                            if (isset($_SERVER['REQUEST_URI'])) {
                                $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                ?>
                                <?php
                                if (isset($_SESSION['username'], $_SESSION['user_id'])) {
                                    $id = $_SESSION['user_id'];
                                    ?>
                                    <form id="comment-form" action="http://localhost/DOANPHPMYSQL_2023/admin/core/xulyadd_binhluan.php"
                                        method="POST">
                                        <input type="hidden" name="maSanPham" value="<?php echo $productId; ?>">
                                        <input type="hidden" name="tenkhachhang" value="<?php echo $id; ?>">
                                        <div class="flex-input" style="display: flex;">
                                            <textarea style="width: 100%; height: 80px; border-radius: 10px;" name="noiDung"
                                                placeholder="Nhập nội dung bình luận..."></textarea>
                                            <input type="hidden" name="link" id="link" class="link" value="<?php echo $currentURL; ?>">
                                            <input
                                                style="padding: 10px 32px; margin-left: 20px; border-radius: 10px; background: red; color: white;"
                                                type="submit" value="Gửi bình luận">
                                        </div>
                                    </form>
                                    <?php
                                }
                                ?>
                                <?php
                            }
                            ?>
                            <?php
                            $productId = $row["MaSanPham"];
                            $sqlComments = "SELECT binhluan.MaBinhLuan,binhluan.link, khachhang.anh, khachhang.TenKhachHang, binhluan.NoiDung, binhluan.NgayBinhLuan
                            FROM binhluan
                            LEFT JOIN khachhang ON binhluan.MaKhachHang = khachhang.MaKhachHang
                            WHERE binhluan.MaSanPham = '$productId'
                            ORDER BY binhluan.NgayBinhLuan DESC";
                            $resultComments = mysqli_query($conn, $sqlComments);
                            if (mysqli_num_rows($resultComments) > 0) {
                                while ($rowComment = mysqli_fetch_assoc($resultComments)) {
                                    ?>
                                    <div class="showcoment" style="margin-top: 20px; display:flex">
                                        <img style="width: 70px; height: 70px; border-radius: 50px;"
                                            src="data:image/jpeg;base64,<?php echo base64_encode($rowComment['anh']); ?>" alt="">
                                        <div class="comen-kh" style="margin-left: 20px;">
                                            <p>
                                                <?php echo $rowComment['TenKhachHang'] ?>
                                            </p>
                                            <p>
                                                <?php echo $rowComment['NoiDung'] ?>
                                            </p>
                                            <p>
                                                <?php echo $rowComment['NgayBinhLuan'] ?> *
                                                <a style="color: blue; cursor: pointer;" data-toggle="modal"
                                                    data-target="#replyModal<?php echo $rowComment['MaBinhLuan']; ?>">Trả lời</a>
                                            </p>
                                            <?php
                                            $traloicoment = $rowComment['MaBinhLuan'];
                                            $traloi = "select nhanvien.VaiTro,nhanvien.anh, nhanvien.TenNhanVien,traloi.NoiDung,traloi.NgayTraLoi from traloi left join nhanvien on traloi.MaNhanVien = nhanvien.MaNhanVien where MaBinhLuan = '$traloicoment'";
                                            $resutraloi = mysqli_query($conn, $traloi);
                                            if (mysqli_num_rows($resutraloi) > 0) {
                                                while ($rowtraloi = mysqli_fetch_assoc($resutraloi)) {
                                                    ?>
                                                    <div class="reply" style="margin-top: 20px; display:flex;">
                                                        <img style="width: 70px; height: 70px; border-radius: 50px;"
                                                            src="data:image/jpeg;base64,<?php echo base64_encode($rowtraloi['anh']); ?>" alt="">
                                                        <div class="comen-kh"
                                                            style="margin-left: 20px; background:white; width: 100%; padding:20px 32px">
                                                            <div class="left" style="display:flex;">
                                                                <p>
                                                                    <?php echo $rowtraloi['TenNhanVien'] ?>
                                                                </p>
                                                                <p
                                                                    style="background: grey; margin-left:10px; border-radius: 10px; padding: 0px 10px; color:white">
                                                                    <?php echo $rowtraloi['VaiTro'] ?>
                                                                </p>
                                                            </div>
                                                            <p>
                                                                <?php echo $rowtraloi['NoiDung'] ?>
                                                            </p>
                                                            <p>
                                                                <?php echo $rowtraloi['NgayTraLoi'] ?> *
                                                                <a style="color: blue; cursor: pointer;" data-toggle="modal"
                                                                    data-target="#replyModal<?php echo $rowComment['MaBinhLuan']; ?>">Trả
                                                                    lời</a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="replyModal<?php echo $rowComment['MaBinhLuan']; ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="replyModalLabel">Trả lời bình luận của
                                                        <?php echo $rowComment['TenKhachHang']; ?>
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="comment-form" action="binhluan.php" method="POST">
                                                        <input type="hidden" name="maSanPham" value="<?php echo $productId; ?>">
                                                        <input type="hidden" name="tenkhachhang" value="<?php echo $id; ?>">
                                                        <div class="flex-input" style="display: flex;">
                                                            <textarea style="width: 100%; height: 80px; border-radius: 10px;"
                                                                name="noiDung" placeholder="Nhập nội dung bình luận..."></textarea>
                                                            <input type="hidden" name="link" id="link" class="link"
                                                                value="<?php echo $currentURL; ?>">
                                                            <input
                                                                style="padding: 10px 32px; margin-left: 20px; border-radius: 10px; background: red; color: white;"
                                                                type="submit" value="Gửi bình luận">
                                                        </div>
                                                    </form>
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

                    <?php
                }
            }
            ?>
            <link rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
            <script>
                $(document).ready(function () {
                    // Xử lý sự kiện khi nhấp vào liên kết "Trả lời"
                    $('.reply-link').click(function () {
                        // Lấy tên người bình luận từ phần tử cha của liên kết
                        var commenterName = $(this).closest('.comen-kh').find('p:first-child').text();
                        // Lấy mã bình luận từ thuộc tính data
                        var commentId = $(this).closest('.showcoment').find('input[name="maSanPham"]').val();

                        // Đặt tên người bình luận và mã bình luận vào modal
                        $('#commenterName').text(commenterName);
                        $('#commentId').val(commentId);

                        // Hiển thị modal
                        $('#myModal').modal('show');
                    });
                });
            </script>
            <style>
                .f {
                    margin-bottom: 30px;
                    border-bottom: 3px solid #000;

                }

                .fs {
                    font-size: 26px;
                }

                .product-img {
                    width: 100%;
                    height: 100%;
                    border-radius: 5px;
                    overflow: hidden;
                    border: 2px solid #ccc;
                    background-color: #f5f5f5;
                }

                .product-img img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
            </style>
        </div>
    </div>
    <script>
        // Lấy phần tử modal
        var modal = document.getElementById("myModal");

        // Lấy phần tử a kích hoạt modal
        var link = document.getElementById("modalLink");

        // Khi người dùng nhấp vào link, hiển thị modal
        link.onclick = function () {
            modal.style.display = "block";
        }

        // Khi người dùng nhấp vào bất kỳ đâu bên ngoài modal, đóng modal
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>


</body>

</html>