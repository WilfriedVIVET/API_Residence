<?php

require_once "./getConnect.php";
//Fonction qui supprime un plat.
function deletePlat($plat){
    try{
        $pdo = getConnect();
        
    if($pdo){

        //Suppression de la clé étrangére (categorie)
            $req = "DELETE from plat_categorie pc 
            WHERE id_plat IN (SELECT plat_id FROM plat where titre = :plat)";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':plat', $plat, PDO::PARAM_STR);
            $stmt->execute();
              
        //Suppression du plat
        $req = "DELETE FROM plat WHERE titre = :plat";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(":plat", $plat, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
            
            echo json_encode(["success"=>"PLat supprimer avec succès"]);
        }
    

}catch(Exception $e){
    echo json_encode(["message"=>"problème lors de la suppression du plat"]);
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
    
    $plat = $data;
    deletePlat($plat);
    
    
} else {
    // Géstion du cas où des données requises sont manquantes
    echo json_encode(["message" => "Paramètres du plat manquants"]);
  
}