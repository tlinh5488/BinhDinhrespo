<head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../../BinhDinhNews/public/css/reset.css">
    <link rel="stylesheet" href="../../../../../BinhDinhNews/public/css/footer-style.css">
    <link rel="stylesheet" href="../../../../../BinhDinhNews/public/css/header-style.css">
    <link rel="stylesheet" href="../../../../../BinhDinhNews/public/css/chinhquyen.css">
    <link rel="stylesheet" href="../../../../../BinhDinhNews/public/css/reponsitive/chinhquyen.css">
    <link rel="stylesheet" href="../../../../../BinhDinhNews/public/css/reponsitive/main.css">
    <link rel="stylesheet" href="../../../../../BinhDinhNews/public/css/reponsitive/header.css">
    <link rel="shortcut icon" href="../../../../../BinhDinhNews/public/images/logo.webp" type="image/x-icon">
    <title>Chính quyền</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<?php include($_SERVER['DOCUMENT_ROOT'].'/BinhDinhNews/app/views/partials/header.php'); ?>

<body>
    <script>
        document.querySelector("nav #f3").classList.add('active');
    </script>
    <div class="main-container">
        <div class="pathway-category">
            <nav class="breadcrumb" aria-label="breadcrumb">
                <span class="breadcrumb-item">
                    <a href="../../../index.php" >
                        <i class="fas fa-home"></i> Trang chủ
                    </a>
                </span>
                <span class="breadcrumb-separator">/</span>
                <span class="breadcrumb-item">
                    <a href="./chinhquyenindex.php" > Chính quyền</a>
                </span>
            </nav>
        </div>
        <div class="category-grid">
            <?php
            $items = [
                ["link" => "./tinhuy.php", "img" => "tinhuy.jpg", "label" => "Tỉnh ủy"],
                ["link" => "./hdnd.php", "img" => "hdnd.jpg", "label" => "HĐND tỉnh"],
                ["link" => "./ubnd.php", "img" => "ubnd.jpg", "label" => "UBND tỉnh"],
                ["link" => "./ubmttqvn.php", "img" => "ubmt.jpg", "label" => "UBMTTQVN tỉnh"],
                ["link" => "./coquanchuyenmon.php", "img" => "cqcm.jpg", "label" => "Cơ quan chuyên môn"],
                ["link" => "./ubndhuyen.php", "img" => "huyen.jpg", "label" => "UBND các huyện, thị xã, thành phố"],
                ["link" => "./sunghiep.php", "img" => "dvsn.jpg", "label" => "Đơn vị Sự nghiệp"],
                ["link" => "./hiepquan.php", "img" => "dvhq.jpg", "label" => "Đơn vị Hiệp quản"],
            ];         
            foreach ($items as $item) {
                echo '<a class="item-category" href="' . $item["link"] . '">
                        <img class="post-image" src="../../../images/imgChinhquyen/logo/' . $item["img"] . '" alt="' . $item["label"] . '">
                        <div class="article-info">' . $item["label"] . '</div>
                    </a>';
            }
            ?>

        </div>
    </div>
</body>

<?php include($_SERVER['DOCUMENT_ROOT'].'/BinhDinhNews/app/views/partials/footer.php'); ?>
