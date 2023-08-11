<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <style>
    /* Custom CSS for the layout */
    body {
      background-color: #f9f9f9;
    }

    .container {
      margin-top: 50px;
    }

    .card {
      border: 1px solid #ccc;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease-in-out;
    }

    .card:hover {
      transform: scale(1.05);
    }

    .card-img-top {
      max-width: 100%;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
    }

    .card-body {
      padding: 10px;
    }

    .card-title {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .card-text {
      color: #666;
    }

    hr {
      margin-top: 15px;
      margin-bottom: 15px;
    }
  </style>
</head>

<body>
  <div class="container">
    <?php
    include "../connect/config_oop.php";
    $sqls = "select * from nhasanxuat";
    $results = mysqli_query($conn, $sqls);
    if (mysqli_num_rows($results) > 0) {
      while ($row = mysqli_fetch_assoc($results)) {
        $TenNhaSanXuat = $row["TenNhaSanXuat"];
        ?>
        <div class="row">
          <div class="col text-center">
            <h2 style="color: red;">
              <?php echo $TenNhaSanXuat ?>
            </h2>
            <hr>
          </div>
        </div>

        <div class="row">
          <?php
          $nsx = "select MaNhaSanXuat from nhasanxuat where TenNhaSanXuat = '$TenNhaSanXuat' ";
          $resultss = mysqli_query($conn, $nsx);
          if (mysqli_num_rows($resultss) > 0) {
            while ($rows = mysqli_fetch_assoc($resultss)) {
              $MaNhaSanXuat = $rows['MaNhaSanXuat'];
              ?>
              <?php
              $sanpham = "select * from SanPham where MaNhaSanXuat = '$MaNhaSanXuat'";
              $resanpham = mysqli_query($conn, $sanpham);
              if (mysqli_num_rows($resanpham) > 0) {
                while ($rowss = mysqli_fetch_assoc($resanpham)) {
                  $AnhSanPham = $rowss['AnhSanPham'];
                  ?>
                  <div class="col-md-3 mb-4">
                    <div class="card">
                      <img class="card-img-top" style="width: 100%;" src="data:image/jpeg;base64,<?php echo base64_encode($AnhSanPham); ?>"
                        alt="<?php echo $rowss['TenSanPham'] ?>">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $rowss['TenSanPham'] ?></h5>
                        <p class="card-text"><?php echo $rowss['GiaBan'] ?></p>
                      </div>
                    </div>
                  </div>
                  <?php
                }
              }
              ?>
            <?php }
          }
          ?>
        </div>
      <?php }
    } ?>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</html>
