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
                <div class="url-path">طلبات</div>
            </div>


            <table class="table table-bordered" role="table">
                <thead>
                    <tr>
                        <th width="2%">#</th>
                        <th class="text-right" width="15%">المنتوج</th>
                        <th class="text-right" width="15%">إسم المشتري</th>
                        <th class="text-right" width="10%">رقم الهاتف</th>
                        <th class="text-right" width="10%">المدينة</th>
                        <th class="text-right" width="10%">تاريخ الطلب</th>
                        <th class="text-right" width="10%">سعر الطلب</th>
                        <th class="text-right" width="15%">الحالة</th>
                        <th class="text-right" width="30%">التحكم</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sql = "SELECT * FROM orders";
                    $result = $conn->query($sql);

                    while($row = $result->fetch_assoc()) {

                        $prd_id = $row["product_id"];

                        $sql2 = "SELECT * FROM products WHERE id='$prd_id'";
                        $result2 = $conn->query($sql2);

                        $row2 = $result2->fetch_assoc();

                        echo '<tr>';
                            echo '<td>' . $row["id"] . '</td>';
                            echo '<td>' . $row2["title"] . '</td>';
                            echo '<td>' . $row["name"] . '</td>';
                            echo '<td>' . $row["phone"] . '</td>';
                            echo '<td>' . $row["city"] . '</td>';
                            echo '<td>' . $row["prd_date"] . '</td>';
                            echo '<td>' . $row["price"] . 'DH</td>';
                            echo '<td>';

                                if ($row["status"] === '1') {
                                    echo 'بإنتظار التأكيد';
                                }
                                if ($row["status"] === '2') {
                                    echo 'بإنتظار الشحن';
                                }
                                if ($row["status"] === '3') {
                                    echo 'تم الإرسال';
                                }
                                if ($row["status"] === '4') {
                                    echo 'تم إلغاء الطلب';
                                }
                                if ($row["status"] === '5') {
                                    echo 'تم الإستلام';
                                }


                            echo '</td>';
                            echo '<td class="text-center">';
                            echo '<a href="assets/pg/admins/info_product.php?req_id=' . $row["id"] . '" class="edit-btn">التفاصيل</a>
                                  <a style="display: inline-block; margin-top: 10px;" href="del_request?del_id=' . $row["id"] . '" class="del-btn">حذف</a>';
                            echo '</td>';
                        echo '</tr>';

                    }

                    ?>
                
                </tbody>		
            </table>

            <button style="margin: 20px;" class="btn-style">تحميل الكل</button>
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