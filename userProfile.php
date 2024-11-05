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
            $lastname = $userData['lastname'];
            $email = $userData['email'];
            $img = $userData['img'];
            $phone = $userData['phone'];
            $description = $userData['description'];
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
    <link rel="stylesheet" href="./css/editUser.css">
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
                        src="<?php echo isset($img) && !empty($img) ? 'uploads/' . $img : 'http://bootdey.com/img/Content/avatar/avatar1.png'; ?>" alt="Foto de perfil">
                        <div class="small font-italic mb-4 text-warning">JPG o PNG no mayor a 5 MB</div>
                        <div class="container-input">
                            <input type="file" name="img" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} archivos seleccionados" multiple />
                            <label for="file-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
                                <span class="iborrainputfile">Seleccionar archivo</span>
                            </label>
                        </div>
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
                                        placeholder="Enter your first name" value="<?php echo isset($username) ? $username : ''; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Apellido</label>
                                    <input class="form-control" id="inputLastName" type="text" name="lastname"
                                        placeholder="Enter your last name" value="<?php echo isset($lastname) ? $lastname : ''; ?>">
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputOrgName">Correo</label>
                                    <input class="form-control" id="email" type="email" name="email" placeholder="relaxifi@relax.com" value="<?php echo isset($email) ? $email : ''; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLocation">Telefono</label>
                                    <input class="form-control" id="phone" name="phone" type="number"
                                        placeholder="Ex.3324904432" value="<?php echo isset($phone) ? $phone : ''; ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Descripcion</label>
                                <textarea class="form-control" name="description" placeholder="Cuenta de ti...."><?php echo isset($description) ? $description : ''; ?></textarea>
                            </div>
                            <button class="btn btn-success" type="submit">Guadar Cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/edit.js"></script>
    <script src="./js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  

</body>

</html>