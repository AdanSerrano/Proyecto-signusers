<?php
    class User {
        private $db;

        public function __construct($db) {
            $this->db = $db;
        }

        // Método para crear un usuario
        public function UsuarioCrear($nombre, $apellido, $email, $password) 
        {
            try 
            {
                // Llamar al procedimiento almacenado
                $stmt = $this->db->prepare("CALL SP_USUARIO_REGISTRO(:nombre, :email, :password)");
    
                $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    
                $stmt->execute();

                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    return false;
                } else {
                    return true;
                }
        
                return true; 
            } catch (PDOException $e) {
                return false; 
            }
        }

        // Método para listar los usuarios
        public function UsuarioListar()
        {
            try 
            {
                // Llamar al procedimiento almacenado
                $stmt = $this->db->prepare("CALL SP_USUARIO_LISTAR()");
    
                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($result) {
                    return $result;
                } else {
                    return false;
                }
                return true; 
            } catch (PDOException $e) {
                return false; 
            }
        }

        // Método para saber si un email ya existe en la base de datos
        public function UsuarioExiste($email)
        {
            try 
            {
                // Llamar al procedimiento almacenado
                $stmt = $this->db->prepare("CALL SP_USUARIO_VERIFICAR_EMAIL(:email)");
    
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    
                $stmt->execute();

                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if (intval($result['total']) == 0) {
                    return false;
                } else {
                    return true;
                }
                return true; 
            } catch (PDOException $e) {
                return false; 
            }
        } 


    }