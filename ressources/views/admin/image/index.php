<?php
use App\Core\Routing\Router;
?>
<div class="row">
    <div class="col-sm-12">
        <div class="col-inner">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Liste des Images</h3>
                    <a href="<?= Router::getRouteByName('admin.image.create')->getUrl() ?>" class="btn btn-add">Ajouter</a>
                
                </div>
                <div class="box-body">
                    <?php $this->addModal("table_show", $configTableImage); ?>
                </div>
            </div>
        </div>
    </div>
</div>