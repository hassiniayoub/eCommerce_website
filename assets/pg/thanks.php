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

    <div class="thanks_page">
    	<div class="thanks_icon"></div>
    	<div class="thanks_text">
    		لقد تم تسجيل طلبكم، <br>
			سنقوم بالاتصال بكم في أقل من 24 ساعة لتأكيد الطلب، <br>
			شكرا !!!

			<p>
				<button class="btn-style" onclick="window.open('index.php', '_self');">إكمال التسوق</button>
			</p>
    	</div>
    </div>

</body>
</html>