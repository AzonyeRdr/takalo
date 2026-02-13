<!DOCTYPE html>
<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
$baseurl = Flight::get('flight.base_url'); 
?>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="base-url" content="<?php echo $baseurl; ?>">
    <title>Takalo - Mes Objets</title>
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

    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Mes Objets</h2>
                        <span>Gérez vos objets disponibles à l'échange</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="section" id="product">
        <div class="container">
            <!-- Add button -->
            <div class="row mb-4">
                <div class="col-lg-12 text-right">
                    <div class="main-border-button d-inline-block">
                        <a href="<?php echo $baseurl; ?>/objets/ajout"><i class="fa fa-plus"></i> Ajouter un objet</a>
                    </div>
                </div>
            </div>

            <?php if (isset($objets) && empty($objets)): ?>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Vous n'avez aucun objet pour le moment.</p>
                    <div class="main-border-button d-inline-block">
                        <a href="<?php echo $baseurl; ?>/objets/ajout">Ajouter votre premier objet</a>
                    </div>
                </div>
            </div>
            <?php elseif (isset($objets)): ?>
                <?php foreach ($objets as $objet): ?>
                <div class="row mb-4" id="objet-row-<?php echo $objet->getId(); ?>">
                    <div class="col-lg-4">
                        <div class="left-images">
                            <?php $photo = $objet->getPhotoPrincipale(); ?>
                            <img src="<?php echo $baseurl ?>/assets/images/products/<?php echo $photo ? htmlspecialchars($photo->getChemin()) : 'default.jpg'; ?>" alt="<?php echo htmlspecialchars($objet->getTitre()); ?>" style="max-height: 200px; object-fit: cover; width: 100%;">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="right-content">
                            <h4><?php echo htmlspecialchars($objet->getTitre()); ?></h4>
                            <span class="price"><?php echo $objet->getPrixEstime() ? number_format($objet->getPrixEstime(), 2) . ' Ar' : 'À négocier'; ?></span>
                            <ul class="stars">
                                <li><i class="fa fa-tag"></i> <?php echo htmlspecialchars($objet->getCategorie()->getLibelle()); ?></li>
                                <li><i class="fa fa-info-circle"></i> <?php echo htmlspecialchars($objet->getEtat()->getLibelle()); ?></li>
                                <li><i class="fa fa-circle"></i> <?php echo htmlspecialchars($objet->getStatut()->getLibelle()); ?></li>
                            </ul>
                            <span><?php echo htmlspecialchars($objet->getDescription()); ?></span>
                            <div class="quantity-content mt-3">
                                <div class="left-content">
                                    <div class="main-border-button">
                                        <a href="<?php echo $baseurl; ?>/objets/<?php echo $objet->getId(); ?>"><i class="fa fa-eye"></i> Voir</a>
                                    </div>
                                </div>
                                <div class="right-content">
                                    <div class="main-border-button">
                                        <a href="<?php echo $baseurl; ?>/objets/<?php echo $objet->getId(); ?>/edit"><i class="fa fa-pencil"></i> Modifier</a>
                                    </div>
                                </div>
                            </div>
                            <div class="total mt-2">
                                <div class="main-border-button">
                                    <a href="javascript:;" class="btn-delete-objet" data-id="<?php echo $objet->getId(); ?>"><i class="fa fa-trash"></i> Supprimer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <?php endforeach; ?>
            <?php else: ?>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Erreur: Variable $objets non définie.</p>
                </div>
            </div>
            <?php endif; ?>
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
