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
    	<div class="first_div">

    		<?php

    		$prd_id = $_GET["id"];

    		$sql = "SELECT * FROM products WHERE id='$prd_id'";

    		$result = $conn->query($sql);

    		$row = $result->fetch_assoc();

    		?>

    		<div class="title_shw_prd"><?php echo $row["title"]; ?></div>
    		<div class="price_shw_prd">
    			<span class="old_price_shw_prd"><s><?php echo $row["old_price"] . "DH"; ?></s></span>
    			<?php echo $row["price"] . "DH"; ?>
    		</div>
    		<div class="quantity-box">
    			الكمية:
    			<div class="quantity-sys">
			        <button id="plus-btn" onclick="add_num();">+</button>
			        <input id="input-num" type="text" value="1" onkeyup="check_num();">
			        <button id="minus-btn" onclick="remove_num();">−</button>
			    </div>
    		</div>
    		
            <form style="width: 100%;" action="order_now?id=<?php echo $prd_id; ?>" method="post">
                <input type="hidden" name="quantity-num" id="quantity-num" value="1">
                <div class="center-btn">
                    <button type="submit" class="order-now">أطلب الآن</button> 
                </div>
            </form>     
            

    		<div class="shipping_info" style="font-size: 18px; margin: 30px 0 20px 0;"><?php echo $row["shipping_info"]; ?></div>

    		<div class="description" style="font-size: 18px; margin: 30px 0 20px 0; border: 1px solid #ccc; background-color: #efefef; padding: 20px 10px;">
    			<?php echo htmlspecialchars_decode($row["disc"]); ?>	
    		</div>
    	</div>
        <script type="text/javascript" src="../../jquery.min.js"></script>
    	<div class="second_div" style="padding: 10px;">
            <?php
                $dir_path = "./admins/products_img/" . $prd_id;
                $extensions_array = array('jpg','png','jpeg');

                if(is_dir($dir_path))
                {
                    $files = scandir($dir_path);

                    $count_files = count($files);
            
    		        echo "<img style='border: 1px solid #ccc;' id='shw_img_main' src='" . $absolute_link . "admins/products_img/" . $prd_id . "/" . $files[2] . "'/>";

                }

                echo "<div style='display: flex;'>";


                if(is_dir($dir_path))
                {
                    $files = scandir($dir_path);
                    
                    for($i = 0; $i < count($files); $i++)
                    {
                        if($files[$i] !='.' && $files[$i] !='..')
                        {
                            
                            // get file extension
                            $file = pathinfo($files[$i]);
                            $extension = $file['extension'];

                            $rm_dot = str_replace(".", "_", $files[$i]);

                        // check file extension
                            if(in_array($extension, $extensions_array))
                            {

                            // show image
                            echo "<div style='width: 70px; height: 70px; overflow: hidden; border: 1px solid #ccc; border-radius: 6px; margin: 5px; cursor: pointer;' onclick='shw_img" . $rm_dot . "();'><img src='$absolute_link" . "admins/products_img/$prd_id/$files[$i]' style='width:100%;'></div>";

                            echo '<script>

                                    function shw_img' . $rm_dot . '() {

                                        $("#shw_img_main").attr("src", "'. $absolute_link . 'admins/products_img/' . $prd_id . '/' . $files[$i] . '");

                                    }
                            
                                  </script>';
                            }
                        }
                    }
                }

                echo "</div>";

                ?>
    	</div>
    </div>

    <footer>
        <div class="title-footer">جميع الحقوق محفوظة &copy; <?php echo date("Y") . " " . $row10["web_name"]; ?></div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function add_num() {
            var get_num = $("#input-num").val();
            var make_calc = parseInt(get_num) + 1;

            if(get_num < "1") {
                $("#input-num").val("1");
                $("#quantity-num").val("1");
            }
            else {
                $("#input-num").val(make_calc);
                $("#quantity-num").val(make_calc);
            }
        }

        function remove_num() {
            var get_num = $("#input-num").val();
            var make_calc = parseInt(get_num) - 1;

            if(get_num <= "1") {
                $("#input-num").val("1");
                $("#quantity-num").val("1");
            }
            else {
                $("#input-num").val(make_calc);
                $("#quantity-num").val(make_calc);
            }
            
        }

        function check_num() {
            var get_num = $("#input-num").val();

            if(get_num === "" || get_num === "0") {
                $("#input-num").val("1");
                $("#quantity-num").val("1");
            }
            else {
                $("#quantity-num").val(get_num);
            }

        }
    </script>
</body>
</html>