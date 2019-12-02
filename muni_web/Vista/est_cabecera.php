<header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo" style="background: #00a65a">
        <!-- mini logo for sidebar mini 50x50 pixels 
        <span class="logo-mini"><img src="../login/images/mundo_opt.png" style="width: 2em" alt=""></span>
        logo for regular state and mobile devices -->
        <span class="logo-lg">EasyWaste</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top"
         style="text-align: center;background-image: linear-gradient(500deg, rgb(0, 166, 90) 200px, rgb(0, 166, 90)60%);">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <input type="date" id="fecha_registro" style="display: none" value="<?php
            date_default_timezone_set("America/Lima");
            echo date('Y-m-d');
            ?>">
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
<!--                        <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
                        <span class="hidden-xs" id="cabecera_user"></span>
                    </a>

                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" title="Salir"onclick="out_login()"><img src="../imagenes/close.png" style="width: 1.5em;height: 1.5em" alt=""></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
