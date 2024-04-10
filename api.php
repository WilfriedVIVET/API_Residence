<?php

require_once("./getConnect.php");


//Fonction sendJSON.
function sendJson($data){
    echo json_encode ($data,JSON_UNESCAPED_UNICODE);   
}


function getEntre(){
    try{
        $pdo = getConnect();

     if($pdo){
        $req = "SELECT p.titre, p.datedmm, c.categorie FROM plat p
        INNER JOIN plat_categorie pc ON p.plat_id = pc.id_plat
        INNER JOIN categorie c ON pc.id_categorie = c.id_categorie
        WHERE c.categorie = 'Entrée'
        GROUP BY titre
        ORDER BY p.titre";
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        sendJson($menus);
    }else{
        throw new Exception("La connexion à la base de données a échoué.");
    }
} catch (Exception $e) {
    sendJson(['error' => "erreur entrée" . $e->getMessage()]);
} finally {
        // Fermeture de la connexion PDO 
        if ($pdo) {
        $pdo = null;
       }
   }
}
function getPlat(){
    try{
        $pdo = getConnect();

     if($pdo){
        $req = "SELECT p.titre, p.datedmm, c.categorie FROM plat p
        INNER JOIN plat_categorie pc ON p.plat_id = pc.id_plat
        INNER JOIN categorie c ON pc.id_categorie = c.id_categorie
        WHERE c.categorie = 'Plat'
        GROUP BY titre
        ORDER BY p.titre";
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        sendJson($menus);
    }else{
        throw new Exception("La connexion à la base de données a échoué.");
    }
} catch (Exception $e) {
    sendJson(['error' => "erreur plat" . $e->getMessage()]);
} finally {
        // Fermeture de la connexion PDO 
        if ($pdo) {
        $pdo = null;
       }
   }
}
function getAccompagnement(){
    try{
        $pdo = getConnect();

     if($pdo){
        $req = "SELECT p.titre, p.datedmm,c.categorie FROM plat p
        INNER JOIN plat_categorie pc ON p.plat_id = pc.id_plat
        INNER JOIN categorie c ON pc.id_categorie = c.id_categorie
        WHERE c.categorie = 'Accompagnement'
        GROUP BY titre
        ORDER BY p.titre";
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        sendJson($menus);
    }else{
        throw new Exception("La connexion à la base de données a échoué.");
    }
} catch (Exception $e) {
    sendJson(['error' => "erreur accompagnement" . $e->getMessage()]);
} finally {
        // Fermeture de la connexion PDO 
        if ($pdo) {
        $pdo = null;
       }
   }
}
function getFromage(){
    try{
        $pdo = getConnect();

     if($pdo){
        $req = "SELECT p.titre, p.datedmm,c.categorie FROM plat p
        INNER JOIN plat_categorie pc ON p.plat_id = pc.id_plat
        INNER JOIN categorie c ON pc.id_categorie = c.id_categorie
        WHERE c.categorie = 'Fromage'
        GROUP BY titre
        ORDER bY p.titre";
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        sendJson($menus);
    }else{
        throw new Exception("La connexion à la base de données a échoué.");
    }
} catch (Exception $e) {
    sendJson(['error' => "erreur fromage" . $e->getMessage()]);
} finally {
        // Fermeture de la connexion PDO 
        if ($pdo) {
        $pdo = null;
       }
   }
}
function getDessert(){
    try{
        $pdo = getConnect();

     if($pdo){
        $req = "SELECT p.titre, p.datedmm, c.categorie FROM plat p
        INNER JOIN plat_categorie pc ON p.plat_id = pc.id_plat
        INNER JOIN categorie c ON pc.id_categorie = c.id_categorie
        WHERE c.categorie = 'Dessert'
        GROUP BY titre
        ORDER BY p.titre";
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        sendJson($menus);
    }else{
        throw new Exception("La connexion à la base de données a échoué.");
    }
} catch (Exception $e) {
    sendJson(['error' => "erreur dessert" . $e->getMessage()]);
} finally {
        // Fermeture de la connexion PDO 
        if ($pdo) {
        $pdo = null;
       }
   }
}

function getMenu($date){
    try{
        $pdo = getConnect();

     if($pdo){
        $req = "SELECT * FROM menu Where dateDay = :date";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(':date',$date, PDO::PARAM_STR);
        $stmt->execute();
        $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        sendJson($menus);
    }else{
        throw new Exception("La connexion à la base de données a échoué.");
    }
} catch (Exception $e) {
    sendJson(['error' => "Pas de menu pour ce jour" . $e->getMessage()]);
} finally {
        // Fermeture de la connexion PDO 
        if ($pdo) {
        $pdo = null;
       }
   }
}

function getUtilisateur(){
    try{
        $pdo = getConnect();

        if($pdo){
           $req = "SELECT 
           u.utilisateur_id,
           u.nom,
           u.prenom,
           u.appt,
           u.mixed,
           GROUP_CONCAT(DISTINCT r.role) AS role
       FROM 
           utilisateur u
       LEFT JOIN 
           role_utilisateur ru ON u.utilisateur_id = ru.id_utilisateur
       LEFT JOIN 
           role r ON ru.id_role = r.id_role
       GROUP BY 
           u.nom, u.prenom, u.appt, u.mixed;";
           $stmt = $pdo->prepare($req);
           $stmt->execute();
           $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
           $stmt->closeCursor();
           sendJson($users);
       }else{
           throw new Exception("La connexion à la base de données a échoué.");
       }
    }catch(Exception $e){
        sendJson(['error' => "Pas d'utilisateur" .$e->getMessage()]);
    }finally{
         // Fermeture de la connexion PDO 
         if ($pdo) {
            $pdo = null;
         }
    }
}

//Récupération des dates des menus déja en base de donnée pour le mois selectionné.
function getDateMenu($month){
    try{
        $pdo = getConnect();

     if($pdo){
        $req = "SELECT dateDay
        FROM menu
        WHERE EXTRACT(MONTH FROM dateDay) = :month";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(':month',$month, PDO::PARAM_INT);
        $stmt->execute();
        $date = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        sendJson($date);
    }else{
        throw new Exception("La connexion à la base de données a échoué.");
    }
} catch (Exception $e) {
    sendJson(['error' => "erreur récupération date" . $e->getMessage()]);
} finally {
        // Fermeture de la connexion PDO 
        if ($pdo) {
        $pdo = null;
       }
   }
}


