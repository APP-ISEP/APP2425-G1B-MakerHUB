<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/images/favico.ico" rel="icon">
        <title>Administration | Makerhub</title>
    </head>

    <body>
    <div class="navbar">
        <div class="header-logo">
            <img alt="Logo MakerHUB" class="img-logo" src="assets/images/logo.svg">
        </div>

        <div class="profil" id="profil">
            <img alt="Photo de profil" class="img-profil" src="assets/images/profil.svg">
            <p id="pseudo">Pseudonyme</p>

            <div id="dropdown">
                <a href="#faq" ><div class="drop-content">FAQ</div></a>
                <a href="#supprimer-produit" ><div class="drop-content">Supprimer produit</div></a>
                <a href="#supprimer-utilisateur" ><div class="drop-content">Supprimer utilisateur</div></a>
                <hr id="separation-bar">
                <a href="log-out.php" ><div class="drop-content logout">Se déconnecter</div></a>
            </div>
        </div>
    </div>

   <main>

        <section id="faq" class="content-box">
           
                    <h2>FAQ</h2>
                    <p>Vous pouvez ajouter ou supprimer des questions fréquemment posées.</p>
                    
                    <form action="faq.php" method="POST">
                        <label for="question">Question</label>  
                        <br>  
                        <input type="text" name="question" placeholder="Question">
                        <br>
                        <label for="reponse">Réponse</label>
                        <br>
                        <input type="text" name="reponse" placeholder="Réponse">
                        <br>
                        <input type="submit" value="Ajouter">
                    </form>

                    <table>
                        <tr>
                            <th>Question</th>
                            <th>Réponse</th>
                            <th>Gérer</th>
                        </tr>
                       <!-- <?php foreach($faqs as $faq) {
                            $question = $faq['question'];
                            $reponse = $faq['reponse'];?>
                            <tr>
                                <td><?php echo($question);?></td>
                                <td><?php echo($reponse);?></td>
                                <td><a href="supprimer_faq.php?id=<?php echo($faq['id_faq']);?>">Supprimer</a></td>
                            </tr>
                        <?php } ?>
                        --->
                    </table>

                </section>


                <section id="supprimer-produit" class="content-box">
                    <h2>Produits</h2>
                    <p>Vous pouvez supprimer des produits.</p>
                    <form action="supprimer_produit.php" method="POST">
                        <select>
                            <option value=""> -- Sélectionner un produit -- </option>
                            <?php foreach($produits as $produit) {
                                $id_produit = $produit['id_produit'];
                                $nom_produit = $produit['nom_produit'];?>
                                <option value="<?php echo($id_produit);?>"><?php echo($nom_produit);?></option>
                            <?php } ?>
                        </select>
                        <input type="submit" value="Supprimer">
                    </form>
                </section>


                <section id="supprimer-utilisateur" class="content-box">
                    <h2>Utilisateurs</h2>
                    <p>Vous pouvez supprimer des utilisateurs.</p>
                    <form action="supprimer_utilisateur.php" method="POST">
                        <select>
                            <option value=""> -- Sélectionner un utilisateur -- </option>
                            <?php foreach($utilisateurs as $utilisateur) {
                                $id_utilisateur = $utilisateur['id_utilisateur'];
                                $email_utilisateur = $utilisateur['email'];?>
                                <option value="<?php echo($id_utilisateur);?>"><?php echo($email_utilisateur);?></option>
                            <?php } ?>
                        </select>
                        <input type="submit" value="Supprimer">
                    </form>
                </section>
    </main>
    </body> 

<?php
include_once 'views/components/footer.html';
?>