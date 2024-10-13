<?php

require_once 'connect.php';

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    $email = $_POST['email'];
    $pass = $_POST['password'];

    $email_check_query = "SELECT * FROM users WHERE email='$email'";

    $conn = getConnect();

    $email_check_result = mysqli_query( $conn, $email_check_query );

    if( $email_check_result ) {

        if( mysqli_num_rows( $email_check_result ) > 0 ) {

            $user = mysqli_fetch_assoc( $email_check_result );

            if( password_verify( $pass, $user['pass'] ) ) {
                session_start();
                $_SESSION['user'] = $user;
                unset( $_SESSION['user']['pass'] );
                $response = array(
                    'status' => 'success',
                    'message' => 'Inicio de sesión correcto.',
                    'user' => $user
                    
                );
                echo json_encode( $response );
                exit();
            } else {

                $response = array(
                    'status' => 'error',
                    'message' => 'Contraseña incorrecta.'
                );
                echo json_encode( $response );
            }
        } else {

            $response = array(
                'status' => 'error',
                'message' => 'El correo electrónico no está registrado.'
            );
            echo json_encode( $response );
        }
    } else {

        echo 'Error en la consulta: ' . mysqli_error( $conn );
    }
}


?>