<?php

//Routage des pages.
require_once("./api.php");

try{
    if(!empty($_GET['page'])){
         $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        
         switch($url[0]){
            case"entre":
                getEntre();
                break;
            case"plat":
                getPlat();
                break;
            case"accompagnement":
                getAccompagnement();
                break;
            case"fromage":
                getFromage();
                break;
            case"dessert":
                getDessert();
                break;
            case"restaurant":
                if(!empty($url[1])){
                    
                    getMenu($url[1]);
                }else{
                    throw new Exception("Cette page n'existe pas");
                }
                break;
            case"restaurantmois":
                if(!empty($url[1])){
                    getMonthMenu($url[1]);
                }else{
                    throw new Exception("Cette page n'existe pas");
                }
                break;    
            case"utilisateur":
                getUtilisateur();
                break;   
            case"datemenu":
                if(!empty($url[1])){
                    getDateMenu($url[1]);
                }else{
                    throw new Exception("Cette page n'existe pas");
                }
                break;    
            default:
                throw new Exception("Cette page n'existe pas");    
         }
    }else{
        throw new Exception("Cette page n'existe pas");    
    }


}catch (Exception $exception){
    $erreur = [
        "message" => $exception->getMessage(),
        "code" => $exception->getCode()
    ];

    // Envoi de la réponse JSON
    header('Content-Type: application/json');
    echo json_encode($erreur);
}