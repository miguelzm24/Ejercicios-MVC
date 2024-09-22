<?php
session_start();
?>

<!DOCTYPE html>
<html>
<body>

<?php
// Set session variables
$_SESSION["session_user"] = $_POST["user"];
$_SESSION["session_email"] =  $_POST["email"];
echo "Se ha iniciado sesión con los siguientes datos: " . $_SESSION["session_user"] . ", ". $_SESSION["session_email"];


?>
<br>
<a href="session_check.php">Ir a la siguiente página</a>

</body>
</html>