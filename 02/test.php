<?php
// Hàm kiểm tra tính hợp lệ của dấu ngoặc
function isValidExpression($expression)
{
    // Thay thế dấu en dash bằng dấu trừ thông thường
    $expression = str_replace('–', '-', $expression);

    $stack = [];
    $pairs = [
        '(' => ')',
        '{' => '}',
        '[' => ']'
    ];

    // Duyệt qua từng ký tự trong biểu thức
    foreach (str_split($expression) as $char) {
        if (isset($pairs[$char])) {
            // Nếu là dấu ngoặc trái, đẩy vào stack
            array_push($stack, $char);
        } elseif (in_array($char, $pairs)) {
            // Nếu là dấu ngoặc phải
            if (empty($stack)) {
                return false;  // Nếu stack rỗng, không có dấu ngoặc trái tương ứng
            }
            $left = array_pop($stack);  // Lấy dấu ngoặc trái từ stack
            if ($pairs[$left] !== $char) {
                return false;  // Nếu dấu ngoặc trái và phải không khớp
            }
        }
    }

    // Kiểm tra nếu có ngoặc trống
    if (strpos($expression, '()') !== false || strpos($expression, '[]') !== false || strpos($expression, '{}') !== false) {
        return false;  // Nếu có ngoặc trống, trả về false
    }

    // Nếu stack còn dấu ngoặc trái, tức là thiếu ngoặc phải
    return empty($stack);
}

$isValid = null;
$expression = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy biểu thức từ form
    $expression = $_POST['expression'];
    // Kiểm tra tính hợp lệ
    $isValid = isValidExpression($expression);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiểm tra dấu ngoặc trong biểu thức</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        input[type="text"] {
            width: 300px;
            padding: 10px;
            margin-right: 10px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .result {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h2>Kiểm tra dấu ngoặc trong biểu thức</h2>
    <form method="POST" action="">
        <label for="expression">Nhập biểu thức:</label>
        <input type="text" name="expression" id="expression" value="<?= htmlspecialchars($expression) ?>"
            placeholder="Ví dụ: (s * (s - a))">
        <button type="submit">Kiểm tra</button>
    </form>

    <div id="result" class="result">
        <?php
        if ($isValid !== null) {
            if ($isValid) {
                echo "<span style='color: green;'>Biểu thức hợp lệ!</span>";
            } else {
                echo "<span style='color: red;'>Biểu thức không hợp lệ!</span>";
            }
        }
        ?>
    </div>

</body>

</html>