<!DOCTYPE html>
<?php $baseurl = Flight::get('flight.base_url'); ?>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Takalo - Plateforme d'échange d'objets entre utilisateurs">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Takalo - Échangez vos objets simplement</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>/assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $baseurl ?>/assets/css/templatemo-hexashop.css">
    <link rel="stylesheet" href="<?php echo $baseurl ?>/assets/css/owl-carousel.css">
    <link rel="stylesheet" href="<?php echo $baseurl ?>/assets/css/lightbox.css">
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
    <div class="main-banner" id="top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content">
                        <div class="thumb">
                            <div class="inner-content">
                                <h4>Bienvenue sur Takalo</h4>
                                <span>Échangez vos objets simplement et gratuitement</span>
                                <div class="main-border-button">
                                    <a href="#women">Découvrir les objets</a>
                                </div>
                            </div>
                            <img src="<?php echo $baseurl ?>/assets/images/left-banner-image.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Proposez</h4>
                                            <span>Vos objets à échanger</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Proposez vos objets</h4>
                                                <p>Mettez en ligne les objets que vous souhaitez échanger avec d'autres membres.</p>
                                                <div class="main-border-button">
                                                    <a href="<?php echo $baseurl; ?>/inscription">Commencer</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="<?php echo $baseurl ?>/assets/images/baner-right-image-01.jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Échangez</h4>
                                            <span>Avec la communauté</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Échangez facilement</h4>
                                                <p>Trouvez les objets qui vous intéressent et proposez des échanges équitables.</p>
                                                <div class="main-border-button">
                                                    <a href="<?php echo $baseurl; ?>/inscription">Parcourir</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="<?php echo $baseurl ?>/assets/images/baner-right-image-02.jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Communauté</h4>
                                            <span>Des milliers d'utilisateurs</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>Rejoignez-nous</h4>
                                                <p>Faites partie d'une communauté engagée dans l'économie circulaire.</p>
                                                <div class="main-border-button">
                                                    <a href="#social">Voir nos contacts</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="<?php echo $baseurl ?>/assets/images/baner-right-image-03.jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Sécurisé</h4>
                                            <span>100% gratuit et fiable</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>En toute sécurité</h4>
                                                <p>Notre plateforme garantit des échanges sécurisés entre membres vérifiés.</p>
                                                <div class="main-border-button">
                                                    <a href="#explore">En savoir plus</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="<?php echo $baseurl ?>/assets/images/baner-right-image-04.jpg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Categories Section Start ***** -->
    <section class="section" id="men">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Nos catégories</h2>
                        <span>Explorez nos différentes catégories d'objets disponibles</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="men-item-carousel">
                        <div class="owl-men-item owl-carousel">
                            <?php foreach ($categories as $index => $categorie) {  ?>
                            <div class="item">
                                <div class="thumb">
                                    <img src="<?php echo $baseurl ?>/assets/images/explore-image-01.jpg" alt="<?php echo htmlspecialchars($categorie['libelle']); ?>">
                                </div>
                                <div class="down-content">
                                    <h4><?php echo htmlspecialchars($categorie['libelle']); ?></h4>
                                    <span><?php echo htmlspecialchars($categorie['description']); ?></span>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Categories Section End ***** -->

    <!-- ***** Recent Objects Section Start ***** -->
    <section class="section" id="women">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Objets ajoutés</h2>
                        <span>Découvrez les objets disponibles pour l'échange</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="men-item-carousel">
                        <div class="owl-men-item owl-carousel">
                            <?php if (empty($objets)){  ?>
                                <div class="item text-center">
                                    <p>Aucun objet disponible pour le moment. Soyez le premier à proposer un objet !</p>
                                    <div class="main-border-button">
                                        <a href="<?php echo $baseurl; ?>/inscription">Commencer</a>
                                    </div>
                                </div>
                            <?php } else {  ?>
                                <?php foreach ($objets as $objet) {?>
                                <div class="item">
                                    <div class="thumb">
                                        <img src="<?php echo $baseurl . '/assets/images/products/' . htmlspecialchars($objet->getPhotos()[0]->getChemin()); ?>" alt="">
                                        <div class="hover-content">
                                            <ul>
                                                <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                                <li><a href="#"><i class="fa fa-exchange"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="down-content">
                                        <h4><?php echo htmlspecialchars($objet->getTitre()); ?></h4>
                                        <span><?php echo $objet->getPrixEstime() ? number_format($objet->getPrixEstime(), 2) . ' Ar' : 'À négocier'; ?></span>
                                        <ul class="stars">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                        <p><small>Proposé par <?php echo htmlspecialchars($objet->getProprietaire()->getNom()); ?></small></p>
                                    </div>
                                </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Recent Objects Section End ***** -->

    <!-- ***** How It Works Section Start ***** -->
    <section class="section" id="explore">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Comment ça marche ?</h2>
                        <span>Échangez vos objets en 3 étapes simples</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mt-4">
                        <div class="card-body text-center">
                            <div class="icon mb-3">
                                <i class="fa fa-user-plus fa-2x"></i>
                            </div>
                            <h4 class="card-title">1. Inscrivez-vous</h4>
                            <p class="card-text">Créez votre compte gratuitement en quelques secondes et rejoignez notre communauté d'échangistes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mt-4">
                        <div class="card-body text-center">
                            <div class="icon mb-3">
                                <i class="fa fa-camera fa-2x"></i>
                            </div>
                            <h4 class="card-title">2. Ajoutez vos objets</h4>
                            <p class="card-text">Prenez des photos de vos objets, ajoutez une description et publiez-les sur la plateforme.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mt-4">
                        <div class="card-body text-center">
                            <div class="icon mb-3">
                                <i class="fa fa-exchange fa-2x"></i>
                            </div>
                            <h4 class="card-title">3. Échangez !</h4>
                            <p class="card-text">Trouvez des objets qui vous intéressent et proposez des échanges avec d'autres utilisateurs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** How It Works Section End ***** -->

    <!-- ***** Explore Area Starts ***** -->
    <section class="section" id="explore">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content">
                        <h2>Prêt à échanger vos objets ?</h2>
                        <span>Échangez vos objets simplement et gratuitement avec notre plateforme communautaire.</span>
                        <div class="quote">
                            <i class="fa fa-quote-left"></i>
                            <p>Rejoignez des milliers d'utilisateurs qui échangent déjà leurs objets inutilisés.</p>
                        </div>
                        <p>Takalo est la plateforme idéale pour donner une seconde vie à vos objets. Inscrivez-vous gratuitement et commencez à échanger dès aujourd'hui.</p>
                        <p>Notre communauté grandit chaque jour, et nous sommes fiers de promouvoir l'échange durable et solidaire.</p>

                        <div class="main-border-button">
                            <a href="<?php echo $baseurl; ?>/inscription">Commencer l'échange</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="leather">
                                    <h4>Objets Divers</h4>
                                    <span>Dernières publications</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="first-image">
                                    <img src="<?php echo $baseurl ?>/assets/images/explore-image-01.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="second-image">
                                    <img src="<?php echo $baseurl ?>/assets/images/explore-image-02.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="types">
                                    <h4>Catégories Variées</h4>
                                    <span>Plus de 100 objets</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Explore Area Ends ***** -->

    <!-- ***** Social Area Starts ***** -->
    <section class="section" id="social">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Notre Communauté</h2>
                        <span>Rejoignez-nous sur les réseaux sociaux pour découvrir plus d'objets à échanger.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row images">
                <div class="col-2">
                    <div class="thumb">
                        <div class="icon">
                            <a href="http://facebook.com">
                                <h6>Facebook</h6>
                                <i class="fa fa-facebook"></i>
                            </a>
                        </div>
                        <img src="<?php echo $baseurl ?>/assets/images/instagram-01.jpg" alt="">
                    </div>
                </div>
                <div class="col-2">
                    <div class="thumb">
                        <div class="icon">
                            <a href="http://instagram.com">
                                <h6>Instagram</h6>
                                <i class="fa fa-instagram"></i>
                            </a>
                        </div>
                        <img src="<?php echo $baseurl ?>/assets/images/instagram-02.jpg" alt="">
                    </div>
                </div>
                <div class="col-2">
                    <div class="thumb">
                        <div class="icon">
                            <a href="http://twitter.com">
                                <h6>Twitter</h6>
                                <i class="fa fa-twitter"></i>
                            </a>
                        </div>
                        <img src="<?php echo $baseurl ?>/assets/images/instagram-03.jpg" alt="">
                    </div>
                </div>
                <div class="col-2">
                    <div class="thumb">
                        <div class="icon">
                            <a href="http://linkedin.com">
                                <h6>LinkedIn</h6>
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </div>
                        <img src="<?php echo $baseurl ?>/assets/images/instagram-04.jpg" alt="">
                    </div>
                </div>
                <div class="col-2">
                    <div class="thumb">
                        <div class="icon">
                            <a href="http://youtube.com">
                                <h6>YouTube</h6>
                                <i class="fa fa-youtube"></i>
                            </a>
                        </div>
                        <img src="<?php echo $baseurl ?>/assets/images/instagram-05.jpg" alt="">
                    </div>
                </div>
                <div class="col-2">
                    <div class="thumb">
                        <div class="icon">
                            <a href="http://tiktok.com">
                                <h6>TikTok</h6>
                                <i class="fa fa-tiktok"></i>
                            </a>
                        </div>
                        <img src="<?php echo $baseurl ?>/assets/images/instagram-06.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Social Area Ends ***** -->

   
    <?php include 'includes/footer.php'; ?>

    <!-- jQuery -->
    <script src="<?php echo $baseurl ?>/assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="<?php echo $baseurl ?>/assets/js/popper.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="<?php echo $baseurl ?>/assets/js/owl-carousel.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/accordions.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/datepicker.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/scrollreveal.min.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/waypoints.min.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/jquery.counterup.min.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/imgfix.min.js"></script> 
    <script src="<?php echo $baseurl ?>/assets/js/slick.js"></script> 
    <script src="<?php echo $baseurl ?>/assets/js/lightbox.js"></script> 
    <script src="<?php echo $baseurl ?>/assets/js/isotope.js"></script> 
    
    <!-- Global Init -->
    <script src="<?php echo $baseurl ?>/assets/js/custom.js"></script>

</body>
</html>
