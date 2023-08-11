<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Line Chart Example</title>
    <!-- Liên kết tệp CSS -->
</head>

<body>
    <div class="container">
        <div id="charkt_div"></div>
    </div>
    <!-- Liên kết tệp JavaScript của Google Charts API -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        // Tải các gói biểu đồ và thiết lập hàm vẽ biểu đồ
        google.charts.load('current', { 'packages': ['corechart'] });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Lấy dữ liệu từ cơ sở dữ liệu
            <?php
            include "../../connect/config_oop.php";
            // Mặc định năm là năm hiện tại
            $currentYear = date('Y');

            // Xử lý tìm kiếm theo năm nếu có dữ liệu POST từ form
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['year'])) {
                    $searchYear = $_POST['year'];
                    // Kiểm tra xem giá trị năm tìm kiếm có hợp lệ hay không
                    if ($searchYear >= 1900 && $searchYear <= 9999) {
                        $currentYear = $searchYear;
                    }
                }
            }

            // Truy vấn dữ liệu từ cơ sở dữ liệu
            $sql = "SELECT MONTH(NgayBan) AS thang, SUM(TongGiaTri) AS doanh_thu FROM HoaDon WHERE YEAR(NgayBan) = $currentYear GROUP BY MONTH(NgayBan)";
            $result = $conn->query($sql);

            // Tạo mảng dữ liệu cho biểu đồ
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $thang = $row['thang'];
                $doanhThu = (float) $row['doanh_thu'];
                $data[] = [$thang, $doanhThu];
            }

            // Đóng kết nối
            $conn->close();

            // Chuyển đổi mảng dữ liệu thành định dạng JSON
            $jsonData = json_encode($data);
            ?>

            // Tạo đối tượng DataTable từ dữ liệu JSON
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Tháng');
            data.addColumn('number', 'Doanh thu');
            data.addRows(<?php echo $jsonData; ?>);

            // Thiết lập các tùy chọn cho biểu đồ
            var options = {
                title: 'Doanh thu theotháng năm <?php echo $currentYear; ?>',
                titleTextStyle: {
                    color: '#FF0000'
                },
                width: 1100,
                height: 400,
                legend: { position: 'none' },
                hAxis: {
                    title: 'Tháng'
                },
                vAxis: {
                    title: 'Doanh thu',
                    format: '#,##0 VND'
                },
                colors: ['red'],
                backgroundColor: '#F5F5F5' // Đổi màu nền thành màu xám đậm
            };

            // Vẽ biểu đồ đường
            var chart = new google.visualization.LineChart(document.getElementById('charkt_div'));
            chart.draw(data, options);
        }
    </script>
</body>

</html>