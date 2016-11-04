<?php
session_start();
$_SESSION['accesopermitido'] = false;
if (!isset($_SESSION['contadoracceso'])) {

  $_SESSION['pas'] = 1234;
  $_SESSION['contadoracceso'] = 0;
  $_SESSION['user'] = "usuario";
  $_SESSION['mal'] =true;
}
?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
    <style>

      *{
        margin: 0xp;
        padding: 0px;
      }
      body{
        background-color: aqua;
      }
      div{
        background-color:#ccccff; 
        width: 450px;
        border:1px aqua solid;
        margin-left: 32%;
        margin-top: 10%;
        text-align: center;  

      }



    </style>
    <?php
  //No entra si la contraseña no se ha enviado  
    if (isset($_REQUEST['clave'])) {
      $_SESSION['contadoracceso'] += 1;
      $claveintro = $_REQUEST['clave'];
      $usuariointro = $_REQUEST['usuario'];
      
 //-----------------Compruebo que la clave y el usuario son correcto --------------------//
      if ($claveintro == $_SESSION['pas'] && ($usuariointro == $_SESSION['user'])) {

        $_SESSION['accesopermitido'] = true;
        $_SESSION['mal'] == false; //Comprueba si esta mala la contraeña
        
 //----------------Envio a las personas a las pagina que se a entrado con primera--------------//
        if ($_SESSION['index'] == true) {
          echo '<script type="text/javascript">
            
                      alert("Has iniciado sesion correctamente");
                      window.location="index.php";
                      
              </script>';
        }
      }
      if (!$_SESSION['mal'] == true) {
        echo '<h1>Contraseña incorrecta</h1>';
      }

      if (isset($_REQUEST['cerrar'])) {


        session_destroy();
        header("refresh: 0;"); // refresca la página
      }
    }
    ?>
  </head>
  <body>
    <?php
    if ($_SESSION['accesopermitido'] == false) {
      ?>
      <div>
        <h1>Iniciar sesion</h1>
        <form action="#" method="GET">

          <input type="text" name="usuario" placeholder="Usuario" autofocus required><br> 
          <input type="password" name="clave" placeholder="Clave" required><br>   
          <input type="submit" value="Aceptar">

        </form>   
        <?php
      }
      ?>
      <br><form action="#" method="GET">  

        <button name="cerrar" > close session</button>     

      </form>
    </div>
  </body>
</html>
