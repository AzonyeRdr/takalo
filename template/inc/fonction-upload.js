let selectedImages = [];
let imageCounter = 0;

// Gestionnaire pour l'ajout d'image
document.getElementById('imageInput').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (file) {
        // Validation côté client
        const maxSize = 10 * 1024 * 1024; // 10MB
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];

        if (file.size > maxSize) {
            alert('Fichier trop volumineux. Maximum 10MB autorisé.');
            this.value = '';
            return;
        }

        if (!allowedTypes.includes(file.type)) {
            alert('Type de fichier non autorisé. Utilisez JPG, PNG, GIF ou WEBP.');
            this.value = '';
            return;
        }

        addImageToList(file);
        this.value = ''; // Reset pour permettre d'ajouter la même image
    }
});

function addImageToList(file) {
    imageCounter++;
    const imageId = 'image_' + imageCounter;

    selectedImages.push({
        id: imageId,
        file: file,
        name: file.name,
        size: file.size
    });

    renderImagesList();
    updateImageCount();
    updateSubmitButton();
}

function removeImage(imageId) {
    selectedImages = selectedImages.filter(img => img.id !== imageId);
    renderImagesList();
    updateImageCount();
    updateSubmitButton();
}

function renderImagesList() {
    const imageList = document.getElementById('imageList');
    imageList.innerHTML = '';

    selectedImages.forEach((image, index) => {
        const sizeInMB = (image.size / 1024 / 1024).toFixed(2);
        const isMainImage = index === 0;

        const imageItem = document.createElement('div');
        imageItem.className = 'image-item' + (isMainImage ? ' main-image' : '');

        imageItem.innerHTML = `
                    <div class="image-info">
                        <div class="image-name">
                            ${image.name}
                            ${isMainImage ? '<span class="image-badge">Image principale</span>' : ''}
                        </div>
                        <div class="image-size">${sizeInMB} MB</div>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeImage('${image.id}')">
                        <i class="fa fa-trash"></i>
                    </button>
                `;

        imageList.appendChild(imageItem);
    });
}

function updateImageCount() {
    const count = selectedImages.length;
    const imageCount = document.getElementById('imageCount');
    imageCount.textContent = `${count} image(s) sélectionnée(s) - Minimum 2 requis`;

    if (count >= 2) {
        imageCount.style.color = '#28a745';
    } else {
        imageCount.style.color = '#dc3545';
    }
}

function updateSubmitButton() {
    const submitBtn = document.getElementById('submitBtn');
    if (selectedImages.length >= 2) {
        submitBtn.disabled = false;
    } else {
        submitBtn.disabled = true;
    }
}

// Gestion du submit du formulaire
document.getElementById('productForm').addEventListener('submit', function (e) {
    e.preventDefault();

    if (selectedImages.length < 2) {
        alert('Veuillez sélectionner au moins 2 images');
        return;
    }

    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Upload en cours...';

    // Créer FormData avec les données du formulaire
    const formData = new FormData();
    formData.append('nom_produit', document.getElementById('nom_produit').value.trim());
    formData.append('desc_produit', document.getElementById('desc_produit').value.trim());
    formData.append('prix_produit', document.getElementById('prix_produit').value);
    formData.append('categorie', document.getElementById('categorie').value);

    // Ajouter les images dans l'ordre (première = principale)
    selectedImages.forEach((image) => {
        formData.append('fichier[]', image.file);
    });

    // Envoyer via fetch
    fetch('../traitements/upload-product.php', {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (response.redirected) {
                window.location.href = response.url;
            } else {
                return response.text();
            }
        })
        .then(data => {
            if (data) {
                console.log('Response:', data);
                // Si pas de redirection, afficher le message
                if (data.includes('success')) {
                    alert('Produit ajouté avec succès!');
                    window.location.href = '../index.php';
                } else {
                    alert('Erreur: ' + data);
                }
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur de connexion: ' + error.message);
        })
        .finally(() => {
            submitBtn.disabled = selectedImages.length < 2;
            submitBtn.innerHTML = '<i class="fa fa-upload"></i> Ajouter le produit';
        });
});

// Auto-dismiss alerts after 5 seconds
setTimeout(function () {
    $('.alert').fadeOut('slow');
}, 5000);