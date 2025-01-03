<?php
include "conexion.php";
// Permitir solicitudes de cualquier origen
header('Access-Control-Allow-Origin: *');
// Especificar que los datos que se envían son de tipo JSON
header('Content-Type: application/json');
// Consulta para seleccionar todos los registros de la tabla
$sql = "SELECT * FROM crea_tu_concepto";
$resultado = $conexion->query($sql);

// Inicializo un array vacío para guardar los registros
$registros = [];

// Guardo cada registro como un array dentro del array $registros
while ($registro = $resultado->fetch_assoc()) {
    $registros[] = $registro;
}

// Genero el JSON y lo escribo en la respuesta
echo json_encode($registros, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
