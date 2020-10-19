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
                <div class="url-path">المدراء</div>

                <button onclick="window.open('http://localhost/ecomweb/assets/pg/admins/add_admin.php', '_self');">أضف مدير</button>
            </div>


            <table class="table table-bordered" role="table">
                <thead>
                    <tr>
                        <th width="2%">#</th>
                        <th class="text-right" width="20%">إسم المدير</th>
                        <th class="text-right" width="30%">الإيميل</th>
                        <th class="text-right" width="30%">التحكم</th>
                    </tr>
                </thead>
                <tbody>

                    

                    <?php

                    $sql2 = "SELECT * FROM admin_login";
                    $result2 = $conn->query($sql2);

                    while ($row2 = $result2->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row2["admin_id"] . "</td>";
                        echo "<td>";

                        if ($row2["admin_user"] === $_SESSION["admin_user"]) {
                            echo "<span style='color: white; font-weight: bold; background-color: #0088ff; padding: 5px;'>" . $row2["admin_user"] . "</span>";
                        }
                        else {
                            echo $row2["admin_user"];
                        }

                        echo "</td>";
                        echo "<td>" . $row2["admin_email"] . "</td>";
                        echo '<td data-title="التحكم" class="text-center">
                            <a href="assets/pg/admins/edit_director.php?drc_id=' . $row2["admin_id"] . '" class="edit-btn">تعديل</a>
                            <a href="del_check_director?del_id=' . $row2["admin_id"] . '" class="del-btn">حذف</a>
                        </td>';
                        echo "</tr>";

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