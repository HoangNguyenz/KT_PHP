<?php
include 'config.php';

// Function to get employee details by ID
function getEmployeeDetails($conn, $id)
{
    $sql = "SELECT * FROM nhanvien WHERE Ma_NV = '$id'";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $ten_nv = $_POST["ten_nv"];
    $phai = $_POST["phai"];
    $noi_sinh = $_POST["noi_sinh"];
    $ma_phong = $_POST["ma_phong"];
    $luong = $_POST["luong"];

    $sql = "UPDATE nhanvien SET Ten_NV = '$ten_nv', Phai = '$phai', Noi_Sinh = '$noi_sinh', Ma_Phong = '$ma_phong', Luong = '$luong' WHERE Ma_NV = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Cập nhật thông tin nhân viên thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Check if ID parameter is passed in URL
if (isset($_GET["ma_nv"])) {
    $id = $_GET["ma_nv"];
    $employee = getEmployeeDetails($conn, $id);
} else {
    echo "Invalid Employee ID";
    exit;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin nhân viên</title>
</head>

<body>
    <h2>Chỉnh sửa thông tin nhân viên</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="ten_nv">Tên nhân viên:</label><br>
        <input type="text" id="ten_nv" name="ten_nv" value="<?php echo $employee['Ten_NV']; ?>"><br>
        <label for="phai">Phái:</label><br>
        <select id="phai" name="phai">
            <option value="NAM" <?php if ($employee['Phai'] == 'NAM') echo 'selected'; ?>>Nam</option>
            <option value="NU" <?php if ($employee['Phai'] == 'NU') echo 'selected'; ?>>Nữ</option>
        </select><br>
        <label for="noi_sinh">Nơi sinh:</label><br>
        <input type="text" id="noi_sinh" name="noi_sinh" value="<?php echo $employee['Noi_Sinh']; ?>"><br>
        <label for="ma_phong">Mã phòng:</label><br>
        <input type="text" id="ma_phong" name="ma_phong" value="<?php echo $employee['Ma_Phong']; ?>"><br>
        <label for="luong">Lương:</label><br>
        <input type="text" id="luong" name="luong" value="<?php echo $employee['Luong']; ?>"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>