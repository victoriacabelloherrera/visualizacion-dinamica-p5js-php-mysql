<?php
include 'conexion.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM crea_tu_concepto WHERE id = $id";
    if ($conexion->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>¡Artista eliminado con éxito!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error al eliminar el artista: " . $conexion->error . "</div>";
    }
}

header("Location: tu_concepto.php?message=deleted");
exit;

?>