<?php
require_once '../util/funciones/definiciones.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Clinica</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php include_once 'ext_estilos.php'; ?>


</head>
<!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
-->
<div class="container">
    <div class="card card-container">
        <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
        <img id="profile-img" class="profile-img-card" src="../imagenes/iniciosesion.png" />
        <p id="profile-name" class="profile-name-card"></p>
        <form class="form-signin" id="frminiciosesion">
            <span id="reauth-email" class="reauth-email"></span>
            <input type="text" id="txtdni" class="form-control" placeholder="Dni Usuario" required autofocus>
            <input type="password" id="txtclave" class="form-control" placeholder="Clave Usuaro" required>
            <div id="remember" class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
        </form><!-- /form -->
        <a href="#" class="forgot-password">
            
        </a>
    </div><!-- /card-container -->
</div><!-- /container -->

<?php include_once 'ext_scripts.php'; ?>
<script src="../js/login.js"></script>

</body>
</html>