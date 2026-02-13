<!DOCTYPE html>
<?php $baseurl = Flight::get('flight.base_url'); ?>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="base-url" content="<?php echo $baseurl; ?>">
    <title>Takalo - Tous les objets</title>
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

    <!-- Page Heading -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Tous les objets</h2>
                        <span>Découvrez les objets disponibles à l'échange</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <section class="section" id="search">
        <div class="container">
            <div class="row mb-4">
                <div class="col-lg-6 offset-lg-1">
                    <input type="text" id="searchKeyword" class="form-control" placeholder="Rechercher un objet par titre...">
                </div>
                <div class="col-lg-3">
                    <select id="searchCategorie" class="form-control">
                        <option value="">Toutes les catégories</option>
                        <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['libelle']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-lg-2">
                    <div class="main-border-button">
                        <a href="javascript:;" id="btnSearch"><i class="fa fa-search"></i> Rechercher</a>
                    </div>
                </div>
            </div>

            <!-- Results -->
            <div class="row" id="objetsContainer">
                <?php if (empty($objets)): ?>
                <div class="col-lg-12 text-center">
                    <p>Aucun objet disponible pour le moment.</p>
                </div>
                <?php else: ?>
                    <?php foreach ($objets as $objet): ?>
                    <div class="col-lg-4 mb-4">
                        <div class="item">
                            <div class="thumb">
                                <?php $photo = $objet->getPhotoPrincipale(); ?>
                                <img src="<?php echo $baseurl ?>/assets/images/products/<?php echo $photo ? htmlspecialchars($photo->getChemin()) : 'default.jpg'; ?>" alt="<?php echo htmlspecialchars($objet->getTitre()); ?>">
                                <div class="hover-content">
                                    <ul>
                                        <li><a href="<?php echo $baseurl; ?>/objets/<?php echo $objet->getId(); ?>"><i class="fa fa-eye"></i></a></li>
                                        <?php if (isset($_SESSION['user']) && $_SESSION['user']->getId() !== $objet->getProprietaire()->getId()): ?>
                                        <li><a href="<?php echo $baseurl; ?>/objets/<?php echo $objet->getId(); ?>"><i class="fa fa-exchange"></i></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="down-content">
                                <h4><?php echo htmlspecialchars($objet->getTitre()); ?></h4>
                                <span><?php echo $objet->getPrixEstime() ? number_format($objet->getPrixEstime(), 2) . ' Ar' : 'À négocier'; ?></span>
                                <p><small><i class="fa fa-tag"></i> <?php echo htmlspecialchars($objet->getCategorie()->getLibelle()); ?></small></p>
                                <p><small><i class="fa fa-user"></i> <?php echo htmlspecialchars($objet->getProprietaire()->getNom()); ?></small></p>
                                <p><small><i class="fa fa-info-circle"></i> <?php echo htmlspecialchars($objet->getEtat()->getLibelle()); ?> - <?php echo htmlspecialchars($objet->getStatut()->getLibelle()); ?></small></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
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
