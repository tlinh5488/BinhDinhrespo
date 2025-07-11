
<?php
echo '<link rel="shortcut icon" href="../../../images/logo.webp" type="image/x-icon">';
?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/BinhDinhNews/app/views/partials/header.php'); ?>

<?php
$conn = new mysqli("localhost", "root", "", "BinhDinhNews");
if ($conn->connect_error) {
    die("Không kết nối được: " . $conn->connect_error);
}

function hienThiCoQuan($conn, $coquan) {
    // Chủ tịch
    $sql_chutich = "SELECT * FROM coquanchuyenmon WHERE tencoquan = '$coquan' AND capbac = 1";
    $result_ct = $conn->query($sql_chutich);

    // Phó Chủ tịch
    $sql_pho = "SELECT * FROM coquanchuyenmon WHERE tencoquan = '$coquan' AND capbac = 2";
    $result_pho = $conn->query($sql_pho);

    // Cấp 3
    $sql_cap3 = "SELECT * FROM coquanchuyenmon WHERE tencoquan = '$coquan' AND capbac = 3";
    $result_cap3 = $conn->query($sql_cap3);

    echo "<h3> {$coquan} </h3>";

if ($result_ct->num_rows > 0) {
    echo '<div class="chutich-container">';
    while ($row = $result_ct->fetch_assoc()) {
        echo '<div class="item">
                <img src="../../../images/imgChinhquyen/coquanchuyenmon/'.$row['hinhanh'].'" alt="'.$row['hoten'].'">
                <label><b>'.$row['chucvu'].'</b><br>'.$row['hoten'].'</label>
              </div>';
    }
    echo '</div>';
}

if ($result_pho->num_rows > 0) {
    echo '<div class="pho-container">';
    while ($row = $result_pho->fetch_assoc()) {
        echo '<div class="item">
                <img src="../../../images/imgChinhquyen/coquanchuyenmon/'.$row['hinhanh'].'" alt="'.$row['hoten'].'">
                <label><b>'.$row['chucvu'].'</b><br>'.$row['hoten'].'</label>
              </div>';
    }
    echo '</div>';
}

if ($result_cap3->num_rows > 0) {
    echo '<div class="cap3-container">';
    while ($row = $result_cap3->fetch_assoc()) {
        echo '<div class="item">
                <img src="../../../images/imgChinhquyen/coquanchuyenmon/'.$row['hinhanh'].'" alt="'.$row['hoten'].'">
                <label><b>'.$row['chucvu'].'</b><br>'.$row['hoten'].'</label>
              </div>';
    }
    echo '</div>';
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../public/css/reset.css">
	<link rel="stylesheet" href="../../../../public/css/footer-style.css">
	<link rel="stylesheet" href="../../../../public/css/header-style.css">

    <link rel="stylesheet" href="../../../../../BinhDinhNews/public/css/reponsitive/main.css">
    <link rel="stylesheet" href="../../../../../BinhDinhNews/public/css/reponsitive/header.css">
        <link rel="stylesheet" href="../../../../../BinhDinhNews/public/css/reponsitive/chinhquyen.css">
    <link rel="stylesheet" href="../../../../../BinhDinhNews/public/css/rightmenu-style.css">
    
    <title>Cơ quan chuyên môn</title>
    <style>
    .container {
        display: grid;
        grid-template-columns: 5% 65% 30%;
        padding: 0 20px; 
        box-sizing: border-box;
    }

    .container-mid h3 {
        text-align: left;
        margin: 20px 0;
        font-size: 22px;
    }

    .chutich-container,
    .pho-container,
    .cap3-container {
        display: flex; /* sắp xếp các phần tử con theo hàng ngang */
        justify-content: center; /* Căn các phần tử con ra giữa theo chiều ngang */
        flex-wrap: wrap;
        gap: 30px;
        margin-bottom: 40px;
    }

    .item {
        width: 220px;
        text-align: center;
    }

    .item img {
        width: 100%;
        height: auto;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .item label {
        display: block; /* Biến phần tử thành phần tư khối */
        margin-top: 10px;
        font-size: 18px;
    }
    </style>
</head>

<body>
    <script>
        document.querySelector("nav #f3").classList.add('active');
    </script>
    <div class="container">
        <div class="container-left"></div>
        <div class="container-mid">
            <?php
                hienThiCoQuan($conn, "VĂN PHÒNG UBND");
                hienThiCoQuan($conn, "SỞ NỘI VỤ");
                hienThiCoQuan($conn, "SỞ TÀI CHÍNH");
                hienThiCoQuan($conn, "SỞ XÂY DỰNG");
                hienThiCoQuan($conn, "SỞ CÔNG THƯƠNG");
                hienThiCoQuan($conn, "SỞ NÔNG NGHIỆP VÀ MÔI TRƯỜNG");
                hienThiCoQuan($conn, "SỞ KHOA HỌC VÀ CÔNG NGHỆ");
                hienThiCoQuan($conn, "SỞ GIÁO DỤC VÀ ĐÀO TẠO");
                hienThiCoQuan($conn, "SỞ VĂN HÓA-THỂ THAO VÀ DU LỊCH");
                hienThiCoQuan($conn, "SỞ Y TẾ");
                hienThiCoQuan($conn, "SỞ TƯ PHÁP");
                hienThiCoQuan($conn, "SỞ NGOẠI VỤ");
                hienThiCoQuan($conn, "BAN QUẢN LÝ KKT");
                hienThiCoQuan($conn, "THANH TRA TỈNH");
                hienThiCoQuan($conn, "SỞ DÂN TỘC VÀ TÔN GIÁO");

            ?>
        </div>
        <div class="container-right">
            <?php include($_SERVER['DOCUMENT_ROOT'].'/BinhDinhNews/app/views/right/homepage.php'); ?>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/BinhDinhNews/app/views/partials/footer.php'); ?>