<?php
use App\Core\Routing\Router;
?>

<h1 class="title"><?= getConfig("nom_du_site")->getInfo(); ?></h1>

<div class="card">
	<h2 class="title color-purple margin-0">Inscription</h2>
	<p class="subtitle margin-bottom-75">Veuillez remplir les champs</p>
	
	<?php $this->formView("registerForm", "auth", "registerForm"); ?>
</div>

<a href="<?= Router::getRouteByName('home')->getUrl() ?>" class="btn btn-account">Retour au site</a>