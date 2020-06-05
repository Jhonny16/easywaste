<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../imagenes/user1-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p id="menu_user"></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Activo</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">

        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header"></li>
            <li><a href="vista_perfil.php"><img src="../imagenes/perfilimagen.png" style="width: 1.5em">
                    <span style="color: #00a65a">Mi Perfil</span>
                    </a></li>
            <li class="treeview" id="menu_mantenimiento">
            <li class="treeview">
                <a href="#">
                    <img src="../imagenes/mantenimiento.png" style="width: 1.5em" alt="">
                    <span style="color: #00a65a">Mantenimientos</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview" id="menu_recicladores">
                        <a href="#">
                            <img src="../imagenes/trash.jpg" style="width: 1.5em" alt="">
                            <span style="color: #00a65a">Reciclador</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="reciclador.php" ><i class="fa fa-circle-o"></i> Nuevo</a></li>
                            <li><a href="reciclador_list.php"><i class="fa fa-circle-o"></i> Lista</a></li>
                        </ul>
                    </li>
                    <li class="treeview" id="menu_proveedores">
                        <a href="#">
                            <img src="../imagenes/persona.png" style="width: 1.5em" alt="">
                            <span style="color: #00a65a">Proveedor</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="proveedor.php" ><i class="fa fa-circle-o"></i> Nuevo</a></li>
                            <li><a href="proveedor_list.php"><i class="fa fa-circle-o"></i> Lista</a></li>
                        </ul>
                    </li>
                    <li class="treeview" id="menu_pintrash">
                        <a href="#">
                            <img src="../imagenes/pintrash.jpg" style="width: 1.5em" alt="">
                            <span style="color: #01a189">Pintrash</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="pintrash_intercambio.php" ><i class="fa fa-circle-o"></i> Canjear</a></li>
                        </ul>
                    </li>
                    <li class="treeview" id="menu_premio">
                        <a href="#">
                            <img src="../imagenes/premio.png" style="width: 1.5em" alt="">
                            <span style="color: #01a189">Premios</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="premios_lista.php" ><i class="fa fa-circle-o"></i> Lista</a></li>
                        </ul>
                    </li>
                    <li class="treeview" id="menu_premio">
                        <a href="#">
                            <img src="../imagenes/centro_acopio.png" style="width: 1.5em" alt="">
                            <span style="color: #01a189">Centro Acopio</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="centro_acopio.php" ><i class="fa fa-circle-o"></i> Temporal</a></li>
                            <li><a href="centro_acopio_final.php" ><i class="fa fa-circle-o"></i> Final</a></li>
                        </ul>
                    </li>
                    <li class="treeview" id="menu_premio">
                        <a href="#">
                            <img src="../imagenes/informacion.png" style="width: 1.5em" alt="">
                            <span style="color: #01a189">Información</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="informacion_list.php" ><i class="fa fa-circle-o"></i> Lista</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            </li>
<!--            <li class="treeview" id="menu_recicladores">-->
<!--                <a href="#">-->
<!--                    <img src="../imagenes/trash.jpg" style="width: 1.5em" alt="">-->
<!--                    <span style="color: #00a65a">Reciclador</span>-->
<!--                    <span class="pull-right-container">-->
<!--                        <i class="fa fa-angle-left pull-right"></i>-->
<!--                    </span>-->
<!--                </a>-->
<!--                <ul class="treeview-menu">-->
<!--                    <li><a href="reciclador.php" ><i class="fa fa-circle-o"></i> Nuevo</a></li>-->
<!--                    <li><a href="reciclador_list.php"><i class="fa fa-circle-o"></i> Lista</a></li>-->
<!--                </ul>-->
<!--            </li>-->
<!--            <li class="treeview" id="menu_proveedores">-->
<!--                <a href="#">-->
<!--                    <img src="../imagenes/persona.png" style="width: 1.5em" alt="">-->
<!--                    <span style="color: #00a65a">Proveedor</span>-->
<!--                    <span class="pull-right-container">-->
<!--                        <i class="fa fa-angle-left pull-right"></i>-->
<!--                    </span>-->
<!--                </a>-->
<!--                <ul class="treeview-menu">-->
<!--                    <li><a href="proveedor.php" ><i class="fa fa-circle-o"></i> Nuevo</a></li>-->
<!--                    <li><a href="proveedor_list.php"><i class="fa fa-circle-o"></i> Lista</a></li>-->
<!--                </ul>-->
<!--            </li>-->
            <li class="treeview" id="menu_criterios">
                <a href="#">
                    <img src="../imagenes/criterios.png" style="width: 1.5em" alt="">
                    <span style="color: #00a65a">Criterios</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="periodo.php" ><i class="fa fa-circle-o"></i> Períodos</a></li>
                    <li><a href="codigo_criterio.php" ><i class="fa fa-circle-o"></i> Código Ingreso</a></li>
                    <li><a href="criterios.php" ><i class="fa fa-circle-o"></i> Comparacion</a></li>
                    <li><a href="criterios_datos_recicladores.php" ><i class="fa fa-circle-o"></i> Normalizacion</a></li>
                    <li><a href="criterios_vectores.php" ><i class="fa fa-circle-o"></i> Vectores</a></li>
                </ul>
            </li>
            <li class="treeview" id="menu_venta">
                <a href="#">
                    <img src="../imagenes/store.png" style="width: 1.5em" alt="">
                    <span style="color: #01a189">Almacenamiento</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
<!--                    <li><a href="almacen.php" ><i class="fa fa-circle-o"></i> Nueva</a></li>-->
                    <li><a href="almacen_lista.php" ><i class="fa fa-circle-o"></i> Lista</a></li>
                </ul>
            </li>
            <li class="treeview" id="menu_almacen">
                <a href="#">
                    <img src="../imagenes/venta.png" style="width: 1.5em" alt="">
                    <span style="color: #01a189">Ventas</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
<!--                    <li><a href="venta.php" ><i class="fa fa-circle-o"></i> Nueva</a></li>-->
                    <li><a href="venta_lista.php" ><i class="fa fa-circle-o"></i> Lista</a></li>
                </ul>
            </li>

<!--            <li class="treeview" id="menu_premio">-->
<!--                <a href="#">-->
<!--                    <img src="../imagenes/premio.png" style="width: 1.5em" alt="">-->
<!--                    <span style="color: #01a189">Premios</span>-->
<!--                    <span class="pull-right-container">-->
<!--                        <i class="fa fa-angle-left pull-right"></i>-->
<!--                    </span>-->
<!--                </a>-->
<!--                <ul class="treeview-menu">-->
<!--                    <li><a href="premios_lista.php" ><i class="fa fa-circle-o"></i> Lista</a></li>-->
<!--                </ul>-->
<!--            </li>-->

            <li class="treeview" id="menu_reporte">
                <a href="#">
                    <img src="../imagenes/report.png" style="width: 1.5em" alt="">
                    <span style="color: #01a189">Reportes</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="reporte_ventas.php" ><i class="fa fa-circle-o"></i> Ventas</a></li>
                    <li><a href="reporte_criterios.php" ><i class="fa fa-circle-o"></i> Prioridad reciclador</a></li>
                    <li><a href="reporte_recoleccion_zona_grafic.php" ><i class="fa fa-circle-o"></i> Recoleccion por zona</a></li>
                    <li><a href="reporte_provee_reciclador.php" ><i class="fa fa-circle-o"></i> Proveedores por reciclador</a></li>
                    <li><a href="reporte_sensibilizacion.php" ><i class="fa fa-circle-o"></i> Sensibilizacion</a></li>
                </ul>
            </li>


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->