
<!DOCTYPE html>
<?php $baseurl = Flight::get('flight.base_url'); ?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Hexashop - Product Detail Page</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl; ?>/assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl; ?>/assets/css/font-awesome.css">

    <link rel="stylesheet" href="<?php echo $baseurl; ?>/assets/css/templatemo-hexashop.css">

    <link rel="stylesheet" href="<?php echo $baseurl; ?>/assets/css/owl-carousel.css">

    <link rel="stylesheet" href="<?php echo $baseurl; ?>/assets/css/lightbox.css">
    <!--

TemplateMo 571 Hexashop

https://templatemo.com/tm-571-hexashop

-->
</head>
<script src="../inc/fonction.js"></script>

<body>

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
    <?php include('../inc/header_autre.php'); ?>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Single Product Page</h2>
                        <span>Awesome &amp; Creative HTML CSS layout by TemplateMo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->


    <!-- ***** Product Area Starts ***** -->
    <!-- <?php  ?> -->
    <section class="section" id="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="left-images">
                        <img src="<?php echo $baseurl; ?>/assets/images/<?= $m['image_produit']; ?> " alt="">
                        <?php if (!empty($i)) { ?>
                            <?php foreach ($img as $i) { ?>
                                <img src="<?php echo $baseurl; ?>/assets/images/<?= $i["url_image"] ?>" alt="">
                            <?php } ?>
                        <?php } else { ?>
                            <img src="<?php echo $baseurl; ?>/assets/images/single-product-02.jpg" alt="">
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="right-content">
                        <h4><?= $m['nom_produit']; ?></h4>
                        <span class="price">$<?= $m['prix_produit']; ?></span>
                        <ul class="stars">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                        </ul>
                        <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.</span>
                        <div class="quote">
                            <i class="fa fa-quote-left"></i>
                            <p><?= $m['description_produit']; ?></p>
                            <p>Categorie : <?= getCategorieById($m["id_categorie"])["nom_categorie"] ?></p>
                        </div>
                        <div class="quantity-content">
                            <div class="left-content">
                                <h6>No. of Orders</h6>
                            </div>
                            <div class="right-content">
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus" onclick="update_total(<?= $m['prix_produit']; ?>)">
                                    <input id="total" type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
                                    <input type="button" value="+" class="plus" onclick="update_total(<?= $m['prix_produit']; ?>)">
                                </div>
                            </div>
                        </div>
                        <div class="total">
                            <h4 id="tot">Total: $<?= $m['prix_produit']; ?></h4>
                            <div class="main-border-button"><a href="#">Add To Cart</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Product Area Ends ***** -->

    <!-- ***** Footer Start ***** -->
    <?php include("../inc/footer.php"); ?>


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
    <script src="<?php echo $baseurl; ?>/assets/js/quantity.js"></script>

    <!-- Global Init -->
    <script src="<?php echo $baseurl; ?>/assets/js/custom.js"></script>

    <script>
        $(function() {
            var selectedClass = "";
            $("p").click(function() {
                selectedClass = $(this).attr("data-rel");
                $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("." + selectedClass).fadeOut();
                setTimeout(function() {
                    $("." + selectedClass).fadeIn();
                    $("#portfolio").fadeTo(50, 1);
                }, 500);

            });
        });
    </script>

</body>

</html>