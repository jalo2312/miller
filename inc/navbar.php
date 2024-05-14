<nav class="navbar" role="navigation" aria-label="main navigation">

    <div class="navbar-brand">
        <a href="">
        <img src="./img/movis.png" style="width: 100px ; height: 100px;">
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">

        <div class="navbar-item has-dropdown is-hoverable">
                

                
            </div>


            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Medicos</a>

                <div class="navbar-dropdown">
                    <a href="index.php?vista=equi_new" class="navbar-item">Nuevo</a>
                    <a href="index.php?vista=equi_list" class="navbar-item">Lista</a>
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Ingresos</a>

                <div class="navbar-dropdown">
                    <a href="index.php?vista=emple_new" class="navbar-item">Nueva</a>
                    <a href="index.php?vista=emple_list" class="navbar-item">Lista</a> 
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Pacientes</a>

                <div class="navbar-dropdown">
                    <a href="index.php?vista=product_new" class="navbar-item">Nuevo</a>
                    <a href="index.php?vista=product_list" class="navbar-item">Lista</a>
                </div>
            </div>
            


        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a href="index.php?vista=logout" class="button is-link is-rounded">
                        Salir
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
