<?php
include 'conexion.php';
include 'views/nav.php';


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    echo "<div class='alert alert-danger'>No se proporcionó un ID válido.</div>";
    exit;
}


$registro = [
    'num_celular' => '',
    'bateria' => '',
    'mes_nacimiento' => ''
];


$result = $conexion->query("SELECT * FROM crea_tu_concepto WHERE id = $id");
if ($result->num_rows > 0) {
    $registro = $result->fetch_assoc();
} else {
    echo "<div class='alert alert-danger'>El registro con ID $id no existe.</div>";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num_celular = $_POST['numero_celular'];
    $bateria = $_POST['bateria'];
    $mes_nacimiento = $_POST['mes_nacimiento'];


    $concepto_celular = datos_del_celular($num_celular);
    $concepto_bateria = datos_de_bateria($bateria);
    $concepto_mes = datos_de_mes($mes_nacimiento);


    $sql = "UPDATE crea_tu_concepto 
            SET num_celular = '$num_celular', bateria = '$bateria', mes_nacimiento = '$mes_nacimiento',
                concepto_celular = '$concepto_celular', concepto_bateria = '$concepto_bateria', concepto_mes = '$concepto_mes' 
            WHERE id = $id";

    if ($conexion->query($sql) === TRUE) {

        header("Location: tu_concepto.php");

    } else {
        echo "<div class='alert alert-danger'>Error al actualizar el registro: " . $conexion->error . "</div>";
    }
}


// Funciones para obtener los conceptos

function datos_del_celular($num_celular) {
    $conceptos = [
        0 => 'La multimedia',
        1 => 'La tecnología',
        2 => 'El artista',
        3 => 'La guerra',
        4 => 'La paz',
        5 => 'La libertad',
        6 => 'La depresión',
        7 => 'La felicidad',
        8 => 'La oscuridad',
        9 => 'La enfermedad',
    ];
    if (isset($conceptos[$num_celular])) {
        return $conceptos[$num_celular];
    }
}

function datos_de_bateria($bateria) {
    $conceptos = [
        0 => 'desmaterializa',
        1 => 'desconfigura',
        2 => 'libera',
        3 => 'trasciende',
        4 => 'expulsa',
        5 => 'refrecta',
        6 => 'impulsa',
        7 => 'destruye',
        8 => 'expande',
        9 => 'deslumbra',
    ];
    if (isset($conceptos[$bateria])) {
        return $conceptos[$bateria];
    }
}

function datos_de_mes($mes_nacimiento) {
    $conceptos = [
        'Enero' => 'nuestra vida',
        'Febrero' => 'la identidad',
        'Marzo' => 'la cotidianeidad',
        'Abril' => 'la política',
        'Mayo' => 'la fascinación',
        'Junio' => 'los antepasados',
        'Julio' => 'el astío',
        'Agosto' => 'el tiempo',
        'Septiembre' => 'la realidad',
        'Octubre' => 'un loop',
        'Noviembre' => 'el infierno',
        'Diciembre' => 'lo externo',
    ];
    if (isset($conceptos[$mes_nacimiento])) {
        return $conceptos[$mes_nacimiento];
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <header class="mt-4">
        <h1>Editar Registro</h1>
        <a href="tu_concepto.php" class="btn btn-secondary">Volver a la Lista</a>
    </header>
    <main class="mt-4">
        <form method="POST">
            <div class="mb-3">
                <label for="numero_celular" class="form-label">Último dígito de tu número de celular</label>
                <select class="form-select" id="numero_celular" name="numero_celular" required>
                    <?php
                    for ($i = 0; $i <= 9; $i++) {
                        $selected = ($i == $registro['num_celular']) ? 'selected' : '';
                        echo "<option value='$i' $selected>$i</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="bateria" class="form-label">Último dígito del nivel de batería</label>
                <select class="form-select" id="bateria" name="bateria" required>
                    <?php
                    for ($i = 0; $i <= 9; $i++) {
                        $selected = ($i == $registro['bateria']) ? 'selected' : '';
                        echo "<option value='$i' $selected>$i</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="mes_nacimiento" class="form-label">Mes de nacimiento</label>
                <select class="form-select" id="mes_nacimiento" name="mes_nacimiento" required>
                    <?php
                    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                    foreach ($meses as $mes) {
                        $selected = ($mes == $registro['mes_nacimiento']) ? 'selected' : '';
                        echo "<option value='$mes' $selected>$mes</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
