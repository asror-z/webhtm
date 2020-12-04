<div class="form-group" style="display: flex;width: 100%; margin-top: 20px; ">
    <label for="action" style="margin-right: 10px;"></label>
    <input type="hidden" class="form-control item-menu" id="action" name="action"
           placeholder="action...">
    <i class="fas fa-keyboard iconn"></i>
    <select class="js-example-programmatic " style="width:50%;" name="action" id="vall">
        <option></option>
        <?

        use zetsoft\system\helpers\ZArrayHelper;
        use zetsoft\system\helpers\ZJsonHelper;

        $datas = ZArrayHelper::map($actions, 'data', 'data');

        $icons = ZArrayHelper::map($actions, 'data', 'icon');

        $titles = ZArrayHelper::map($actions, 'data', 'title');

        $text = ZArrayHelper::map($actions, 'data', 'text');

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
    <input  type="hidden" class="form-control item-menu" id="paramVal" name="param">
    <input type="text" class="form-control item-menu" style="width:45%;height: 35px;" id="param"
           name="param" placeholder="Параметр">

</div>
