<!DOCTYPE html>
<?php $baseurl = Flight::get('flight.base_url'); ?>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="base-url" content="<?php echo $baseurl; ?>">
    <title>Takalo - Modifier l'objet</title>
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
        <div class="jumper"><div></div><div></div><div></div></div>
    </div>

    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Modifier l'objet</h2>
                        <span><?php echo htmlspecialchars($objet->getTitre()); ?></span>
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
                        <form id="formEditObjet" enctype="multipart/form-data" data-id="<?php echo $objet->getId(); ?>">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label class="form-label">Titre *</label>
                                    <input type="text" name="titre" class="form-control" value="<?php echo htmlspecialchars($objet->getTitre()); ?>" required>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="4"><?php echo htmlspecialchars($objet->getDescription()); ?></textarea>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Catégorie *</label>
                                    <select name="categorie_id" class="form-control" required>
                                        <?php foreach ($categories as $cat): ?>
                                        <option value="<?php echo $cat['id']; ?>" <?php echo $cat['id'] == $objet->getCategorie()->getId() ? 'selected' : ''; ?>><?php echo htmlspecialchars($cat['libelle']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">État *</label>
                                    <select name="etat_id" class="form-control" required>
                                        <?php foreach ($etats as $etat): ?>
                                        <option value="<?php echo $etat['id']; ?>" <?php echo $etat['id'] == $objet->getEtat()->getId() ? 'selected' : ''; ?>><?php echo htmlspecialchars($etat['libelle']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Prix estimé (Ar)</label>
                                    <input type="number" name="prix_estime" class="form-control" value="<?php echo $objet->getPrixEstime(); ?>" step="0.01" min="0">
                                </div>

                                <!-- Photos actuelles -->
                                <div class="col-lg-12 mb-3">
                                    <label class="form-label">Photos actuelles :</label>
                                    <div class="row">
                                        <?php foreach ($objet->getPhotos() as $photo): ?>
                                        <div class="col-3 text-center mb-2">
                                            <img src="<?php echo $baseurl ?>/assets/images/products/<?php echo htmlspecialchars($photo->getChemin()); ?>" alt="" class="img-fluid">
                                            <?php if ($photo->getEstPrincipale()): ?>
                                            <span class="badge badge-primary">Principale</span>
                                            <?php endif; ?>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <label class="form-label">Remplacer les photos (optionnel)</label>
                                    <input type="file" name="photos[]" id="photosInput" class="form-control" multiple accept="image/*">
                                    <small class="form-text text-muted">Si vous sélectionnez de nouvelles photos, elles remplaceront les anciennes</small>
                                </div>
                                <div class="col-lg-12 mb-3" id="photoPreviewContainer" style="display:none;">
                                    <label class="form-label">Choisissez l'image principale :</label>
                                    <div id="photoPreview" class="row"></div>
                                    <input type="hidden" name="photo_principale" id="photoPrincipale" value="0">
                                </div>

                                <div class="col-lg-6">
                                    <div class="main-border-button">
                                        <a href="<?php echo $baseurl; ?>/mes-objets"><i class="fa fa-arrow-left"></i> Retour</a>
                                    </div>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <button type="submit" class="main-dark-button"><i class="fa fa-save"></i> Enregistrer</button>
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
