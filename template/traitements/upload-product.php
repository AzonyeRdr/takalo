
<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once('../inc/func.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Méthode non autorisée");
}

try {
    // Récupérer et valider les données
    $nom_produit = trim($_POST['nom_produit'] ?? '');
    $desc_produit = trim($_POST['desc_produit'] ?? '');
    $prix_produit = floatval($_POST['prix_produit'] ?? 0);
    $categorie = intval($_POST['categorie'] ?? 0);
    
    // Validation des champs
    if (empty($nom_produit)) {
        throw new Exception("Le nom du produit est requis");
    }
    if (empty($desc_produit)) {
        throw new Exception("La description est requise");
    }
    if ($prix_produit <= 0) {
        throw new Exception("Le prix doit être supérieur à 0");
    }
    if ($categorie <= 0) {
        throw new Exception("Veuillez sélectionner une catégorie");
    }
    
    // Vérifier les images (votre nom de champ est 'fichier')
    if (!isset($_FILES['fichier']) || !isset($_FILES['fichier']['name']) || !is_array($_FILES['fichier']['name'])) {
        throw new Exception("Aucune image reçue");
    }
    
    // Compter les images valides
    $imageCount = 0;
    foreach ($_FILES['fichier']['name'] as $name) {
        if (!empty($name)) {
            $imageCount++;
        }
    }
    
    if ($imageCount < 2) {
        throw new Exception("Minimum 2 images requises. Vous avez sélectionné: $imageCount image(s)");
    }
    
    // Préparer le dossier d'upload
    $uploadDir = '../assets/images/';
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            throw new Exception("Impossible de créer le dossier d'upload");
        }
    }
    
    if (!is_writable($uploadDir)) {
        throw new Exception("Dossier d'upload non accessible en écriture");
    }
    
    $uploadedImages = [];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $maxSize = 10 * 1024 * 1024; // 10MB
    
    // Traiter chaque image
    for ($i = 0; $i < count($_FILES['fichier']['name']); $i++) {
        if (empty($_FILES['fichier']['name'][$i])) {
            continue;
        }
        
        $error = $_FILES['fichier']['error'][$i];
        $tmpName = $_FILES['fichier']['tmp_name'][$i];
        $originalName = $_FILES['fichier']['name'][$i];
        $fileSize = $_FILES['fichier']['size'][$i];
        
        // Vérifier les erreurs d'upload
        if ($error !== UPLOAD_ERR_OK) {
            $errorMessages = [
                UPLOAD_ERR_INI_SIZE => 'Fichier trop volumineux (limite serveur)',
                UPLOAD_ERR_FORM_SIZE => 'Fichier trop volumineux (limite formulaire)',
                UPLOAD_ERR_PARTIAL => 'Upload interrompu',
                UPLOAD_ERR_NO_FILE => 'Aucun fichier',
                UPLOAD_ERR_NO_TMP_DIR => 'Dossier temporaire manquant',
                UPLOAD_ERR_CANT_WRITE => 'Impossible d\'écrire le fichier',
                UPLOAD_ERR_EXTENSION => 'Extension bloquée'
            ];
            $message = $errorMessages[$error] ?? "Erreur inconnue ($error)";
            throw new Exception("Erreur upload '$originalName': $message");
        }
        
        // Vérifications de sécurité
        if (!is_uploaded_file($tmpName)) {
            throw new Exception("Fichier non valide: $originalName");
        }
        
        if ($fileSize > $maxSize) {
            throw new Exception("Fichier '$originalName' trop volumineux (" . round($fileSize/1024/1024, 2) . "MB > 10MB)");
        }
        
        // Vérifier l'extension
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        if (!in_array($extension, $allowedExtensions)) {
            throw new Exception("Extension non autorisée pour '$originalName': .$extension");
        }
        
        // Vérifier le type MIME réel
        if (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $tmpName);
            finfo_close($finfo);
            
            if (!in_array($mimeType, $allowedMimeTypes)) {
                throw new Exception("Type de fichier non autorisé pour '$originalName': $mimeType");
            }
        }
        
        // Générer un nom de fichier unique et sécurisé
        $fileName = uniqid('prod_' . date('Ymd_His') . '_', true) . '.' . $extension;
        $filePath = $uploadDir . $fileName;
        
        // Déplacer le fichier
        if (!move_uploaded_file($tmpName, $filePath)) {
            throw new Exception("Impossible de sauvegarder: $originalName");
        }
        
        // Vérifier que le fichier existe
        if (!file_exists($filePath)) {
            throw new Exception("Fichier non créé: $fileName");
        }
        
        $uploadedImages[] = $fileName;
    }
    
    if (count($uploadedImages) < 2) {
        throw new Exception("Pas assez d'images uploadées: " . count($uploadedImages));
    }
    
    // Insérer le produit avec l'image principale (première image)
    $mainImage = $uploadedImages[0];
    $productId = upload_produit($nom_produit, $desc_produit, $prix_produit, $categorie, $mainImage);
    
    if (!$productId) {
        // En cas d'erreur, supprimer les fichiers uploadés
        foreach ($uploadedImages as $image) {
            $filePath = $uploadDir . $image;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        throw new Exception("Échec de l'insertion du produit");
    }
    
    // Insérer les images supplémentaires dans la table images
    $imagesInserted = 0;
    for ($i = 1; $i < count($uploadedImages); $i++) {
        if (insert_image($productId, $uploadedImages[$i])) {
            $imagesInserted++;
        } else {
            // Log l'erreur mais continuer
            error_log("Erreur insertion image: " . $uploadedImages[$i]);
        }
    }
    
    // Rediriger vers la page d'accueil avec un message de succès
    header("Location: ../index.php?success=1&product_id=$productId&images_uploaded=" . count($uploadedImages));
    exit();
    
} catch (Exception $e) {
    // Log l'erreur
    error_log("Erreur upload-product: " . $e->getMessage());
    
    // Rediriger vers la page de formulaire avec l'erreur
    $errorMessage = urlencode($e->getMessage());
    header("Location: ../pages/upload-product.php?error=$errorMessage");
    exit();
}
?>