<!DOCTYPE html>
<?php $baseurl = Flight::get('flight.base_url');?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script defer src="<?php echo $baseurl; ?>/assets/js/loginValidation.js"></script>
</head>

<body>
    <form action="<?=$baseurl?>/" method="post" novalidate>
        <h2>Login</h2>
        
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <p id="Wemail" class="errors"></p>
        </div>
        
        <input type="submit" value="Login">
    </form>

</body>

</html>