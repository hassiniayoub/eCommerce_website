<?php

    require_once("admins/inc/conn.inc.php");

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
    <style>
    	.quantity-box {
    		margin-top: 20px;
    	}

        .quantity-sys {
        	margin-top: 10px;
            width: 110px;
            height: auto;
            position: relative;
        }

        .quantity-sys button {
            font-size: 18px;
            border: none;
            background-color: #eee;
            padding: 3px 10px;
            -moz-appearance: none;
            -webkit-appearance: none;
            position: absolute;
            cursor: pointer;
        }

        #plus-btn {
            top: 0;
            left: 0;
        }

        #minus-btn {
            top: 0;
            right: 0;
        }

        .quantity-sys input[type=text] {
            width: 110px;
            font-size: 17px;
            text-align: center!important;
            border: none;
            outline: none;
            padding: 3px;
            -moz-appearance: none;
            -webkit-appearance: none;
        }
    </style>
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
            <button onclick="window.open('coupons', '_self');">التخفيضات</button>
        </div>
    </header>

    <div class="show_prd">
    	<div>

    		<?php

    		$prd_id = $_GET["id"];

    		$sql = "SELECT * FROM products WHERE id='$prd_id'";

    		$result = $conn->query($sql);

    		$row = $result->fetch_assoc();

            $quantity_num = $_POST["quantity-num"];

    		?>

            <div class="order_now_box">
                <div class="order_now_img">
                    <?php

                    $dir_path = "./admins/products_img/" . $prd_id;
                    $extensions_array = array('jpg','png','jpeg');

                    if(is_dir($dir_path))
                    {
                        $files = scandir($dir_path);

                        $count_files = count($files);
                
                        echo "<img style='width: 100%; border: 1px solid #ccc;' src='" . $absolute_link . "admins/products_img/" . $prd_id . "/" . $files[2] . "'/>";

                    }

                    ?>
                </div>
                <div class="order_now_title">
                    <div>
                        <?php echo $row["title"]; ?>
                    </div>
                </div>
                <div class="order_now_price">
                    <div>
                        <?php echo $row["price"]; ?>DH
                    </div>
                </div>
            </div>

            <hr style="margin-top: 20px; border: none; border-top: 1px solid #ccc;">

            <div style="margin-top: 20px;">
                <div style="display: flex; position: relative; font-size: 24px;">
                    الكمية : 
                    <div class="ship_info">
                        <?php echo $quantity_num; ?>
                    </div>
                </div>
                <div style="display: flex; position: relative; font-size: 24px;">
                    مصاريف الشحن : 
                    <div class="ship_info">
                        <?php echo $row["shipping"]; ?>DH
                    </div>
                </div>
                <div style="margin-top: 10px; display: flex; position: relative; font-size: 24px;">
                    المبلغ الواجب أداؤه :
                    <div class="ship_info">
                        <?php echo  $row["price"] * $quantity_num + $row["shipping"]; ?>DH
                    </div>
                </div>
                <div style="height: 50px;"></div>
            </div>


    	</div>
        <script type="text/javascript" src="../../jquery.min.js"></script>

    	<div style="padding: 0 10px 10px 10px;">
            <form style="width: 100%;" action="" method="post">
                <div class="container-form">
                    <?php

                    if (isset($_POST["order_sub"])) {

                        $fullname   = htmlspecialchars($_POST["fullname"]);
                        $phone      = htmlspecialchars($_POST["phone"]);
                        $address    = htmlspecialchars($_POST["address"]);
                        $city       = htmlspecialchars($_POST["city"]);
                        $coupon     = htmlspecialchars($_POST["coupon"]);

                        if (empty($fullname) || empty($phone) || empty($address) || empty($city)) {
                            echo "<div style='font-size: 20px; font-weight: bold; color: red; display: block;'>المرجوا ملئ الفراغات!</div>";
                        }
                        else {
                            
                            $price = $row["price"] * $_POST["quantity-num"];
                            $shipping = $row["shipping"];
                            $date = date("d/m/Y h:m:s a");
                            $status = "1";

                            $sql = "INSERT INTO orders (product_id, name, phone, address, city, coupon, price, shipping, prd_date, status)
                                    VALUES
                                                       ('$prd_id','$fullname', '$phone', '$address', '$city', '$coupon', '$price', '$shipping', '$date', '$status')";

                            if ($conn->query($sql) === TRUE) {
                                header("Location: thanks");
                            }
                            else {
                                echo "<div style='font-size: 20px; font-weight: bold; color: red; display: block;'>هناك خطأ ما</div>";
                            }
                        }
                    }

                    ?>
                    <span style="font-size: 20px; font-weight: bold;">المرجو ملأ الاستمارة لإتمام الطلب</span>
                    <input type="hidden" name="quantity-num" value="<?php echo $_POST["quantity-num"]; ?>">
                    <input type="text" name="fullname" placeholder="الاسم">
                    <input type="tel" name="phone" placeholder="الهاتف">
                    <input type="text" name="address" placeholder="العنوان">                       
                    <input type="text" name="city" placeholder="المدينة">
                    
                    <input type="text" name="coupon" placeholder="كود التخفيض" id="coupon">
                    <input type="submit" name="order_sub" value="تأكيد الطلب">
                </div>
            </form>
    	</div>
    </div>

    <footer>
        <div class="title-footer">جميع الحقوق محفوظة &copy; <?php echo date("Y") . " " . $row10["web_name"]; ?></div>
    </footer>
</body>
</html>