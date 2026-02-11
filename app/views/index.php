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
                                    <a href="#recent">Découvrir les objets</a>
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
                                                    <a href="<?php echo $baseurl; ?>/login">Parcourir</a>
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
                                                    <a href="<?php echo $baseurl; ?>/inscription">S'inscrire</a>
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

    <!-- ***** Statistics Section Start ***** -->
    <!-- ***** Categories Section Start ***** -->
    <section class="section" id="categories">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Catégories populaires</h2>
                        <span>Explorez nos différentes catégories d'objets</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php foreach ($categories as $categorie): ?>
                <div class="col-lg-3 col-md-6">
                    <div class="item">
                        <div class="thumb">
                            <div class="hover-content">
                                <div class="inner">
                                    <h4><?php echo htmlspecialchars($categorie['libelle']); ?></h4>
                                    <p><?php echo $categorie['objet_count']; ?> objet<?php echo $categorie['objet_count'] > 1 ? 's' : ''; ?></p>
                                    <div class="main-border-button">
                                        <a href="<?php echo $baseurl; ?>/list-produit?categorie=<?php echo $categorie['id']; ?>">Explorer</a>
                                    </div>
                                </div>
                            </div>
                            <div class="down-content">
                                <h4><?php echo htmlspecialchars($categorie['libelle']); ?></h4>
                                <span><?php echo $categorie['objet_count']; ?> objet<?php echo $categorie['objet_count'] > 1 ? 's' : ''; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- ***** Categories Section End ***** -->

    <!-- ***** Recent Objects Section Start ***** -->
    <section class="section" id="recent">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Objets récemment ajoutés</h2>
                        <span>Découvrez les derniers objets disponibles pour l'échange</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php if (empty($recentObjects)): ?>
                    <div class="col-lg-12 text-center">
                        <p>Aucun objet disponible pour le moment. Soyez le premier à proposer un objet !</p>
                        <div class="main-border-button">
                            <a href="<?php echo $baseurl; ?>/inscription">Commencer</a>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($recentObjects as $objet): ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="item">
                            <div class="thumb">
                                <?php if ($objet['photo_principale']): ?>
                                    <img src="<?php echo $baseurl . '/' . htmlspecialchars($objet['photo_principale']); ?>" alt="">
                                <?php else: ?>
                                    <img src="<?php echo $baseurl ?>/assets/images/explore-image-01.jpg" alt="">
                                <?php endif; ?>
                                <div class="hover-content">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                        <li><a href="#"><i class="fa fa-exchange"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="down-content">
                                <h4><?php echo htmlspecialchars($objet['titre']); ?></h4>
                                <span><?php echo $objet['prix_estime'] ? number_format($objet['prix_estime'], 2) . ' Ar' : 'À négocier'; ?></span>
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <p><small>Proposé par <?php echo htmlspecialchars($objet['proprietaire_nom']); ?></small></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
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
                    <div class="item">
                        <div class="icon">
                            <i class="fa fa-user-plus"></i>
                        </div>
                        <h4>1. Inscrivez-vous</h4>
                        <p>Créez votre compte gratuitement en quelques secondes et rejoignez notre communauté d'échangistes.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="item">
                        <div class="icon">
                            <i class="fa fa-camera"></i>
                        </div>
                        <h4>2. Ajoutez vos objets</h4>
                        <p>Prenez des photos de vos objets, ajoutez une description et publiez-les sur la plateforme.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="item">
                        <div class="icon">
                            <i class="fa fa-exchange"></i>
                        </div>
                        <h4>3. Échangez !</h4>
                        <p>Trouvez des objets qui vous intéressent et proposez des échanges avec d'autres utilisateurs.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** How It Works Section End ***** -->

    <!-- ***** Call to Action Start ***** -->
    <section class="section" id="subscribe">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-heading">
                        <h2>Prêt à échanger vos objets ?</h2>
                        <span>Rejoignez dès maintenant notre communauté et commencez à échanger !</span>
                    </div>
                    <div class="main-border-button">
                        <a href="<?php echo $baseurl; ?>/inscription">S'inscrire gratuitement</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="section-heading">
                        <h2>Besoin d'aide ?</h2>
                        <span>Notre équipe est là pour vous accompagner</span>
                    </div>
                    <div class="main-border-button">
                        <a href="<?php echo $baseurl; ?>/index#explore">En savoir plus</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Call to Action End ***** -->

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
