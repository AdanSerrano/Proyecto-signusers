<?php
    include_once '../model/Login.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $objLogin = new Login();
        $login = $objLogin -> Login($email, $password);

        // valida si retorna información
        if ($login ) {
            foreach ($login as $valor) {
                print json_encode(array(
                    "mensaje" => $valor['message']
                ));
            }
        } else {
            print json_encode(array(
                "mensaje" => "Ha ocurrido un error"
            ));
        }
    }