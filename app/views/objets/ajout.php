<!DOCTYPE html>
<?php $baseurl = Flight::get('flight.base_url'); ?>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="base-url" content="<?php echo $baseurl; ?>">
    <title>Takalo - Ajouter un objet</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>/assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $baseurl ?>/assets/css/templatemo-hexashop.css">
    <link rel="stylesheet" href="<?php echo $baseurl ?>/assets/css/owl-carousel.css">
    <link rel="stylesheet" href="<?php echo $baseurl ?>/assets/css/lightbox.css">
</head>

<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- Page Heading -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Ajouter un objet</h2>
                        <span>Proposez un nouvel objet à l'échange</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-us">
                        <div id="formAlert" class="alert d-none"></div>
                        <form id="formAjoutObjet" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label class="form-label">Titre *</label>
                                    <input type="text" name="titre" class="form-control" placeholder="Titre de l'objet" required>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="4" placeholder="Décrivez votre objet"></textarea>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Catégorie *</label>
                                    <select name="categorie_id" class="form-control" required>
                                        <option value="">-- Choisir --</option>
                                        <?php foreach ($categories as $cat): ?>
                                            <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['libelle']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">État *</label>
                                    <select name="etat_id" class="form-control" required>
                                        <option value="">-- Choisir --</option>
                                        <?php foreach ($etats as $etat): ?>
                                            <option value="<?php echo $etat['id']; ?>"><?php echo htmlspecialchars($etat['libelle']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Prix estimé (Ar)</label>
                                    <input type="number" name="prix_estime" class="form-control" placeholder="0.00" step="0.01" min="0">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="form-label">Photos de l'objet</label>
                                    <input type="file" name="photos[]" id="photosInput" class="form-control" multiple accept="image/*">
                                    <small class="form-text text-muted">Vous pouvez sélectionner plusieurs images</small>
                                </div>
                                <div class="col-lg-12 mb-3" id="photosPreviewContainer" style="display:none;">
                                    <label class="form-label">Choisissez l'image principale :</label>
                                    <div id="photosPreview" class="row"></div>
                                    <input type="hidden" name="photo_principale" id="photoPrincipale" value="0">
                                </div>
                                <div class="col-lg-6">
                                    <div class="main-border-button">
                                        <a href="<?php echo $baseurl; ?>/mes-objets"><i class="fa fa-arrow-left"></i> Retour</a>
                                    </div>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <button type="submit" class="main-dark-button"><i class="fa fa-plus"></i> Ajouter l'objet</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/../includes/footer.php'; ?>

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
    <script src="<?php echo $baseurl ?>/assets/js/custom.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/objets.js"></script>
</body>

</html>