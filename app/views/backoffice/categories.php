<!DOCTYPE html>
<?php 
$baseurl = Flight::get('flight.base_url');
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="base-url" content="<?php echo $baseurl; ?>">
    <title>Takalo - Catégories</title>
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
                    <h1 class="navbar-brand mb-0"><i class="fa fa-tags"></i> Catégories</h1>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalCategorie" id="btnAddCategorie">
                        <i class="fa fa-plus"></i> Ajouter
                    </button>
                </div>
            </nav>

            <div class="container-fluid py-4">
                <div id="categorieAlert" class="alert d-none"></div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="tableCategories">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Libellé</th>
                                <th>Symbole</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $cat): ?>
                            <tr id="cat-row-<?php echo $cat['id']; ?>">
                                <td><?php echo $cat['id']; ?></td>
                                <td><?php echo htmlspecialchars($cat['libelle']); ?></td>
                                <td><?php echo htmlspecialchars($cat['symbole'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($cat['description'] ?? ''); ?></td>
                                <td>
                                    <button class="btn btn-sm btn-warning btn-edit-cat" 
                                            data-id="<?php echo $cat['id']; ?>"
                                            data-libelle="<?php echo htmlspecialchars($cat['libelle']); ?>"
                                            data-symbole="<?php echo htmlspecialchars($cat['symbole'] ?? ''); ?>"
                                            data-description="<?php echo htmlspecialchars($cat['description'] ?? ''); ?>">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger btn-delete-cat" data-id="<?php echo $cat['id']; ?>">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Categorie -->
<div class="modal fade" id="modalCategorie" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCategorieTitle"><i class="fa fa-plus"></i> Ajouter une catégorie</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="formCategorie">
                    <input type="hidden" id="catId" value="">
                    <div class="form-group">
                        <label>Libellé *</label>
                        <input type="text" class="form-control" id="catLibelle" required>
                    </div>
                    <div class="form-group">
                        <label>Symbole</label>
                        <input type="text" class="form-control" id="catSymbole">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" id="catDescription" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="btnSaveCategorie"><i class="fa fa-save"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>

    <script src="<?php echo $baseurl ?>/assets/js/jquery-2.1.0.min.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/popper.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo $baseurl ?>/assets/js/backoffice.js"></script>
</body>
</html>
