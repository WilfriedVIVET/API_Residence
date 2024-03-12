<?php

require_once "./getConnect.php";
//Fonction qui ajoute un menu du jour.
function postMenu($date,$entre1,$entre2,$entre3,$plat1,$plat2,$accompagnement1,$accompagnement2,$fromage1,$fromage2,$dessert1,$dessert2,$jour){
    try{
        $pdo = getConnect();
        
    if($pdo){
        //Verification qu'un menu n'existe pas déjà en cette date.
        $checkDateMenuStmt = $pdo->prepare("SELECT COUNT(*) from menu WHERE date = :date");
        $checkDateMenuStmt->bindParam(':date', $date, PDO::PARAM_STR);
        $checkDateMenuStmt->execute();
        $menuExist = (bool)$checkDateMenuStmt->fetchColumn();
        //Si déjà un menu confirmation d'ecrasement.
        if($menuExist){
            echo json_encode(["message"=>"Un menu existe déjà pour cette date"]);
            
        }else{
            $req = "INSERT INTO menu (`date`,entre1,entre2,entre3,plat1,plat2,accompagnement1,accompagnement2,fromage1,fromage2,dessert1,dessert2,jour)
            VALUES (:date, :entre1, :entre2, :entre3, :plat1, :plat2, :accompagnement1, :accompagnement2, :fromage1, :fromage2, :dessert1, :dessert2, :jour)";
            $stmt = $pdo->prepare($req);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
            $stmt->bindParam(':entre1', $entre1, PDO::PARAM_STR);
            $stmt->bindParam(':entre2', $entre2, PDO::PARAM_STR);
            $stmt->bindParam(':entre3', $entre3, PDO::PARAM_STR);
            $stmt->bindParam(':plat1', $plat1, PDO::PARAM_STR);
            $stmt->bindParam(':plat2', $plat2, PDO::PARAM_STR);
            $stmt->bindParam(':accompagnement1', $accompagnement1, PDO::PARAM_STR);
            $stmt->bindParam(':accompagnement2', $accompagnement2, PDO::PARAM_STR);
            $stmt->bindParam(':fromage1', $fromage1, PDO::PARAM_STR);
            $stmt->bindParam(':fromage2', $fromage2, PDO::PARAM_STR);
            $stmt->bindParam(':dessert1', $dessert1, PDO::PARAM_STR);
            $stmt->bindParam(':dessert2', $dessert2, PDO::PARAM_STR);
            $stmt->bindParam(':jour', $jour, PDO::PARAM_STR);
            $stmt->execute();
           
        }
    }

}catch(Exception $e){
    echo json_encode(["message"=>"problème lors de l'enregistrement du menu"]);
}finally{
    //Fermeture de la connexion PDO.
    if ($pdo){
        $pdo = null;
    }
    }
}

$data = json_decode(file_get_contents("php://input"), true);
echo json_encode(["message"=>"$date"]);

// Vérification si les données nécessaires sont présentes
if (isset($data['date'], $data['entre1'], $data['entre2'], $data['entre3'], $data['plat1'], $data['plat2'], $data['accompagnement1'], $data['accompagnement2'], $data['fromage1'], $data['fromage2'], $data['dessert1'], $data['dessert2'], $data['jour'])) {
    
    $dateString = $data['date']; // Récupération de la date depuis les données d'entrée
    $date = DateTime::createFromFormat('d-m-Y', $dateString); // Création d'un objet DateTime à partir de la chaîne de date

    $date = $data['date'];  
    $entre1 = $data['entre1'];
    $entre2 = $data['entre2'];
    $entre3 = $data['entre3'];
    $plat1 = $data['plat1'];
    $plat2 = $data['plat2'];
    $accompagnement1 = $data['accompagnement1'];
    $accompagnement2 = $data['accompagnement2'];
    $fromage1 = $data['fromage1'];
    $fromage2 = $data['fromage2'];
    $dessert1 = $data['dessert1'];
    $dessert2 = $data['dessert2'];
    $jour = $data['jour'];
  
    
    postMenu($date,$jour,$entre1,$entre2,$entre3,$plat1,$plat2,$accompagnement1,$accompagnement2,$fromage1,$fromage2,$dessert1,$dessert2);
    
    
} else {
    // Géstion du cas où des données requises sont manquantes
    echo json_encode(["message" => "Paramètres manquants"]);
}