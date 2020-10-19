<?php

require_once("inc/conn.inc.php");

session_start();

if (!$_SESSION["admin_user"]) {
    header("Location: admin");
}


$delete_product = $_GET["del_id"];


if($_GET["del_stm"] === "true") {

    $dir = "products_img/" . $delete_product;

    $sql = "DELETE FROM products WHERE id='$delete_product'";
    $result = $conn->query($sql);

    function removeDirectory($path) {
        $i = new DirectoryIterator($path);

        foreach($i as $f) {
            if($f->isFile()) {
                unlink($f->getRealPath());
            }
            else if(!$f->isDot() && $f->isDir()) {
                rmdir($f->getRealPath());
            }
        }
        rmdir($path);
    }

    removeDirectory($dir);

    header("Location: products");

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

    <h1 style="text-align: center; margin-top: 100px;">هل أنت متأكد من أنك تريد أن تمسح هذا ألمنتوج (رقم <?php echo $delete_product; ?>)</h1>
    <h2 style="text-align: center; margin-top: 50px;">
        <a style="margin: 0 10px; color: white; background-color: #E74C3C; padding: 10px 15px; text-decoration: none;" href="del_product?del_id=<?php echo $delete_product?>&del_stm=true">نعم</a>
        <a style="margin: 0 10px; color: white; background-color: #18BC9C; padding: 10px 15px; text-decoration: none;" href="products">لا</a>
    </h2>
    
</body>
</html>


<?php
}

?>