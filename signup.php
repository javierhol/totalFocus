<?php
require_once 'connect.php';

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

    $username = $_POST[ 'username' ];
    $email = $_POST[ 'email' ];
    $pass = $_POST[ 'password' ];

    $email_check_query = "SELECT * FROM users WHERE email='$email'";

    $conn = getConnect();

    $email_check_result = mysqli_query( $conn, $email_check_query );

    if ( $email_check_result ) {

        if ( mysqli_num_rows( $email_check_result ) > 0 ) {

            $response = array(
                'status' => 'error',
                'message' => 'El correo electrónico ya está en uso.'
            );
            echo json_encode( $response );

        } else {

            $hashed_password = password_hash( $pass, PASSWORD_DEFAULT );

            $insert_query = "INSERT INTO users (username,email,pass) VALUES ('$username','$email','$hashed_password')";

            if ( mysqli_query( $conn, $insert_query ) ) {

                $response = array(
                    'status' => 'success',
                    'message' => 'Usuario registrado correctamente.'
                );
                echo json_encode( $response );
                exit();
            } else {

                echo 'Error al registrar el usuario: ' . mysqli_error( $conn );
            }
        }
    } else {

        echo 'Error en la consulta: ' . mysqli_error( $conn );
    }
}
?>