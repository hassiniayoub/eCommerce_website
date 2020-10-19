<?php

    require_once("./admins/inc/conn.inc.php");

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

    <?php

        $cat_id2 = $_GET["cat_id"];

        $sql3 = "SELECT * FROM category WHERE id='$cat_id2'";
        $result3 = $conn->query($sql3);

        $row3 = $result3->fetch_assoc();

    ?>

    <div class="title-content"><?php echo $row3["cat_name"]; ?></div>


    <div class="content">

        <?php

        $cat_name2 = $row3["cat_name"];
        
        $sql = "SELECT * FROM products where cat_type='$cat_name2'";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {

            $dir_path = "admins/products_img/" . $row["id"];
            $extensions_array = array('jpg','png','jpeg');

                    
            ?>

            <div class="product-pack" onclick='redrq<?php echo $row["id"]; ?>();'>
                <?php
                
                if(is_dir($dir_path))
                {
                    $files = scandir($dir_path);

                    $count_files = count($files);

                    echo '<div style="background-image: url(assets/pg/' . $dir_path . '/' . $files[2] . ')" class="product-img"></div>';

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