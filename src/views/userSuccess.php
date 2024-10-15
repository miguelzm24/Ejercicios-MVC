<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Created</title>
</head>
<body>
    <h1>User Created Successfully!</h1>
    <p>Name: <?php echo htmlspecialchars($user->name); ?></p>
    <a href="index.php">Create Another User</a>
</body>
</html>
