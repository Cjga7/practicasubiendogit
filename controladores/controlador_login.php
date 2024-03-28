<?php
//include_once "../modelo/mod_login.php";
if ($_POST) {
    if (isset($_POST["usuario"]) and $_POST["usuario"]) {
        $usuario=htmlspecialchars($_POST["usuario"]);
    }
    if (isset($_POST["pass"]) and $_POST["pass"]) {
        $pass=htmlspecialchars($_POST["pass"]);
    }
    $login=new Login();
    $login->asignar("usuario",$usuario);
    $login->asignar("pass",$pass);
    $login->validar();
}else{
    echo "no hay post";
}