<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sistema EasyWaste</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="login/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/css/util.css">
    <link rel="stylesheet" type="text/css" href="login/css/main.css">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background-image: url('login/images/fndr.png');">
        <div class="wrap-login100" >
            <form class="login100-form validate-form" id="frminiciosesion">
<!--					<span class="login100-form-logo"  style="height: 240px; width: 230px" >-->
					<span class="login100-form-logo"   >
						<img src="login/images/mundo_opt.png" >
					</span>

                <span class="login100-form-title p-b-34 p-t-27">
						EasyWaste
					</span>
                <p style="text-align: center">Inicio Sesión</p>


                <div class="wrap-input100 validate-input" data-validate = "Enter username">
                    <select class="input100"  name="txtrol" id="txtrol" style="background-color: #02d49d"></select>
                    <span class="focus-input100" data-placeholder="&#xf209;"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate = "Enter username">
                    <input class="input100" type="text"  id="txtdni" placeholder="Ingrese DNI"
                           onkeypress="return numeros(event);" maxlength="8">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>

                <div class="wrap-input100 validate-input"  data-validate="Enter password">
                    <input class="input100" type="password" name="txtclave" id="txtclave" placeholder="Ingrese Contraseña">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>

<!--                <div class="contact100-form-checkbox">-->
<!--                    <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">-->
<!--                    <label class="label-checkbox100" for="ckb1">-->
<!--                        Remember me-->
<!--                    </label>-->
<!--                </div>-->

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Ingresar
                    </button>
                </div>
                <div class="text-center p-t-90">
                    <a class="txt1" href="#">
                        
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="login/vendor/bootstrap/js/popper.js"></script>
<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="login/vendor/daterangepicker/moment.min.js"></script>
<script src="login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="login/js/main.js"></script>

<script src="js/roles.js"></script>
<script src="js/login.js"></script>
<script src="js/validacion.js"></script>

</body>
</html>