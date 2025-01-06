<script src="views/order-img.js"></script>

<?php

session_start();
require_once("php/getOrder.php");


$title = "Order History";

ob_start();

if (!isset($_SESSION) || !isset($_SESSION['account'])) {
    header("Location: ./log-in.php");
    die();
};

include_once 'views/order-history.html';

echo '<div class="order-history">';
$result = getOrder($id_account);
if($result->rowCount() > 0){
    while($row= $result->fetch(PDO::FETCH_ASSOC)){
        $id_produit=$row['id_produit_fini'];
        $titre = $row['titre'];
        $prix = $row['prix'];
        $description = $row['description'];
        $chemin_image = $row['chemin_image'];

?>      
            <div id="modal" class="offer-card">
                <?php $imgName = $row['chemin_image'] ? '/uploads/' . $row['chemin_image'] : './assets/images/placeholder.svg'; ?>
                <img src="<?= $imgName ?>" alt="Image de l'offre" class="order-history-img">
                <div class="card-info">
                    <h4 class="card-title"><?php echo $titre ?></h4>
                    <h3 class="card-price"><?php echo $prix ?></h3>
                    <p class ="card-description"> <?php echo substr_replace($description,'...',30) ?></p>
                    <button class="button button-buy" onclick="HideShow()">Voir</button>
                </div>
            </div>
                   
        
    <?php
    }
} else{
    echo "Pas encore de commande Clique ici pour commander";
}
?>

</div> 
<?php 
$body = ob_get_clean();

include_once "views/components/template.php";