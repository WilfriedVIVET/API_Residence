<?php

require_once "./getConnect.php";
//Fonction qui récupère le rôle de l'utilisateur.
function postRole($name,$password){
    try{
        $pdo = getConnect();

     if($pdo){
        $req = "SELECT u.password, r.role FROM role r
        INNER JOIN role_utilisateur ru ON r.id_role = ru.id_role
        INNER JOIN utilisateur u ON ru.id_utilisateur = u.utilisateur_id
        WHERE u.nom = :name" ;
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(':name',$name, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
       
        // Vérifie si un utilisateur avec le nom donné existe
        if ($user) {
            
            // Si le mot de passe fourni correspond au mot de passe en base de données
            if(password_verify($password, $user['password'])) {
            
                // Renvoie le rôle de l'utilisateur
                echo json_encode(['role' => $user['role']]);
             
            } else {
                // Sinon, renvoie une erreur d'authentification
                echo json_encode(['error' => 'Mot de passe incorrect '.$user['role']]);
            }
        } else {
            // Si aucun utilisateur avec le nom donné n'est trouvé
            echo json_encode(['error' => 'Utilisateur non trouvé']);
        }

    } else {
        throw new Exception("La connexion à la base de données a échoué.");
    }
} catch (Exception $e) {
    sendJson(['error' => "erreur connexion utilisateur " . $e->getMessage()]);
} finally {
    // Fermeture de la connexion PDO 
    if ($pdo) {
        $pdo = null;
    }
}
}

$data = json_decode(file_get_contents("php://input"), true);


// Vérification si les données nécessaires sont présentes
if (isset($data['name'], $data['password'])) {
    
    $name = $data['name'];  
    $password = $data['password'];

    postRole($name,$password);
    
    
} else {
    // Géstion du cas où des données requises sont manquantes
    echo json_encode(["message" => "Paramètres du compte manquants"]);
  
}



