<?php

require_once("inc/conn.inc.php");

session_start();

if (!$_SESSION["admin_user"]) {
    header("Location: admin");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WoneyMaroc | لوحة التحكم</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="header">
        <div class="header-title">لوحة التحكم</div>

        <div class="side-menu">
            <div class="menu-item" onclick="window.open('../../../setting', '_self');">إعدادات الموقع</div>
            <div style="color: #E74C3C;" class="menu-item" onclick="window.open('logout', '_self');">تسجيل الخروج</div>
        </div>
    </div>

    <div class="content">
        <div class="side-bar">
            <div class="item-bar" onclick="window.open('../../../home', '_self');">الصفحة الرئيسية</div>
            <div class="item-bar" onclick="window.open('../../../products', '_self');">المنتوجات</div>
            <div id="req1" class="item-bar" onclick="sub_menu_open();">الطلبات</div>
            <div id="req2" class="item-bar" onclick="sub_menu_close();">الطلبات</div>

            <div id="sub-menu" class="sub-menu">
                <div onclick="window.open('requests', '_self')">الكل</div>
                <div onclick="window.open('req1', '_self')">بإنتظار التأكيد</div>
                <div onclick="window.open('req2', '_self')">بإنتظار الشحن</div>
                <div onclick="window.open('req3', '_self')">تم الإرسال</div>
                <div onclick="window.open('req4', '_self')">تم إلغاء الطلب</div>
                <div onclick="window.open('req5', '_self')">تم الإستلام</div>
            </div>

            <div class="item-bar" onclick="window.open('../../../discounts', '_self');">الخصومات</div>
            <div class="item-bar" onclick="window.open('../../../cat', '_self');">الاقسام</div>
            <div class="item-bar" onclick="window.open('../../../director', '_self');">المدراء</div>
            <div class="item-bar" onclick="window.open('../../../setting', '_self');">إعدادات الموقع</div>
        </div>
        <div class="content-bar">

            <div class="path-bar">
                <div class="url-path active-path">الرئيسية</div>
                <div class="url-path slash">/</div>
                <div class="url-path active-path">المنتوجات</div>
                <div class="url-path slash">/</div>
                <div class="url-path">إضافة منتوج</div>
            </div>

            <?php

                if (isset($_POST["sub_form"])) {

                    $product_title = $_POST["product_title"];
                    $original_price = $_POST["original_price"];
                    $old_price = $_POST["old_price"];
                    $shipping_price = $_POST["shipping_price"];
                    $description = htmlspecialchars($_POST["editor1"]);
                    $shipping_info = $_POST["shipping_info"];
                    // product_images = $_POST["product_images"];
                    $category_type = $_POST["cat_type"];

                    if (empty($product_title) ||
                        empty($original_price) ||
                        empty($old_price) ||
                        empty($description) ||
                        empty($shipping_info) ||
                        empty($category_type)) {
                        echo "<div style='margin: 20px; font-size: 18px; padding: 10px 15px; background-color: #ffe6e6;'>إملأ الفراغات</div>";
                    }
                    else {

                        $sql = "INSERT INTO products (title, disc, price, old_price, shipping, shipping_info, cat_type) VALUES ('$product_title', '$description', '$original_price', '$old_price', '$shipping_price', '$shipping_info', '$category_type')";
                        
                        if ($conn->query($sql) === TRUE) {
                            echo "<div style='margin: 20px; font-size: 18px; padding: 10px 15px; background-color: #e6fff5;'>لقد تم إضافة المنتوج بنجاح</div>";
                        }
                        else {
                            echo "<div style='margin: 20px; font-size: 18px; padding: 10px 15px; background-color: #ffe6e6;'>هناك خطأ: " . $conn->error . "</div>";
                        }

                        $sql2 = "SELECT * FROM products ORDER BY id DESC";
                        $result2 = $conn->query($sql2);

                        $row2 = $result2->fetch_assoc();

                        if($result2->num_rows === "0") {
                            $product_id = "1";
                        }
                        else {
                            $product_id = $row2["id"]; // intval($row2["id"]+1);
                        }

                        mkdir('products_img/' . $product_id, 0777, true);
                        chmod('products_img/' . $product_id, 0777);

                        $file_count = count($_FILES["product_images"]["name"]);

                        for($i=0;$i<$file_count;$i++) {
                            $product_images = $_FILES["product_images"]["tmp_name"][$i];
                            $file_name = $_FILES["product_images"]["name"][$i];
                            move_uploaded_file($product_images, 'products_img/' . $product_id . '/' . $file_name);
                        }

                    }

                }
            
            
            ?>

            <div class="container-form">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="text" name="product_title" id="" placeholder="عنوان المنتوج">
                    <input type="text" name="original_price" id="" placeholder="السعر الاصلي">
                    <input type="text" name="old_price" id="" placeholder="السعر القديم">
                    <input type="text" name="shipping_price" id="" placeholder="سعر الشحن">
                    <textarea name="editor1" id="editor1"></textarea>
                    <textarea style="height: 100px;" name="shipping_info" id="" placeholder="معلومات الشحن و التسليم"></textarea>

                    <?php

                        $sql5 = "SELECT * FROM category";
                        $result5 = $conn->query($sql5);

                    ?>

                    <select name="cat_type" style="margin: 20px;" class="my-font">

                        <option value="" selected="selected">إختر القسم</option>

                    <?php

                        while ($row5 = $result5->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row5["cat_name"]; ?>" class="my-font"><?php echo $row5["cat_name"]; ?></option>
                            <?php
                        }

                    ?>

                    </select>

                    <input id="files" type="file" name="product_images[]" multiple id="">
                    <input type="button" class="file-btn" value="أضف صور للمنتوج" onclick="document.getElementById('files').click();">

                    <p>
                        <input type="submit" name="sub_form" value="حفظ">
                    </p>
                </form>
            </div>

        </div>
    </div>
    
    <script src="ckeditor/ckeditor.js"></script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        CKEDITOR.editorConfig = function( config ) {
            config.language = 'ar';
            config.uiColor = '#F7B42C';
            config.height = 300;
            config.toolbarCanCollapse = true;
        };
    </script>

    <script>
        function sub_menu_open() {
            document.getElementById("req1").style.display = "none";
            document.getElementById("req2").style.display = "block";
            document.getElementById("sub-menu").style.height = "260px";
        }

        function sub_menu_close() {
            document.getElementById("req1").style.display = "block";
            document.getElementById("req2").style.display = "none";
            document.getElementById("sub-menu").style.height = "0px";
        }
    </script>
</body>
</html>