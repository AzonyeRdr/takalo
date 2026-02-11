<!DOCTYPE html>
<?php $baseurl = Flight::get('flight.base_url'); ?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <title>Hexashop - Inscription</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl; ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl; ?>/assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/assets/css/templatemo-hexashop.css">
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/assets/css/owl-carousel.css">
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/assets/css/lightbox.css">
</head>
    
<body>

    <?php include 'includes/header.php'; ?>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading about-page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Inscription</h2>
                        <span>Rejoignez notre communauté d'échange</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Inscription Area Start ***** -->
    <div class="contact-us">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="section-heading text-center">
                                <h2>S'inscrire</h2>
                                <span>Créez votre compte pour commencer à échanger</span>
                            </div>
                            <form id="inscriptionForm">
                                <div id="formStatus" class="alert d-none"></div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <input name="nom" type="text" id="nom" placeholder="Votre nom complet" required="">
                                            <div id="nomError" class="invalid-feedback d-block"></div>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <input name="email" type="email" id="email" placeholder="Votre email" required="">
                                            <div id="emailError" class="invalid-feedback d-block"></div>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <input name="telephone" type="tel" id="telephone" placeholder="Votre téléphone" required="">
                                            <div id="telephoneError" class="invalid-feedback d-block"></div>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <input name="password" type="password" id="password" placeholder="Mot de passe" required="">
                                            <div id="passwordError" class="invalid-feedback d-block"></div>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <input name="confirm_password" type="password" id="confirm_password" placeholder="Confirmer le mot de passe" required="">
                                            <div id="confirmPasswordError" class="invalid-feedback d-block"></div>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <button type="submit" id="form-submit" class="main-dark-button">S'inscrire</button>
                                        </fieldset>
                                    </div>
                                </div>
                            </form>
                            <div class="text-center mt-3">
                                <p>Déjà un compte? <a href="<?php echo $baseurl; ?>/login">Se connecter</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Inscription Area End ***** -->

    <?php include 'includes/footer.php'; ?>

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

    <script src="<?php echo $baseurl; ?>/assets/js/user/inscription.js"></script>

</body>
</html>
