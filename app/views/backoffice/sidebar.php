<?php $baseurl = Flight::get('flight.base_url'); ?>
<!-- Sidebar -->
<div class="col-md-2 bg-dark text-white min-vh-100 p-0">
    <div class="p-4 bg-secondary">
        <h3 class="mb-0"><i class="fa fa-exchange"></i> Takalo</h3>
        <p class="mb-0 small">Administration</p>
    </div>
    <nav class="nav flex-column py-3">
        <a class="nav-link text-white" href="<?php echo $baseurl; ?>/backoffice"><i class="fa fa-dashboard mr-2"></i> Tableau de bord</a>
        <a class="nav-link text-white" href="<?php echo $baseurl; ?>/backoffice/stats"><i class="fa fa-bar-chart mr-2"></i> Statistiques</a>
        <a class="nav-link text-white" href="<?php echo $baseurl; ?>/backoffice/categories"><i class="fa fa-tags mr-2"></i> Catégories</a>
        <hr class="my-3 bg-secondary">
        <a class="nav-link text-white" href="<?php echo $baseurl; ?>/index"><i class="fa fa-home mr-2"></i> Retour au site</a>
        <a class="nav-link text-white" href="<?php echo $baseurl; ?>/logout"><i class="fa fa-sign-out mr-2"></i> Déconnexion</a>
    </nav>
</div>
