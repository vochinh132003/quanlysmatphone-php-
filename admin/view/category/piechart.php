<?php
// Thay đổi thông tin kết nối theo CSDL của bạn
include "../../connect/config_oop.php";

// Mặc định tháng và năm là tháng và năm hiện tại
$currentMonth = date('n');
$currentYear = date('Y');

// Xử lý tìm kiếm theo tháng và năm nếu có dữ liệu POST từ form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $searchMonth = $_POST['month'];
    // Kiểm tra xem khóa mảng "year" có tồn tại hay không
    $searchYear = isset($_POST['year']) ? $_POST['year'] : $currentYear;
    // Kiểm tra xem giá trị tháng và năm tìm kiếm có hợp lệ hay không
    if (checkdate($searchMonth, 1, $searchYear)) {
        $currentMonth = $searchMonth;
        $currentYear = $searchYear;
    }
}

// Truy vấn dữ liệu theo tháng và năm
$sql = "SELECT sp.TenSanPham, SUM(cthd.SoLuongBan * hd.TongGiaTri) AS doanh_thu
        FROM ChiTietHoaDon cthd
        INNER JOIN HoaDon hd ON cthd.MaHoaDon = hd.MaHoaDon
        INNER JOIN SanPham sp ON cthd.MaSanPham = sp.MaSanPham
        WHERE MONTH(hd.NgayBan) = $currentMonth AND YEAR(hd.NgayBan) = $currentYear
        GROUP BY sp.TenSanPham";

$result = $conn->query($sql);

// Xây dựng mảng dữ liệu cho biểu đồ
$data = array();
while ($row = $result->fetch_assoc()) {
    $tenSanPham = $row['TenSanPham'];
    $doanhThu = (float) $row['doanh_thu'];

    $data[] = array($tenSanPham, $doanhThu);
}

// Sắp xếp mảng dữ liệu theo doanh thu giảm dần
usort($data, function ($a, $b) {
    return $b[1] - $a[1];
});
$jsonData = json_encode($data);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biểu đồ doanh thu sản phẩm</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', { 'packages': ['corechart'] });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var jsonData = <?php echo $jsonData; ?>;

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Sản phẩm');
            data.addColumn('number', 'Doanh thu');
            data.addRows(jsonData);

            var options = {
                title: 'Biểu đồ doanh thu sản phẩm tháng <?php echo $currentMonth; ?> năm <?php echo $currentYear; ?>',
                width: 600,
                height: 400,
                colors: ['blue', 'green', 'red', 'orange','black','pink','yellow','grey'], // Thay đổi màu sắc theo ý muốn
                backgroundColor: '#F5F5F5' // Đổi màu nền thành màu xám đậm
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }

    </script>
    <style>
        /* CSS cho form tìm kiếm */
        form {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        label {
            font-weight: bold;
        }

        select {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div>
        <form method="POST" action="">
            <br><br><br>
            <label for="month">Chọn tháng:</label>
            <select name="month" id="month">
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    $selected = ($i == $currentMonth) ? 'selected' : '';
                    echo "<option value='$i' $selected>Tháng $i</option>";
                }
                ?>
            </select>
            <label for="year">Chọn năm:</label>
            <select name="year" id="year">
                <?php
                $startYear = date('Y') - 10; // Giới hạn năm từ 10 năm trước đến năm hiện tại
                $endYear = date('Y');
                for ($i = $startYear; $i <= $endYear; $i++) {
                    $selected = ($i == $currentYear) ? 'selected' : '';
                    echo "<option value='$i' $selected>Năm $i</option>";
                }
                ?>
            </select>
            <button type="submit">Tìm kiếm</button>
        </form>
    </div>
    <div id="chart_div"></div>
</body>

</html>