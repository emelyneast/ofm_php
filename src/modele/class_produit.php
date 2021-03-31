<?php
    class Produit
    {    
        private $db;  private $insert; 
        // Étape 1    
        public function __construct($db){        
            $this->db = $db; 
            $this->insert = $this->db->prepare("insert into produit ( prix, designation, description, idType )values ( :prix, :designation, :description, :type)");   
            // Étape 2         
        } public function insert( $prix, $designation,$description, $type){ 
            // Étape 3
            $r = true;        
            $this->insert->execute(array( ':prix'=>$prix,  ':designation'=>$designation,':description'=>$description,':type'=>$type));        
            if ($this->insert->errorCode()!=0){             
                print_r($this->insert->errorInfo());               
                $r=false;        
            }        
            return $r;    
        }       
           
    
    }

?>