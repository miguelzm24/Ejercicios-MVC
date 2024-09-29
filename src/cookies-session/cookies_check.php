<?php
?>

<!DOCTYPE html>
<html>
<body>

<?php
if(isset($_COOKIE["cookie_user"]) && isset($_COOKIE["cookie_email"])) {
    echo "Hola " . $_COOKIE["cookie_user"] . ", " . $_COOKIE["cookie_email"] . ".";
} else {
    echo "No tenemos datos tuyos.";
}
?>
</body>
</html>