<?php $baseurl = Flight::get('flight.base_url');
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<header class="header-area header-admin">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6 col-md-4">
                <a href="<?php echo $baseurl; ?>/backoffice" class="logo">
                    <img src="<?php echo $baseurl ?>/assets/images/logo.png" alt="Takalo logo">
                </a>
            </div>
            <div class="col-6 col-md-8 text-right">
                <nav class="admin-nav d-inline-block">
                    <div class="btn-group" role="group" aria-label="Admin nav">
                        <a class="btn btn-sm btn-light" href="<?php echo $baseurl; ?>/backoffice"><i class="fa fa-dashboard"></i> Dashboard</a>
                        <a class="btn btn-sm btn-light" href="<?php echo $baseurl; ?>/backoffice/stats"><i class="fa fa-bar-chart"></i> Stats</a>
                        <a class="btn btn-sm btn-light" href="<?php echo $baseurl; ?>/backoffice/categories"><i class="fa fa-tags"></i> Catégories</a>
                        <a class="btn btn-sm btn-light" href="<?php echo $baseurl; ?>/backoffice/users"><i class="fa fa-users"></i> Utilisateurs</a>
                        <a class="btn btn-sm btn-light" href="<?php echo $baseurl; ?>/backoffice/objets"><i class="fa fa-cube"></i> Objets</a>
                    </div>
                    <span class="ml-3 d-inline-block align-middle">
                        <?php if (isset($_SESSION['session_type']) && $_SESSION['session_type'] === 'admin'): ?>
                            <span class="badge badge-secondary">Admin: <?php echo htmlspecialchars($_SESSION['user']->getNom()); ?></span>
                            <a class="btn btn-sm btn-outline-secondary ml-2" href="<?php echo $baseurl; ?>/logout"><i class="fa fa-sign-out"></i> Déconnexion</a>
                        <?php else: ?>
                            <a class="btn btn-sm btn-outline-secondary ml-2" href="<?php echo $baseurl; ?>/login">Se connecter</a>
                        <?php endif; ?>
                    </span>
                </nav>
            </div>
        </div>
    </div>
</header>

<style>
    /* Small inline admin header tweaks to match template */
    .header-admin {
        background: linear-gradient(90deg, #ffffff, #f8f9fb);
        padding: 12px 0;
        border-bottom: 1px solid #ececec;
    }

    .header-admin .logo img {
        height: 40px;
    }

    .admin-nav .btn {
        vertical-align: middle;
    }

    .badge-secondary {
        background: #6c757d;
        color: #fff;
        padding: 6px 12px;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 32px;
    }
</style>