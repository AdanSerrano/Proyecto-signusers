<?php
    require_once('modelo.php');

    class User extends modeloCredencialesBD{

        // Método para crear un usuario
        public function UsuarioCrear($nombre, $email, $password) 
        {
            try 
            {
                $instruccion = "CALL SP_USUARIO_REGISTRO('".$nombre."', '".  $email."', '". $password."')";
                $actualizar = $this->_db->query($instruccion);
                
                if($actualizar){
                    return $actualizar;
                    $resactualizarultado->close();
                    $this->_db->close();
                }
                else{
                    echo "Error al actualizar los votos";
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
                $instruccion = "call SP_USUARIO_LISTAR()";
            
                $consulta = $this->_db->query($instruccion);
                $resultado = $consulta->fetch_all(MYSQLI_ASSOC);

                if(!$resultado){
                    echo "Error al consultar las noticias";
                }
                else{
                    return $resultado;
                    $resultado->close();
                    $this->_db->close();
                }
            } catch (PDOException $e) {
                return false; 
            }
        }

        // Método para saber si un email ya existe en la base de datos
        public function UsuarioExiste($email)
        {

            try 
            {
                $instruccion = "call SP_USUARIO_VERIFICAR_EMAIL('".$email."')";
            
                $consulta = $this->_db->query($instruccion);
                $resultado = $consulta->fetch_all(MYSQLI_ASSOC);

                if(!$resultado){
                    echo "Error al consultar las noticias";
                }
                else{
                    return $resultado;
                    $resultado->close();
                    $this->_db->close();
                }
            } catch (PDOException $e) {
                return false; 
            }
       } 

        // Método para mostrar información de un usuario por correo
        public function UsuarioMostrar($email)
        {
            try 
            {
                $stmt = $this->db->prepare("CALL SP_USUARIO_LISTAR_POR_CORREO(:email)");
    
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    
                $stmt->execute();

                $result = $stmt->fetch(PDO::FETCH_ASSOC);

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

        // Método para modificar información de un usuario
        public function UsuarioModificar($nombre, $email, $password)
        {
            try 
            {
                $stmt = $this->db->prepare("CALL SP_USUARIO_MODIFICAR(:nombre, :email, :password)");
    
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

        // Método para modificar imagen de un usuario
        public function UsuarioActualizarImagen($email, $imagen)
        {
            try 
            {
                $stmt = $this->db->prepare("CALL SP_USUARIO_ACTUALIZAR_IMAGEN(:email, :imagen)");
    
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':imagen', $imagen, PDO::PARAM_STR);
    
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

        // Método para eliminar un usuario
        public function UsuarioEliminar($email)
        {
            try 
            {
                $stmt = $this->db->prepare("CALL SP_USUARIO_ELIMINAR(:email)");
    
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    
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

    }