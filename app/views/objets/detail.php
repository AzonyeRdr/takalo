<!DOCTYPE html>
<?php $baseurl = Flight::get('flight.base_url'); ?>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="base-url" content="<?php echo $baseurl; ?>">
    <title>Takalo - <?php echo htmlspecialchars($objet->getTitre()); ?></title>
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
                        <h2><?php echo htmlspecialchars($objet->getTitre()); ?></h2>
                        <span>Fiche détaillée de l'objet</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Detail -->
    <section class="section" id="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="left-images">
                        <?php $photos = $objet->getPhotos(); ?>
                        <?php if (!empty($photos)): ?>
                            <?php foreach ($photos as $photo): ?>
                            <img src="<?php echo $baseurl ?>/assets/images/products/<?php echo htmlspecialchars($photo->getChemin()); ?>" alt="<?php echo htmlspecialchars($objet->getTitre()); ?>">
                            <?php endforeach; ?>
                        <?php else: ?>
                            <img src="<?php echo $baseurl ?>/assets/images/products/default.jpg" alt="Pas de photo">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="right-content">
                        <h4><?php echo htmlspecialchars($objet->getTitre()); ?></h4>
                        <span class="price"><?php echo $objet->getPrixEstime() ? number_format($objet->getPrixEstime(), 2) . ' Ar' : 'À négocier'; ?></span>
                        
                        <ul class="stars">
                            <li><i class="fa fa-tag"></i> <?php echo htmlspecialchars($objet->getCategorie()->getLibelle()); ?></li>
                        </ul>
                        
                        <span><?php echo htmlspecialchars($objet->getDescription()); ?></span>
                        
                        <div class="quote">
                            <i class="fa fa-quote-left"></i>
                            <p><strong>État :</strong> <?php echo htmlspecialchars($objet->getEtat()->getLibelle()); ?></p>
                            <p><strong>Statut :</strong> <?php echo htmlspecialchars($objet->getStatut()->getLibelle()); ?></p>
                            <p><strong>Propriétaire :</strong> <?php echo htmlspecialchars($objet->getProprietaire()->getNom()); ?></p>
                        </div>

                        <?php if (isset($_SESSION['user']) && $_SESSION['user']->getId() !== $objet->getProprietaire()->getId() && $objet->getStatut()->getId() == 1): ?>
                        <div class="total">
                            <div class="main-border-button">
                                <a href="javascript:;" data-toggle="modal" data-target="#modalEchange"><i class="fa fa-exchange"></i> Proposer un échange</a>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="total mt-3">
                            <div class="main-border-button">
                                <a href="<?php echo $baseurl; ?>/objets"><i class="fa fa-arrow-left"></i> Retour à la liste</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Historique des propriétaires -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Historique des propriétaires</h2>
                        <span>Parcours de cet objet au fil des échanges</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><i class="fa fa-user"></i> Propriétaire</th>
                                <th><i class="fa fa-calendar"></i> Date d'acquisition</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($historique)): ?>
                                <?php foreach ($historique as $h): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($h['proprietaire']); ?></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($h['date_acquisition'])); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="2" class="text-center">Aucun historique disponible</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Proposer Échange -->
    <?php if (isset($_SESSION['user']) && $_SESSION['user']->getId() !== $objet->getProprietaire()->getId()): ?>
    <div class="modal fade" id="modalEchange" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-exchange"></i> Proposer un échange</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Vous souhaitez échanger contre : <strong><?php echo htmlspecialchars($objet->getTitre()); ?></strong></p>
                    <div class="form-group">
                        <label for="objetOffert">Choisissez un de vos objets à proposer :</label>
                        <select id="objetOffert" class="form-control">
                            <option value="">-- Sélectionner un objet --</option>
                            <?php foreach ($mesObjets as $monObjet): ?>
                            <option value="<?php echo $monObjet->getId(); ?>"><?php echo htmlspecialchars($monObjet->getTitre()); ?> (<?php echo number_format($monObjet->getPrixEstime(), 2); ?> Ar)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="echangeAlert" class="alert d-none mt-2"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="btnProposerEchange" data-objet-demande="<?php echo $objet->getId(); ?>">
                        <i class="fa fa-paper-plane"></i> Proposer l'échange
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

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
    <script src="<?php echo $baseurl ?>/assets/js/echanges.js"></script>
</body>
</html>
