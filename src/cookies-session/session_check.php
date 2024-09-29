<?php
session_start();
?>

<!DOCTYPE html>
<html>
<body>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    session_unset();
    session_destroy();
}
if(isset($_SESSION["session_user"]) && isset($_SESSION["session_email"])) {
    echo "Variables de sesión: " . $_SESSION["session_user"] . ", ". $_SESSION["session_email"];
} else {
    echo "Sesión cerrada.";
}
?>
<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
    Cerrar sesión:
    <input type="submit">
</form>
</body>
</html>