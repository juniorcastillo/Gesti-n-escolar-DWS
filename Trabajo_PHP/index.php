<?php
session_start();
$_SESSION['index'] = true;
//-----------Compruebo si han iniciado session -------------------//
if ($_SESSION['accesopermitido'] == true) {
  ?>
  <!DOCTYPE html>

  <html>
    <head>
      <meta charset="UTF-8">
      <link href="Style/Css.css" rel="stylesheet">
    </head>
    <body>
      <div id="contenedor">
        <h1>Gestion de alumnos</h1>
  <?php
  // Conexión a la base de datos
  try {
    $conexion = new PDO("mysql:host=localhost;dbname=escuela;charset=utf8", "root", "");
  } catch (PDOException $e) {
    echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
    die("Error: " . $e->getMessage());
  }

  $consulta = $conexion->query("SELECT * FROM alumnos order by 1");
  ?>
        <table border="1">
          <tr>
            <th>Clave alumno</th>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Curso actual</th>
            <th>Teléfono</th>
            <th>Dirección</th>

          </tr>

  <?php
  while ($alum = $consulta->fetchObject()) {
    ?>
            <tr>
              <td><?= $alum->clave_alumno ?></td>
              <td><?= $alum->nombre ?></td>
              <td><?= $alum->edad ?></td>
              <td><?= $alum->curso_actual ?></td>
              <td><?= $alum->telefono ?></td>
              <td><?= $alum->direccion ?></td>
              
<!--*********************** Elimino jr estudiantes ********************************-->  
       
              <td><form action="baja_Alumno.php" method="GET">
                  <input type="hidden"  name="clave" value="<?= $alum->clave_alumno ?>" >
                  <input type="submit" value="Eliminar">
                </form>
              </td>
            </tr>
    <?php
  }
  ?>
          
<!-- *********************** Añado estudiantes nuevos jr************************* -->  
        
            <tr><form action="alta_Alumno.php" method="post">
             <td>Clave <input type="number" name="clave" size="1"  min="1" max="300" required ></td>
              <td>Nombre <input type="text" name="nombre" required></td>
              <td>Edad <input type="number" name="edad" size="1"  min="5" max="20" required ></td>
              <td>Curso_Altual <input type="number" name="curso"   min="1" max="4" required ></td>
              <td> Teléfono <input type="tel" name="telefono" required></td>
              <td> Dirección <input type="text" name="direccion" required></td>
             
              <td><input type="submit" value="Añadir">
             </form></td></tr>
             
        </table>
        <br>
        Número de clientes: <?= $consulta->rowCount() ?>

      </div>
    </body>
  </html>
  <?php
} else {
//--------------Si no ha iniciado session se envia a la pagina para que inicie session ------------------------- //
  echo '<script type="text/javascript">
           alert("iniciar sesion");
           window.location="control_Usuario.php";
          </script>';
}
?>