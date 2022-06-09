<?php
require_once('connect.php');

if(isset($_POST)){
    if(isset($_POST['id']) 
        && isset($_POST['type']) && !empty($_POST['type'])){
        $id = strip_tags($_GET['id']);
        $type = strip_tags($_POST['type']);
        

        $sql = "UPDATE `FicheFrais` SET `idEtat`=:type WHERE `idVisiteur`=:id";

        $query = $db->prepare($sql);

        $query->bindValue(':type', $type, PDO::PARAM_STR);
        $query->bindValue(':id', $id, PDO::PARAM_STR);

        $query->execute();

        header('Location: index.php');
    }
}

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = strip_tags($_GET['id']);
    $sql = "SELECT * FROM `FicheFrais` WHERE `idEtat`=:id;";

    $query = $db->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $result = $query->fetch();
}

require_once('close.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche frais</title>

</head>
<body>
<h1>Modifier l'état de la fiche </h1>
    <p>Mois : <?= $result['mois'] ?></p>
    <p>Visiteur : <?= $result['idVisiteur'] ?></p>

    <form method="post">

        <p>
            <label for="type">Code Fiche</label>
            <input type="text" name="type" id="type" value="<?= $result['idEtat'] ?>">
        </p>
        <p>
            <button>Enregistrer</button>
        </p>

        <input type="hidden" name="id" value="<?= $result['idVisiteur'] ?>">

    </form>
</body>
</html>