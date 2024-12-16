<?php

session_start();
require_once("php/getOrder.php");

$title = "Order History";

ob_start();

include_once 'views/order-history.html';

echo '<div class="order-history">';
$result = getOrder($id_account);
if($result->rowCount() > 0){
    while($row= $result->fetch(PDO::FETCH_ASSOC)){
        $titre = $row['titre'];
        $prix = $row['prix'];
        $description = $row['description'];
        $statut_commande = $row['statut_impression'];
        $chemin_image = $row['chemin_image'];

?>      
            <div class="offer-card">
                <img src="./assets/images/placeholder.svg<?php echo $chemin_image ?>" alt="">
                <div class="card-info">                    
                    <h4 class="card-title"><?php echo $titre ?></h4>
                    <h3 class="card-price"><?php echo $prix ?></h3>
                    <p class ="card-description"> <?php echo $description ?></p>
                    <p class="card-status">Statut : <?php echo $statut_commande ?></p>
                    <button class="button button-buy">Voir</button>
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