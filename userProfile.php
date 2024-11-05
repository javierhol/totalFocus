<?php
// Incluir el archivo de conexión a la base de datos
require_once "connect.php";
session_start();

if(isset($_SESSION['user'])) {
    $userId = $_SESSION['user'];

    try {
        $conn = getConnect();

        $query = "SELECT * FROM users WHERE id = ?";

        $statement = $conn->prepare($query);

        $statement->bind_param("i", $userId);

        $statement->execute();

        $result = $statement->get_result();

        if($result->num_rows > 0) {
            $userData = $result->fetch_assoc();
            $username = $userData['username'];
            $email = $userData['email'];
            $img = $userData['img'];
        } else {
            echo 'No se encontró ningún usuario con el ID proporcionado';
        }
    } catch (Exception $e) {
        echo 'Error de conexión: ' . $e->getMessage();
    } finally {
        $statement->close();
        $conn->close();
    }
} else {
    echo "No hay datos de usuario en el localStorage";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/userProfile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Editar Perfil</title>
</head>

<body>
    <div class="container-xl px-4 mt-4">
    <form id="edit-profile" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xl-4">
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Foto de perfil</div>
                    <div class="card-body text-center">
                        <img class="img-account-profile rounded border border-success mb-2"
                        src="<?php echo isset($img) ? $img : 'https://bootdey.com/img/Content/avatar/avatar1.png'; ?>" alt="Foto de perfil">
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card mb-4">
                    <div class="card-header">Cuenta</div>

                    <div class="card-body">
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Nombre</label>
                                <input class="form-control" id="inputFirstName" type="text" name="username"
                                    placeholder="Enter your first name" value="<?php echo isset($username) ? $username : ''; ?> " disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOrgName">Correo</label>
                                <input class="form-control" id="email" type="email" name="email" placeholder="relaxifi@relax.com" value="<?php echo isset($email) ? $email : ''; ?>" disabled>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="currentPassword">Contraseña Actual</label>
                            <input class="form-control" id="currentPassword" type="password" name="currentPassword" placeholder="Contraseña Actual">
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="newPassword">Nueva Contraseña</label>
                            <input class="form-control" id="newPassword" type="password" name="newPassword" placeholder="Nueva Contraseña">
                        </div>
                        <button class="btn btn-success" type="submit">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    <script src="./js/editUser.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  

</body>

</html>