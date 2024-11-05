<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link href="assets/css/style_admin.css" rel="stylesheet">
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
            <p id="pseudo">Panel</p>

            <div id="dropdown">
                <a href="#faq" ><div class="drop-content">FAQ</div></a>
                <a href="#supprimer-produit" ><div class="drop-content">Produit</div></a>
                <a href="#supprimer-utilisateur" ><div class="drop-content">Utilisateur</div></a>
                <hr id="separation-bar">
                <a href="log-out.php" ><div class="drop-content logout">Se déconnecter</div></a>
            </div>
        </div>
    </div>

   <main class="main">

        <section id="faq" class="section content-box">
           
                    <h2>FAQ</h2>
                    <p>Vous pouvez ajouter ou supprimer des questions fréquemment posées.</p>
                    
                    <form action="faq.php" method="POST">
                        <label for="question">Question</label>  
                        <br>  
                        <textarea type="text" name="question" placeholder="Question"></textarea>
                        <br>
                        <label for="reponse">Réponse</label>
                        <br>
                        <textarea type="text" name="reponse" placeholder="Réponse"></textarea>
                        <br>
                        <input class="submit" type="submit" value="Ajouter">
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
                        <tr>
                            <td>Question 1</td>
                            <td>Réponse 1</td>
                            <td><a href=""><button class="submit">Supprimer</button></a></td>
                        </tr>
                        <tr>
                            <td>Question 2</td>
                            <td>Réponse 2</td>
                            <td><a href=""><button class="submit">Supprimer</button></a></td>
                        </tr>
                        <tr>
                            <td>Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3Question 3</td>
                            <td>Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3Réponse 3</td>
                            <td><a href=""><button class="submit">Supprimer</button></a></td>
                        </tr>
                    </table>

                </section>


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


                <section id="supprimer-utilisateur" class="section content-box">
                    <h2>Utilisateurs</h2>
                    <form class="form-container" action="supprimer_utilisateur.php" method="POST">
                        <label for="suppression_utilisateur">Supprimer un utilisateur</label>
                        <select name="suppression_utilisateur" autocomplete="on">
                            <option value=""> -- Sélectionner un utilisateur -- </option>
                            <?php foreach($utilisateurs as $utilisateur) {
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
include_once 'views/components/footer.html';
?>