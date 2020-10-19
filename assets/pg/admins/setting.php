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
    <link rel="stylesheet" href="style">
</head>
<body>

    <div class="header">
        <div class="header-title">لوحة التحكم</div>

        <div class="side-menu">
            <div class="menu-item" onclick="window.open('setting', '_self');">إعدادات الموقع</div>
            <div style="color: #E74C3C;" class="menu-item" onclick="window.open('logout', '_self');">تسجيل الخروج</div>
        </div>
    </div>

    <div class="content">
        <div class="side-bar">
            <div class="item-bar" onclick="window.open('home', '_self');">الصفحة الرئيسية</div>
            <div class="item-bar" onclick="window.open('products', '_self');">المنتوجات</div>
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

            <div class="item-bar" onclick="window.open('discounts', '_self');">الخصومات</div>
            <div class="item-bar" onclick="window.open('cat', '_self');">الاقسام</div>
            <div class="item-bar" onclick="window.open('director', '_self');">المدراء</div>
            <div class="item-bar" onclick="window.open('setting', '_self');">إعدادات الموقع</div>
        </div>
        <div class="content-bar">

            <div class="path-bar">
                <div class="url-path active-path">الرئيسية</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الإعدادت</div>
            </div>

            <?php

                if (isset($_POST["sett_sub"])) {
                    $web_name       = $_POST["website_name"];
                    $whatsapp_num   = $_POST["whatsapp_number"];
                    $header_text    = $_POST["header_text"];
                    $web_disc       = $_POST["about_website"];
                    $fb_pixel       = $_POST["facebook_pixel"];
                    $gl_analytics   = $_POST["google_analytics"];
                    $web_logo       = $_POST["website_logo"];

                    if (empty($web_name) ||
                        empty($whatsapp_num) ||
                        empty($header_text) ||
                        empty($web_disc) ||
                        empty($fb_pixel) ||
                        empty($gl_analytics)) {
                        echo "<div style='margin: 20px; font-size: 18px; padding: 10px 15px; background-color: #ffe6e6;'>إملأ الفراغات</div>";
                    }
                    else {
                        $sql = "UPDATE web_settings SET web_name = '$web_name',
                                                        whatsapp_num = '$whatsapp_num',
                                                        header_text = '$header_text',
                                                        web_disc = '$web_disc',
                                                        fb_pixel = '$fb_pixel',
                                                        gl_analytics = '$gl_analytics' WHERE id='1'";
                    
                        if ($conn->query($sql) === TRUE) {
                            echo "<div style='margin: 20px; font-size: 18px; padding: 10px 15px; background-color: #e6fff5;'>لقد تم تحديث الإعدادات بنجاح</div>";
                        }
                        else {
                            echo "<div style='margin: 20px; font-size: 18px; padding: 10px 15px; background-color: #ffe6e6;'>هناك خطأ: " . $conn->error . "</div>";
                        }

                        if ($_FILES["website_logo"]["name"]) {
                            mkdir('../../img/', 0777, true);
                            chmod('../../img/', 0777);

                            $website_logo2 = $_FILES["website_logo"]["tmp_name"];
                            $file_name = "web_logo.png"; // $_FILES["website_logo"]["name"];

                            move_uploaded_file($website_logo2, '../../img/' . $file_name);
                        }


                    }

                }


                $sql2 = "SELECT * FROM web_settings";
                $result2 = $conn->query($sql2);

                $row2 = $result2->fetch_assoc();


            ?>

            <div class="container-form">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="text" name="website_name" id="" value="<?php echo $row2['web_name']; ?>" placeholder="اسم الموقع">
                    <input type="text" name="whatsapp_number" id="" value="<?php echo $row2['whatsapp_num']; ?>" placeholder="رقم الواتس اب">
                    <input type="text" name="header_text" id="" value="<?php echo $row2['header_text']; ?>" placeholder="نص الهيدر">
                    <input type="text" name="about_website" id="" value="<?php echo $row2['web_disc']; ?>" placeholder="وصف الموقع">
                    <textarea style="height: 100px;" class="txt-style" name="facebook_pixel" id="" placeholder="فيس بوك بيكسل"><?php echo $row2['fb_pixel']; ?></textarea>
                    <textarea style="height: 100px;" class="txt-style" name="google_analytics" id="" placeholder="جوجل اناليتكس"><?php echo $row2['gl_analytics']; ?></textarea>

                    <img style="display: block; margin-bottom: 20px;" width="150" src="./assets/img/web_logo.png">

                    <input id="files" type="file" name="website_logo" >
                    <input type="button" class="file-btn" value="شعار الموقع" onclick="document.getElementById('files').click();">

                    <p>
                        <input type="submit" name="sett_sub" value="حفظ">
                    </p>
                </form>
            </div>

        </div>
    </div>
    
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