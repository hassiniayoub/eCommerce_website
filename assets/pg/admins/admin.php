<?php

require_once("inc/conn.inc.php");

session_start();

if ($_SESSION["admin_user"]) {
    header("Location: home");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WoenyMaroc | تسجيل الدخول</title>
    <link rel="stylesheet" href="style">
</head>
<body style="background-color: #333; color: white; background-image: url('bg1'); background-size: cover; background-repeat: no-repeat;">
    <div class="login-box">
        <div class="login-title">تسجيل الدخول</div>
        <?php

        if (isset($_POST["sub_log"])) {
            $user_login = htmlspecialchars($_POST["user_log"]);
            $pass_login = htmlspecialchars($_POST["pass_log"]);

            $sql = "SELECT * FROM admin_login WHERE admin_user='$user_login' AND admin_pass='$pass_login'";
            $result = $conn->query($sql);

            $row = $result->fetch_assoc();

            $admin_user = $row["admin_user"];
            $admin_pass = $row["admin_pass"];

            if (empty($user_login) || empty($pass_login)) {
                echo "<div style='color: red; font-size: 18px; font-weight: 500; text-align: center;'>المرجوا ملئ الفراغات</div>";
            }
            else {
                if ($user_login !== $admin_user || $pass_login !== $admin_pass) {
                    echo "<div style='color: red; font-size: 18px; font-weight: 500; text-align: center;'>المعلومات التي ادخلت غير صحيحة</div>";
                }
                else {
                    $_SESSION["admin_user"] = $user_login;
                    header("Location: home");
                }
            }
        }
        
        ?>
        <div class="login-form">
            <form action="" method="post">
                <input type="text" name="user_log" id="" placeholder="إسم المستخدم">
                <input type="password" name="pass_log" id="" placeholder="كلمة المرور">
                <input type="submit" name="sub_log" value="دخول">
            </form>
        </div>
    </div>
</body>
</html>