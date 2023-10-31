<?php
    class UsuarioController {
        public function listar() {
            // Llama al modelo para obtener la lista de productos
            $lstUsuario = Usuario::UsuarioListar();
    
            // Devuelve la lista de productos como resultado en formato JSON
            header('Content-Type: application/json');
            echo json_encode($lstUsuario);
        }
    }