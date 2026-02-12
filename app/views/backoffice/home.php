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
    
    <!-- Sidebar Navigation -->
    <div style="position: fixed; left: 0; top: 0; width: 250px; height: 100vh; background: #2c3e50; color: white; overflow-y: auto; z-index: 1000;">
        <div style="padding: 30px 20px; background: rgba(0,0,0,0.2); border-bottom: 1px solid rgba(255,255,255,0.1);">
            <h3 style="margin: 0; font-size: 24px;"><i class="fa fa-exchange"></i> Takalo</h3>
            <p style="margin: 5px 0 0; font-size: 12px; opacity: 0.8;">Administration</p>
        </div>
        <ul style="list-style: none; padding: 0; margin: 20px 0;">
            <li><a href="<?php echo $baseurl; ?>/backoffice" style="display: flex; align-items: center; padding: 15px 25px; color: white; text-decoration: none; border-left: 3px solid white; background: rgba(255,255,255,0.1);"><i class="fa fa-dashboard" style="margin-right: 15px; width: 20px;"></i> Tableau de bord</a></li>
            <li><a href="#" style="display: flex; align-items: center; padding: 15px 25px; color: white; text-decoration: none; border-left: 3px solid transparent;"><i class="fa fa-users" style="margin-right: 15px; width: 20px;"></i> Utilisateurs</a></li>
            <li><a href="#" style="display: flex; align-items: center; padding: 15px 25px; color: white; text-decoration: none; border-left: 3px solid transparent;"><i class="fa fa-cube" style="margin-right: 15px; width: 20px;"></i> Objets</a></li>
            <li><a href="#" style="display: flex; align-items: center; padding: 15px 25px; color: white; text-decoration: none; border-left: 3px solid transparent;"><i class="fa fa-exchange" style="margin-right: 15px; width: 20px;"></i> Échanges</a></li>
            <li><a href="#" style="display: flex; align-items: center; padding: 15px 25px; color: white; text-decoration: none; border-left: 3px solid transparent;"><i class="fa fa-tags" style="margin-right: 15px; width: 20px;"></i> Catégories</a></li>
            <li><a href="<?php echo $baseurl; ?>/index" style="display: flex; align-items: center; padding: 15px 25px; color: white; text-decoration: none; border-left: 3px solid transparent;"><i class="fa fa-home" style="margin-right: 15px; width: 20px;"></i> Retour au site</a></li>
            <li><a href="<?php echo $baseurl; ?>/logout" style="display: flex; align-items: center; padding: 15px 25px; color: white; text-decoration: none; border-left: 3px solid transparent;"><i class="fa fa-sign-out" style="margin-right: 15px; width: 20px;"></i> Déconnexion</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div style="margin-left: 250px; min-height: 100vh; background: #f4f4f4;">
        
        <!-- Top Header -->
        <div style="background: white; padding: 20px 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h1 style="margin: 0; font-size: 28px; color: #2c3e50;"><i class="fa fa-dashboard"></i> Tableau de bord</h1>
            <p style="margin: 5px 0 0; color: #7f8c8d;">Administrateur: <?php echo isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']->getEmail()) : 'Admin'; ?></p>
        </div>

        <!-- Content -->
        <div class="container-fluid" style="padding: 30px;">
            
            <!-- Statistics -->
            <div class="row mb-4">
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fa fa-users fa-3x text-primary"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h3 class="mb-0"><?php echo number_format($stats['totalUsers']); ?></h3>
                                    <p class="text-muted mb-0">Utilisateurs</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fa fa-cube fa-3x text-success"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h3 class="mb-0"><?php echo number_format($stats['totalObjects']); ?></h3>
                                    <p class="text-muted mb-0">Objets</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fa fa-exchange fa-3x text-warning"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h3 class="mb-0"><?php echo number_format($stats['totalExchanges']); ?></h3>
                                    <p class="text-muted mb-0">Échanges</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Objects -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fa fa-cube"></i> Objets récents</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Titre</th>
                                    <th>Catégorie</th>
                                    <th>Propriétaire</th>
                                    <th>Prix</th>
                                    <th>ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($activity['recentObjects'])): ?>
                                    <?php foreach ($activity['recentObjects'] as $objet): ?>
                                    <tr>
                                        <td><?php echo $objet['id']; ?></td>
                                        <td><?php echo htmlspecialchars($objet['titre']); ?></td>
                                        <td><span class="badge bg-info"><?php echo htmlspecialchars($objet['categorie_nom']); ?></span></td>
                                        <td><?php echo htmlspecialchars($objet['proprietaire_nom']); ?></td>
                                        <td><?php echo $objet['prix_estime'] ? number_format($objet['prix_estime'], 2) . ' Ar' : 'N/A'; ?></td>
                                        <td><?php echo $objet['id']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="6" class="text-center">Aucun objet</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Recent Exchanges -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fa fa-exchange"></i> Échanges récents</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Demandeur</th>
                                    <th>Receveur</th>
                                    <th>Statut</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($activity['recentExchanges'])): ?>
                                    <?php foreach ($activity['recentExchanges'] as $echange): ?>
                                    <tr>
                                        <td><?php echo $echange['id']; ?></td>
                                        <td><?php echo htmlspecialchars($echange['demandeur_nom']); ?></td>
                                        <td><?php echo htmlspecialchars($echange['receveur_nom']); ?></td>
                                        <td><span class="badge bg-warning"><?php echo htmlspecialchars($echange['statut']); ?></span></td>
                                        <td><?php echo date('d/m/Y', strtotime($echange['date_demande'])); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" class="text-center">Aucun échange</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="<?php echo $baseurl ?>/assets/js/jquery-2.1.0.min.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/popper.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/bootstrap.min.js"></script>

</body>
</html>
                <p>Generate reports and analytics.</p>
                <a href="#" class="btn">View Reports</a>
            </div>
        </div>

        <div style="text-align: center; margin-top: 40px;">
            <a href="/logout" class="btn logout-btn">🚪 Logout</a>
            <a href="/index" class="btn">🏠 Back to Site</a>
        </div>
    </div>
</body>
</html>