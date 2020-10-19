<?php

require_once("inc/conn.inc.php");

session_start();

if (!$_SESSION["admin_user"]) {
    header("Location: admin");
}


$delete_coupon = $_GET["del_id"];


if($_GET["del_stm"] === "true") {

    $sql = "DELETE FROM coupons WHERE id='$delete_coupon'";
    $result = $conn->query($sql);

    header("Location: discounts");

}
else {

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WoneyMaroc | لوحة التحكم</title>
    <link rel="stylesheet" href="style">
</head>
<body>

    <h1 style="text-align: center; margin-top: 100px;">هل أنت متأكد من أنك تريد أن تمسح هذا الكود التخفيض (رقم <?php echo $delete_coupon; ?>)</h1>
    <h2 style="text-align: center; margin-top: 50px;">
        <a style="margin: 0 10px; color: white; background-color: #E74C3C; padding: 10px 15px; text-decoration: none;" href="del_discount?del_id=<?php echo $delete_coupon?>&del_stm=true">نعم</a>
        <a style="margin: 0 10px; color: white; background-color: #18BC9C; padding: 10px 15px; text-decoration: none;" href="discounts">لا</a>
    </h2>
    
</body>
</html>


<?php
}

?>