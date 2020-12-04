<div class="">
    <div class="form-group" style="display: flex;width: 100%; margin-top: 20px; margin-right:20px;">

        <label for="action"></label>
        <input type="hidden" class="form-control item-menu" id="action" name="action"
               placeholder="action...">
        <div><button type="button" id="ac_btn"  style="margin-right: 10px" class="btn btn-sm btn-primary"><i class="far fa-copy"></i></button></div>

        <select class="js-example-programmatic " style="width:50%;" name="action" id="vall">
            <option></option>
            <?

            use zetsoft\system\helpers\ZArrayHelper;
            use zetsoft\system\helpers\ZJsonHelper;

            $datas = ZArrayHelper::map($actions, 'id', 'data');

            $icons = ZArrayHelper::map($actions, 'id', 'icon');

            $titles = ZArrayHelper::map($actions, 'id', 'title');

            $iconsJS = ZJsonHelper::encode($icons);

            foreach ($datas as $key => $action):
                ?>
                <option value="<?= $key ?>"><?= $action ?></option>
            <?

            endforeach;
            ?>
        </select>

        <label for="param" style="margin-right: 10px; margin-left: 5px;"></label>
        <i class="fas fa-cubes iconn"></i>
        <input type="text" class="form-control item-menu" style="width:45%;height: 35px; margin-right: 20px !important;" id="param" name="param" placeholder="Параметр">

    </div>
</div>

