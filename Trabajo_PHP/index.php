<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link href="Style/Css.css" rel="stylesheet">
  </head>
  <body>
    <h2>
      Base de datos <u>banco</u><br>
      Tabla <u>cliente</u><br>
    </h2>
    <?php
    
      // Conexión a la base de datos
      try {
        $conexion = new PDO("mysql:host=localhost;dbname=banco;charset=utf8", "root", "");
       
        
        
        
      } catch (PDOException $e) {
        echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
        die ("Error: " . $e->getMessage());
      }
      
      $consulta = $conexion->query("SELECT dni, nombre, direccion, telefono FROM cliente");
         
      ?>
      <table border="1">
      <tr>
        <td><b>DNI</b></td>
        <td><b>Nombre</b></td>
        <td><b>Dirección</b></td>
        <td><b>Teléfono</b></td>
      </tr>

      <?php
      while ($cliente = $consulta->fetchObject()) {
        ?>
        <tr>
          <td><?= $cliente->dni ?></td>
          <td><?= $cliente->nombre ?></td>
          <td><?= $cliente->direccion ?></td>
          <td><?= $cliente->telefono ?></td>
          <td><form action="eliminarCliente.php" method="get">
                <input type="hidden"  name="dniCli" value="<?= $cliente->dni?>" >
                <input type="submit" value="Eliminar">
              </form>
          </td>
        </tr>
        <?php              
      }
      ?>
      </table>
      <br>
      Número de clientes: <?= $consulta->rowCount() ?>
      
     
  </body>
</html>
