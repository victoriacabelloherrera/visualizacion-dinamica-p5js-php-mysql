<?php
include 'conexion.php';


$num_celular = '';
$bateria = '';
$mes_nacimiento = '';
$concepto_celular = '';
$concepto_bateria = '';
$concepto_mes = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $num_celular = $_POST['numero_celular'];  
    $bateria = $_POST['bateria'];  
    $mes_nacimiento = $_POST['mes_nacimiento'];  


    $concepto_celular = datos_del_celular($num_celular);
    $concepto_bateria = datos_de_bateria($bateria);
    $concepto_mes = datos_de_mes($mes_nacimiento);

    
    $sql = "INSERT INTO crea_tu_concepto (num_celular, bateria, mes_nacimiento, concepto_celular, concepto_bateria, concepto_mes) 
            VALUES ('$num_celular', '$bateria', '$mes_nacimiento', '$concepto_celular', '$concepto_bateria', '$concepto_mes')";

    if ($conexion->query($sql) === TRUE) {

        header("Location: tu_concepto.php");
        exit;  
    } else {
        echo "Error al insertar los datos: " . $conexion->error;
    }
}

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
