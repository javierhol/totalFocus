<?php
require_once 'connect.php';

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $theme = $_POST['theme'];
    $message = $_POST['message'];

    $conn = getConnect();

    $sql = "INSERT INTO contact (name, email, theme, message) VALUES ('$name', '$email', '$theme', '$message')";

    if( $conn->query( $sql ) === TRUE ) {

        $response = array(
            'status' => 'success',
            'message' => 'Mensaje enviado correctamente.'
        );
        echo json_encode( $response );
    } else {

        $response = array(
            'status' => 'error',
            'message' => 'Error al enviar el mensaje.'
        );
        echo json_encode( $response );
    }
}

?>