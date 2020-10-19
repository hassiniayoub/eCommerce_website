<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.loader-pack {
	top: 50%;
	left: 50%;
	font-size: 20px;
	position: absolute;
	transform: translate(-50%, -50%);
}

.loader {
	margin: 0 auto 20px auto;
	border: 8px solid #f3f3f3;
	border-radius: 50%;
	border-top: 8px solid #3498db;
	width: 120px;
	height: 120px;
	-webkit-animation: spin 2s linear infinite; /* Safari */
	animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
</head>
<body>

<div class="loader-pack">
	<div class="loader"></div>
	<div>يتم إنشاء الجداول, المرجوا الانتظار!</div>
</div>

</body>
</html>
<?php

	include("conn.inc.php");

	$sql = "CREATE TABLE `admin_login` (
			 `admin_id` int(11) NOT NULL AUTO_INCREMENT,
			 `admin_user` varchar(255) NOT NULL,
			 `admin_email` varchar(255) NOT NULL,
			 `admin_pass` varchar(255) NOT NULL,
			 PRIMARY KEY (`admin_id`)
			) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8";



	$sql2 = "CREATE TABLE `category` (
			 `id` int(22) NOT NULL AUTO_INCREMENT,
			 `cat_name` varchar(255) NOT NULL,
			 `listorder` int(11) NOT NULL,
			 PRIMARY KEY (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8";

	$sql3 = "CREATE TABLE `coupons` (
			 `id` int(22) NOT NULL AUTO_INCREMENT,
			 `coupon_name` varchar(255) NOT NULL,
			 `date` varchar(255) NOT NULL,
			 PRIMARY KEY (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8";

	$sql4 = "CREATE TABLE `orders` (
			 `id` int(22) NOT NULL AUTO_INCREMENT,
			 `product_id` int(22) NOT NULL,
			 `name` varchar(255) NOT NULL,
			 `phone` varchar(255) NOT NULL,
			 `address` varchar(255) NOT NULL,
			 `city` varchar(255) NOT NULL,
			 `coupon` varchar(255) NOT NULL,
			 `price` varchar(255) NOT NULL,
			 `shipping` varchar(255) NOT NULL,
			 `prd_date` varchar(255) NOT NULL,
			 `status` varchar(255) NOT NULL,
			 PRIMARY KEY (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8";

	$sql5 = "CREATE TABLE `products` (
			 `id` int(22) NOT NULL AUTO_INCREMENT,
			 `title` varchar(255) NOT NULL,
			 `disc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
			 `price` varchar(255) NOT NULL,
			 `old_price` varchar(255) NOT NULL,
			 `shipping` varchar(255) NOT NULL,
			 `shipping_info` varchar(255) NOT NULL,
			 `cat_type` varchar(255) NOT NULL,
			 PRIMARY KEY (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8";

	$sql6 = "CREATE TABLE `web_settings` (
			 `id` int(22) NOT NULL AUTO_INCREMENT,
			 `web_name` varchar(255) NOT NULL,
			 `whatsapp_num` varchar(255) NOT NULL,
			 `header_text` varchar(255) NOT NULL,
			 `web_disc` varchar(255) NOT NULL,
			 `fb_pixel` varchar(255) NOT NULL,
			 `gl_analytics` varchar(255) NOT NULL,
			 PRIMARY KEY (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8";


	if ($conn->query($sql) === TRUE &&
		$conn->query($sql2) === TRUE &&
		$conn->query($sql3) === TRUE &&
		$conn->query($sql4) === TRUE &&
		$conn->query($sql5) === TRUE &&
		$conn->query($sql6) === TRUE) {
		header("Location: install?check=3");
	}
	else {
		echo "error Tables is not Created! <br>" . $conn->error;
	}


?>