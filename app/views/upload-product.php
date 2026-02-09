<!DOCTYPE html>
<?php $baseurl = Flight::get('flight.base_url'); ?>
<html lang="en">

<head>
    <meta charset="utf-8">    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">eta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">n" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <title>Hexashop - Ajouter un Produit</title>oduit</title>

    <!-- Additional CSS Files -->    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>/assets/css/bootstrap.min.css">"<?php echo $baseurl ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>/assets/css/font-awesome.css">    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>/assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $baseurl ?>/assets/css/templatemo-hexashop.css"><?php echo $baseurl ?>/assets/css/templatemo-hexashop.css">
    <link rel="stylesheet" href="<?php echo $baseurl ?>/assets/css/owl-carousel.css">
    <link rel="stylesheet" href="<?php echo $baseurl ?>/assets/css/lightbox.css">
    <link rel="stylesheet" href="<?php echo $baseurl ?>/assets/css/styles2.css">
</head>

<body><body>
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">v id="preloader">
        <div class="jumper">        <div class="jumper">
            <div></div>      <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->r End ***** -->

    <!-- ***** Header Area Start ***** --> Header Area Start ***** -->
    <header class="header-area header-sticky">r class="header-area header-sticky">
        <div class="container">
            <div class="row">            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <a href="/" class="logo">s="logo">
                            <img src="<?php echo $baseurl ?>/assets/images/logo.png">                            <img src="<?php echo $baseurl ?>/assets/images/logo.png">
                        </a>
                        <ul class="nav">>
                            <li class="scroll-to-section"><a href="/">Home</a></li> class="scroll-to-section"><a href="/">Home</a></li>
                            <li class="scroll-to-section"><a href="/about">About Us</a></li>li class="scroll-to-section"><a href="/about">About Us</a></li>
                            <li class="scroll-to-section"><a href="/contact">Contact</a></li>scroll-to-section"><a href="/contact">Contact</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>a>
                    </nav>nav>
                </div>div>
            </div>div>
        </div>div>
    </header>
    <!-- ***** Header Area End ***** -->    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->* -->
    <div class="page-heading" id="top">d="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content"> class="inner-content">
                        <h2>Ajouter un Produit</h2>
                        <span>Ajoutez un nouveau produit à votre catalogue</span>otre catalogue</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->er Area End ***** -->

    <!-- ***** Form Product Area Starts ***** -->
    <section class="section" id="product">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="form-container">

                        <form id="productForm" action="#" method="POST" enctype="multipart/form-data">ctForm" action="#" method="POST" enctype="multipart/form-data">
                                                        
                            <div class="form-group">
                                <label for="nom_produit" class="form-label">    <label for="nom_produit" class="form-label">
                                    Nom du produit <span class="required">*</span>span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" name="nom_produit" id="nom_produit" required produit" id="nom_produit" required 
                                       placeholder="Entrez le nom du produit">laceholder="Entrez le nom du produit">
                            </div>

                            <div class="form-group">lass="form-group">
                                <label for="desc_produit" class="form-label">                                <label for="desc_produit" class="form-label">
                                    Description du produit <span class="required">*</span>roduit <span class="required">*</span>
                                </label>
                                <textarea class="form-control" name="desc_produit" id="desc_produit" rows="4" required c_produit" rows="4" required 
                                          placeholder="Décrivez votre produit..."></textarea>  placeholder="Décrivez votre produit..."></textarea>
                            </div>

                            <div class="form-group">lass="form-group">
                                <label for="prix_produit" class="form-label">                                <label for="prix_produit" class="form-label">
                                    Prix du produit (€) <span class="required">*</span>(€) <span class="required">*</span>
                                </label>
                                <input type="number" class="form-control" name="prix_produit" id="prix_produit" oduit" id="prix_produit" 
                                       step="0.01" min="0" required placeholder="0.00">tep="0.01" min="0" required placeholder="0.00">
                            </div>

                            <div class="form-group">lass="form-group">
                                <label class="form-label">                                <label class="form-label">
                                    Images du produit <span class="required">*</span>t <span class="required">*</span>
                                    <small class="text-muted">(Minimum 2 images - JPG, PNG, GIF, WEBP - Max 10MB chacune)</small>ed">(Minimum 2 images - JPG, PNG, GIF, WEBP - Max 10MB chacune)</small>
                                </label>
                                
                                <div class="add-image-btn" onclick="document.getElementById('imageInput').click()">ss="add-image-btn" onclick="document.getElementById('imageInput').click()">
                                    <i class="fa fa-plus" style="font-size: 24px; color: #666; margin-bottom: 10px;"></i>    <i class="fa fa-plus" style="font-size: 24px; color: #666; margin-bottom: 10px;"></i>
                                    <div style="font-weight: 500;">Ajouter une image</div>
                                    <small style="color: #666;">Cliquez pour sélectionner une image</small>
                                </div>
                                
                                <input type="file" id="imageInput" accept="image/*" style="display: none;"> type="file" id="imageInput" accept="image/*" style="display: none;">
                                
                                <div id="imageList" class="image-list"></div>
                                
                                <div id="imageCount" class="image-count-info">>
                                    0 image(s) sélectionnée(s) - Minimum 2 requis    0 image(s) sélectionnée(s) - Minimum 2 requis
                                </div>
                            </div>

                            <div class="form-group">lass="form-group">
                                <label for="categorie" class="form-label">                                <label for="categorie" class="form-label">
                                    Catégorie du produit <span class="required">*</span>duit <span class="required">*</span>
                                </label>
                                <select class="" name="categorie" id="categorie" required>d>
                                    <option value="">Sélectionnez une catégorie</option>ion value="">Sélectionnez une catégorie</option>
                                    <option value="1">Men</option>
                                    <option value="2">Women</option>
                                    <option value="3">Kids</option>
                                    <option value="4">Accessories</option>
                                </select>
                            </div>

                            <div class="form-group text-center">orm-group text-center">
                                <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">utton type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                    <i class="fa fa-upload"></i> Ajouter le produit                                    <i class="fa fa-upload"></i> Ajouter le produit
                                </button>
                            </div>

                        </form>
                    </div>
                </div>                </div>
            </div>
        </div>
    </section>
    <!-- ***** Form Product Area Ends ***** -->m Product Area Ends ***** -->

    <!-- ***** Footer Start ***** --> Footer Start ***** -->
    <footer>
        <div class="container">        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="first-item">                    <div class="first-item">
                        <div class="logo">     <div class="logo">
                            <img src="<?php echo $baseurl ?>/assets/images/white-logo.png" alt="">
                        </div>  </div>
                        <ul>
                            <li><a href="#">16501 Collins Ave, Sunny Isles Beach</a></li>ch</a></li>
                            <li><a href="#">hexashop@company.com</a></li>        <li><a href="#">hexashop@company.com</a></li>
                            <li><a href="#">010-020-0340</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <h4>Shopping &amp; Categories</h4>
                    <ul>
                        <li><a href="#">Men's Shopping</a></li>
                        <li><a href="#">Women's Shopping</a></li>
                        <li><a href="#">Kid's Shopping</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Useful Links</h4>                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Homepage</a></li>                        <li><a href="#">Homepage</a></li>
                        <li><a href="#">About Us</a></li>                 <li><a href="#">About Us</a></li>
                        <li><a href="#">Help</a></li>                 <li><a href="#">Help</a></li>












































