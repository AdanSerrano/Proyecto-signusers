<?php
    class Login{
        private $db;

        public function __construct($db) {
            $this->db = $db;
        }

        // Método para crear un usuario
        public function Login($email, $password) 
        {
            try 
            {
                $stmt = $this->db->prepare("CALL SP_LOGIN(:email, :password)");
    
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    
                $stmt->execute();

                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    return true;
                } else {
                    return false;
                }
        
                return true; 
            } catch (PDOException $e) {
                return false; 
            }
        }
    }