<?php
// Kết nối tới MySQL
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "shopaoquan";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Truy vấn danh sách nhà sản xuất để đổ vào <select>
$sqlNSX = "SELECT MaNCC, TenNCC FROM nhacungcap";
$resultNSX = mysqli_query($conn, $sqlNSX);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm</title>
</head>
<body>
    <h2>QUẢN LÝ SẢN PHẨM - Thêm sản phẩm</h2>
    <form name="frmthemsp" action="xulythem.php" method="post" enctype="multipart/form-data">
        <!-- Drop-down list Công ty sản xuất -->
        <label for="cbocongtysx">Công ty sản xuất:</label>
        <select name="cbocongtysx" id="cbocongtysx">
            <option value="">-- Chọn công ty --</option>
            <?php
            if ($resultNSX && mysqli_num_rows($resultNSX) > 0) {
                while ($row = mysqli_fetch_assoc($resultNSX)) {
                    // giá trị value là maNhaSanXuat, hiển thị tenNSX
                    echo '<option value="' . $row['MaNCC'] . '">' 
                         . htmlspecialchars($row['TenNCC'], ENT_QUOTES, 'UTF-8') 
                         . '</option>';
                }
            }
            ?>
        </select>
        <br><br>

        <!-- Nhập tên sản phẩm -->
        <label for="txttensp">Nhập tên sản phẩm:</label>
        <input type="text" name="txttensp" id="txttensp">
        <br><br>

        <!-- Nhập giá chính thức -->
        <label for="txtgia">Nhập giá chính thức:</label>
        <input type="text" name="txtgia" id="txtgia">
        <br><br>

        <!-- Nhập giá đã được giảm -->
        <label for="txtgiagiam">Nhập giá đã được giảm:</label>
        <input type="text" name="txtgiagiam" id="txtgiagiam">
        <br><br>

        <!-- Nhập mô tả -->
        <label for="txtareamota">Nhập mô tả:</label>
        <br>
        <textarea name="txtareamota" id="txtareamota" rows="5" cols="40"></textarea>
        <br><br>

        <!-- File upload hình đại diện -->
        <label for="f_daidiem">Hình đại diện:</label>
        <input type="file" name="f_daidiem" id="f_daidiem" accept="image/*">
        <br><br>

        <!-- Button Thêm sản phẩm -->
        <input type="submit" name="btnthemsanpham" value="Thêm sản phẩm">
    </form>
</body>
</html>

<?php
// Đóng kết nối
mysqli_close($conn);
?>
