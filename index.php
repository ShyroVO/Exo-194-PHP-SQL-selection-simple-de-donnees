<link href="style.css" rel="stylesheet">

<?php

/**
 * 1. Importez le fichier SQL se trouvant dans le dossier SQL.
 * 2. Connectez vous à votre base de données avec PHP
 * 3. Sélectionnez tous les utilisateurs et affichez toutes les infos
 * proprement dans un div avec du css
 *    ex:  <div class="classe-css-utilisateur">
 *              utilisateur 1, données ( nom, prenom, etc ... )
 *         </div>
 *         <div class="classe-css-utilisateur">
 *              utilisateur 2, données ( nom, prenom, etc ... )
 *         </div>
 * 4. Faites la même chose, mais cette fois ci, triez le résultat selon
 * la colonne ID, du plus grand au plus petit.
 * 5. Faites la même chose, mais cette fois ci en ne sélectionnant que
 * les noms et les prénoms.
 */

try {
    $user = 'root';

    $pdo = new PDO("mysql:host=localhost;dbname=table_test_php;charset=utf8", 'root' , '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $start = $pdo->prepare("SELECT * from table_test_php.user");
    $nomrecup = $start->execute();
    ?><div class="contenu"><?php
    if ($nomrecup){
        foreach ($start->fetchAll() as $user) {
            echo "<div><h3>".$user['nom']. " " . $user['prenom'] ."</h3><hr>".
                $user['pays'].", ".$user['code_postal']."<br>".$user['mail']."</div>";
        }
    }
    ?></div><hr><?php

    $reload = $pdo->prepare("SELECT * from table_test_php.user ORDER BY id ASC ");
    $reloadstart = $reload->execute();
    ?><div class="contenu"><?php
    if ($reloadstart){
        foreach ($reload->fetchAll() as $user) {

            echo "<div><h3>". $user['id'] . " " .$user['nom']. " " . $user['prenom'] ."</h3><hr>".
                $user['pays'].", ".$user['code_postal']."<br>".$user['mail']."</div>";
        }
    }
    ?></div><hr><?php

}
catch (PDOException $exception) {
    echo $exception->getMessage();
}