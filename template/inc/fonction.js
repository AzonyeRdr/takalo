function update_total(item_price){
    
    let qty=document.getElementById('total').value;
    let total_price=item_price * qty;
    document.getElementById('tot').innerText="Total: $" + total_price.toFixed(2);
}


function ouvrirPopup(id) {
    document.getElementById("btnDeleteConfirm").href = "../traitements/traitement-sup.php?id_p=" + id;
    document.getElementById("annuler").href = "list-produit.php";

    var myModal = new bootstrap.Modal(document.getElementById('confirmDelete'));
    myModal.show();
}
