<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đếm số lần xuất hiện</title>
</head>

<body>
    <h1>Đếm số lần xuất hiện của một giá trị trong mảng</h1>
    <form method="post">
        <label for="array">Nhập mảng (các số phân cách bằng dấu phẩy):</label><br>
        <input type="text" id="array" name="array" placeholder="Ví dụ: 1,2,3,4,2,2,5,6" required><br><br>
        <label for="value">Nhập giá trị cần đếm:</label><br>
        <input type="number" id="value" name="value" placeholder="Ví dụ: 2" required><br><br>
        <button type="submit">Đếm</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $arrayInput = $_POST['array'];
        $value = $_POST['value'];

        // Chuyển chuỗi thành mảng
        $numbers = array_map('trim', explode(',', $arrayInput)); // Loại bỏ khoảng trắng xung quanh
    
        // Hàm đếm số lần xuất hiện
        function countOccurrences($numbers, $value)
        {
            $count = 0;
            foreach ($numbers as $number) {
                if ($number == $value) {
                    $count++;
                }
            }
            return $count;
        }

        // Kết quả
        $result = countOccurrences($numbers, $value);
        echo "<h2>Kết quả</h2>";
        echo "Giá trị <b>$value</b> xuất hiện <b>$result</b> lần trong mảng.";
    }
    ?>
</body>

</html>