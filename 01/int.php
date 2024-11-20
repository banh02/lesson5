<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chuyển đổi Thập phân sang Nhị phân</title>
</head>

<body>
    <h2>Chuyển đổi từ hệ Thập phân sang hệ Nhị phân</h2>

    <!-- Form nhập số thập phân -->
    <form method="POST">
        <label for="decimal">Nhập số thập phân: </label>
        <input type="number" id="decimal" name="decimal" required>
        <input type="submit" value="Chuyển đổi">
    </form>

    <?php
    // Kiểm tra nếu có số nhập vào
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $decimal = intval($_POST['decimal']); // Lấy giá trị số thập phân
    
        // Hàm chuyển đổi từ hệ thập phân sang hệ nhị phân
        function decimalToBinary($decimal)
        {
            $stack = [];

            // Chia số thập phân cho 2 và lưu phần dư vào stack
            while ($decimal > 0) {
                array_push($stack, $decimal % 2); // Lưu phần dư vào stack
                $decimal = intdiv($decimal, 2);   // Chia lấy phần nguyên
            }

            // Đọc kết quả từ stack
            $binary = '';
            while (!empty($stack)) {
                $binary .= array_pop($stack);  // Lấy phần tử từ stack
            }

            return $binary;
        }

        // Chuyển đổi và in kết quả
        $binary = decimalToBinary($decimal);
        echo "<h3>Chuỗi nhị phân của $decimal là: $binary</h3>";
    }
    ?>

</body>

</html>