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
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>/assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $baseurl ?>/assets/css/templatemo-hexashop.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
</head>
<body>
    
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 bg-dark text-white min-vh-100 p-0">
            <div class="p-4 bg-secondary">
                <h3 class="mb-0"><i class="fa fa-exchange"></i> Takalo</h3>
                <p class="mb-0 small opacity-75">Administration</p>
            </div>
            <nav class="nav flex-column py-3">
                <a class="nav-link text-white active" href="<?php echo $baseurl; ?>/backoffice"><i class="fa fa-dashboard mr-2"></i> Tableau de bord</a>
                <a class="nav-link text-white" href="#"><i class="fa fa-users mr-2"></i> Utilisateurs</a>
                <a class="nav-link text-white" href="#"><i class="fa fa-cube mr-2"></i> Objets</a>
                <a class="nav-link text-white" href="#"><i class="fa fa-exchange mr-2"></i> Échanges</a>
                <a class="nav-link text-white" href="#"><i class="fa fa-tags mr-2"></i> Catégories</a>
                <hr class="my-3">
                <a class="nav-link text-white" href="<?php echo $baseurl; ?>/index"><i class="fa fa-home mr-2"></i> Retour au site</a>
                <a class="nav-link text-white" href="<?php echo $baseurl; ?>/logout"><i class="fa fa-sign-out mr-2"></i> Déconnexion</a>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-10 p-0">
            <!-- Header -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <h1 class="navbar-brand mb-0"><i class="fa fa-dashboard"></i> Tableau de bord</h1>
                    <span class="navbar-text">Administrateur: <?php echo isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']->getEmail()) : 'Admin'; ?></span>
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
                                <p class="card-text h4">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <i class="fa fa-cube fa-2x text-success mb-2"></i>
                                <h5 class="card-title">Objets</h5>
                                <p class="card-text h4">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <i class="fa fa-exchange fa-2x text-info mb-2"></i>
                                <h5 class="card-title">Échanges</h5>
                                <p class="card-text h4">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <i class="fa fa-tags fa-2x text-warning mb-2"></i>
                                <h5 class="card-title">Catégories</h5>
                                <p class="card-text h4">0</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Activity -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5><i class="fa fa-cube"></i> Objets récents</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Aucun objet récent.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5><i class="fa fa-exchange"></i> Échanges récents</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Aucun échange récent.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- jQuery -->
    <script src="<?php echo $baseurl ?>/assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="<?php echo $baseurl ?>/assets/js/popper.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
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
    
    <!-- Global Init -->
    <script src="<?php echo $baseurl ?>/assets/js/custom.js"></script>

</body>
</html>