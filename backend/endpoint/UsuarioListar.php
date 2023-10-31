<?php
    include_once '../model/User.php';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        $objUsuario = new User();
        $lstUsuario = $objUsuario -> UsuarioListar();

        if ($lstUsuario) {
            $datos["usuarios"] = $lstUsuario;

            print json_encode($datos);
        } else {
            print json_encode(array(
                "mensaje" => "Ha ocurrido un error"
            ));
        }
    }