<?php

require_once "./getConnect.php";
//Fonction qui ajoute un menu du jour.
function postCompte($nom,$prenom,$password,$numAppart,$mixe,$role){
    try{
        $pdo = getConnect();
        
    if($pdo){
        
            //Verification que le nouvel utilisateur ne soit pas déjà créée.
            $reqCheckUser = "SELECT COUNT(*) from utilisateur WHERE nom = :nom and prenom = :prenom ";
            $stmtCheckUser = $pdo->prepare($reqCheckUser);
            $stmtCheckUser->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmtCheckUser->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmtCheckUser->execute();
            $userExist = (bool)$stmtCheckUser->fetchColumn();

            if($userExist){
                echo json_encode(["success"=>"Ce compte existe déjà"]);
            }else{
                $req = "INSERT INTO utilisateur (nom , prenom , appt, `password`, `mixed`)
                VALUES (:nom, :prenom, :numAppart, :password, :mixe)";
                $stmt = $pdo->prepare($req);
                $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
                $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                $stmt->bindParam(':numAppart', $numAppart, PDO::PARAM_INT);
                //hash du password
                $stmt->bindValue(':password', password_hash($password, PASSWORD_BCRYPT),PDO::PARAM_STR);
                $stmt->bindParam(':mixe', $mixe, PDO::PARAM_BOOL);
                $stmt->execute();
            
                //Récupération de l'ID du nouveau compte.
                $newCompte = $pdo->lastInsertId();
            
                 //insertion du role du nouvel utilisateur.
                $stmt = $pdo->prepare("INSERT INTO role_utilisateur (id_utilisateur, id_role) VALUES (:idUtilisateur,:idRole)");
                $stmt->bindParam(":idUtilisateur", $newCompte, PDO::PARAM_INT);
                $stmt->bindParam(":idRole", $role, PDO::PARAM_INT);
                $stmt->execute();
                $stmt->closeCursor();
            
            echo json_encode(["success"=>"Compte créée avec succès"]);
        }
    }
    

}catch(Exception $e){
    echo json_encode(["message"=>"problème lors de l'enregistrement du compte".$e]);
}finally{
    //Fermeture de la connexion PDO.
    if ($pdo){
        $pdo = null;
    }
}
}

$data = json_decode(file_get_contents("php://input"), true);


// Vérification si les données nécessaires sont présentes
if (isset($data['nom'], $data['prenom'],$data['password'],$data['numAppart'],$data['mixe'],$data['role'])) {
    
       $nom = $data['nom'];
       $prenom = $data['prenom'];
       $password = $data['password'];
       $numAppart = $data['numAppart'];
       $mixe = $data['mixe'];
       $role = $data['role'];

    postCompte($nom,$prenom,$password,$numAppart,$mixe,$role);
    
    
} else {
    // Géstion du cas où des données requises sont manquantes
    echo json_encode(["message" => "Paramètres du plat manquants"]);
  
}