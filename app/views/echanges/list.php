<!DOCTYPE html>
<?php $baseurl = Flight::get('flight.base_url'); ?>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="base-url" content="<?php echo $baseurl; ?>">
    <title>Takalo - Mes Échanges</title>
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
                        <h2>Mes Échanges</h2>
                        <span>Gérez vos propositions et réponses d'échanges</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <!-- Section: Mes propositions (où je suis impliqué) -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2><i class="fa fa-exchange"></i> Mes propositions</h2>
                        <span>Les échanges où vous êtes impliqué</span>
                    </div>
                </div>
            </div>

            <?php
            $mesPropositions = [];
            $propositionsAutres = [];
            foreach ($echanges as $e) {
                if ($e['demandeur_id'] == $userId || $e['receveur_id'] == $userId) {
                    $mesPropositions[] = $e;
                } else {
                    $propositionsAutres[] = $e;
                }
            }
            ?>

            <?php if (empty($mesPropositions)): ?>
            <div class="row mb-4">
                <div class="col-lg-12 text-center">
                    <p class="text-muted">Aucun échange en cours. Explorez les <a href="<?php echo $baseurl; ?>/objets">objets disponibles</a> !</p>
                </div>
            </div>
            <?php else: ?>
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Demandeur</th>
                                    <th>Receveur</th>
                                    <th>Statut</th>
                                    <th>Date demande</th>
                                    <th>Date réponse</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mesPropositions as $e): ?>
                                <tr id="echange-row-<?php echo $e['id']; ?>">
                                    <td><?php echo $e['id']; ?></td>
                                    <td>
                                        <?php echo htmlspecialchars($e['demandeur_nom']); ?>
                                        <?php if ($e['demandeur_id'] == $userId): ?>
                                        <span class="badge badge-info">Moi</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($e['receveur_nom']); ?>
                                        <?php if ($e['receveur_id'] == $userId): ?>
                                        <span class="badge badge-info">Moi</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $badgeClass = 'badge-secondary';
                                        if ($e['statut_code'] === 'en_attente') $badgeClass = 'badge-warning';
                                        elseif ($e['statut_code'] === 'accepte') $badgeClass = 'badge-success';
                                        elseif ($e['statut_code'] === 'refuse') $badgeClass = 'badge-danger';
                                        ?>
                                        <span class="badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars($e['statut_libelle']); ?></span>
                                    </td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($e['date_demande'])); ?></td>
                                    <td><?php echo $e['date_reponse'] ? date('d/m/Y H:i', strtotime($e['date_reponse'])) : '-'; ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-info btn-detail-echange" data-id="<?php echo $e['id']; ?>">
                                            <i class="fa fa-eye"></i> Détail
                                        </button>

                                        <?php if ($e['statut_code'] === 'en_attente'): ?>
                                            <?php if ($e['demandeur_id'] == $userId): ?>
                                            <!-- Je suis le demandeur: je peux annuler -->
                                            <button class="btn btn-sm btn-danger btn-annuler-echange" data-id="<?php echo $e['id']; ?>">
                                                <i class="fa fa-times"></i> Annuler
                                            </button>
                                            <?php else: ?>
                                            <!-- Je suis le receveur: je peux accepter ou refuser -->
                                            <button class="btn btn-sm btn-success btn-accepter-echange" data-id="<?php echo $e['id']; ?>">
                                                <i class="fa fa-check"></i> Accepter
                                            </button>
                                            <button class="btn btn-sm btn-danger btn-refuser-echange" data-id="<?php echo $e['id']; ?>">
                                                <i class="fa fa-times"></i> Refuser
                                            </button>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Modal Détail Échange -->
    <div class="modal fade" id="modalDetailEchange" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-exchange"></i> Détail de l'échange</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" id="detailEchangeBody">
                    <div class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

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
