<?php

// On inclut la connexion à la base
require_once('connect.php');

// On écrit notre requête
$sql = 'SELECT * FROM `FicheFrais`';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('close.php');

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des fiches</title>
</head>
<body>

    <h1>Liste des fiches</h1>
    <table>
        <thead>
            <th>ID Visiteur</th>
            <th>Mois</th>
            <th>Etat</th>
        </thead>
        <tbody>
        <?php
            foreach($result as $etat){
        ?>
                <tr>
                    <td><?= $etat['idVisiteur'] ?></td>
                    <td><?= $etat['mois'] ?></td>
                    <td><?= $etat['idEtat'] ?></td>

                    <td> <a href="edit.php?id=<?= $etat['idVisiteur'] ?>">Modifier l'état</a>  </td>
                </tr>
        <?php
            }
        ?>
        </tbody>
    </table>

</body>
</html>
