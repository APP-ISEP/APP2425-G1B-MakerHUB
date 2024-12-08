<?php
require_once "../connectToDB.php" //../permet de revenir en arriere d'un cran
//once car on veut se connecter qu'une sule fois la base de donnée et require parcq on a besoin que la fonction soit executé 

//$anna->test(); dans anna y'a une méthode test et on l'appelle 
// fetchassoc = mettre resultats ds tableau 
//insert into 
//pdo= bd / la connexion à la bd
// pdo exeecption =erreur
//connectToDB();  là on utilise la function
//Un PDOStatement est un objet en PHP qui représente une requête SQL préparée.
//Il est créé quand tu appelles la méthode prepare() sur ton objet PDO (qui est la connexion à la base de données).

function addInfosInTheForm(string $pseudo, string $email, string $message): ?bool {// ici les attributs doivent etre les 
    //meme que dans les attributs name de mes input html
    try {
        $pdo = connectToDB();
        $sql = "INSERT IGNORE INTO `form` (pseudo, email, message) VALUES (:valPseudo, :valEmail, :valMessage)";

        $stmt = $pdo ->prepare($sql); //Ici, $pdo est l’objet PDO (connexion à la base de données). 
        //La méthode prepare($sql) prend la requête SQL ($sql) que tu veux exécuter et retourne un objet PDOStatement. 
        //Ce $stmt (le PDOStatement) contient maintenant ta requête, prête à être exécutée.
        $stmt ->bindParam(":valPseudo", $pseudo);
        $stmt->bindParam( ":valEmail", $email);
        $stmt->bindParam(":valMessage", $message);

        $bool =$stmt->execute(); //Cela envoie la requête préparée (avec les valeurs liées) à la base de données.
        //$bool contient true si l’exécution a réussi, sinon false.
        if (!$stmt->execute()) {
            echo "Erreur d'exécution de la requête.";
        }        
        $stmt->closeCursor();

        return $bool;
    } catch(PDOException $e) { // $e est un objet de type PDOException.
        $error =$e->getMessage();  //dans l'objet e il y a une function getMessage, fait la et met la dans $error
        echo mb_convert_encoding (string "database access error: $error \n", to_encoding:'UTF-8', from_encoding: 'UTF-8');
        return null;
    }
}
