<?php
session_start();
session_unset(); // Limpia todas las variables de sesión
session_destroy(); // Destruye la sesión
echo json_encode(["success" => true, "message" => "Sesión cerrada correctamente."]);

?>