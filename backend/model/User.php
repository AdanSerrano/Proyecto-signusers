<?php
    require_once('modelo.php');

    class User extends modeloCredencialesBD{



      

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

    }