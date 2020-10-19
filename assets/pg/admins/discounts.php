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
                <div class="url-path">الخصومات</div>

                <button onclick="window.open('http://localhost/ecomweb/assets/pg/admins/add_discount.php', '_self');">أضف خصم جديد</button>
            </div>

            <table class="table table-bordered" role="table">
                <thead>
                    <tr>
                        <th width="2%">#</th>
                        <th class="text-right" width="15%">كود التخفيض</th>
                        <th class="text-right" width="15%">تاريخ إنتهاء الخصم</th>
                        <th class="text-right" width="60%">التحكم</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $sql = "SELECT * FROM coupons";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>
                        <td><span class="badge">' . $row["id"] . '</span></td>
                        <td>' . $row["coupon_name"] . '</td>
                        <td>' . $row["date"] . 'dh</td>
                        <td>
                            <a href="assets/pg/admins/edit_discount.php?dis_id=' . $row["id"] . '" class="edit-btn">تعديل</a>
                            <a href="del_discount?del_id=' . $row["id"] . '" class="del-btn">حذف</a>
                        </td>
                    </tr>';
                    }
                    
                    ?>
                </tbody>		
            </table>

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