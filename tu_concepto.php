<?php
include 'conexion.php';
include 'views/nav.php';


if (isset($_GET['message']) && $_GET['message'] === 'deleted') {
    echo "<div class='alert alert-success alert-dismissible fade show mt-4' role='alert'>
            ¡Registro eliminado con éxito!
          </div>";
}
?>

<div class="container">
    <header class="mt-4">
        <h1>Ingresa tus datos</h1>
    </header>

    <main class="mt-4">
        <div class="row">
            <!-- FORM DE INGRESO DE DATOS -->
            <div class="col-md-6">
                <h2>Agregar Datos Personales</h2>
                <form method="POST" action="procesamiento.php">
                    <div class="mb-3">
                        <label for="numero_telefono" class="form-label">Último dígito de tu número de celular</label>
                        <select class="form-select" id="numero_telefono" name="numero_celular" required>
                            <option value="">Selecciona el dígito</option>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nivel_bateria" class="form-label">Último dígito del nivel de batería</label>
                        <select class="form-select" id="nivel_bateria" name="bateria" required>
                            <option value="">Selecciona el dígito</option>
                            <?php
                            for ($i = 0; $i <= 9; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="mes_nacimiento" class="form-label">Mes de nacimiento</label>
                        <select class="form-select" id="mes_nacimiento" name="mes_nacimiento" required>
                            <option value="">Selecciona tu mes de nacimiento</option>
                            <?php
                            $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                            foreach ($meses as $mes) {
                                echo "<option value='$mes'>$mes</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Agregar</button>
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Volver al inicio</button>
                </form>
            </div>

            <!-- TABLA DE DATOS INGRESADOS -->
            <div class="col-md-6">
                <h2>Lista de Datos</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Último dígito de celular</th>
                            <th>Último dígito de batería</th>
                            <th>Mes de nacimiento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT id, num_celular, bateria, mes_nacimiento, concepto_celular, concepto_bateria, concepto_mes FROM crea_tu_concepto ORDER BY id DESC";
                        $result = $conexion->query($sql);

                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['concepto_celular'] . "</td>";
                                echo "<td>" . $row['concepto_bateria'] . "</td>";
                                echo "<td>" . $row['concepto_mes'] . "</td>";
                                echo "<td>
                                        <div class='d-flex'>
                                            <a href='editar.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm mx-1'>Editar</a>
                                            <a href='eliminar.php?delete=" . $row['id'] . "' class='btn btn-danger btn-sm mx-1' onclick=\"return confirm('¿Estás seguro de eliminar este registro?');\">Eliminar</a>
                                        </div>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No hay datos registrados</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center mt-5">
            <p>¿Te gustaría ver tu concepto dentro de una interfaz visual?</p>
            <a href="http://localhost/cabello_herrera_final/visualizacion_p5/index.html" target="_blank" class="btn btn-success">
                Presiona aquí
            </a>
        </div>
    </main>
</div>

<?php
include 'views/footer.php';
?>
