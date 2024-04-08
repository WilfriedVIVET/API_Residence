<?php

require_once "./getConnect.php";
//Fonction qui supprime un utililsateur.
function deleteUtilisateur($id){
    try{
        $pdo = getConnect();
        
    if($pdo){

        //Suppression de la clé étrangére (role)
            $req = "DELETE FROM role_utilisateur WHERE id_utilisateur = :id ";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
              
        //Suppression de l'utilisateur
             $req = "DELETE FROM utilisateur WHERE  utilisateur_id = :id";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();
            
            echo json_encode(["success"=>"Utilisateur supprimer avec succès"]);
        }
    

}catch(Exception $e){
    echo json_encode(["message"=>"problème lors de la suppression de l'utilisateur"]);
}finally{
    //Fermeture de la connexion PDO.
    if ($pdo){
        $pdo = null;
    }
}
}

$data = json_decode(file_get_contents("php://input"), true);


// Vérification si les données nécessaires sont présentes
if (isset($data)) {
    
    $id = $data;
    deleteUtilisateur($id);
    
    
} else {
    // Géstion du cas où des données requises sont manquantes
    echo json_encode(["message" => "Paramètres de l'utilisateur manquants"]);
  
}