<?php

use App\Core\Routing\Router;

?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="scss/dist/main.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
    <script src="<?= url('js/dashboard/dashboard-graphs.js') ?>"></script>
    <script src="js/navbar.js"></script>
</head>
<body>
<div class="row padding-0">
    <div class="col-sm-2 padding-0">
        <div class="col-inner sidebar">
            <nav class="sidebar-nav">
                <a href="" class="sidebar-link">Dashboard<img src='<?= url('/img/arrow.svg') ?>'></a>
                <a href="" class="sidebar-link">Articles<img src='<?= url('img/arrow.svg') ?>'></a>
                <a href="<?= Router::getRouteByName('admin.menu.show') ?>" class="sidebar-link">Menus<img src='<?= url('/img/arrow.svg') ?>'></a>
                <a href="" class="sidebar-link">Réservations<img src='<?= url('/img/arrow.svg')?>'></a>
                <a href="" class="sidebar-link">Plans<img src='<?= url('/img/arrow.svg') ?>'></a>
                <a href="" class="sidebar-link">Utilisateurs<img src='<?= url('/img/arrow.svg') ?>'></a>
                <a href="" class="sidebar-link">Paramètres<img src='<?= url('/img/arrow.svg') ?>'></a>
                <nav>
        </div>
    </div>

    <div class="col-sm-10 padding-0">
        <div class="row padding-0">
            <div class="col-sm-12 padding-right-0 padding-left-0">
                <div class="col-inner navbar bg-white">
                    <div class="navbar-back">
                        <form class="navbar-search">
                            <span class="search-icon"><img src="public/img/icones/search.png"></span>
                            <input class="form-control" type="text" placeholder="Recherche">
                        </form>

                        <a class="computer" href="#">
                            <img src="public/img/icones/computer.png">
                            <span>DivinEat</span>
                        </a>
                    </div>

                    <div class="dropdown">
                        <button class="btn-dropdown bg-white"><img src="public/img/icones/user.png"></button>
                        <div class="dropdown-content">
                            <a href="#"><img src="public/img/icones/profil.png"> Profil</a>
                            <a href="#"><img src="public/img/icones/settings.png"> Paramètres</a><hr/>
                            <a href="#"><img src="public/img/icones/logout.png"> Se déconnecter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="col-inner">
                    <?php include $this->viewPath;?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>