<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link href="../../assets/css/style_admin.css" rel="stylesheet">
        <link href="../../assets/css/style.css" rel="stylesheet">
        <link href="../../assets/images/favico.ico" rel="icon">
        <title>Administration | Makerhub</title>
        <script>
            xmlhttp = new XMLHttpRequest();

            
            
            function setFaq(id, question, reponse) {
                try{
                        if (window.XMLHttpRequest) {
                        xmlhttp= new XMLHttpRequest();
                    } else {
                        if (window.ActiveXObject)
                            try {
                                xmlhttp= new ActiveXObject("Msxml2.XMLHTTP");
                            } catch (e) {
                                try {
                                    xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
                                } catch (e) {
                                    return NULL;
                                }
                            }
                    }

                    xmlhttp.onreadystatechange = function ()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        {
                            console.log(xmlhttp.responseText);
                        }
                    }
                        console.log(id);
                        console.log(question);
                        console.log(reponse);
                        xmlhttp.open("GET", "../php/faq/setFaq.php?id="+id+"&reponse="+reponse+"&question="+question, true);
                        xmlhttp.send();
                }
                catch(e){
                    console.log(e);
                }
            }

            function deleteFaq(id) {
                try{
                    console.log(id);
                    if (window.XMLHttpRequest) {
                        xmlhttp= new XMLHttpRequest();
                    } else {
                        if (window.ActiveXObject)
                            try {
                                xmlhttp= new ActiveXObject("Msxml2.XMLHTTP");
                            } catch (e) {
                                try {
                                    xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
                                } catch (e) {
                                    return NULL;
                                }
                            }
                    }

                    xmlhttp.onreadystatechange = function ()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        {
                            console.log(xmlhttp.responseText);
                        }
                    }
                    xmlhttp.open("GET", "../php/faq/setFaq.php?id="+id, true);
                    xmlhttp.send();
                }
                catch(e){
                    console.log(e);
                }
                
            }
        </script>
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
                <a href="#faq" ><div class="drop-content">FAQ</div></a>
                <a href="panel_admin_produit.php" ><div class="drop-content">Produit</div></a>
                <a href="panel_admin_utilisateur.php" ><div class="drop-content">Utilisateur</div></a>
                <hr id="separation-bar">
                <a href="log-out.php" ><div class="drop-content logout">Se déconnecter</div></a>
            </div>
        </div>
    </div>

   <main class="main">
    <div class="mini-menu">
        <a href="panel_admin_produit.php" ><div class="submitButton">Produit</div></a>
        <a href="panel_admin_utilisateur.php" ><div class="submitButton">Utilisateur</div></a>
    </div>

        <section id="faq" class="section content-box">
           
                    <h2>FAQ</h2>
                    <p>Vous pouvez ajouter ou supprimer des questions fréquemment posées.</p>
                    
                    <form action="../php/faq/addFaq.php" method="POST">
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
                            <th><th></th></th>
                        </tr>
                       <?php
                       require_once('../php/faq/getFaq.php'); 
                   
                       $faqs = getFaq();
                       foreach($faqs as $faq) {
                            $question = $faq['question'];
                            $reponse = $faq['reponse'];?>
                            <tr>
                                <td><?php echo($question);?></td>
                                <td><?php echo($reponse);?></td>
                                <td><a onclick="deleteFaq(<?php echo $faq['id_faq'];?>)"><button class="submit"><i class="fa-regular fa-trash-can" style="color: #ffffff;"></i></button></a></td>
                                <td><a onclick="setFaq(<?php echo $faq['id_faq'].','.$question.','.$reponse?>)"><button class="submit"><i class="fa-regular fa-pen-to-square" style="color: #ffffff;"></i></button></a></td>
                            </tr>
                        <?php } ?>
                    </table>

                </section>

    </main> 

<?php
include_once 'components/footer.html';
?>