<?php use App\Core\Routing\Router; ?>

<div class="image-banner image-banner--text" style="background-image: url('img/banner.jpg')">
    <section>
        <h1>
            <?= getConfig("nom_du_site")->getInfo(); ?>
        </h1>
    </section>
</div>

<div class="row frame">
    <div class="col-sm-12">
        <div class="row"><span>Menus</span></div>
        <div class="ligne"></div>
        <div class="row">
            <?php if(isset($menus)):
                $count = count($menus) / 2; ?>
                <div class="col-sm-12 col-md-6">
                    <div class="col-inner">
                        <?php for($i = 0; $i < $count; $i++): 
                            if(isset($menus[$i])): ?>
                                <div class="menu">
                                    <div><b><?= $menus[$i]->getNom() ?></b> <?= " - <i>".$menus[$i]->getEntree()->getNom()
                                        .", ".$menus[$i]->getPlat()->getNom().", ".$menus[$i]->getDessert()->getNom() ?></i></div>
                                    <div><?= $menus[$i]->getPrix() ?></div>
                                </div>
                            <?php endif;
                        endfor; ?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="col-inner">
                        <?php if (count($menus)%2 != 0){ $count++; }
                        for($i = $count; $i < count($menus); $i++): 
                            if(isset($menus[$i])): ?>
                                <div class="menu">
                                    <div><b><?= $menus[$i]->getNom() ?></b> <?= " - <i>".$menus[$i]->getEntree()->getNom()
                                        .", ".$menus[$i]->getPlat()->getNom().", ".$menus[$i]->getDessert()->getNom() ?></i></div>
                                    <div><?= $menus[$i]->getPrix() ?></div>
                                </div>
                            <?php endif;
                        endfor; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="row more"><a href="<?= Router::getRouteByName('menus')->getUrl() ?>">Voir plus</a></div>
    </div>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="col-inner">
            <div id="slider">
                <?php 
                    $files = glob('img/slider/*.{jpg,png,gif}', GLOB_BRACE);
                    foreach($files as $file) {
                      echo "<img src='$file'>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<?php if(! empty($article)): ?>
    <div class="row frame">
        <div class="col-sm-12">
            <div class="row"><span>Dernier article</span></div>
            <div class="ligne"></div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-inner article">
                        <?= $article->getContent(); ?>
                    </div>
                </div>
            </div>
            <div class="row more"><a href="<?= Router::getRouteByName('actualites.show', $article->getId())->getUrl() ?>">Voir plus</a></div>
        </div>
    </div>
<?php endif; ?>