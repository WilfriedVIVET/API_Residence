<?php

require_once("./getConnect.php");


//Fonction sendJSON.
function sendJson($data){
    echo json_encode ($data,JSON_UNESCAPED_UNICODE);   
}

function getPlats (){
    try{
        $pdo = getConnect();

     if($pdo){
        $req = "SELECT p.titre, p.datedmm, p.notemoyenne, c.categorie FROM plat p
        INNER JOIN plat_categorie pc ON p.plat_id = pc.id_plat
        INNER JOIN categorie c ON pc.id_categorie = c.id_categorie
        GROUP BY titre";
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        sendJson($menus);
    }else{
        throw new Exception("La connexion à la base de données a échoué.");
    }
} catch (Exception $e) {
    sendJson(['error' => "erreur" . $e->getMessage()]);
} finally {
        // Fermeture de la connexion PDO 
        if ($pdo) {
        $pdo = null;
       }
   }
}
function getEntre(){
    try{
        $pdo = getConnect();

     if($pdo){
        $req = "SELECT p.titre, p.datedmm, p.notemoyenne, c.categorie FROM plat p
        INNER JOIN plat_categorie pc ON p.plat_id = pc.id_plat
        INNER JOIN categorie c ON pc.id_categorie = c.id_categorie
        WHERE c.categorie = 'Entrée'
        GROUP BY titre";
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        sendJson($menus);
    }else{
        throw new Exception("La connexion à la base de données a échoué.");
    }
} catch (Exception $e) {
    sendJson(['error' => "erreur" . $e->getMessage()]);
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
        $req = "SELECT p.titre, p.datedmm, p.notemoyenne, c.categorie FROM plat p
        INNER JOIN plat_categorie pc ON p.plat_id = pc.id_plat
        INNER JOIN categorie c ON pc.id_categorie = c.id_categorie
        WHERE c.categorie = 'Plat'
        GROUP BY titre";
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        sendJson($menus);
    }else{
        throw new Exception("La connexion à la base de données a échoué.");
    }
} catch (Exception $e) {
    sendJson(['error' => "erreur" . $e->getMessage()]);
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
        $req = "SELECT p.titre, p.datedmm, p.notemoyenne, c.categorie FROM plat p
        INNER JOIN plat_categorie pc ON p.plat_id = pc.id_plat
        INNER JOIN categorie c ON pc.id_categorie = c.id_categorie
        WHERE c.categorie = 'Accompagnement'
        GROUP BY titre";
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        sendJson($menus);
    }else{
        throw new Exception("La connexion à la base de données a échoué.");
    }
} catch (Exception $e) {
    sendJson(['error' => "erreur" . $e->getMessage()]);
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
        $req = "SELECT p.titre, p.datedmm, p.notemoyenne, c.categorie FROM plat p
        INNER JOIN plat_categorie pc ON p.plat_id = pc.id_plat
        INNER JOIN categorie c ON pc.id_categorie = c.id_categorie
        WHERE c.categorie = 'Fromage'
        GROUP BY titre";
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        sendJson($menus);
    }else{
        throw new Exception("La connexion à la base de données a échoué.");
    }
} catch (Exception $e) {
    sendJson(['error' => "erreur" . $e->getMessage()]);
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
        $req = "SELECT p.titre, p.datedmm, p.notemoyenne, c.categorie FROM plat p
        INNER JOIN plat_categorie pc ON p.plat_id = pc.id_plat
        INNER JOIN categorie c ON pc.id_categorie = c.id_categorie
        WHERE c.categorie = 'Dessert'
        GROUP BY titre";
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        sendJson($menus);
    }else{
        throw new Exception("La connexion à la base de données a échoué.");
    }
} catch (Exception $e) {
    sendJson(['error' => "erreur" . $e->getMessage()]);
} finally {
        // Fermeture de la connexion PDO 
        if ($pdo) {
        $pdo = null;
       }
   }
}

function getMenu(){
    try{
        $pdo = getConnect();

     if($pdo){
        $req = "SELECT * FROM menu";
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        sendJson($menus);
    }else{
        throw new Exception("La connexion à la base de données a échoué.");
    }
} catch (Exception $e) {
    sendJson(['error' => "erreur" . $e->getMessage()]);
} finally {
        // Fermeture de la connexion PDO 
        if ($pdo) {
        $pdo = null;
       }
   }
}