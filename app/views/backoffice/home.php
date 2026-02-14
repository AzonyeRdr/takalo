<!DOCTYPE html>
<?php
$baseurl = Flight::get('flight.base_url');
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Takalo - Administration</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>/assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $baseurl ?>/assets/css/templatemo-hexashop.css">
    <link rel="stylesheet" href="<?php echo $baseurl ?>/assets/css/backoffice.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
</head>

<body>

    <?php include __DIR__ . "/../includes/headeradmin.php"; ?>

    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Administration</h2>
                        <span>Tableau de bord administrateur</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pb-3">
                        <h3>Tableau de bord</h3>
                        <p class="small">Administrateur: <?php echo isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']->getNom()) : 'Admin'; ?></p>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <i class="fa fa-users fa-2x text-primary mb-2"></i>
                                    <h5 class="card-title">Utilisateurs</h5>
                                    <p class="card-text h4"><?php echo $nbUsers ?? 0; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <i class="fa fa-cube fa-2x text-success mb-2"></i>
                                    <h5 class="card-title">Objets</h5>
                                    <p class="card-text h4"><?php echo $nbObjets ?? 0; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <i class="fa fa-exchange fa-2x text-info mb-2"></i>
                                    <h5 class="card-title">Échanges</h5>
                                    <p class="card-text h4"><?php echo $nbEchanges ?? 0; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <i class="fa fa-tags fa-2x text-warning mb-2"></i>
                                    <h5 class="card-title">Catégories</h5>
                                    <p class="card-text h4"><?php echo $nbCategories ?? 0; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Actions rapides</h5>
                                    <p class="card-text">Accéder aux sections d'administration.</p>
                                    <a href="<?php echo $baseurl; ?>/backoffice/categories" class="btn btn-success mr-2"><i class="fa fa-tags"></i> Catégories</a>
                                    <a href="<?php echo $baseurl; ?>/backoffice/stats" class="btn btn-primary"><i class="fa fa-bar-chart"></i> Statistiques</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include __DIR__ . "/../includes/footer.php"; ?>

    <script src="<?php echo $baseurl ?>/assets/js/jquery-2.1.0.min.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/popper.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/custom.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/backoffice.js"></script>

</body>

</html>