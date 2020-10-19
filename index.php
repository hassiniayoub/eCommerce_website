<?php

    require_once("./assets/pg/admins/inc/conn.inc.php");

    $sql10 = "SELECT * FROM web_settings";
    $result10 = $conn->query($sql10);

    $row10 = $result10->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row10["web_name"]; ?> | بيع جميع أنواع السلع</title>
    <link rel="stylesheet" href="main_style">
</head>
<body>

    <!-- Google Analytics -->
        <?php echo $row10["fb_pixel"]; ?>
    <!-- End Google Analytics -->

    <!-- Facebook Pixel -->
        <?php echo $row10["gl_analytics"]; ?>
    <!-- End Facebook Pixel -->


    <div class="whts-num-box">
        <button class="whts-btn"></button>
        <span class="whts-text"><?php echo $row10["whatsapp_num"]; ?></span>
    </div>

    <div class="header-bar">
        <?php echo $row10["header_text"]; ?>
    </div>

    <header>
        <div class="center-bar">
            <div class="logo-wbs" onclick="window.open('main_page', '_self');"></div>

            <div class="menu-bar">

            <?php

            $sql2 = "SELECT * FROM category ORDER BY listorder ASC";
            $result2 = $conn->query($sql2);

            while ($row2 = $result2->fetch_assoc()) {
                ?>

                <div onclick="window.open('sp_cat?cat_id=<?php echo $row2["id"]; ?>', '_self');">

                <?php echo $row2["cat_name"]; ?>

                </div>
                <?php
            }

            ?>
            </div>

            <button onclick="window.open('coupons', '_self');">التخفيضات</button>
        </div>
    </header>

    <div class="title-content">جديد المنتجات</div>
    <div class="title2-content">أحدث المنتوجات المضافة إلى الموقع</div>


    <div class="content">

        <?php
        
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {

            $dir_path = "assets/pg/admins/products_img/" . $row["id"];
            $extensions_array = array('jpg','png','jpeg');

                    
            ?>

            <div class="product-pack" onclick='redrq<?php echo $row["id"]; ?>();'>
                <?php
                
                if(is_dir($dir_path))
                {
                    $files = scandir($dir_path);

                    $count_files = count($files);

                    echo '<div style="background-image: url(' . $dir_path . '/' . $files[2] . ')" class="product-img"></div>';

                }
                
                
                ?>
                
                <div class="product-title">
                    <?php echo $row["title"]; ?>
                </div>
                <div class="product-prices">
                    <span class="old-price"><s><?php echo $row["old_price"]; ?>DH</s></span>
                    <span class="original-price"><?php echo $row["price"]; ?>DH</span>
                </div>
            </div>

            <script type="text/javascript">
                function redrq<?php echo $row["id"]; ?>() {
                    window.open('<?php echo "show_products?id=" . $row["id"]; ?>', '_self');
                }
            </script>

            <?php
        }
        
        
        
        ?>
        
        
    </div>
    
    <footer>
        <div class="title-footer">جميع الحقوق محفوظة &copy; <?php echo date("Y") . " " . $row10["web_name"]; ?></div>
    </footer>
</body>
</html>