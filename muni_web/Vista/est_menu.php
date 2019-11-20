<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../imagenes/user.png" class="img-circle" alt="User Image">
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
            <li class="header">MENÚ DESPLEGABLE</li>
            <li class="treeview" >
                <a href="#">
                    <img src="../imagenes/perfil.png" style="width: 1.5em" alt="">
                    <span style="color: #01a189">Mi Perfil</span>
                </a>
            </li>
            <li class="treeview" id="menu_recicladores">
                <a href="#">
                    <img src="../imagenes/trash.jpg" style="width: 1.5em" alt="">
                    <span style="color: #01a189">Reciclador</span>
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
                    <span style="color: #01a189">Proveedor</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="proveedor.php" ><i class="fa fa-circle-o"></i> Nuevo</a></li>
                    <li><a href="proveedor_list.php"><i class="fa fa-circle-o"></i> Lista</a></li>
                </ul>
            </li>
            <li class="treeview" id="menu_criterios">
                <a href="#">
                    <img src="../imagenes/criterios.png" style="width: 1.5em" alt="">
                    <span style="color: #01a189">Criterios</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="codigo_criterio.php" ><i class="fa fa-circle-o"></i> Código Ingreso</a></li>
                    <li><a href="criterios.php" ><i class="fa fa-circle-o"></i> Comparacion</a></li>
                    <li><a href="criterios_datos_recicladores.php" ><i class="fa fa-circle-o"></i> Normalizacion</a></li>
                    <li><a href="criterios_vectores.php" ><i class="fa fa-circle-o"></i> Vectores</a></li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->