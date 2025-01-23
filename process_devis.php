<?php
session_start();

require_once("modele/connectToDB.php");

try {
    $pdo = connectToDB();
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_devis = $_POST['id_devis'] ?? null;
    $action = $_POST['action'] ?? null;

    if ($id_devis && in_array($action, ['accepter', 'refuser'])) {
        $statut_devis_id = $action === 'accepter' ? 1 : 2; 


        $sql = "UPDATE devis SET statut_devis_id = :statut_devis_id WHERE id_devis = :id_devis";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':statut_devis_id', $statut_devis_id, PDO::PARAM_INT);
        $stmt->bindParam(':id_devis', $id_devis, PDO::PARAM_INT);

        if ($stmt->execute()) {
            if ($action === 'accepter') {
                header("Location: paymentPage.php");
            } else {
                header("Location: devis-history.php");
            }
            exit();
        } else {
            echo "Erreur lors de la mise à jour du devis.";
        }
    } else {
        echo "Erreur";
    }
} else {
    echo "Erreur";
}
?>
