<?php

function accueilControleur($twig){    
    echo $twig->render('accueil.html.twig', array());
}

function aboutControleur($twig){    
    echo $twig->render('about.html.twig', array());
}

function connexionControleur($twig){    
   
    echo $twig->render('connexion.html.twig', array());
}
    
function inscriptionControleur($twig){    
   
    echo $twig->render('inscription.html.twig', array());
}
function adminControleur($twig){    
   
    echo $twig->render('admin.html.twig', array());
}

?>