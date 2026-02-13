<!DOCTYPE html>
<?php 
$baseurl = Flight::get('flight.base_url');
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Takalo - Statistiques</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>/assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $baseurl ?>/assets/css/templatemo-hexashop.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <?php include __DIR__ . '/sidebar.php'; ?>

        <div class="col-md-10 p-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <h1 class="navbar-brand mb-0"><i class="fa fa-bar-chart"></i> Statistiques</h1>
                </div>
            </nav>

            <div class="container-fluid py-4">
                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card text-center border-primary">
                            <div class="card-body">
                                <i class="fa fa-users fa-3x text-primary mb-3"></i>
                                <h5>Utilisateurs inscrits</h5>
                                <p class="h2 text-primary"><?php echo $nbUsers ?? 0; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center border-success">
                            <div class="card-body">
                                <i class="fa fa-exchange fa-3x text-success mb-3"></i>
                                <h5>Échanges effectués</h5>
                                <p class="h2 text-success"><?php echo $nbEchanges ?? 0; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center border-info">
                            <div class="card-body">
                                <i class="fa fa-cube fa-3x text-info mb-3"></i>
                                <h5>Objets publiés</h5>
                                <p class="h2 text-info"><?php echo $nbObjets ?? 0; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center border-warning">
                            <div class="card-body">
                                <i class="fa fa-tags fa-3x text-warning mb-3"></i>
                                <h5>Catégories</h5>
                                <p class="h2 text-warning"><?php echo $nbCategories ?? 0; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Exchanges -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5><i class="fa fa-exchange"></i> Derniers échanges</h5>
                            </div>
                            <div class="card-body">
                                <?php if (empty($recentEchanges)): ?>
                                <p class="text-muted">Aucun échange récent.</p>
                                <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Demandeur</th>
                                                <th>Receveur</th>
                                                <th>Statut</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($recentEchanges as $e): ?>
                                            <tr>
                                                <td><?php echo $e['id']; ?></td>
                                                <td><?php echo htmlspecialchars($e['demandeur_nom']); ?></td>
                                                <td><?php echo htmlspecialchars($e['receveur_nom']); ?></td>
                                                <td>
                                                    <?php
                                                    $badge = 'badge-secondary';
                                                    if ($e['statut_code'] === 'en_attente') $badge = 'badge-warning';
                                                    elseif ($e['statut_code'] === 'accepte') $badge = 'badge-success';
                                                    elseif ($e['statut_code'] === 'refuse') $badge = 'badge-danger';
                                                    ?>
                                                    <span class="badge <?php echo $badge; ?>"><?php echo htmlspecialchars($e['statut_libelle']); ?></span>
                                                </td>
                                                <td><?php echo date('d/m/Y H:i', strtotime($e['date_demande'])); ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php endif; ?>
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
