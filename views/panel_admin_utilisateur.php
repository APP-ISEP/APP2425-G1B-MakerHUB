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
                <a href="panel_admin_produit.php" ><div class="drop-content">Produit</div></a>
                <a href="#supprimer-utilisateur" ><div class="drop-content">Utilisateur</div></a>
                <hr id="separation-bar">
                <a href="log-out.php" ><div class="drop-content logout">Se déconnecter</div></a>
            </div>
        </div>
    </div>

   <main class="main">
        <div class="mini-menu">
                <a href="panel_admin_faq.php" ><div class="submitButton">FAQ</div></a>
                <a href="panel_admin_produit.php" ><div class="submitButton">Produit</div></a>
        </div>
   

        <table>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th><th></th></th>
            </tr>
            <?php
            require('../php/user/getUser.php'); 
        
            $users = getUsers();
            foreach($users as $user) {
                $prenom = $user['prenom'];
                $nom = $user['nom'];
                $email = $user['email'];?>
                <tr>
                    <td><?php echo($prenom);?></td>
                    <td><?php echo($nom);?></td>
                    <td><?php echo($email);?></td>
                    <td><a onclick="deleteFaq(<?php echo $user['id_utilisateur'];?>)"><button class="submit"><i class="fa-regular fa-trash-can" style="color: #ffffff;"></i></button></a></td>
                </tr>
            <?php } ?>
        </table>


                <section id="supprimer-utilisateur" class="section content-box">
                    <h2>Utilisateurs</h2>
                    <form class="form-container" action="supprimer_utilisateur.php" method="POST">
                        <label for="suppression_utilisateur">Supprimer un utilisateur</label>
                        <select name="suppression_utilisateur" autocomplete="on">
                            <option value=""> -- Sélectionner un utilisateur -- </option>
                            <?php foreach($users as $user) {
                                $id_utilisateur = $utilisateur['id_utilisateur'];
                                $email_utilisateur = $utilisateur['email'];?>
                                <option value="<?php echo($id_utilisateur);?>"><?php echo($email_utilisateur);?></option>
                            <?php } ?>
                            <option value="1">test</option>

                        </select>
                        <input class="submit"  type="submit" value="Supprimer">
                    </form>
                </section>
    </main> 

<?php
include_once 'components/footer.html';
?>