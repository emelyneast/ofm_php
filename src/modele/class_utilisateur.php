<?php
class Utilisateur{    
    private $db;
    private $select;  
    private $connect;
    private $insert; 
    private $selectById;
    private $update;
    private $delete;
    // Étape 1 
    public function __construct($db){        
        $this->db = $db; 
        $this->delete = $db->prepare("delete from utilisateur where id=:id");
        $this->insert = $this->db->prepare("insert into utilisateur(email, mdp, nom, prenom, idRole)values (:email, :mdp, :nom, :prenom, :role)");   // Étape 2         
        //pas trop d'espace
        $this->update  =  $db->prepare("update  utilisateur  set  nom=:nom,  prenom=:prenom,  idRole=:role where id=:id");
        $this->selectById  =  $db->prepare("select  id,  email,  nom,  prenom,  idRole  from  utilisateur  where id=:id");
        $this->connect   =   $this->db->prepare("select email, idRole, mdp from utilisateur  where email=:email");          
        $this->select = $db->prepare("select u.id, email, idRole, nom, prenom, r.libelle as libellerole from utilisateur u, role r where u.idRole = r.id order by nom");   
    }

    public function delete($id){
        $r = true;
        $this->delete->execute(array(':id'=>$id));
        if ($this->delete->errorCode()!=0){
        print_r($this->delete->errorInfo());
        $r=false;
        }
        return $r;
        }
       

    public function update($id, $role, $nom, $prenom){        
        $r = true;        
        $this->update->execute(array(':id'=>$id, ':role'=>$role, ':nom'=>$nom, ':prenom'=>$prenom));        
        if ($this->update->errorCode()!=0)
        {             
            print_r($this->update->errorInfo());               
            $r=false;        
        }        
        return $r;    
    }

    public function selectById($id){          
        $this->selectById->execute(array(':id'=>$id));        
        if ($this->selectById->errorCode()!=0){             
            print_r($this->selectById->errorInfo());          
        }        
        return $this->selectById->fetch(); 
    }

    public function insert($email, $mdp, $role, $nom, $prenom){ // Étape 3         
        $r = true;        
        $this->insert->execute(array(':email'=>$email, ':mdp'=>$mdp, ':role'=>$role, ':nom'=>$nom,':prenom'=>$prenom));        
        if ($this->insert->errorCode()!=0)
        {             
            print_r($this->insert->errorInfo());               
            $r=false;        
        }        
        
        return $r;   
    }
    
    public function connect($email){   
        $unUtilisateur = $this->connect->execute(array(':email'=>$email));        
        if ($this->connect->errorCode()!=0){            
             print_r($this->connect->errorInfo());          
        }        
        return $this->connect->fetch();  
    }

    public function select(){        
        $this->select->execute();        
        if ($this->select->errorCode()!=0){             
            print_r($this->select->errorInfo());          
        }        
        return $this->select->fetchAll();    
    }
    }
?>