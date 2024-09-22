<!DOCTYPE html>
<html>
<body>

<?php
$user = $email = $user_err = $email_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["user"]) && !empty($_POST["user"])) {
        $user = $_POST["user"];
    } else {
        $user_err = "El usuario no puede estar vacío.";
    }
    if(isset($_POST["email"]) && !empty($_POST["email"])) {
        $email = $_POST["email"];
    } else {
        $email_err = "El email no puede estar vacío.";
    }
}
?>

<form action="cookies.php" method="POST">
    <input type="text" name="user" value="<?php echo $user; ?>"><span> * <?php echo $user_err?></span>
    <br>
    <input type="text" name="email" value="<?php echo $email; ?>"><span> * <?php echo $email_err?></span>
    <br>
    <input type="submit">
</form>

</body>
</html>