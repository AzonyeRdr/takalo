<!DOCTYPE html>
<?php $baseurl = Flight::get('flight.base_url'); ?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <title>Hexashop - Product List Page</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>/assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $baseurl ?>/assets/css/templatemo-hexashop.css">
    <link rel="stylesheet" href="<?php echo $baseurl ?>/assets/css/owl-carousel.css">
    <link rel="stylesheet" href="<?php echo $baseurl ?>/assets/css/lightbox.css">
    <link rel="stylesheet" href="<?php echo $baseurl ?>/assets/css/styles.css">
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

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <a href="/" class="logo">
                            <img src="<?php echo $baseurl ?>/assets/images/logo.png">
                        </a>
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="/">Home</a></li>
                            <li class="scroll-to-section"><a href="/about">About Us</a></li>
                            <li class="scroll-to-section"><a href="/contact">Contact</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>List Products Page</h2>
                        <span>Awesome &amp; Creative HTML CSS layout by TemplateMo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Product Area Starts ***** -->
    <section class="section" id="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="left-images">
                        <img src="<?php echo $baseurl ?>/assets/images/single-product-01.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="right-content">
                        <h4>Produit Test 1</h4>
                        <span class="price">$120.00</span>
                        <ul class="stars">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                        </ul>
                        <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                        <div class="quote">
                            <i class="fa fa-quote-left"></i>
                            <p>Description du produit test 1</p>
                            <p>Categorie : Men</p>
                        </div>
                        <div class="quantity-content">
                            <div class="left-content">
                                <div class="main-border-button"><a href="#">Modifier</a></div>
                            </div>
                            <div class="right-content">
                                <div class="main-border-button"><a href="#">Supprimer</a></div>
                            </div>
                        </div>
                        <div class="total">
                            <div class="main-border-button"><a href="/single-product">Voir le Produit</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="left-images">
                        <img src="<?php echo $baseurl ?>/assets/images/single-product-02.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="right-content">
                        <h4>Produit Test 2</h4>
                        <span class="price">$85.00</span>
                        <ul class="stars">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                        </ul>
                        <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                        <div class="quote">
                            <i class="fa fa-quote-left"></i>
                            <p>Description du produit test 2</p>
                            <p>Categorie : Women</p>
                        </div>
                        <div class="quantity-content">
                            <div class="left-content">
                                <div class="main-border-button"><a href="#">Modifier</a></div>
                            </div>
                            <div class="right-content">
                                <div class="main-border-button"><a href="#">Supprimer</a></div>
                            </div>
                        </div>
                        <div class="total">
                            <div class="main-border-button"><a href="/single-product">Voir le Produit</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Product Area Ends ***** -->

    <?php include 'includes/footer.php'; ?>

    <!-- jQuery -->
    <script src="<?php echo $baseurl ?>/assets/js/jquery-2.1.0.min.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/popper.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/bootstrap.min.js"></script>
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
    <script src="<?php echo $baseurl ?>/assets/js/quantity.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/custom.js"></script>

</body>

</html>
