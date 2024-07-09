<?php
$conexion = mysqli_connect('localhost', 'root', '', 'sm32');

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isbn = $_POST['isbn'];
    $nombre = $_POST['nombre'];
    $autor = $_POST['autor'];
    $precio = $_POST['precio'];
    $editorial = $_POST['editorial'];
    $imagen = $_POST['imagen'];

    if ($isbn === '') {
        $errores[] = 'Debes ingresar un ISBN';
    }
    if ($nombre === '') {
        $errores[] = 'Debes ingresar un Nombre';
    }
    if ($autor === '') {
        $errores[] = 'Debes ingresar un Autor';
    }
    if ($precio === '') {
        $errores[] = 'Debes ingresar un Precio';
    }
    if ($editorial === '') {
        $errores[] = 'Debes ingresar un Editorial';
    }
    if ($imagen === '') {
        $errores[] = 'Debes ingresar una Imagen';
    }

    if (empty($errores)) {
        $peticionInsertar = "INSERT INTO libros (isbn, nombre, autor, precio, editorial, imagen) VALUES ('$isbn','$nombre','$autor','$precio','$editorial','$imagen')";
        if (mysqli_query($conexion, $peticionInsertar)) {
            header("Location: ../index.php");
            exit;
        }
    } else {
        header("Location: mensaje_error.php"); 
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear un libro</title>
</head>
<body>
    <a href="../index.php">Regresar</a>
    <?php foreach ($errores as $error): ?>
        <div style="background-color: black; color: red;"><?php echo $error ?></div>
    <?php endforeach ?>

    <form action="crear.php" method="POST">
        <label for="">ISBN</label>
        <input type="text" name="isbn">
        <label for="">Nombre</label>
        <input type="text" name="nombre">
        <label for="">Autor</label>
        <input type="text" name="autor">
        <label for="">Precio</label>
        <input type="number" name="precio">
        <label for="">Editorial</label>
        <input type="text" name="editorial">
        <label for="">Imagen</label>
        <input type="text" name="imagen">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
