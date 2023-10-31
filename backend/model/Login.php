<?php
    require_once('modelo.php');

    class Login extends modeloCredencialesBD{

        // Método para crear un usuario
        public function Login($email, $password) 
        {
            try 
            {
                $instruccion = "CALL SP_LOGIN('". $email."', '". $password."')";
                $consulta = $this->_db->query($instruccion);
                
                $resultado = $consulta->fetch_all(MYSQLI_ASSOC);

                if($resultado){
                    return $resultado;
                    $resactualizarultado->close();
                    $this->_db->close();
                }
                else{
                    return "usuario o contraseña incorrectos :p";
                }        
                return true; 
            } catch (PDOException $e) {
                return false; 
            }
        }
    }