<!DOCTYPE html>
<?php
$baseurl = Flight::get('flight.base_url');
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Takalo - Utilisateurs</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>/assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $baseurl ?>/assets/css/templatemo-hexashop.css">
    <link rel="stylesheet" href="<?php echo $baseurl ?>/assets/css/backoffice.css">
</head>

<body>

    <?php include __DIR__ . '/../includes/headeradmin.php'; ?>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="mb-0"><i class="fa fa-users"></i> Utilisateurs</h3>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Tel</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $u): ?>
                                    <tr>
                                        <td><?php echo $u['id']; ?></td>
                                        <td><?php echo htmlspecialchars($u['nom']); ?></td>
                                        <td><?php echo htmlspecialchars($u['email']); ?></td>
                                        <td><?php echo htmlspecialchars($u['tel'] ?? ''); ?></td>
                                        <td><?php echo htmlspecialchars($u['role_id']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/../includes/footer.php'; ?>

    <script src="<?php echo $baseurl ?>/assets/js/jquery-2.1.0.min.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/popper.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/bootstrap.min.js"></script>
</body>

</html>