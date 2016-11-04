<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
  </head>
  <body>
    <?php
      // Conexión a la base de datos
      try {
       $conexion = new PDO("mysql:host=localhost;dbname=escuela;charset=utf8", "root", "");
      } catch (PDOException $e) {
        echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
        die ("Error: " . $e->getMessage());
      }
      
      // Comprueba si ya existe un cliente con el DNI introducido
      $consulta = $conexion->query("SELECT clave_alumno FROM alumnos WHERE clave_alumno=".$_POST['clave']);
      
      if ($consulta->rowCount() > 0) {
      ?>
      <script>
        alert("Esta clave existe , introduzca otra clave");
        window.location="index.php";
      </script>
      
      <?php
      } else {
        $insercion = "INSERT INTO alumnos (clave_alumno, nombre,edad,curso_actual, telefono ,direccion) VALUES ('$_POST[clave]','$_POST[nombre]','$_POST[edad]','$_POST[curso] ','$_POST[telefono] ','$_POST[direccion]')";
        //echo $insercion;
        $conexion->exec($insercion);
        echo "<script>
          alert('El alumno se a añadido correctamente');
          window.location='index.php';
         </script> ";
       // $conexion=null;
      }
    ?>
  </body>
</html>
