<?php

function accueilControleur($twig){    
    echo $twig->render('accueil.html.twig', array());
}

function aboutControleur($twig){    
    echo $twig->render('about.html.twig', array());
}

function connexionControleur($twig, $db){    
    $form = array();     
    if (isset($_POST['btConnecter'])){        
        $form['valide'] = true;        
        $inputEmail = $_POST['inputEmail'];        
        $inputPassword = $_POST['inputPassword'];    
        $utilisateur = new Utilisateur($db);        
        $unUtilisateur = $utilisateur->connect($inputEmail);       
         if ($unUtilisateur!=null){          
             if(!password_verify($inputPassword,$unUtilisateur['mdp'])){              
                $form['valide'] = false;
                $form['message'] = 'Login ou mot de passe incorrect';          
            }            
            else{ 
                $_SESSION['login'] = $inputEmail;                
                $_SESSION['role'] = $unUtilisateur['idRole'];           
                header("Location:index.php");          
             }         
        }        
        else{           
            $form['valide'] = false;           
            $form['message'] = 'Login ou mot de passe incorrect';
        }    
    }    
    echo $twig->render('connexion.html.twig', array('form'=>$form));
}
    
function inscriptionControleur($twig, $db){    
    $form = array();     
    if (isset($_POST['btInscrire'])){       
        $inputEmail = $_POST['inputEmail'];      
        $inputPassword = $_POST['inputPassword'];       
        $inputPassword2 =$_POST['inputPassword2'];
        $inputNom = $_POST['inputNom'];       
        $inputPrenom =$_POST['inputPrenom'];       
        $role = $_POST['role'];      
        $form['valide'] = true; 
        if ($inputPassword!=$inputPassword2){        
            $form['valide'] = false;          
            $form['message'] = 'Les mots de passe sont différents';      
        }else{
            $utilisateur = new Utilisateur($db);         
            $exec = $utilisateur->insert($inputEmail, password_hash($inputPassword, PASSWORD_DEFAULT), $role, $inputNom, $inputPrenom);        
            if (!$exec){          
                $form['valide'] = false;            
                $form['message'] = 'Problème d\'insertion dans la table utilisateur ';          
            }
        }      
        $form['email'] = $inputEmail;    
        $form['Nom'] = $inputNom;
        $form['Prenom'] = $inputPrenom;  
        $form['role'] = $role;    }
        
    echo $twig->render('inscription.html.twig', array());
}

function adminControleur($twig){    
   
    echo $twig->render('admin.html.twig', array());
}


 


?>