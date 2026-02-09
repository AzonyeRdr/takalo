
<?php
ini_set("display_errors", 1);
require_once('../inc/func.php');
$categ = getCateg();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Hexashop - Ajouter un Produit</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-hexashop.css">
    <link rel="stylesheet" href="../assets/css/owl-carousel.css">
    <link rel="stylesheet" href="../assets/css/lightbox.css">

    <link rel="stylesheet" href="../assets/css/styles2.css">
</head>

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
                        <h2>Ajouter un Produit</h2>
                        <span>Ajoutez un nouveau produit à votre catalogue</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Form Product Area Starts ***** -->
    <section class="section" id="product">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="form-container">
                        
                        <!-- Messages d'erreur et de succès -->
                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Erreur!</strong> <?= htmlspecialchars(urldecode($_GET['error'])) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (isset($_GET['success'])): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Succès!</strong> Produit ajouté avec succès! 
                                <?php if (isset($_GET['images_uploaded'])): ?>
                                    (<?= $_GET['images_uploaded'] ?> image(s) uploadée(s))
                                <?php endif; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form id="productForm" action="../traitements/upload-product.php" method="POST" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label for="nom_produit" class="form-label">
                                    Nom du produit <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" name="nom_produit" id="nom_produit" required 
                                       placeholder="Entrez le nom du produit">
                            </div>

                            <div class="form-group">
                                <label for="desc_produit" class="form-label">
                                    Description du produit <span class="required">*</span>
                                </label>
                                <textarea class="form-control" name="desc_produit" id="desc_produit" rows="4" required 
                                          placeholder="Décrivez votre produit..."></textarea>
                            </div>

                            <div class="form-group">
                                <label for="prix_produit" class="form-label">
                                    Prix du produit (€) <span class="required">*</span>
                                </label>
                                <input type="number" class="form-control" name="prix_produit" id="prix_produit" 
                                       step="0.01" min="0" required placeholder="0.00">
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    Images du produit <span class="required">*</span>
                                    <small class="text-muted">(Minimum 2 images - JPG, PNG, GIF, WEBP - Max 10MB chacune)</small>
                                </label>
                                
                                <div class="add-image-btn" onclick="document.getElementById('imageInput').click()">
                                    <i class="fa fa-plus" style="font-size: 24px; color: #666; margin-bottom: 10px;"></i>
                                    <div style="font-weight: 500;">Ajouter une image</div>
                                    <small style="color: #666;">Cliquez pour sélectionner une image</small>
                                </div>
                                
                                <input type="file" id="imageInput" accept="image/*" style="display: none;">
                                
                                <div id="imageList" class="image-list"></div>
                                
                                <div id="imageCount" class="image-count-info">
                                    0 image(s) sélectionnée(s) - Minimum 2 requis
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="categorie" class="form-label">
                                    Catégorie du produit <span class="required">*</span>
                                </label>
                                <select class="" name="categorie" id="categorie" required>
                                    <option value="">Sélectionnez une catégorie</option>
                                    <?php foreach ($categ as $c): ?>
                                        <option value="<?= $c['id_categorie']; ?>">
                                            <?= htmlspecialchars($c['nom_categorie']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-lg" id="submitBtn" disabled>
                                    <i class="fa fa-upload"></i> Ajouter le produit
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Form Product Area Ends ***** -->

    <!-- ***** Footer Start ***** -->
    <?php include("../inc/footer.php"); ?>

    <!-- jQuery -->
    <script src="../assets/js/jquery-2.1.0.min.js"></script>
    <!-- Bootstrap -->
    <script src="../assets/js/popper.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- Plugins -->
    <script src="../assets/js/owl-carousel.js"></script>
    <script src="../assets/js/accordions.js"></script>
    <script src="../assets/js/datepicker.js"></script>
    <script src="../assets/js/scrollreveal.min.js"></script>
    <script src="../assets/js/waypoints.min.js"></script>
    <script src="../assets/js/jquery.counterup.min.js"></script>
    <script src="../assets/js/imgfix.min.js"></script>
    <script src="../assets/js/slick.js"></script>
    <script src="../assets/js/lightbox.js"></script>
    <script src="../assets/js/isotope.js"></script>
    <script src="../assets/js/quantity.js"></script>
    <!-- Global Init -->
    <script src="../assets/js/custom.js"></script>

    <script src="../inc/fonction-upload.js"></script>

</body>
</html>