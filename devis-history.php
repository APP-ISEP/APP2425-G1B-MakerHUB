<script>src="assets/js/scrpit.js"
    console.log("zizi")
</script>
<?php

session_start();
require_once("modele/order/getDevis.php");
$title = "Historique de devis";

ob_start();

if (isset($_SESSION['account'])) {
    if($_SESSION['role'] === 'admin') {
        header("Location: admin.php");
    }
}

if (!isset($_SESSION) || !isset($_SESSION['account'])) {
    header("Location: ./log-in.php");
    die();
};


include_once 'views/devis-history.html';

echo '<div class="order-history-container">';
$result = getDevis($id_account);
if($result->rowCount() > 0){
    while($row= $result->fetch(PDO::FETCH_ASSOC)){
        $id_produit=$row['produit_demande_id'];
        $titre = $row['titre'];
        $prix = $row['prix_produit'];
        $description = $row['description'];
        $statut_commande = isset($row['libelle']) ? $row['libelle'] : 'Statut inconnu';
        $chemin_image = $row['chemin_image'];
        $role = $_SESSION['role'];
        $id_devis = $row['id_devis'];

?>      
            <div id="modal" class="item-card" data-status="<?= htmlspecialchars($statut_commande) ?>">
                <?php $imgName = $row['chemin_image'] ? './uploads/' . $row['chemin_image'] : './assets/images/placeholder.svg'; ?>
                <img src="<?= $imgName ?>" alt="Image de l'offre" class="order-history-img">
                <div class="card-info">
                    <h4 class="card-title"><?php echo $titre ?></h4>
                    <h3 class="card-price"><?php echo $prix ?></h3>
                    <p class ="card-description"> <?php echo substr_replace($description,'...',30) ?></p>
                    <h3 class="statut_commande"><?php echo $statut_commande ?></h3>

                    <?php if (($_SESSION['role'] === 'acheteur') && $statut_commande === 'Devis envoyé'): ?>
                    <form method="POST" action="process_devis.php"onsubmit="return confirmAction(this.querySelector('[name=action]').value)">
                        <input type="hidden" name="id_devis" value="<?= $id_devis ?>">
                        <button type="submit" name="action" value="accepter" class="btn btn-success">Accepter</button>
                        <button type="submit" name="action" value="refuser" class="btn btn-danger">Refuser</button>
                    </form>
                    <?php else: ?>
                    <?php endif; ?>                

                </div>
            </div>


        
    <?php
    }
} else{
    echo "Pas encore de devis";
}
?>

</div> 
<?php 
$body = ob_get_clean();

include_once "views/components/template.php";