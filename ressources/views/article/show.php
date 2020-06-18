<?php
use App\Core\Routing\Router;
?>
<div style="height: 4em;"></div>

<?php if(isset($article)): ?>
    <div class="row frame">
        <div class="col-sm-12">
            <div class="row"><span><?= $article->getTitle(); ?></span></div>
            <div class="ligne"></div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-inner show-article">
                        <?= $article->getContent(); ?>
                    </div>
                </div>
            </div>
            <div class="row more"><a href="<?= Router::getRouteByName('actualites.index')->getUrl() ?>">Retour</a></div>
        </div>
    </div>
<?php endif; ?>