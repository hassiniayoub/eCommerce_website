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
                <div class="url-path active-path">المدراء</div>
                <div class="url-path slash">/</div>
                <div class="url-path">إضافة مدير</div>
            </div>

            <?php

            $drc_id = $_GET["drc_id"];

            if (isset($_POST["admin_sub"])) {

                $admin_name     = htmlspecialchars($_POST["admin_name"]);
                $admin_email    = htmlspecialchars($_POST["admin_email"]);
                $admin_pass     = htmlspecialchars($_POST["admin_pass"]);
                $admin_pass2     = htmlspecialchars($_POST["admin_pass2"]);

                if (empty($admin_name) ||
                    empty($admin_email) ||
                    empty($admin_pass)) {
                        echo "<div style='margin: 20px; font-size: 18px; padding: 10px 15px; background-color: #ffe6e6;'>إملأ الفراغات</div>";
                    }
                    else {

                        if ($admin_pass === $admin_pass2) {
                            $sql = "UPDATE admin_login SET admin_user='$admin_name', admin_email='$admin_email', admin_pass='$admin_pass' WHERE admin_id='$drc_id'";
                        
                            if ($conn->query($sql) === TRUE) {
                                echo "<div style='margin: 20px; font-size: 18px; padding: 10px 15px; background-color: #e6fff5;'>لقد تم تحديث إعدادات المدير بنجاح</div>";
                            }
                            else {
                                echo "<div style='margin: 20px; font-size: 18px; padding: 10px 15px; background-color: #ffe6e6;'>هناك خطأ: " . $conn->error . "</div>";
                            }
                        }
                        else {
                            echo "<div style='margin: 20px; font-size: 18px; padding: 10px 15px; background-color: #ffe6e6;'>كلمة المرور ليست متطابقة!</div>";
                        }

                    }
            }

            $sql2 = "SELECT admin_user, admin_email FROM admin_login WHERE admin_id='$drc_id'";
            $result2 = $conn->query($sql2);

            $row2 = $result2->fetch_assoc();

            ?>

            <div class="container-form">
                <form action="" method="post">
                    <input type="text" name="admin_name" id="" value="<?php echo $row2['admin_user']; ?>" placeholder="إسم المستخدم">
                    <input type="text" name="admin_email" id="" value="<?php echo $row2['admin_email']; ?>" placeholder="البريد الالكتروني">
                    <input type="password" name="admin_pass" id="" placeholder="كلمة السر">
                    <input type="password" name="admin_pass2" id="" placeholder="أعد إدخال كلمة السر">

                    <p>
                        <input type="submit" name="admin_sub" value="حفظ">
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