</html></body>    <script src="<?php echo $baseurl ?>/assets/js/custom.js"></script>    <!-- Global Init -->    <script src="<?php echo $baseurl ?>/assets/js/quantity.js"></script>    <script src="<?php echo $baseurl ?>/assets/js/isotope.js"></script>    <script src="<?php echo $baseurl ?>/assets/js/lightbox.js"></script>    <script src="<?php echo $baseurl ?>/assets/js/slick.js"></script>    <script src="<?php echo $baseurl ?>/assets/js/imgfix.min.js"></script>    <script src="<?php echo $baseurl ?>/assets/js/jquery.counterup.min.js"></script>    <script src="<?php echo $baseurl ?>/assets/js/waypoints.min.js"></script>    <script src="<?php echo $baseurl ?>/assets/js/scrollreveal.min.js"></script>    <script src="<?php echo $baseurl ?>/assets/js/datepicker.js"></script>    <script src="<?php echo $baseurl ?>/assets/js/accordions.js"></script>    <script src="<?php echo $baseurl ?>/assets/js/owl-carousel.js"></script>    <!-- Plugins -->    <script src="<?php echo $baseurl ?>/assets/js/bootstrap.min.js"></script>    <script src="<?php echo $baseurl ?>/assets/js/popper.js"></script>    <!-- Bootstrap -->    <script src="<?php echo $baseurl ?>/assets/js/jquery-2.1.0.min.js"></script>    <!-- jQuery -->    </footer>        </div>            </div>                </div>                    </div>                        <p>Copyright © 2022 HexaShop Co., Ltd. All Rights Reserved.</p>                    <div class="under-footer">                <div class="col-lg-12">                </div>                    </ul>                        <li><a href="#">Tracking ID</a></li>                        <li><a href="#">Shipping</a></li>                        <li><a href="#">FAQ's</a></li>                        <li><a href="#">Help</a></li>                    <ul>                    <h4>Help &amp; Information</h4>                <div class="col-lg-3">                </div>                    </ul>                        <li><a href="#">Contact Us</a></li>                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Help &amp; Information</h4>
                    <ul>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">FAQ's</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Tracking ID</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="under-footer">
                        <p>Copyright © 2022 HexaShop Co., Ltd. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

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
