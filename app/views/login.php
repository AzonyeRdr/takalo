<!DOCTYPE html>
<?php $baseurl = Flight::get('flight.base_url'); ?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <title>Hexashop - Connexion</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl; ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl; ?>/assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/assets/css/templatemo-hexashop.css">
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/assets/css/owl-carousel.css">
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/assets/css/lightbox.css">
</head>


<body>

    <!-- ***** Login Area Start ***** -->
    <div class="contact-us" style="min-height: 100vh; display: flex; align-items: center; justify-content: center;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="section-heading text-center">
                                <h2>Se connecter</h2>
                                <span>Connectez-vous à votre compte</span>
                            </div>
                            <div id="alertContainer"></div>
                            <form id="loginForm">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input name="email" type="email" class="form-control" id="email" placeholder="Votre email" required="">
                                        <div id="emailError" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="password" class="form-label">Mot de passe</label>
                                        <input name="password" type="password" class="form-control" id="password" placeholder="Mot de passe" required="">
                                        <div id="passwordError" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <button type="submit" id="loginBtn" class="main-dark-button w-100">
                                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                            <span class="btn-text">Se connecter</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="text-center mt-3">
                                <p>Pas de compte? <a href="<?php echo $baseurl; ?>/signup">S'inscrire</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Login Area End ***** -->

    <!-- jQuery -->
    <script src="<?php echo $baseurl; ?>/assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="<?php echo $baseurl; ?>/assets/js/popper.js"></script>
    <script src="<?php echo $baseurl; ?>/assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="<?php echo $baseurl; ?>/assets/js/owl-carousel.js"></script>
    <script src="<?php echo $baseurl; ?>/assets/js/accordions.js"></script>
    <script src="<?php echo $baseurl; ?>/assets/js/datepicker.js"></script>
    <script src="<?php echo $baseurl; ?>/assets/js/scrollreveal.min.js"></script>
    <script src="<?php echo $baseurl; ?>/assets/js/waypoints.min.js"></script>
    <script src="<?php echo $baseurl; ?>/assets/js/jquery.counterup.min.js"></script>
    <script src="<?php echo $baseurl; ?>/assets/js/imgfix.min.js"></script>
    <script src="<?php echo $baseurl; ?>/assets/js/slick.js"></script>
    <script src="<?php echo $baseurl; ?>/assets/js/lightbox.js"></script>
    <script src="<?php echo $baseurl; ?>/assets/js/isotope.js"></script>

    <!-- Global Init -->
    <script src="<?php echo $baseurl; ?>/assets/js/custom.js"></script>

    <script src="<?php echo $baseurl; ?>/assets/js/user/login.js"></script>

</body>

</html>