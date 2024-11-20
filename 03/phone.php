<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phân loại số điện thoại</title>
</head>

<body>
    <h1>Phân loại số điện thoại</h1>
    <form method="post">
        <textarea name="phone_numbers" rows="5" cols="50"
            placeholder="Nhập các số điện thoại, phân cách bằng dấu phẩy"></textarea><br>
        <button type="submit">Phân loại</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ textarea
        $input = $_POST['phone_numbers'];
        $phone_numbers = explode(',', $input);

        // Danh sách đầu số
        $viettel_prefixes = ['086', '096', '097', '098', '032', '033', '034', '035', '036', '037', '038', '039'];
        $mobifone_prefixes = ['089', '090', '093', '070', '079', '077', '076', '078'];
        $vinaphone_prefixes = ['088', '091', '094', '083', '084', '085', '081', '082'];

        // Mảng lưu kết quả
        $viettel = [];
        $mobifone = [];
        $vinaphone = [];

        // Phân loại số điện thoại
        foreach ($phone_numbers as $number) {
            $number = trim($number); // Loại bỏ khoảng trắng
            $prefix = substr($number, 0, 3); // Lấy 3 ký tự đầu
    
            if (in_array($prefix, $viettel_prefixes)) {
                $viettel[] = $number;
            } elseif (in_array($prefix, $mobifone_prefixes)) {
                $mobifone[] = $number;
            } elseif (in_array($prefix, $vinaphone_prefixes)) {
                $vinaphone[] = $number;
            }
        }

        // Hiển thị kết quả
        echo "<h2>Kết quả phân loại</h2>";
        echo "<h3>Viettel</h3>";
        echo !empty($viettel) ? implode(', ', $viettel) : "Không có số nào";

        echo "<h3>Mobifone</h3>";
        echo !empty($mobifone) ? implode(', ', $mobifone) : "Không có số nào";

        echo "<h3>Vinaphone</h3>";
        echo !empty($vinaphone) ? implode(', ', $vinaphone) : "Không có số nào";
    }
    ?>
</body>

</html>