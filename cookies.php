<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    setcookie("cookie_user", $_POST["user"], time() + (86400 * 30), "/");
    setcookie("cookie_email", $_POST["email"], time() + (86400 * 30), "/");
    echo "Cookies guardadas.";
}
?>

<!DOCTYPE html>
<html>
<body>
<a href="cookies_check.php">Ir a la siguiente página.</a>
</body>
</html>