<div class="pageBuilder row padding-0">
    <div class="col-sm-12">
        <div class="col-inner padding-0">
            <div id="page" class="page padding-0">
                <div class="pageBuilder-container-hidden">
                    <div class="pageBuilder-btn-add">+</div>
                </div>
            </div>
        </div>
    </div>
</div>
<form method="post" action="<?= route('admin.page.store')->getUrl() ?>">
    <input type="submit" value="Submit" />
</form>