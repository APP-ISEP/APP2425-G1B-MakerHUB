<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link href="../../assets/css/style_admin.css" rel="stylesheet">
        <link href="../../assets/css/style.css" rel="stylesheet">
        <link href="../../assets/images/favico.ico" rel="icon">
        
        <title>Administration | Makerhub</title>
    </head>

    <body>
    <div class="navbar">
        <div class="header-logo">
            <img alt="Logo MakerHUB" class="img-logo" src="../../assets/images/logo.svg">
        </div>

        <div class="profil" id="profil">
            <img alt="Photo de profil" class="img-profil" src="../../assets/images/profil.svg">
            <p id="pseudo">Panel</p>

            <div id="dropdown">
                <a href="panel_admin_faq.php" ><div class="drop-content">FAQ</div></a>
                <a href="#supprimer-produit" ><div class="drop-content">Produit</div></a>
                <a href="panel_admin_utilisateur.php" ><div class="drop-content">Utilisateur</div></a>
                <hr id="separation-bar">
                <a href="log-out.php" ><div class="drop-content logout">Se déconnecter</div></a>
            </div>
        </div>
    </div>

   <main class="main">
    <div class="mini-menu">
        <a href="panel_admin_faq.php" ><div class="submitButton">FAQ</div></a>
        <a href="panel_admin_utilisateur.php" ><div class="submitButton">Utilisateur</div></a>
    </div>

        <section id="supprimer-produit" class="section content-box">
            <h2>Produits</h2>
            <form class="form-container" action="supprimer_produit.php" method="POST">
            <label for="suppression_produit">Supprimer un produit</label>
            <select name="suppression_produit" autocomplete="on">
                    <option value=""> -- Sélectionner un produit -- </option>
                    <?php foreach($produits as $produit) {
                        $id_produit = $produit['id_produit'];
                        $nom_produit = $produit['nom_produit'];?>
                        <option value="<?php echo($id_produit);?>"><?php echo($nom_produit);?></option>
                    <?php } ?>
                </select>
                <input class="submit" type="submit" value="Supprimer">
            </form>
        </section>

    </main> 

<?php
include_once 'components/footer.html';
?>