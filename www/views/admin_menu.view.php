<div class="row">
    <div class="col-sm-12">
        <div class="col-inner">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Liste des article</h3>
                    <a href="<?= helpers::getUrl("Menu", "add")?>" class="btn btn-add">Ajouter</a>
                </div>
                <div class="box-body">
                    <?php $this->addModal("table-show", $configTableMenu );?>
                </div>
            </div>
        </div>
    </div>
</div>