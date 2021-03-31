<?php
    
function getPage(){
    
    
    $lesPages['accueil'] = "accueilControleur";
    $lesPages['about'] = "aboutControleur";
    $lesPages['connexion'] = "connexionControleur";
    $lesPages['inscription'] = "inscriptionControleur";
    $lesPages['admin'] = "adminControleur";

        if (isset($_GET['page'])){        
            $page = $_GET['page'];    
        }    
        else{        
            $page = 'accueil';
        }    if (isset($lesPages[$page])){        
        $contenu = $lesPages[$page];    }    
            else{        
             $contenu = $lesPages['accueil'];    
            }


         
    
    return $contenu;
}
?>