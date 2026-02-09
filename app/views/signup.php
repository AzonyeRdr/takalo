<!DOCTYPE html>
<?php $baseurl = Flight::get('flight.base_url'); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
</head>
<body>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="admin">Cocher si vous voulez vous enregistrez en tant qu'administrateur</label>
        <input type="radio" id="admin" name="admin" value="admin" checked><br><br>
        <input type="submit" value="Signup">
    </form>
</body>
</html>