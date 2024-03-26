<?php

require_once "./getConnect.php";
//Fonction qui ajoute un menu du jour.
function postPlat($categorie,$plat){
    try{
        $pdo = getConnect();
        
    if($pdo){
        
            $req = "INSERT INTO plat (titre)
            VALUES (:plat)";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':plat', $plat, PDO::PARAM_STR);
            $stmt->execute();
              

            //Récupération de l'ID du nouveau plat créé
            $newPlatId = $pdo->lastInsertId();

            //insertion de la catégorie associés à ce plat
            $stmt = $pdo->prepare("INSERT INTO plat_categorie (id_plat, id_categorie) VALUES (:idPlat, :idCategorie)");
            $stmt->bindParam(":idPlat", $newPlatId, PDO::PARAM_INT);
            $stmt->bindParam(":idCategorie", $categorie, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();
            
            echo json_encode(["success"=>"PLat ajoutés avec succès"]);
        }
    

}catch(Exception $e){
    echo json_encode(["message"=>"problème lors de l'enregistrement du plat"]);
}finally{
    //Fermeture de la connexion PDO.
    if ($pdo){
        $pdo = null;
    }
}
}

$data = json_decode(file_get_contents("php://input"), true);


// Vérification si les données nécessaires sont présentes
if (isset($data['categorie'], $data['plat'])) {
    
    $categorie = $data['categorie'];  
    $plat = $data['plat'];

    postPlat($categorie,$plat);
    
    
} else {
    // Géstion du cas où des données requises sont manquantes
    echo json_encode(["message" => "Paramètres du plat manquants"]);
  
}