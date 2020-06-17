<?php
use App\Core\Routing\Router;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Front</title>
    <link href="<?= url('scss/dist/main.css') ?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="<?= url('js/navbar.js') ?>"></script>
    <script src="<?= url('js/top.js') ?>"></script>
    <script src="<?= url('js/slider.js') ?>"></script>
</head>
<body>
<header id="navbar" class="navbar navbar--fixed bg-white">
    <a href="<?= Router::getRouteByName('home')->getUrl() ?>"><img src="<?= url('img/logo.png') ?>" style="height:60px"></img></a>

    <nav class="navbar-front">
        <a href="<?= Router::getRouteByName('menus')->getUrl() ?>">Menus</a>
        <a href="#">Réservations</a>
        <a href="<?= Router::getRouteByName('actualites.index')->getUrl() ?>">Actualités</a>
        </a>
    </nav>

    <div id="navbar-front-mobile" class="navbar-front-mobile">
        <a href="" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="<?= Router::getRouteByName('menus')->getUrl() ?>">Menus</a>
        <a href="#">Réservations</a>
        <a href="<?= Router::getRouteByName('actualites.index')->getUrl() ?>">Actualités</a>
    </div>

    <div class="dropdown dropdown-front">
        <button class="btn-dropdown bg-white"><img src="<?= url('img/icones/user.png') ?>"></button>
        <div class="dropdown-content">
            <a href="#"><img src="<?= url('img/icones/profil.png') ?>"> Profil</a>
            <a href="#"><img src="<?= url('img/icones/settings.png') ?>"> Paramètres</a><hr/>
            <a href="#"><img src="<?= url('img/icones/logout.png') ?>"> Se déconnecter</a>
        </div>
    </div>
    <span class="burger" onclick="openNav()">&#9776;</span>
</header>

<?php include $this->viewPath;?>

<footer>
    <div class="left">
        <div>
            <p><a href="<?= Router::getRouteByName('contact.index')->getUrl() ?>" target="_blank">Nous contacter</a></p>
            <a href="#" target="_blank"><img src="<?= url('img/icones/linkedin.png') ?>"></a>
            <a href="#" target="_blank"><img src="<?= url('img/icones/facebook.png') ?>"></a>
            <a href="#" target="_blank"><img src="<?= url('img/icones/instagram.png') ?>"></a>
        </div>
    </div>
    <div class="right">
        <button class="btn-footer" id="scroll_to_top">
            <div class="circle">
                <span class="arrow up"></span><br>
                Top
            </div>
        </button>
    </div>
    </div>
</footer>
</body>
</html>