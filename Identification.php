<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
        <h1>Identification</h1>
        <form method="POST" name="identif">
            <label for="identif">Identifiant (login):</label>
            <input type="text" name="identif" id="identif" size="30" required>
            <label for="mdp">Mot de passe:</label>
            <input type="password" name="mdp" id="mdp" size="30" required>
            <input type="hidden" name="ref" value="identification">
            <input type="submit" name="valider" value="Valider">
        </form>
        <?php
            if ($_POST['ref'] == 'identification') {
                echo "<div class='info'>Traitement du formulaire<br></div>";
                $identif = $_POST['identif'];
                $mdp = $_POST['mdp'];
                try {   
                    $con = new PDO('mysql:host=localhost;dbname=ING2', 'Mouhamadou', 'Mouhamadou');
                    echo "<div class='info'>Connexion au serveur de BD<br></div>";
                    $req = "SELECT nom, prenom FROM utilisateurs WHERE login=:identif AND password=:mdp";
                    $stmt = $con->prepare($req);
                    $stmt->bindParam(':identif', $identif);
                    $stmt->bindParam(':mdp', $mdp);
                    $stmt->execute();
                    $lignes = $stmt->fetchAll();
                    if ($lignes) {
                        echo "<div class='success'><hr>Votre nom est " . $lignes[0]['nom'] . " et votre prénom est " . $lignes[0]['prenom'] . "</div>";
                    } else {
                        echo "<div class='error'>Identifiant ou mot de passe incorrect</div>";
                    }
                } catch (PDOException $e) {
                    echo "<div class='error'>Erreur de connexion : " . $e->getMessage() . "</div>";
                }
            }
        ?>
    </div>
</body>
</html>
