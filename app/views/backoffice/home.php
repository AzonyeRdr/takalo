<!DOCTYPE html>
<?php 
$baseurl = Flight::get('flight.base_url');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Takalo - Administration</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>/assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $baseurl ?>/assets/css/templatemo-hexashop.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
</head>
<body>
    
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include __DIR__ . '/sidebar.php'; ?>
        
        <!-- Main Content -->
        <div class="col-md-10 p-0">
            <!-- Header -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <h1 class="navbar-brand mb-0"><i class="fa fa-dashboard"></i> Tableau de bord</h1>
                    <span class="navbar-text">Administrateur: <?php echo isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']->getNom()) : 'Admin'; ?></span>
                </div>
            </nav>
            
            <!-- Content -->
            <div class="container-fluid py-4">
                <!-- Stats Cards -->
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

                <!-- Navigation Cards -->
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <h4 class="mb-3"><i class="fa fa-compass"></i> Naviguer vers...</h4>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fa fa-bar-chart fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">Statistiques</h5>
                                <p class="card-text">Voir les statistiques détaillées du site</p>
                                <a href="<?php echo $baseurl; ?>/backoffice/stats" class="btn btn-primary"><i class="fa fa-arrow-right"></i> Accéder</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fa fa-tags fa-3x text-success mb-3"></i>
                                <h5 class="card-title">Catégories</h5>
                                <p class="card-text">Gérer les catégories d'objets</p>
                                <a href="<?php echo $baseurl; ?>/backoffice/categories" class="btn btn-success"><i class="fa fa-arrow-right"></i> Accéder</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fa fa-home fa-3x text-info mb-3"></i>
                                <h5 class="card-title">Retour au site</h5>
                                <p class="card-text">Retourner à la page d'accueil</p>
                                <a href="<?php echo $baseurl; ?>/index" class="btn btn-info"><i class="fa fa-arrow-right"></i> Accéder</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="<?php echo $baseurl ?>/assets/js/jquery-2.1.0.min.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/popper.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/bootstrap.min.js"></script>

</body>
</html>